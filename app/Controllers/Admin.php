<?php

namespace App\Controllers;

use App\Models\AccountModel;
use App\Models\CategoryModel;
use App\Models\UserModel;
use ReflectionException;

class Admin extends BaseController
{
    public function getUpdate($id): string
    {
        $userModel = new UserModel();
        $data['user'] = $userModel->find($id);

        if (empty($data['user'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('User no found: ' . $id);
        }

        return view('Admin/edit', $data);
    }
    /**
     * @throws ReflectionException
     */
    public function update($id): \CodeIgniter\HTTP\RedirectResponse
    {
        $userModel = new UserModel();
        $dataUser=[
            "username"=>$this->request->getPost("username"),
            "email"=>$this->request->getPost("email"),
        ];
        $userModel->update($id,$dataUser);
        return redirect()->to('/admin/dashboard')->with("success","User has been updated");
    }
    public function delete($id): \CodeIgniter\HTTP\RedirectResponse
    {
        $userModel = new UserModel();
        $userModel->delete($id);
        return redirect()->to('/admin/dashboard')->with("success","User has been deleted");
    }
    public function getAllDash(): string
    {
        $db = db_connect();
        $sql = 'SELECT * FROM users WHERE id <> :id: AND role <> :role: ';
        $query = $db->query($sql, [
            'id'     => session()->get('user_id'),
            'role' => 'admin',
        ]);
        $data['users']=$query->getResultObject();
        $sql= 'SELECT * FROM usage_statistics';
        $query= $db->query($sql, []);
        $data['statistics']=$query->getResultObject();
        $sql = 'SELECT COUNT(*) as user_count FROM users WHERE id <> :id: AND role <> :role:';
        $query = $db->query($sql, [
            'id'   => session()->get('user_id'),
            'role' => 'admin',
        ]);
        $data['user_count'] = $query->getRow()->user_count;

        return view('Dashboard/infoUser_view',$data);
    }

    public function getFormCateg(): string
    {
        return view('Admin/categForm');
    }

    /**
     * @throws ReflectionException
     */
    public function  createCateg(): \CodeIgniter\HTTP\RedirectResponse
    {
        $categoryModel = new CategoryModel();
        $rules = [
            'name' => 'required|max_length[30]|alpha_space',
        ];
        $dataCategory = $this->request->getPost(array_keys($rules));
        if ($categoryModel->insert($dataCategory)) {
            return redirect()->to('/admin/dashboard')->with('success', 'Category has been added.');
        }
        return redirect()->to('/admin/dashboard')->with('fail', 'Something went wrong.');
    }
    /*
     *
    public function  getAllAccounts(): string
    {
        $db = db_connect();
        $sql = 'SELECT A.id as accountId, U.username, A.balance, A.account_type, A.created_at, A.account_number FROM accounts as A INNER JOIN users as U ON A.user_id = U.id';
        $query = $db->query($sql, []);
        $data['accounts']=$query->getResultObject();

        return view('Dashboard/listAccounts', $data);
    }
    public function getAccount($id): string
    {
        $accountModel = new AccountModel();
        $data['account'] = $accountModel->find($id);
        if (empty($data['account'])) {
            throw new \CodeIgniter\Exceptions\PageNotFoundException('Account not found');
        }
        return view('Account/editAccount', $data);
    }
    public function upAccount($id): \CodeIgniter\HTTP\RedirectResponse
    {
        $accountModel = new AccountModel();
        $dataAccount=[
            "account_type"=>$this->request->getPost("account_type"),
        ];
        $accountModel->update($id,$dataAccount);
        return redirect()->to('/admin/dashboard')->with("success","User account has been updated");
    }
    public function delAccount($id): \CodeIgniter\HTTP\RedirectResponse
    {
        $accountModel = new AccountModel();
        $accountModel->delete($id);
        return redirect()->to('/admin/dashboard')->with("success","User account has been deleted");
    }
     */
}