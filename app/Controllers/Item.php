<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
use App\Models\ExchangeModel;
use App\Models\ItemModel;
use App\Models\ItemPhotoModel;
use ReflectionException;

class Item extends BaseController
{
    public function getFormCreate(): string
    {
        $categModel = new CategoryModel();
        $data['categories'] = $categModel->findAll();
        return view('item/formCreate', $data);
    }

    /**
     * @throws ReflectionException
     */
    public function create(): \CodeIgniter\HTTP\RedirectResponse
    {
        $itemModel = new ItemModel();

        $dataItem = [
            "user_id" => strip_tags($this->request->getPost("user_id")),
            'category_id' => $this->request->getPost("category_id"),
            'title' => strip_tags($this->request->getPost('title')),
            'description' => strip_tags($this->request->getPost('description')),
            'estimated_price' => strip_tags($this->request->getPost('price')),
        ];

        if ($itemModel->insert($dataItem)) {
            $itemId = $itemModel->getInsertID();
            $this->storePhotos($itemId);
            return redirect()->to('/user/dashboard')->with('success', 'Item was created successfully.');
        }

        return redirect()->to('/user/dashboard')->with('error', 'Something went wrong.');
    }

    public function getFormUpdate(): string
    {
        $itemModel = new ItemModel();
        $data['item'] = $itemModel->find($this->request->getPost("item_id"));
        return view('item/formUpdate', $data);
    }

    /**
     * Handle item update
     * @throws ReflectionException
     */
    public function update(): \CodeIgniter\HTTP\RedirectResponse
    {
        $itemModel = new ItemModel();
        $itemPhotoModel = new ItemPhotoModel();

        $dataItem = [
            'title' => strip_tags($this->request->getPost('title')),
            'description' => strip_tags($this->request->getPost('description')),
            'estimated_price' => strip_tags($this->request->getPost('estimated_price')),
            'id' => $this->request->getPost('id'),
        ];

        if ($itemModel->update($this->request->getPost('id'), $dataItem)) {
            $this->deleteOldPhotos($this->request->getPost('id'));

            $this->storePhotos($this->request->getPost('id'));

            return redirect()->to('/user/dashboard')->with('success', 'Item updated and photos replaced successfully.');
        }

        return redirect()->to('/user/dashboard')->with('error', 'Something went wrong.');
    }

    /**
     * Delete old photos before uploading new ones
     */
    public function deleteOldPhotos($itemId): void
    {
        $itemPhotoModel = new ItemPhotoModel();

        $oldPhotos = $itemPhotoModel->where('item_id', $itemId)->findAll();

        foreach ($oldPhotos as $photo) {
            $photoPath = FCPATH . 'uploads/' . $photo['photo_url'];

            if (file_exists($photoPath)) {
                unlink($photoPath);
            }

            $itemPhotoModel->delete($photo['id']);
        }
    }
    public function show($id): string
    {
        $itemModel = new ItemModel();
        $data['item'] = $itemModel->find($id);
        return view('item/showItem', $data);
    }

    public function delete($id): \CodeIgniter\HTTP\RedirectResponse
    {
        $itemModel = new ItemModel();
        $itemModel->delete($id);
        return redirect()->to('/user/dashboard')->with("success", "Item has been deleted");
    }

    /**
     *
     * @throws ReflectionException
     */
    public function storePhotos($itemId): \CodeIgniter\HTTP\RedirectResponse
    {
        $files = $this->request->getFiles();
        $itemPhotoModel = new ItemPhotoModel();

        $rules = [
            'files.*' => [
                'uploaded[files]',
                'mime_in[files,image/jpg,image/jpeg,image/png]',
                'max_size[files,2048]',
            ],
        ];

        if (!$this->validate($rules)) {
            return redirect()->back()->with('error', 'Each file must be a JPG, JPEG, or PNG image, and must not exceed 2MB.');
        }

        foreach ($files['files'] as $file) {
            if ($file->isValid() && !$file->hasMoved()) {
                $file->move(FCPATH . 'uploads');

                $fileName = $file->getName();

                $dataPhoto = [
                    'item_id' => $itemId,
                    'photo_url' => $fileName,
                ];

                $itemPhotoModel->insert($dataPhoto);
            } else {
                return redirect()->back()->with('error', 'There was an error uploading one or more files.');
            }
        }

        return redirect()->back()->with('success', 'Files uploaded successfully.');
    }

