<?php

namespace App\Http\Controllers\order;
use App\Http\Controllers\Controller;
use App\Http\Controllers\product\ProductController;
use App\Models\Order;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;
use App\Services\OrderService;

class OrderController extends Controller
{

    protected OrderService $orderService;
    protected ProductController $productController;

    public function __construct(OrderService $orderService, ProductController $productController)
    {
        $this->orderService = $orderService;
        $this->productController = $productController;
    }


    public function showOrders(Request $request): View {
        $orders = $this->orderService->getOrders($request->filtro);
        return view('order.orders')->with('orders' , $orders);
    }

    public function showOrder(Order $order): View {
        $totalPrice = $this->orderService->calculateTotal($order);
        return view('order.show')->with('order', $order)->with('totalPrice', $totalPrice);
    }

    public function createOrder(): View {
        $products = $this->productController->getProducts();
        return view('order.create_or_edit')->with('products', $products);
    }

    public function storeOrder(Request $request): RedirectResponse {

         //validate data
        $request->validate([
            'products' => ['required', 'array', function ($attribute, $value, $fail) {
                $totalQuantity = array_sum($value);
                if ($totalQuantity < 1) { 
                    $fail('Debes tener al menos un producto selecionado para realizar un pedido.');
                }
            }],
        ]);

        $this->orderService->storeOrder($request->all(), auth()->id());
        
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

        //validate data
        $validated = $request->validate([
            'status' => 'required|string',
            'products' => ['required', 'array', function ($attribute, $value, $fail) {
                $totalQuantity = array_sum($value);
                if ($totalQuantity < 1) { 
                    $fail('Debes tener al menos un producto seleccionado con cantidad mayor a 0.');
                }
            }],
        ]);

        $this->orderService->updateOrder($order, array_merge($validated, ['products'=> $request->products]));

        session()->flash('message', 'Pedido actualizado!');

        return redirect()->route('order.orders');
    }

    public function deleteOrder(Order $order): RedirectResponse {
        $this->authorize('delete', $order);

        $this->orderService->deleteOrder($order);

        session()->flash('message', 'Pedido eliminado!');

        return redirect()->route('order.orders');
    }
}
