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
    private array $validationRulesCreate = [
    ];

    private array $validationRulesUpdate = [
        'status' => 'required|string',
    ];

    private array $errorMessages = [
        'quantity.required' => 'debe indicar que cantidad de pedidos va a realizar',
    ];

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
        //valido los datos
        $validated = $request->validate($this->validationRulesCreate, $this->errorMessages);

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

        $validated = $request->validate($this->validationRulesUpdate);

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
