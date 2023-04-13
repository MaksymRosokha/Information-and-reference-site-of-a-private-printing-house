<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateServiceRequest;
use App\Models\Service;

class AdminController extends Controller
{
    private const PATH_TO_SERVICE_IMAGES = 'storage/images/services/';
    private const DEFAULT_SERVICE_IMAGE = 'default/defaultServiceImage.png';

    public function showAdminPage()
    {
        return view('users.admin');
    }

    public function createService(CreateServiceRequest $request)
    {
        $data = $request->validated();
        $image = $this->moveServiceImageToStorage($request);

        Service::create([
            'name' => $data['name'],
            'type' => $data['type'],
            'image' => $image,
        ]);
    }

    private function moveServiceImageToStorage(CreateServiceRequest $request): string
    {
        if ($request->hasFile('image')) {
            $imageData = $request->file('image');
            $newImageName = $this->generateRandomString(20) .
                '=' .
                date('Y-m-d~H.i.s') .
                '.' .
                $imageData->getClientOriginalExtension();

            $request->file('image')->move(
                public_path(AdminController::PATH_TO_SERVICE_IMAGES),
                $request->file('image')->getClientOriginalName()
            );
            rename(
                public_path(AdminController::PATH_TO_SERVICE_IMAGES) . $imageData->getClientOriginalName(),
                public_path(AdminController::PATH_TO_SERVICE_IMAGES) . $newImageName
            );

            return $newImageName;
        }
        return AdminController::DEFAULT_SERVICE_IMAGE;
    }

    /**
     * Generates random string.
     *
     * @param int $length the length of the string to be generated
     * @return string generated string
     */
    private function generateRandomString(int $length = 10): string
    {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    public function updateService()
    {
    }

    public function deleteService()
    {
    }

    public function createProduct()
    {
    }

    public function updateProduct()
    {
    }

    public function deleteProduct()
    {
    }

    public function createPost()
    {
    }

    public function updatePost()
    {
    }

    public function deletePost()
    {
    }
}
