<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;


class ProductController extends Controller
{

    protected ProductService $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }


    /**
     * Get all the products and return a Collection.
     */
    public function getProducts(Request $request = null): Collection  { 
        $filter = $request?->filtro ?? null;
        $name = $request?->name ?? null;
        return $this->productService->getProducts($filter, $name);
    }

    /**
     * Show all the products.
     */
    public function showProducts(Request $request): View {
        return view('product.products')->with('products', $this->getProducts($request)); //with agrega data a la vista
    }

    /**
     * Show a product.
     */
    public function showProduct(Product $product): View {
        return view('product.show')->with('product', $product );
    }

    /**
     * Displays a form to create a new product.
     */
    public function createProduct(): View {
        $this->authorize('create', Product::class);
        return view('product.create_or_edit');
    }

    /**
     * Save a new product.
     */
    public function storeProduct(Request $request): RedirectResponse {
        $this->authorize('create', Product::class);

        //validate the data
        $validated = $request->validate($this->getValidationRules(), $this->getErrorMessages());

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public'); // Almacenar en storage/app/public/products
            $validated['image_path'] = $path;
        }

        $this->productService->storeProduct($validated);

        // Use flash session to display a message to the user that the product was created successfully
        session()->flash('message', 'Producto creado exitosamente!');

        // Redirect to show all products
        return redirect()->route('product.products');
    }

    /**
     * Displays a form to edit a product.
     */
    public function editProduct(Product $product): View {
        $this->authorize('update', $product);
        return view('product.create_or_edit')->with('product', $product);
    }

    /**
     * Updated a product.
     */
    public function updateProduct(Request $request, Product $product) : RedirectResponse {
        $this->authorize('update', $product);

        //validate the data
        $validated = $request->validate($this->getValidationRules(), $this->getErrorMessages());
        
        // Check if a new image was uploaded
        if ($request->hasFile('image')) {
        // Delete the old image if exist.
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }

            // Save the new image.
            $path = $request->file('image')->store('products', 'public');
            $validated['image_path'] = $path;
        }

        $this->productService->updateProduct($product, $validated);

        session()->flash('message', 'Producto actualizado exitosamente!');

        return redirect()->route('product.products');
    }

    /**
     * Delete a product.
     */
    public function deleteProduct(Product $product): RedirectResponse {
        $this->authorize('delete', $product);

        //Delete the product image.
        if($product->image_path) {
            Storage::disk('public')->delete($product->image_path);
        }
        
        $this->productService->deleteProduct($product);

        session()->flash('message', 'Producto eliminado exitosamente!');

        return redirect()->route('product.products');
    }


    private function getValidationRules() 
    {
        return [
            'name' => 'required|string',
            'price' => 'required|numeric',
            'ingredients' => 'nullable',
            'description' => 'nullable',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'is_sweet' => 'required|boolean',
        ];
    }   

    private function getErrorMessages(): array 
    {
        return [
            'name.required' => 'El nombre del producto es obligatorio.',
            'price.required' => 'El precio del producto es obligatorio.',
            'price.numeric' => 'El precio del producto debe ser un número.',
            'is_sweet.required' => 'Debes indicar si el producto es dulce o no.',
        ];
    }
}
