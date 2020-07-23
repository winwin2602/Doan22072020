<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\BrandRequest;
use App\Repositories\Brand\BrandInterface;
use Carbon\Carbon;
use App\Models\Brand;
use Str;

class BrandController extends Controller
{
    protected $brandRepository;

    public function __construct(BrandInterface $brandRepos)
    {
        $this->brandRepository = $brandRepos;
        $this->middleware('guest', ['except' => 'logout']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = $this->brandRepository->getAll();

        return view('admin.layouts.brands.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.layouts.brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(BrandRequest $request)
    {
        $request->validated();
        $nameimage=$request->logo->getClientOriginalName();
        $request->logo->move('images', $nameimage); 
        $data = new Brand([
            'name' => $request->name,
            'phone_no' => $request->phone_no,
            'slug' => Str::slug($request->name),
            'logo' => $nameimage,
            'address' => $request->address,
            'is_deleted' => false,
        ]);
        $brands = $this->brandRepository->create($data->toArray());
        $brands->save();
        if ($brands) return redirect('/admin/brand')->with('message','Create New successfully!');
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
        $brand = $this->brandRepository->find($id);

        return view('admin.layouts.brands.detail', compact('brand'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = $this->brandRepository->find($id);

        return view('admin.layouts.brands.edit', compact('brand'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(BrandRequest $request, $id)
    {
        if($request->hasFile('logo'))
        {
            $imagename=$request->logo->getClientOriginalName();
            $request->logo->move('images', $imagename);
        } else $imagename = $request->image; 

        $brand = $this->brandRepository->find($id);
        $brand->name = $request->name;
        $brand->phone_no = $request->phone_no;
        $brand->logo = $imagename;
        $brand->slug = Str::slug($request->name);
        $brand->address = $request->address;
        $result = $this->brandRepository->update($id, $brand->toArray());

        return redirect('admin/brand')->with('message','Edit successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {        
        $brand = $this->brandRepository->find($request->id);
        $brand->is_deleted = true;
        $brands = $this->brandRepository->update($brand->id, $brand->toArray());

        if ($brands) { 
            $brands->update();
            return back()->with('message','Delete success!');
        } else return back()->with('err','Delete failse!');
    }
}
