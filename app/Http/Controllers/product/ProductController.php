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
     * Obtiene productos y los devuelve como una colección.
     */
    public function getProducts(Request $request = null): Collection  { 
        $filter = $request?->filtro ?? null;
        return $this->productService->getProducts($filter);
    }

    /**
     * Muestra todos los productos en la vista.
     */
    public function showProducts(Request $request): View {
        return view('product.products')->with('products', $this->getProducts($request)); //with agrega data a la vista
    }

    /**
     * Muestra un producto específico.
     */
    public function showProduct(Product $product): View {
        return view('product.show')->with('product', $product );
    }

    /**
     * Muestra el formulario para crear un producto.
     */
    public function createProduct(): View {
        $this->authorize('create', Product::class);
        return view('product.create_or_edit');
    }

    /**
     * Almacena un nuevo producto.
     */
    public function storeProduct(Request $request): RedirectResponse {
        $this->authorize('create', Product::class);

        //valido los datos
        $validated = $request->validate($this->getValidationRules(), $this->getErrorMessages());

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public'); // Almacenar en storage/app/public/products
            $validated['image_path'] = $path;
        }

        $this->productService->storeProduct($validated);

        //utilizo una session flash para mostrar un mensaje al usuario que se creo el producto
        session()->flash('message', 'Producto creado exitosamente!');

        //redirigo a la vista donde se encuentran todos los productos
        return redirect()->route('product.products');
    }

    /**
     * Muestra el formulario para editar un producto existente.
     */
    public function editProduct(Product $product): View {
        $this->authorize('update', $product);
        return view('product.create_or_edit')->with('product', $product);
    }

    /**
     * Actualiza un producto existente.
     */
    public function updateProduct(Request $request, Product $product) : RedirectResponse {
        $this->authorize('update', $product);

        //valido los datos
        $validated = $request->validate($this->getValidationRules(), $this->getErrorMessages());
        
        // Verifico si se subió una nueva imagen
        if ($request->hasFile('image')) {
        // Eliminar la imagen anterior si existe
            if ($product->image_path) {
                Storage::disk('public')->delete($product->image_path);
            }

            // Guardar la nueva imagen
            $path = $request->file('image')->store('products', 'public');
            $validated['image_path'] = $path;
        }

        $this->productService->updateProduct($product, $validated);

        session()->flash('message', 'Producto actualizado exitosamente!');

        return redirect()->route('product.products');
    }

    /**
     * Elimina un producto.
     */
    public function deleteProduct(Product $product): RedirectResponse {
        $this->authorize('delete', $product);
        
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
