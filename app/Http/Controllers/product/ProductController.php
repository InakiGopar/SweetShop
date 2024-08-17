<?php

namespace App\Http\Controllers\product;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use Laravel\Ui\Presets\React;

class ProductController extends Controller
{
    private array $validationRules = [
        'name' => 'required|string',
        'price' => 'required|numeric',
        'ingredients' => 'nullable',
        'description' => 'nullable',
        'is_sweet' => 'required'
    ];

    private array $errorMessages = [
        'name.required' => 'El nombre del producto es obligatorio.',
        'price.required' => 'El precio del producto es obligatorio.',
        'price.numeric' => 'El precio del producto debe ser un número.',
        'is_sweet.required' => 'Debes indicar si el producto es dulce o no.',
    ];



    
    /**
     * @return Collection<Product>
     */
    public function getProducts(Request $request = null): Collection  { 
        if(!empty($request->filtro) && $request->filtro === 'productos-dulces') {
            $products = Product::sweetProducts($request->filtro)->get();
        }
        elseif(!empty($request->filtro) && $request->filtro === 'productos-salados') {
            $products = Product::saltyProducts($request->filtro)->get();
        }
        else {
            $products = Product::get(); //me traigo todos los productos de la base de datos
        }
        return $products;
    }

    public function showProducts(Request $request): View {
        return view('product.products')->with('products', $this->getProducts($request)); //with agrega data a la vista
    }

    public function showProduct(Product $product): View {
        return view('product.show')->with('product', $product );
    }

    public function createProduct(): View {
        $this->authorize('create', Product::class);
        return view('product.create_or_edit');
    }

    public function storeProduct(Request $request): RedirectResponse {
        $this->authorize('create', Product::class);

        //valido los datos
        $validated = $request->validate($this->validationRules, $this->errorMessages);

        //crear un nuevo registro en la tabla Products
        Product::create([
            'name' => $validated['name'],
            'price' => $validated['price'],
            'ingredients' => $validated['ingredients'],
            'description' => $validated['description'],
            'is_sweet' => $validated['is_sweet'],
        ]);

        //utilizo una session flash para mostrar un mensaje al usuario que se creo el producto
        session()->flash('message', 'Producto creado exitosamente!');

        //redirigo a la vista donde se encuentran todos los productos
        return redirect()->route('product.products');
    }

    public function editProduct(Product $product): View {
        $this->authorize('update', $product);
        return view('product.create_or_edit')->with('product', $product);
    }

    public function updateProduct(Request $request, Product $product) : RedirectResponse {
        $this->authorize('update', $product);
        //valido los datos
        $validated = $request->validate($this->validationRules, $this->errorMessages);

        $product->update($validated);

        session()->flash('message', 'Producto actualizado exitosamente!');

        return redirect()->route('product.products');
    }

    public function deleteProduct(Product $product): RedirectResponse {
        $this->authorize('delete', $product);
        $product->delete();

        session()->flash('message', 'Producto eliminado exitosamente!');

        return redirect()->route('product.products');
    }
}
