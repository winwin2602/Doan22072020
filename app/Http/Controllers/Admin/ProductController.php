<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\ProductRequest;
use App\Repositories\Product\ProductInterface;
use App\Repositories\Brand\BrandInterface;
use App\Repositories\Category\CategoryInterface;
use Str;
use Carbon\Carbon;
use App\Models\Product;
use App\Models\Brand;
use App\Models\ProductCategory;
use App\Repositories\EloquentInterface;
use Illuminate\Database\Eloquent\Model;
class ProductController extends Controller
{
    protected $productRepository;
    protected $brandRepository;
    protected $categoryRepository;
    public function __construct(ProductInterface $productRepos, BrandInterface $brandRepos, CategoryInterface $categoryRepos)
    {
        $this->productRepository = $productRepos;
        $this->brandRepository = $brandRepos;
        $this->categoryRepository = $categoryRepos;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = $this->productRepository->getAll();
        $brands = $this->brandRepository->getAll();
        $categories = $this->categoryRepository->getAll();
        return view('admin.layouts.products.index', compact('products','brands','categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $products = $this->productRepository->getAll();
        $brands = $this->brandRepository->getPluck('name','id');
        $categories = $this->categoryRepository->getPluck('name','id'); 
        // vi du minh k muon lay name nua, lay description vs id
        return view('admin.layouts.products.create',compact('products','brands','categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $request->validated();
//        dd($request);
        $nameimage = "";
        if($request->hasFile('url_image'))
        {
            $nameimage=$request->url_image->getClientOriginalName();
            $request->url_image->move('images', $nameimage);
        }
        $data = new Product([
            'name' => $request->name,
            'code' => $request->code,
            'description'=> $request->description,
            'url_image' => $nameimage,
            'detail' => $request->detail,
            'price' => $request->price,
            'promotion_price' => $request->promotion_price,
            'quantity' => $request->quantity,
            'slug' => Str::slug($request->name),
            'is_hot' => $request->has('is_hot') ? 1 : 0,
            'is_new' => $request->has('is_new') ? 1 : 0,
            'category_id' => $request->category_id,
            'brand_id' => $request->brand_id,
            'is_deleted' => false,
        ]);
        $products = $this->productRepository->create($data->toArray());
        $products->save();
        if ($products) return redirect('/admin/product')->with('message','Create New successfully!');
        else return back()->with('err','Save error!');  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $products = $this->productRepository->find($id);
        $brands = $this->brandRepository->getPluck('name','id');
        $categories = $this->categoryRepository->getPluck('name','id'); 
        return view('admin.layouts.products.detail',compact('products','brands','categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $product = $this->productRepository->find($id);
        $brands = $this->brandRepository->getPluck('name','id');
        $categories = $this->categoryRepository->getPluck('name','id'); 
        return view('admin.layouts.products.edit',compact('product','brands','categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, $id)
    {
        if($request->hasFile('url_image'))
        {
            $imagename=$request->url_image->getClientOriginalName();
            $request->url_image->move('images', $imagename);
        } else $imagename = $request->image;

        $product = $this->productRepository->find($id);
        $product->name = $request->name;
        $product->code = $request->code;
        $product->description = $request->description;
        $product->url_image = $imagename;
        $product->detail = $request->detail;
        $product->price = $request->price;
        $product->promotion_price = $request->promotion_price;
        $product->quantity = $request->quantity;
        $product->slug = Str::slug($request->name);
        $product->is_hot = $request->has('is_hot') ? 1 : 0;
        $product->is_new = $request->has('is_new') ? 1 : 0;
        $product->brand_id = $request->brand_id;
        $product->category_id = $request->category_id;
        $result = $this->productRepository->update($id, $product->toArray());

        return redirect('admin/product')->with('message','Edit successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $product = $this->productRepository->find($request->id);
        $product->is_deleted = true;
        // dd($product);
        $product = $this->productRepository->update($product->id, $product->toArray());

        if ($product) { 
            $product->update();
            return back()->with('message','Delete success!');
        } else return back()->with('err','Delete failse!');
    }
}
