<?php
namespace App\Controllers;
use App\Models\UserModel;
use ReflectionException;

class  Auth extends BaseController
{
    protected $helpers = ['form'];
    /**
     * @throws ReflectionException
     */
    public function register()
    {
        $userModel = new UserModel();
        $rules = [
            'username' => 'required|max_length[30]|alpha_space',
            'password' => 'required|max_length[255]|min_length[8]',
            'email'    => [
                'rules'  => 'required|max_length[254]|valid_email|is_unique[users.email]',
                'errors' => [
                    'is_unique'=> 'Email already choosen by another client',
                    'required' => 'We really need your email.',
                ],
            ],
        ];
        if ($this->request->is('post')) {
            $dataUser = $this->request->getPost(array_keys($rules));
            $dataUser["password"] = password_hash($dataUser["password"], PASSWORD_DEFAULT);
            if (! $this->validateData($dataUser, $rules)) {
                return redirect()->back()->with('error', $this->validator->listErrors());
            }
            if ($userModel->insert($dataUser)) {
                return redirect()->to('/auth/login')->with('success', 'you are registred.');
            }
        }
        return view('Auth/register_view');
    }

    public function login()
    {

        $userModel = new UserModel();

        if ($this->request->is('post')) {
            $email = $this->request->getPost('email');
            $email= strip_tags($email);
            $password = $this->request->getPost('password');
            $password= strip_tags($password);
            $user = $userModel->where('email', $email)->first();
            if ($user && password_verify($password, $user['password'])) {
                session()->set('isLoggedIn', true);
                session()->set('name', $user['username']);
                session()->set('user_id', $user['id']);
                session()->set('role', $user['role']);
                return redirect()->to('/');
            } else {
                return redirect()->back()->with('error', 'Email or password is wrong.');
            }
        }

        return view('Auth/login_view');
    }

    public function logout(): \CodeIgniter\HTTP\RedirectResponse
    {
        session()->destroy();
        return redirect()->to('auth/login')->with('success', 'Vous avez été déconnecté.');
    }



}