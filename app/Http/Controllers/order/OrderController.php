<?php

namespace App\Http\Controllers\order;
use App\Http\Controllers\Controller;
use App\Http\Controllers\product\ProductController;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class OrderController extends Controller
{
    private array $validationRulesCreate = [
    ];

    private array $validationRulesUpdate = [
        'status' => 'required|string',
    ];

    private array $errorMessages = [
        'quantity.required' => 'debe indicar que cantidad de pedidos va a realizar',
    ];

    protected $productController;

    public function __construct(ProductController $productController)
    {
        $this->productController = $productController;
    }




    public function showOrders(Request $request): View {
        $orders = [];
        //me traigo solo los pedidos del usuario
        if(!empty($request->filtro) && $request->filtro === 'mis-pedidos') {
            $orders = Order::myOrders($request->filtro)->get();
        }
        else {
            //me traigo todos los pedidos de la base de datos
            $orders = Order::get();
        }
        return view('order.orders')->with('orders', $orders);
    }

    public function showOrder(Order $order): View {
        return view('order.show')->with('order', $order);
    }

    public function createOrder(): View {
        $products = $this->productController->getProducts();
        return view('order.create_or_edit')->with('products', $products);
    }

    public function storeOrder(Request $request): RedirectResponse {
        //valido los datos
        $validated = $request->validate($this->validationRulesCreate, $this->errorMessages);

        //crear un nuevo registro en la tabla Order
        $order = Order::create([
            'user_id' => auth()->user()->id,
            'quantity' => array_sum($request->products)
        ]);
        
        // Agregar a la tabla pivote.
        // Cada iteración del array proporciona:
        // - $product_id: id del producto.
        // - $quantity: cantidad selecionada para ese producto.

        foreach ($request->products as $product_id => $quantity) {
            if ($quantity > 0) {
                $order->products()->attach($product_id, ['quantity' => $quantity]);
            }
        }   
        session()->flash('message', 'Pedido realizado!');
        return redirect()->route('order.orders');
    }

    public function editOrder(Order $order): View {
        $products = $this->productController->getProducts();
        return view('order.create_or_edit')
        ->with('order', $order)
        ->with('products', $products);
    }

    public function updateOrder(Request $request, Order $order): RedirectResponse {
        $this->authorize('update', $order);
        $validated = $request->validate($this->validationRulesUpdate);

        // Actualizar la cantidad total del pedido  
        $totalQuantity = array_sum($request->products);
        $order->update([
            'quantity' => $totalQuantity,
            'status' => $validated['status']      
        ]);

        // Sincronizar con la tabla pivote
        $productsWithQuantities = [];
        foreach ($request->products as $product_id => $quantity) {
            if ($quantity > 0) {
                $productsWithQuantities[$product_id] = ['quantity' => $quantity];
            }
        }

        $order->products()->sync($productsWithQuantities);
        session()->flash('message', 'Pedido actualizado!');

        return redirect()->route('order.orders');
    }

    public function deleteOrder(Order $order): RedirectResponse {
        $this->authorize('delete', $order);

        $order->delete();
        session()->flash('message', 'Pedido eliminado!');

        return redirect()->route('order.orders');
    }
}
