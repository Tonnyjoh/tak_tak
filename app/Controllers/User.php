<?php


namespace App\Controllers;
use App\Models\UserModel;
use ReflectionException;

class User extends BaseController
{
    public function index(): \CodeIgniter\HTTP\RedirectResponse
    {

        if (session()->get('isLoggedIn') && session()->get('role')=='client') {
            return redirect()->to('/user/dashboard');
        }elseif (session()->get('isLoggedIn') && session()->get('role')=='admin') {
            return redirect()->to('/admin/dashboard');
        }
        return redirect()->to('/auth/login');
    }

    public function dash(): string
    {
        $id = session()->get('user_id');

        $userModel = new UserModel();
        $data['user'] = $userModel->find($id);

        $db = db_connect();

        $sql = 'SELECT items.*, GROUP_CONCAT(item_photos.photo_url) AS photos 
            FROM items 
            LEFT JOIN item_photos ON items.id = item_photos.item_id 
            WHERE items.user_id = :user_id:
            GROUP BY items.id';

        $query = $db->query($sql, [
            'user_id' => $id,
        ]);

        $data['items'] = $query->getResultObject();
        return view('Dashboard/infoUser_view', $data);
    }


    public function getUpdate(): string
    {
        $id=session()->get('user_id');
        $userModel = new UserModel();
        $data['user'] = $userModel->find($id);

        if (empty($data['user'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Utilisateur non trouvé');
        }

        return view('User/edit', $data);
    }
    /**
     * @throws ReflectionException
     */
    public function update(): \CodeIgniter\HTTP\RedirectResponse
    {
        $id=session()->get('user_id');
        $userModel = new UserModel();
        $dataUser=[
            "email"=>$this->request->getPost("email"),
            "password"=>password_hash($this->request->getPost("password"), PASSWORD_DEFAULT),
        ];
        $userModel->update($id,$dataUser);
        return redirect()->to('/user/dashboard');
    }

}
