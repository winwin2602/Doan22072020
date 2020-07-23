<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Repositories\Order\OrderInterface;
use App\Repositories\Product\ProductInterface;
use App\Repositories\User\UserInterface;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    protected $productRepository;
    protected $orderRepository;
    protected $userRepository;
    public function __construct(ProductInterface $productRepos, OrderInterface $orderRepos, UserInterface $userRepos)
    {
        $this->middleware('guest', ['except' => 'logout']);
        $this->productRepository = $productRepos;
        $this->orderRepository = $orderRepos;
        $this->userRepository = $userRepos;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $total_product = $this->productRepository->getTotalProduct();
        $total_customer = $this->userRepository->getTotalUser();
        $total_order = $this->orderRepository->getTotalOrder();
        return view('admin.layouts.dashboards.index', compact('total_product', 'total_customer', 'total_order'));
    }
}
