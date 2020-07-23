<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\SlideRequest;
use App\Repositories\Slide\SlideInterface;
use Carbon\Carbon;
use App\Models\Slide;

class SlideController extends Controller
{
    protected $slideRepository;

    public function __construct(SlideInterface $slideRepos)
    {
        $this->slideRepository = $slideRepos;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $slides = $this->slideRepository->getAll();

        return view('admin.layouts.slides.index', compact('slides'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.layouts.slides.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SlideRequest $request)
    {
        $request->validated();
        $nameimage=$request->image->getClientOriginalName();
        $request->image->move('images', $nameimage);
        $data = new Slide([
            'content' => $request->content,
            'image' => $nameimage,
            'url' => $request->url,
            'description' => $request->description,
            'is_deleted' => false,
        ]);
        $slides = $this->slideRepository->create($data->toArray());
        $slides->save();
        if ($slides) return redirect('/admin/slide')->with('message','Create new successfully!');
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
        $slide = $this->slideRepository->find($id);

        return view('admin.layouts.slides.detail', compact('slide'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $slide = $this->slideRepository->find($id);

        return view('admin.layouts.slides.edit', compact('slide'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(SlideRequest $request, $id)
    {
        if($request->hasFile('image'))
        {
            $imagename=$request->image->getClientOriginalName();
            $request->image->move('images', $imagename);
        } else {
            $imagename = $request->old_image;
        }

        $slide = $this->slideRepository->find($id);
        $slide->content = $request->content;
        $slide->description = $request->description;
        $slide->image = $imagename;
        $slide->url = $request->url;
        $result = $this->slideRepository->update($id, $slide->toArray());

        return redirect('admin/slide')->with('message','Edit successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $slide = $this->slideRepository->find($request->id);
        $slide->is_deleted = true;
        $slides = $this->slideRepository->update($slide->id, $slide->toArray());

        if ($slides) {
            $slides->update();
            return back()->with('message','Delete success!');
        } else return back()->with('err','Delete fail!');
    }
}
