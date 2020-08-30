<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use App\Models\Customer;
use App\Repositories\Customer\CustomerInterface;
use App\Repositories\Order\OrderInterface;
use App\Repositories\OrderDetail\OrderDetailInterface;
use App\Repositories\Product\ProductInterface;
use App\Repositories\User\UserInterface;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;
use Str;
class CartController extends Controller
{
    private $productRepository;
    private $orderRepository;
    private $orderDetailRepository;
    private $customerRepository;
    private $userRepository;

    public function __construct(ProductInterface $productRepos, OrderInterface $orderRepos, UserInterface $userRepos,
                                CustomerInterface $customerRepos, OrderDetailInterface $orderDetailRepos)
    {
        $this->productRepository = $productRepos;
        $this->orderRepository = $orderRepos;
        $this->customerRepository = $customerRepos;
        $this->userRepository = $userRepos;
        $this->orderDetailRepository = $orderDetailRepos;
    }

    //Page cart index
    public function cartpage()
    {
        return view('client.layouts.cartpage');
    }

    //Add product to cart
    public function addToCart(Request $request){
        $product = Product::find($request->product_id);
        //dd($product);
        if(!$product) {
            abort(404);
        }
        $cart = session()->get('cart');
        // if cart is empty then this the first product
        if(!$cart) {
            if (intval($request->quantity) > $product->quantity) {
                session()->flash('err', 'Số Lượng ít hơn '.$product->quantity);
                return redirect()->back()->with('err', 'Số Lượng ít hơn '.$product->quantity);
            }else{
                $cart = [
                    $product->id => [
                        "id" => $product->id,
                        "name" => $product->name,
                        "slug" => $product->slug,
                        "quantity" => intval($request->quantity),
                        "price" => $product->promotion_price ?? $product->price,
                        "image" => $product->url_image,
                    ]
                ];
                session()->put('cart', $cart);
                return redirect()->back()->with('message', 'Product added to cart successfully!');
            }
        }
        // if cart not empty then check if this product exist then increment quantity
        if(isset($cart[$product->id])) {
            if (intval($request->quantity) > $product->quantity) {
                session()->flash('err', 'Số Lượng ít hơn '.$product->quantity);
                return redirect()->back()->with('err', 'Số Lượng ít hơn '.$product->quantity);
            }else{
                $cart[$product->id]['quantity'] += $request->quantity;
                session()->put('cart', $cart);
                return redirect()->back()->with('success', 'Product added to cart successfully!');
            }
        }
        // if item not exist in cart then add to cart
        if (intval($request->quantity) > $product->quantity) {
            session()->flash('err', 'Số Lượng ít hơn '.$product->quantity);
            return redirect()->back()->with('err', 'Số Lượng ít hơn '.$product->quantity);
        }else{
            $cart[$product->id] = [
                    "id" => $product->id,
                    "name" => $product->name,
                    "slug" => $product->slug,
                    "quantity" => intval($request->quantity),
                    "price" => $product->promotion_price ?? $product->price,
                    "image" => $product->url_image,
            ];
            session()->put('cart', $cart);
            return redirect()->back()->with('success', 'Product added to cart successfully!');
        }
    }

    //Update cart
    public function updateCart(Request $request)
    {
        if($request->id and $request->quantity)
        {
            $product = Product::find($request->id);
            if($product){
                if (intval($request->quantity) > $product->quantity) {
                    session()->flash('err', 'Số Lượng ít hơn '.$product->quantity);
                }else{
                    $cart = session()->get('cart');
                    $cart[$request->id]["quantity"] = intval($request->quantity);
                    session()->put('cart', $cart);
                    session()->flash('success', 'Cart updated successfully!');
                }
            }else{
                abort(404);
            }
        }
    }

