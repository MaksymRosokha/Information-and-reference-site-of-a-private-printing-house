<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreatePostRequest;
use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\CreateServiceRequest;
use App\Models\Post;
use App\Models\Product;
use App\Models\Service;
use Illuminate\Support\Facades\DB;

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
            'products' => response()->json(Product::all()),
            'posts' => response()->json(Post::all()),
        ]);
    }

    public function createService(CreateServiceRequest $request)
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

    public function updateService()
    {
    }

    public function deleteService()
    {
    }

    public function createProduct(CreateProductRequest $request)
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

        $product = array('service_id'=>$data['serviceID'],"name"=>$data['name'],"image"=>$image, "price"=>$data['price']);
        DB::table('products')->insert($product);
    }

    public function updateProduct()
    {
    }

    public function deleteProduct()
    {
    }

    public function createPost(CreatePostRequest $request)
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

        $post = array("title"=>$data['title'],
            "image"=>$image,
            "content"=>$data['content'],
            'created_at' => date('Y-m-d H.i.s'),
            'updated_at' => date('Y-m-d H.i.s'));
        DB::table('posts')->insert($post);
    }

    public function updatePost()
    {
    }

    public function deletePost()
    {
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
