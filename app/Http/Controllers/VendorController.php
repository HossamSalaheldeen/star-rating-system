<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Vendor;
use App\Http\Requests\StoreVendorRequest;
use App\Http\Requests\UpdateVendorRequest;
use Illuminate\Support\Facades\Auth;
use willvincent\Rateable\Rating;

class VendorController extends Controller
{
    public function __construct()
    {
        Auth::loginUsingId(3, true);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $vendors = Vendor::all();

        return view('vendors.index', compact('vendors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return  view('vendors.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreVendorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

//        dd(Auth::user());
//        dd($request->all());
        $vendor = Vendor::create($request->only('name'));
        if ($request->has('star'))
        {
            $vendor->rate($request->input('star'));
        }

        return redirect()->route('vendors.index')->with(['success' => 'Vendor Successfully Created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function show(Vendor $vendor)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function edit(Vendor $vendor)
    {
//        dd(Rating::where('user_id',Auth::id())->where('rateable_id',$vendor->id)->exists());
        $rating = Rating::where('user_id',Auth::id())->where('rateable_id',$vendor->id)->exists()
            ? Rating::where('user_id',Auth::id())->where('rateable_id',$vendor->id)->pluck('rating')->first()
            : 0;
        return  view('vendors.edit',compact('vendor','rating'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateVendorRequest  $request
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vendor $vendor)
    {

        $vendor->update($request->only('name'));
//        dd($request->all());
        if ($request->has('star'))
        {
            $vendor->rateOnce($request->input('star'));
        }else if($vendor->ratings()->first()) {
//            dd("dsd");
            $vendor->ratings()->where('id', '=', $vendor->ratings()->first()->id)->delete();
        }
        return redirect()->route('vendors.index')->with(['success' => 'Vendor Successfully Updated']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Vendor  $vendor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vendor $vendor)
    {
        $vendor->delete();
        return redirect()->route('vendors.index')->with(['success' => 'Vendor Successfully Deleted']);
    }
}
