<?php

namespace App\Repositories;

use App\Models\Product;
use Storage;

class ProductRepository extends BaseRepository
{
    public function __construct(Product $product)
    {
        parent::__construct($product);
    }

    /**
     * Get all active products and adjust prices based on user type.
     *
     * @param string $userType
     * @return \Illuminate\Database\Eloquent\Collection
     */
    public function getProductsByUserType($userType)
    {
        return $this->model->where('is_active', true)
        ->paginate(request()->pagination ? request()->pagination :10)
            ->map(function ($product) use ($userType) {
                $product->price = $this->adjustPrice($product->price, $userType);
                return $product;
            });
    }

    /**
     * Adjust the price based on user type.
     *
     * @param float $price
     * @param string $userType
     * @return float
     */
    private function adjustPrice($price, $userType)
    {
        switch ($userType) {
            case 'gold':
                return $price * 0.9; // 10% discount for gold users
            case 'silver':
                return $price * 0.95; // 5% discount for silver users
            default:
                return $price; // No discount for normal users
        }
    }
     /**
     * Store the image for a product.
     *
     * @param \Illuminate\Http\UploadedFile $file
     * @return string|null
     */
    public function storeImage($file)
    {
        return $file->store('product_images', 'public');
    }

    /**
     * Delete the image for a product if it exists.
     *
     * @param string|null $imagePath
     * @return void
     */
    public function deleteImage($imagePath)
    {
        if ($imagePath && Storage::exists($imagePath)) {
            Storage::delete($imagePath);
        }
    }
}
