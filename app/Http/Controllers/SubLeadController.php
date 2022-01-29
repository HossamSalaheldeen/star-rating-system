<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use App\Models\SubLead;
use Illuminate\Http\Request;
use App\Http\Requests\StoreSubLeadRequest;
use App\Http\Requests\UpdateSubLeadRequest;

class SubLeadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Lead $lead)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Lead $lead)
    {
        return view('sub-leads.create',compact('lead'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSubLeadRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request,Lead $lead)
    {
        $lead->subLeads()->create($request->only('name'));
        return redirect()->route('leads.show',$lead->id)->with(['success' => 'Sub Lead Successfully Created']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SubLead  $subLead
     * @return \Illuminate\Http\Response
     */
    public function show(Lead $lead, SubLead $subLead)
    {
        $purchaseRequests = $subLead->purchaseRequests()->get();
        return view('sub-leads.show',compact('lead','subLead', 'purchaseRequests'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SubLead  $subLead
     * @return \Illuminate\Http\Response
     */
    public function edit(Lead $lead, SubLead $subLead)
    {
        return view('sub-leads.edit',compact('lead','subLead'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSubLeadRequest  $request
     * @param  \App\Models\SubLead  $subLead
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Lead $lead, SubLead $subLead)
    {
        $subLead->update($request->only('name'));

        return redirect()->route('leads.show',$lead->id)->with(['success' => 'Sub Lead Successfully Updated']);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SubLead  $subLead
     * @return \Illuminate\Http\Response
     */
    public function destroy(Lead $lead, SubLead $subLead)
    {
        $subLead->delete();
        return redirect()->route('leads.show',$lead->id)->with(['success' => 'Sub Lead Successfully Deleted']);
    }
}
