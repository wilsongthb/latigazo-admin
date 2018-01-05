<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdmOutputs;
use App\Http\Controllers\Admin\ReasonsController;

class OutputsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $query = AdmOutputs::
            select(
                'r.title AS reason',
                'r.require_authorizer',
                'o.*'
            )
            ->from('adm_outputs AS o')
            // ->join('adm_budgets AS b', 'b.id', 'o.budget_id')
            ->leftJoin('adm_reasons AS r', 'r.id', 'o.reason_id')
            // ->where('r.area_id', request()->area_id)
            ->where('r.area_id', session('area_id'));

        if(request()->get('today')){
            $date = date('Y-m-d', time());
            // dd($date);
            $query = $query
                ->whereBetween('o.created_at', [$date.' 00:00:00', $date.' 23:59:59']);
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

    // function processAuthorizer(&$output, $reason = false){
    //     if(!$reason){
    //         $reason = (new ReasonsController)->show($output->reason_id);
    //     }

    // }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $reg->reason_id = $request->reason_id;
        // if($request->has('observation')){
        //     $reg->observation = $request->observation;
        // }
        // $reg->observation = $request->observation ? $request->observation : '';
        // 
        // $reg->budget_id = $reason->budget->id;
        $reg = new AdmOutputs;
        $reg->user_id = auth()->user()->id;
        $reg->type_id = $request->type_id;
        $reg->reason_id = $request->reason_id;
        $reason = (new ReasonsController)->show($reg->reason_id);
        // var_dump($reason->free);
        if($reason->free == '1'){
            // var_dump('free');
            // echo "free";
            $reg->quantity = $request->quantity;
            // $this->processAuthorizer($reg);
        }else{
            // echo "don't free";
            // if($reason->)
            if($reason->budget_id){
                // echo "con budget";
                $reg->budget_id = $reason->budget_id;
                $reg->quantity = 
                    $reason->max > $request->quantity ? 
                    $request->quantity : 
                    $reason->max ;
            }else{
                echo "erro, no hay budget";
                exit();
            }
        }
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
        // $reg = AdmOutputs::find($id);
        // $reg->enable = false;
        // $reg->save();
        AdmOutputs::destroy($id);
    }
}
