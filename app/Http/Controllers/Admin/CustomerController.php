<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Http\Requests\CustomerRequest;
class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     $customer=Customer::all();

     return view('admin.layouts.customers.index',compact('customer'));
 }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd("oke");
     return view('admin.layouts.customers.create');
 }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        // dd("oke");
        $customers= new Customer([
          'full_name'=>$request->full_name,


          'address'=>$request->address,

          'phone_no'=>$request->phone_no,
          'email'=>$request->email,
          'slug'=>$request->slug,
      ]);
        $customers->save();

        return back()->with('message','On Your Successful Save');
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
       $ctm=Customer::findOrfail($id);
       return view('admin.layouts.customers.edit',compact('ctm'));
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
     $customer=Customer::findOrfail($id);
     $customer->update([

       'full_name'=>$request->full_name,


       'address'=>$request->address,

       'phone_no'=>$request->phone_no,
       'email'=>$request->email,
       'slug'=>$request->slug,



   ]);
     $customer->save();

     return back()->with('update','Update Data Success');
     
 }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
          $ctm=Customer::findOrfail($request->id);
        $ctm->delete();
        return back();
    }
    
}