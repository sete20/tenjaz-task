<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Repositories\ProductRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function __construct(protected ProductRepository $productRepo)
    {
    }

    public function index(Request $request)
    {
        $userType = $request->user()->type;
        return response()->json($this->productRepo->getProductsByUserType($userType));
    }

    public function show($id)
    {
        return response()->json($this->productRepo->find($id));
    }

    public function store(StoreProductRequest $request)
    {
        $data = $request->validated();

        // Handle image upload
        if ($request->hasFile('image')) {
            $data['image'] = $this->productRepo->storeImage($request->file('image'));
        }
        $product = $this->productRepo->create($data);

        return response()->json($product, 201);
    }

    public function update(UpdateProductRequest $request, $id)
    {
        $data = $request->validated();
        $product = $this->productRepo->find($id);

        // Check if a new image is uploaded
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            $this->productRepo->deleteImage($product->image);
            $data['image'] = $this->productRepo->storeImage($request->file('image'));
        }

        $product = $this->productRepo->update($id, $data);
        return response()->json($product);
    }

    public function destroy($id)
    {
        $product = $this->productRepo->find($id);

        // Delete the image if it exists
        $this->productRepo->deleteImage($product->image);
        $this->productRepo->delete($id);

        return response()->json(['message' => 'Product deleted successfully']);
    }
}
