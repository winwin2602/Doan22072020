<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Repositories\Brand\BrandInterface;
use App\Repositories\Category\CategoryInterface;
use App\Repositories\Product\ProductInterface;
use App\Repositories\Slide\SlideInterface;
use Illuminate\Http\Request;
use Mail;
use Session;
class HomeController extends Controller
{
    private $productRepository;
    private $brandRepository;
    private $slideRepository;
    private $categoryRepository;

    public function __construct(ProductInterface $productRepos, BrandInterface $brandRepos,
        SlideInterface $slideRepos, CategoryInterface $categoryRepos)
    {
        $this->productRepository = $productRepos;
        $this->brandRepository = $brandRepos;
        $this->slideRepository = $slideRepos;
        $this->categoryRepository = $categoryRepos;
    }

	public function index()
    {
        $slides = $this->slideRepository->getTopSlide(3);
        $topHots = $this->productRepository->getTopHotProduct(4);
        $topNews = $this->productRepository->getTopNewProduct(4);
        $topSales = $this->productRepository->getTopSaleProduct(4);
        $brands = $this->brandRepository->getTopBrand(10);
        $categories = $this->categoryRepository->getCategory();
        return view('client.layouts.home', compact('slides', 'topHots', 'topNews', 'topSales', 'brands', 'categories'));
    }
    public function about()
    {
        return view('client.layouts.about_us');
    }
    // send gmail
    public function contact()
    {
        return view('client.layouts.contact_us');
    }
    public function sendContact(Request $request)
    {
        // dd($request);
        $input = $request->all();
        Mail::send('client.layouts.mail', array('name'=>$input["name"],'email'=>$input["email"], 'subject'=>$input['subject'], 'mess'=>$input['mess']), function($message){
            $message->to('winwin260299@gmail.com')->subject('Visitor Feedback!');
        });
        Session::flash('flash_message', 'Send message successfully!');
        return back();
    }
    // end
    public function login()
    {
        return view('client.layouts.login');
    }
    public function register()
    {
        return view('client.layouts.register');
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
