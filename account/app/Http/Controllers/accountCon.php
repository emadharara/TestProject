<?php

namespace App\Http\Controllers;

use App\account;
use App\catigury;
use App\subCat;
use Illuminate\Http\Request;

class accountCon extends Controller
{
    public function allAccount(){
     $data =  account::all();
     $data2 =catigury::all();
        return view('home', ['account' => $data , 'cat'=> $data2]);
    }
    public static function getNameCat($catId){
        $data = catigury::where('id',$catId)->get();
        return $data;
    }
    public static function getNamesub($subId){
        $data = subCat::where('id',$subId)->get();
        return $data;
    }
    public function getSup(Request $request)
    {
        $m_supCat = $request->m_supCat;
        $arrSup = subCat::where('catId', $m_supCat)->get();
        echo json_encode($arrSup);

    }
    public function getData(Request $request){
        $m_supCat = $request->m_supCat;
        $arrSup = account::where('catId', $m_supCat)->get();
        echo json_encode($arrSup);
    }
    public function getData2(Request $request){
        $supCat = $request->supCat;
        $arrSup = account::where('subCatId', $supCat)->get();
        echo json_encode($arrSup);
    }

}
