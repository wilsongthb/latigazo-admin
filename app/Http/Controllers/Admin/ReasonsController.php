<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\AdmReasons;
use App\Models\AdmBudgets;
use DB;

class ReasonsController extends Controller
{
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
            ->where('r.area_id', request()->area_id)
            ->get();

        // cargar presupuesto
        foreach ($reasons as $key => &$value) {
            $budget = AdmBudgets::
                where('reason_id', $value->id)
                ->orderBy('id', 'DESC')
                ->first();

            if($budget){
                $total = DB::select(
                    "SELECT 
                        IFNULL(SUM(o.quantity), 0) AS total
                    FROM adm_budgets AS b
                    LEFT JOIN adm_outputs AS o ON o.budget_id = b.id
                    WHERE b.id ='$budget->id'"
                )[0]->total;

                $value->max = $budget->max - $total;
                $value->budget = $budget;
            }
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
        //
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
        //
    }
}
