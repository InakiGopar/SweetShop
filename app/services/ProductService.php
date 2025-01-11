<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    private string $FILTER_SWEET_PRODUCTS = 'productos-dulces';
    private string $FILTER_SALTY_PRODUCTS = 'productos-salados';
    /**
     * Get all products according to the filter
     *
     * @param string|null $filter
     * @return Collection
     */
    public function getProducts( string $filter = null, string $name = null) {
        
        $query = Product::query();

        // Apply the sweet or salty filter if provided
        if ($filter === $this->FILTER_SWEET_PRODUCTS) {
            $query->sweetProducts();
        } elseif ($filter === $this->FILTER_SALTY_PRODUCTS) {
            $query->saltyProducts();
        }
    
        // Apply the search term filter if provided
        if ($name) {
            $query->productName($name);
        }
    
        // Return the filtered results
        return $query->get();
    }


    /**
     * Crete a product.
     *
     * @param array $data
     * @return Product
     */
    public function storeProduct(array $data): Product {
        return Product::create($data);
    }

    /**
     * Edit a product.
     *
     * @param Product $product
     * @param array $data
     * @return bool
     */

    public function updateProduct(Product $product, array $data): bool
    {
        return $product->update($data);
    }

    /**
     * Delete a product.
     *
     * @param Product $product
     * @return bool
    **/
    public function deleteProduct(Product $product): bool
    {
        return $product->delete();
    }
}

