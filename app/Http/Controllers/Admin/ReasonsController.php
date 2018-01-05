<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdmReasons;
use App\Models\AdmBudgets;
use DB;
use App\User;

class ReasonsController extends Controller
{
    static function lastBudget($reason_id){
        return AdmBudgets::
            where('reason_id', $reason_id)
            ->orderBy('id', 'DESC')
            ->first();
    }
    function loadReason(&$value){
        $budget = $this->lastBudget($value->id);

        $value->max = 0;
        $value->total = 0;
        $value->budget = null;
        $value->budget_id = null;
        if(!$value->free){
            if($budget){
                $total = DB::select(
                    "SELECT 
                        IFNULL(SUM(o.quantity), 0) AS total
                    FROM adm_budgets AS b
                    LEFT JOIN adm_outputs AS o ON o.budget_id = b.id
                    WHERE b.id ='$budget->id'"
                )[0]->total;

                $value->max = $budget->max - $total;
                $value->total = $total;
                $value->budget = $budget;
                $value->budget_id = $budget->id;
            }
        }
        
        
        if($value->require_authorizer){
            $value->authorizer = User::find($value->authorizer_id);
        }
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reasons = AdmReasons::
            select(
                'r.*'
            )
            ->from('adm_reasons AS r')
            // ->where('r.area_id', request()->area_id)
            ->where('r.area_id', session('area_id'))
            ->get();

        // cargar presupuesto y autorizador
        foreach ($reasons as $key => &$value) {
            $this->loadReason($value);
        }
        return $reasons;
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
        $reg = new AdmReasons;
        $reg->title = $request->title;
        $reg->description = $request->description ? $request->description : '';
        if(isset($request->free)){
            $reg->free = $request->free;
        }
        if($request->require_authorizer){
            $reg->require_authorizer = $request->require_authorizer;
            $reg->authorizer_id = $request->authorizer_id;
        }
        $reg->area_id = session('area_id');
        $reg->user_id = auth()->user()->id;

        $reg->save();

        return AdmReasons::find($reg->id);
        // return $reg;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $reason = AdmReasons::find($id);
        $this->loadReason($reason);
        return $reason;
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
        $reg = AdmReasons::find($id);
        $reg->title = $request->title;
        $reg->description = $request->description ? $request->description : '';
        if(isset($request->free)){
            $reg->free = $request->free;
        }
        if($request->require_authorizer){
            // echo "auth";
            $reg->require_authorizer = $request->require_authorizer;
            $reg->authorizer_id = $request->authorizer_id;
        }
        // $reg->area_id = session('area_id');
        $reg->user_id = auth()->user()->id;

        $reg->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        AdmReasons::destroy($id);
    }
}
