<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\OrderDetail\OrderDetailInterface;
use App\Repositories\Product\ProductInterface;
use Illuminate\Http\Request;
// use App\Http\Requests\OrderRequest;
use App\Repositories\Order\OrderInterface;
use Carbon\Carbon;
use App\Models\Order;

class OrderController extends Controller
{
    private $orderRepository;
    private $productRepository;
    private $orderDetailRepository;

    public function __construct(OrderInterface $orderRepos, ProductInterface $productRepos, OrderDetailInterface $orderDetailRepos)
    {
        $this->orderRepository = $orderRepos;
        $this->productRepository = $productRepos;
        $this->orderDetailRepository = $orderDetailRepos;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $orders = $this->orderRepository->getOrders();
        return view('admin.layouts.orders.index', compact('orders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.layouts.orders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $order_details = $this->orderDetailRepository->getByOrderId($id);
        return view('admin.layouts.orders.detail', compact('order_details'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
    }

    public function update($id){
        var_dump($id);
        $order = $this->orderRepository->find($id);
        $order->order_status = !$order->order_status;
        $result = $this->orderRepository->update($id, $order->toArray());
        $result->save();
        return redirect()->back()->with('message', 'Update successful!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {        
        $order = $this->orderRepository->find($request->id);
        $order->is_deleted = true;
        $orders = $this->orderRepository->update($order->id, $order->toArray());

        if ($orders) { 
            $orders->update();
            return back()->with('message','Delete success!');
        } else return back()->with('err','Delete false!');
    }
}
