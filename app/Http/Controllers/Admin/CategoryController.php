<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;
use App\Repositories\Category\CategoryInterface;
use Carbon\Carbon;
use App\Models\ProductCategory;
use Str;


class CategoryController extends Controller
{
    protected $categoryRepository;

    public function __construct(CategoryInterface $categoryRepos)
    {
        $this->categoryRepository = $categoryRepos;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = $this->categoryRepository->getAll();

        return view('admin.layouts.categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.layouts.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CategoryRequest $request)
    {
        $request->validated();
        $data = new ProductCategory([
            'name' => $request->name,
            'slug'=> Str::slug($request->name),
            'description' => $request->description,
            'is_deleted' => false,
        ]);
        $categories = $this->categoryRepository->create($data->toArray());
        $categories->save();
        if ($categories) return redirect('/admin/category')->with('message','Create New successfully!');
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
        $categories = $this->categoryRepository->getAll();

        return view('admin.layouts.categories.detail', compact('categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = $this->categoryRepository->find($id);

        return view('admin.layouts.categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CategoryRequest $request, $id)
    {
        $category = $this->categoryRepository->find($id);
        $category->name = $request->name;
        $category->slug = Str::slug($request->name);
        $category->description = $request->description;
        $result = $this->categoryRepository->update($id, $category->toArray());

        return redirect('admin/category')->with('message','Edit successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $category = $this->categoryRepository->find($request->id);
        $category->is_deleted = true;
        $category = $this->categoryRepository->update($category->id, $category->toArray());

        if ($category) { 
            $category->update();
            return back()->with('message','Delete success!');
        } else return back()->with('err','Delete failse!');
    }
}