    public function getListItems(): string
    {
        $categModel = new CategoryModel();
        $userId = session()->get('user_id');
        $db = db_connect();

        $category = $this->request->getPost('category');
        $keywords = $this->request->getPost('keywords');

        $sqlItems = 'SELECT items.*, GROUP_CONCAT(item_photos.photo_url) AS photos, categories.name AS category_name 
                 FROM items 
                 LEFT JOIN item_photos ON items.id = item_photos.item_id 
                 LEFT JOIN categories ON items.category_id = categories.id
                 WHERE items.user_id != :user_id:';

        if (!empty($category)) {
            $sqlItems .= ' AND items.category_id = :category_id:';
        }

        if (!empty($keywords)) {
            $sqlItems .= ' AND items.title LIKE :keywords:';
            $keywords = '%' . $keywords . '%';
        }

        $sqlItems .= ' GROUP BY items.id';
        $queryItems = $db->query($sqlItems, [
            'user_id' => $userId,
            'category_id' => $category,
            'keywords' => $keywords,
        ]);
        $items = $queryItems->getResultObject();

        $sqlUserItems = 'SELECT * FROM items WHERE user_id = :user_id:';
        $queryUserItems = $db->query($sqlUserItems, [
            'user_id' => $userId,
        ]);
        $userItems = $queryUserItems->getResultObject();

        return view('item/listItems', [
            'items' => $items,
            'userItems' => $userItems,
            'categories' => $categModel->findAll(),
        ]);
    }



    /**
     * @throws ReflectionException
     */
    public function exchange(): \CodeIgniter\HTTP\RedirectResponse
    {
        if (!$this->request->is("post")) {
            return redirect()->back()->with('error', 'Invalid request method.');
        }

        $itemModel = new ItemModel();
        $item = $itemModel->find($this->request->getPost("item_id"));
        if (!$item) {
            return redirect()->to('/user/dashboard')->with('error', 'Item not found.');
        }

        $exchangeModel = new ExchangeModel();
        $exchangeData = [
            'offered_item_id' => strip_tags($this->request->getPost('offered_item_id')),
            'requested_item_id' => strip_tags($this->request->getPost('requested_item_id')),
            'status' => 'proposed',
        ];
        if ($exchangeModel->insert($exchangeData)) {
            return redirect()->to('/user/dashboard')->with('success', 'Exchange requested successfully.');
        }
        return redirect()->to('/user/dashboard')->with('error', 'Something went wrong.');
    }

