<?php

namespace App\Services;

use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductService
{
    private string $FILTER_SWEET_PRODUCTS = 'productos-dulces';
    private string $FILTER_SALTY_PRODUCTS = 'productos-salados';
    /**
     * Obtiene productos según el filtro.
     *
     * @param string|null $filter
     * @return Collection
     */
    public function getProducts( string $filter = null) {
        
        //me traigo los productos dulces
        if($filter === $this->FILTER_SWEET_PRODUCTS) {
            return Product::sweetProducts($filter)->get();
        }

        //me traigo los productos salados
        if($filter === $this->FILTER_SALTY_PRODUCTS) {
            return Product::saltyProducts($filter)->get();
        }

        //me traigo todos los productos
        return Product::get();
    }

    /**
     * Crea un producto.
     *
     * @param array $data
     * @return Product
     */
    public function storeProduct(array $data): Product {
        return Product::create($data);
    }

    /**
     * Actualiza un producto.
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
     * Elimina un producto.
     *
     * @param Product $product
     * @return bool
    **/
    public function deleteProduct(Product $product): bool
    {
        return $product->delete();
    }
}

