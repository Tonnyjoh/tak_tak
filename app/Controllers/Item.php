<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\CategoryModel;
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

    public function getFormUpdate($id): string
    {
        $itemModel = new ItemModel();
        $data['item'] = $itemModel->find($id);
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

}