        public function acceptExchange($exchange_id): \CodeIgniter\HTTP\RedirectResponse
        {


            $db = db_connect();

            $sql = 'SELECT offered_item_id, requested_item_id FROM exchanges WHERE id = :exchange_id:';
            $query = $db->query($sql, ['exchange_id' => $exchange_id]);
            $exchange = $query->getRow();

            if ($exchange) {
                $db->transStart();

                $offered_item_sql = 'SELECT user_id  FROM items WHERE id = :offered_item_id:';
                $requested_item_sql = 'SELECT user_id FROM items WHERE id = :requested_item_id:';

                $offered_item_query = $db->query($offered_item_sql, ['offered_item_id' => $exchange->offered_item_id]);
                $requested_item_query = $db->query($requested_item_sql, ['requested_item_id' => $exchange->requested_item_id]);

                $offered_item_user_id = $offered_item_query->getRow()->user_id;
                $requested_item_user_id = $requested_item_query->getRow()->user_id;

                $swap_sql = 'UPDATE items 
                         SET user_id = CASE 
                             WHEN id = :offered_item_id: THEN :requested_item_user_id:
                             WHEN id = :requested_item_id: THEN :offered_item_user_id:
                             END
                         WHERE id IN (:offered_item_id:, :requested_item_id:)';

                $db->query($swap_sql, [
                    'offered_item_id' => $exchange->offered_item_id,
                    'requested_item_id' => $exchange->requested_item_id,
                    'offered_item_user_id' => $offered_item_user_id,
                    'requested_item_user_id' => $requested_item_user_id,
                ]);

                $update_exchange_sql = 'UPDATE exchanges SET status = "accepted" WHERE id = :exchange_id:';
                $db->query($update_exchange_sql, ['exchange_id' => $exchange_id]);

                $historique_sql = 'INSERT INTO exchange_history (item_id, previous_owner_id, new_owner_id) 
                           VALUES (:offered_item_id:, :offered_item_user_id:, :requested_item_user_id:),
                                  (:requested_item_id:, :requested_item_user_id:, :offered_item_user_id:)';
                $db->query($historique_sql, [
                    'offered_item_id' => $exchange->offered_item_id,
                    'requested_item_id' => $exchange->requested_item_id,
                    'offered_item_user_id' => $offered_item_user_id,
                    'requested_item_user_id' => $requested_item_user_id,
                ]);

                $db->transComplete();

                if ($db->transStatus() === false) {
                    return redirect()->back()->with('error', 'Failed to accept exchange.');
                }

                return redirect()->back()->with('success', 'Exchange accepted and items swapped.');
            }

            return redirect()->back()->with('error', 'Exchange not found.');
        }

    public function declineExchange($exchange_id): \CodeIgniter\HTTP\RedirectResponse
    {
        $db = db_connect();

        $sql = 'DELETE FROM exchanges WHERE id = :exchange_id:';
        $db->query($sql, ['exchange_id' => $exchange_id]);

        return redirect()->back()->with('success', 'Exchange declined and removed.');
    }

    public function getHistory(): string
    {
        $db = db_connect();
        $item_id= $this->request->getPost("item_id");

        $db = db_connect();

        $sql = 'SELECT eh.exchange_date, u1.username AS previous_owner, u2.username AS new_owner
            FROM exchange_history eh
            JOIN users u1 ON eh.previous_owner_id = u1.id
            JOIN users u2 ON eh.new_owner_id = u2.id
            WHERE eh.item_id = ?
            ORDER BY eh.exchange_date DESC';

        $query = $db->query($sql, [$item_id]);
        $history = $query->getResultArray();
        $itemModel = new ItemModel();
        $item = $itemModel->find($item_id);
        return view('/item/item_history', ['history' => $history, 'item' => $item]);
    }
    public function searchPercent()
    {
        $db = db_connect();

        $item_id = $this->request->getPost("item_id");
        $percent = $this->request->getPost("percent");
        $user_id = session()->get('user_id');

        $sql = 'SELECT estimated_price FROM items WHERE id = ?';
        $query = $db->query($sql, [$item_id]);
        $item = $query->getRow();

        if (!$item) {
            return redirect()->to('/user/dashboard')->with('error', 'Item not found.');
        }

        $estimated_price = $item->estimated_price;

        $moins = $estimated_price * (1 - $percent / 100);
        $plus = $estimated_price * (1 + $percent / 100);

        $sql = 'SELECT * FROM items WHERE estimated_price BETWEEN ? AND ? AND user_id != ?';
        $query = $db->query($sql, [$moins, $plus, $user_id]);
        $items = $query->getResultArray();

        foreach ($items as &$item) {
            $itemPrice = $item['estimated_price'];
            $item['price_difference'] = (($itemPrice - $estimated_price) / $estimated_price) * 100;
        }

        $sql = 'SELECT id, title FROM items WHERE user_id = ?';
        $userItemsQuery = $db->query($sql, [$user_id]);
        $userItems = $userItemsQuery->getResult();

        return view('/item/search_percent', [
            'items' => $items,
            'percent' => $percent,
            'item_id' => $item_id,
            'userItems' => $userItems,
            'referencePrice' => $estimated_price
        ]);
    }












}
