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
        $query = $db->query($sql, ['user_id' => $id]);
        $data['items'] = $query->getResultObject();

        $exchange_sql = 'SELECT e.id, e.offered_item_id, e.requested_item_id, e.exchange_date, e.status,
                            i1.title AS offered_item_title, i2.title AS requested_item_title,
                            u1.username AS requester_name, u2.username AS recipient_name
                     FROM exchanges e
                     JOIN items i1 ON e.offered_item_id = i1.id
                     JOIN items i2 ON e.requested_item_id = i2.id
                     JOIN users u1 ON i1.user_id = u1.id
                     JOIN users u2 ON i2.user_id = u2.id
                     WHERE u1.id = :user_id: OR u2.id = :user_id:';
        $exchange_query = $db->query($exchange_sql, ['user_id' => $id]);
        $data['exchanges'] = $exchange_query->getResultObject();

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
        return redirect()->to('/user/dashboard')->with('success',"Updated successfully");
    }

}
