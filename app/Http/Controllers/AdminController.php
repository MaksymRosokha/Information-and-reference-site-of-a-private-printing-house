<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCRUDRequest;
use App\Http\Requests\ProductCRUDRequest;
use App\Http\Requests\ServiceCRUDRequest;
use App\Models\Post;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    private const PATH_TO_SERVICE_IMAGES = 'storage/images/services/';
    private const DEFAULT_SERVICE_IMAGE = 'default/defaultServiceImage.png';

    private const PATH_TO_PRODUCT_IMAGES = 'storage/images/products/';
    private const DEFAULT_PRODUCT_IMAGE = 'default/defaultProduct.png';

    private const PATH_TO_POST_IMAGES = 'storage/images/posts/';
    private const DEFAULT_POST_IMAGE = 'default/defaultNews.jpg';

    public function showAdminPage()
    {
        return view('users.admin', [
            'services' => Service::all()->toArray(),
            'products' => Product::all()->toArray(),
            'posts' => Post::all()->toArray(),
        ]);
    }

    public function createService(ServiceCRUDRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $image = $this->moveImageToStorage(
                imageData: $request->file('image'),
                pathToFolder: AdminController::PATH_TO_SERVICE_IMAGES
            );
        } else {
            $image = AdminController::DEFAULT_SERVICE_IMAGE;
        }

        Service::create([
            'name' => $data['name'],
            'type' => $data['type'],
            'image' => $image,
        ]);
    }

    public function updateService(ServiceCRUDRequest $request)
    {
        $data = $request->validated();
        $service = Service::whereId($data['serviceID'])->firstOrFail();
        $image = $service->image;

        if ($request->hasFile('image')) {
            if (Storage::exists('public/images/services/' . $service->image)
                && $image !== 'default/defaultServiceImage.png') {
                Storage::delete('public/images/services/' . $service->image);
            }
            $image = $this->moveImageToStorage(
                imageData: $request->file('image'),
                pathToFolder: AdminController::PATH_TO_SERVICE_IMAGES
            );
        }

        $service->update([
            'name' => $data['name'],
            'type' => $data['type'],
            'image' => $image,
        ]);
    }

    public function deleteService(ServiceCRUDRequest $request)
    {
        $data = $request->validated();
    }

    public function createProduct(ProductCRUDRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $image = $this->moveImageToStorage(
                imageData: $request->file('image'),
                pathToFolder: AdminController::PATH_TO_PRODUCT_IMAGES
            );
        } else {
            $image = AdminController::DEFAULT_PRODUCT_IMAGE;
        }

        $product = [
            'service_id' => $data['serviceID'],
            "name" => $data['name'],
            "image" => $image,
            "price" => $data['price'],
        ];
        DB::table('products')->insert($product);
    }

    public function updateProduct(ProductCRUDRequest $request)
    {
        $data = $request->validated();
        $product = Product::whereId($data['productID'])->firstOrFail();
        $image = $product->image;

        if ($request->hasFile('image')) {
            if (Storage::exists('public/images/products/' . $product->image)
                && $image !== 'default/defaultProduct.png') {
                Storage::delete('public/images/products/' . $product->image);
            }
            $image = $this->moveImageToStorage(
                imageData: $request->file('image'),
                pathToFolder: AdminController::PATH_TO_PRODUCT_IMAGES
            );
        }

        $product->update([
            'service_id' => $data['serviceID'],
            'name' => $data['name'],
            'price' => $data['price'],
            'image' => $image,
            'created_at' => date('Y-m-d H.i.s'),
            'updated_at' => date('Y-m-d H.i.s'),
        ]);
    }

    public function deleteProduct(ProductCRUDRequest $request)
    {
        $data = $request->validated();
    }

    public function createPost(PostCRUDRequest $request)
    {
        $data = $request->validated();
        if ($request->hasFile('image')) {
            $image = $this->moveImageToStorage(
                imageData: $request->file('image'),
                pathToFolder: AdminController::PATH_TO_POST_IMAGES
            );
        } else {
            $image = AdminController::DEFAULT_POST_IMAGE;
        }

        $post = [
            "title" => $data['title'],
            "image" => $image,
            "content" => $data['content'],
            'created_at' => date('Y-m-d H.i.s'),
            'updated_at' => date('Y-m-d H.i.s'),
        ];
        DB::table('posts')->insert($post);
    }

    public function updatePost(PostCRUDRequest $request)
    {
        $data = $request->validated();
        $post = Post::whereId($data['postID'])->firstOrFail();
        $image = $post->image;

        if ($request->hasFile('image')) {
            if (Storage::exists('public/images/posts/' . $post->image)
                && $image !== 'default/defaultNews.jpg') {
                Storage::delete('public/images/posts/' . $post->image);
            }
            $image = $this->moveImageToStorage(
                imageData: $request->file('image'),
                pathToFolder: AdminController::PATH_TO_POST_IMAGES
            );
        }

        $post->update([
            'title' => $data['title'],
            'content' => $data['content'],
            'image' => $image,
        ]);
    }

    public function deletePost(PostCRUDRequest $request)
    {
        $data = $request->validated();
    }

    private function moveImageToStorage($imageData, string $pathToFolder): string
    {
        $newImageName = $this->generateRandomString(20) .
            '=' .
            date('Y-m-d~H.i.s') .
            '.' .
            $imageData->getClientOriginalExtension();

        $imageData->move(
            public_path($pathToFolder),
            $imageData->getClientOriginalName()
        );
        rename(
            public_path($pathToFolder) . $imageData->getClientOriginalName(),
            public_path($pathToFolder) . $newImageName
        );

        return $newImageName;
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
}
