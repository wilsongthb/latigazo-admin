<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdmInputs;

class InputsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = AdmInputs::
            select(
                's.title AS source',
                'i.*'
            )
            ->from('adm_inputs AS i')
            ->leftJoin('adm_sources AS s', 's.id', 'i.source_id')
            // ->where('s.area_id', request()->area_id);
            ->where('s.area_id', session('area_id'));

        if(request()->get('today')){
            $date = date('Y-m-d', time());
            // dd($date);
            $query = $query
                ->whereBetween('i.created_at', [$date.' 00:00:00', $date.' 23:59:59']);
        }
        
        return $query->get();
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
        // return $request->all();
        $reg = new AdmInputs;
        $reg->quantity = $request->quantity;
        $reg->observation = $request->observation;
        $reg->source_id = $request->source_id;
        $reg->type_id = $request->type_id;
        $reg->user_id = auth()->user()->id;
        $reg->save();
        return $reg;
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
        // $reg = AdmInputs::find($id);
        // $reg->enable = false;
        // $reg->save();
        AdmInputs::destroy($id);
    }
}