    //Remove product from cart
    public function removeFromCart(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            session()->flash('success', 'Product has been removed successfully');
        }
    }

    //Page cart checkout
    public function checkout()
    {
        $customer = new Customer();
        if (Auth::check()){
            $customer = $this->customerRepository->getCustomerByUserId(Auth::user()->id);
            return view('client.layouts.payment', compact('customer'));
        }else{
//            return redirect()->back()->with('err', trans('log.err'));
            return view('client.layouts.payment',compact('customer'));
        }
    }

    //Payment
    public function payment(Request $request)
    {
        $customer = new Customer();
        if (Auth::check()){
            $customer = $this->customerRepository->getCustomerByUserId(Auth::user()->id);
        }else{
            $customer->full_name = $request->full_name;
            $customer->address = $request->address;
            $customer->phone_no = $request->phone_no;
            $customer->email = $request->email;
            $customer->slug= Str::slug($request->full_name);
            $customer->is_deleted= false;
            $customer->created_at= Carbon::now();
            $customer->updated_at= Carbon::now();
            $createCustomer= $this->customerRepository->create($customer->toArray());
            $createCustomer->save();
            $customer = $createCustomer;
        }
        $order = new Order([
            'order_status' => 1, //1-un-confirmed | 2-confirmed
            'payment_status' => $request->payment_method,
            'customer_id' => $customer->id,
        ]);
        $products = $this->productRepository->find($request->product_id);
        foreach ($products as $key => $product){
            $product->quantity = $product->quantity - $request->quantity[$key];
            echo $product->quantity.'\n';
            $result = $this->productRepository->update($product->id, $product->toArray());
        }
        $order_result = $this->orderRepository->create($order->toArray());
        $order_result->save();
        foreach ($request->product_id as $key => $value) {
            $order_detail = new OrderDetail([
                'quantity' => $request->quantity[$key],
                'order_id' => $order_result->id,
                'product_id' => $value,
                'created_at' => Carbon::now()->toDateTimeString(),
            ]);
            $result = $this->orderDetailRepository->create($order_detail->toArray());
            $result->save();
        }
        // $request->session()->forget('cart');
        if ($request->payment_method == 2) {// 1-Cod, 2-Momo
            //MoMo
            $endpoint = "https://test-payment.momo.vn/gw_payment/transactionProcessor";
            $partnerCode = "MOMO2XCN20200620";
            $accessKey = "UqIGYRJeL3A3lqV5";
            $serectkey = "NrHQ1H9bDmLu3FkOLFqFIO1rEE9qREng";
            $orderId = $order_result->id.date("YmdHi"); // M� don h�ng
            $orderInfo = "Thanh toán bằng Momo";
            $amount = $request->total_amount;
            $notifyurl = url('cart-page');
            $returnUrl = url('return-payment');
            $extraData = "merchantName=MoMo Partner";
            $requestId = time() . "";
            $requestType = "captureMoMoWallet";
            $extraData = ($request->extraData ? $request->extraData : "");
            //before sign HMAC SHA256 signature
            $rawHash = "partnerCode=" . $partnerCode . "&accessKey=" . $accessKey . "&requestId=" . $requestId . "&amount=" . $amount . "&orderId=" . $orderId . "&orderInfo=" . $orderInfo . "&returnUrl=" . $returnUrl . "&notifyUrl=" . $notifyurl . "&extraData=" . $extraData;
            $signature = hash_hmac("sha256", $rawHash, $serectkey);
            $data = array('partnerCode' => $partnerCode,
                'accessKey' => $accessKey,
                'requestId' => $requestId,
                'amount' => $amount,
                'orderId' => $orderId,
                'orderInfo' => $orderInfo,
                'returnUrl' => $returnUrl,
                'notifyUrl' => $notifyurl,
                'extraData' => $extraData,
                'requestType' => $requestType,
                'signature' => $signature);
            $result = $this->execPostRequest($endpoint, json_encode($data));
            $jsonResult = json_decode($result, true);  // decode json
            // dd($jsonResult);
            return redirect($jsonResult['payUrl']);

        }
        $request->session()->forget('cart');
        // thanh toan vnpay
        if ($request->payment_method == 3) {// 1-Cod, 2-Momo 3 vnpay
        session(['cost_id' => $request->id]);
        session(['url_prev' => url()->previous()]);
        $vnp_TmnCode = "5JUZLNGZ"; //Mã website tại VNPAY 
        $vnp_HashSecret = "ZIYDABXSFWJSAFKVGNNTRHHTXHTAAWYE"; //Chuỗi bí mật
        $vnp_Url = "http://sandbox.vnpayment.vn/paymentv2/vpcpay.html";
        $vnp_Returnurl = url('return-payment?id='.$order_result->id);

        $vnp_TxnRef = date("YmdHis"); //Mã đơn hàng. Trong thực tế Merchant cần insert đơn hàng vào DB và gửi mã này sang VNPAY
        $vnp_OrderInfo = "Thanh toán hóa đơn phí dich vụ";
        $vnp_OrderType = 'billpayment';
        $vnp_Amount = $request->total_amount * 100;
        $vnp_Locale = 'vn';
        $vnp_IpAddr = request()->ip();

        $inputData = array(
            "vnp_Version" => "2.0.0",
            "vnp_TmnCode" => $vnp_TmnCode,
            "vnp_Amount" => $vnp_Amount,
            "vnp_Command" => "pay",
            "vnp_CreateDate" => date('YmdHis'),
            "vnp_CurrCode" => "VND",
            "vnp_IpAddr" => $vnp_IpAddr,
            "vnp_Locale" => $vnp_Locale,
            "vnp_OrderInfo" => $vnp_OrderInfo,
            "vnp_OrderType" => $vnp_OrderType,
            "vnp_ReturnUrl" => $vnp_Returnurl,
            "vnp_TxnRef" => $vnp_TxnRef,
        );

        if (isset($vnp_BankCode) && $vnp_BankCode != "") {
            $inputData['vnp_BankCode'] = $vnp_BankCode;
        }
        ksort($inputData);
        $query = "";
        $i = 0;
        $hashdata = "";
        foreach ($inputData as $key => $value) {
            if ($i == 1) {
                $hashdata .= '&' . $key . "=" . $value;
            } else {
                $hashdata .= $key . "=" . $value;
                $i = 1;
            }
            $query .= urlencode($key) . "=" . urlencode($value) . '&';
        }

        $vnp_Url = $vnp_Url . "?" . $query;
        if (isset($vnp_HashSecret)) {
           // $vnpSecureHash = md5($vnp_HashSecret . $hashdata);
            $vnpSecureHash = hash('sha256', $vnp_HashSecret . $hashdata);
            $vnp_Url .= 'vnp_SecureHashType=SHA256&vnp_SecureHash=' . $vnpSecureHash;
        }
        return redirect($vnp_Url);
    }
        $request->session()->forget('cart');    
        return redirect('/cart-page');

}
    function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data))
        );
        curl_setopt($ch, CURLOPT_TIMEOUT, 5);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        //execute post
        $result = curl_exec($ch);
        //close connection
        curl_close($ch);
        return $result;
    }
    public function returnpayment(Request $request)
    {
       // dd($request);
        if ($request->errorCode == "0") {
            $id = substr($request->orderId, 0,-12);
            $order = $this->orderRepository->find($id);
            $order->order_status = 1;//0-unconfirmed, 1-confirmed
            $order->payment_status = 2;//1-COD, 2-MOMO 3 VNPAY
            $result = $this->orderRepository->update($id, $order->toArray());
            $result->save();
            
            return redirect('/cart-page')->with('message' ,'Payment by momo successful!');
        }
        if($request->vnp_ResponseCode == '00') {
           $id = $request->id;
            $order = $this->orderRepository->find($id);
            // dd($order);
            $order->order_status = 1;//0-unconfirmed, 1-confirmed
            $order->payment_status = 3;//1-COD, 2-MOMO 3 VNPAY
            $result = $this->orderRepository->update($id, $order->toArray());
            $result->save();
            
            return redirect('/cart-page')->with('message' ,'Payment by vnpay successful!');
        }else{
            return redirect('/cart-page');
        }
    }
    
}
