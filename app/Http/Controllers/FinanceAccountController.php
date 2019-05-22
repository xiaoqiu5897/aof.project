<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\FinanceAccount;
use Datatables;

class FinanceAccountController extends Controller
{
    public function find($id){
        $finance_accounts = FinanceAccount::where('parent_id', '=', $id)->get();

        return response()->json(['finance_accounts'=>$finance_accounts]);
    }

    public function getList()
    {
        $finance_accounts = FinanceAccount::orderBy('id','DESC')->get();
        //dd($finance_accounts);
        if (request()->ajax()) {
            return Datatables::of($finance_accounts)
                ->addColumn('action', function ($finance_accounts) {
                    if ($finance_accounts->parent_id != 0) {
                        return '<a class="btn btn-xs btn-edit" data-tooltip="tooltip" title="Ghi sổ" data-show-path="" id="'.$finance_accounts->id.'" style="background: #36c6d3; color: white"> <i class="fa fa-edit" aria-hidden="true"></i></a>';
                    } else {
                        return '';
                    }
                })
                
                ->addIndexColumn()

                ->make(true);
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('finance_account.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $parents = FinanceAccount::select('id', 'name')->where('level', '=', 0)->get();

        return response()->json(['parents'=>$parents]);
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
