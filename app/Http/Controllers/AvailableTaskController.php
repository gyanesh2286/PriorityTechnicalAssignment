<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;
class AvailableTaskController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $strJsonRecords     = file_get_contents(public_path().'/todo.json');
        $arrJsonRecords     = json_decode($strJsonRecords, true);
        return response()->json(['status'=>'success','data'=>$arrJsonRecords],200);
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
        $strJsonRecords             = file_get_contents(public_path().'/todo.json');
        $arrJsonRecords             = json_decode($strJsonRecords, true);
        $intInputHours              = $intHours   = $request->inputRemainingHours;
        $arrTaskWouldBeInProgress   = [];
        $arrTaskCanComplete         = [];
        $intInputHours              = $intInputHours+8;
        $intHours                   = ($intHours>8)?8:$intHours;
        foreach($arrJsonRecords as $key=>$value){
            
            if($value['estimate']<=$intHours && $value['status']!="Done"){
                $arrTaskCanComplete[]=$value;
                $intHours        = $intHours-$value['estimate'];
            }else if($value['estimate']<=$intInputHours && $value['status']!="Done"){
                $arrTaskWouldBeInProgress[]=$value;
                $intInputHours        = $intInputHours-$value['estimate'];
            }
           
        }
       
        uasort($arrTaskCanComplete, function($arrFirst, $arrSecond) {
            return $arrFirst['priority'] - $arrSecond['priority'];
        });
        uasort($arrTaskCanComplete, function($arrFirst, $arrSecond) {
            return $arrFirst['due_date'] - $arrSecond['due_date'];
        });
        uasort($arrTaskWouldBeInProgress, function($arrFirst, $arrSecond) {
            return $arrFirst['priority'] - $arrSecond['priority'];
        });
        uasort($arrTaskWouldBeInProgress, function($arrFirst, $arrSecond) {
            return $arrFirst['due_date'] - $arrSecond['due_date'];
        });
        
        return response()->json(['status'=>'success','arrTaskCanComplete'=>$arrTaskCanComplete,'arrTaskWouldBeInProgress'=>$arrTaskWouldBeInProgress],200);
       
       
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
