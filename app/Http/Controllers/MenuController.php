<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOMeta;
use Artesaos\SEOTools\Facades\OpenGraph;
use Artesaos\SEOTools\Facades\TwitterCard;
use Artesaos\SEOTools\Facades\JsonLd;
// OR with multi
use Artesaos\SEOTools\Facades\JsonLdMulti;

// OR use only single facades
use Artesaos\SEOTools\Facades\SEOTools;
class MenuController extends Controller
{

    public function welcomepage(){
        SEOMeta::setTitle('My Trip Friend ');
        SEOMeta::setDescription('My Trip Friend ');
        SEOMeta::setCanonical('https://MyTripFriend.com');
        return view('welcome');
    }
    public function index(Request $request){
        $data = Menu::orderBy('sort_id','asc')->get();
        return view('menu',compact('data'));
    }

    public function updateOrder(Request $request){
        if($request->has('ids')){
            $arr = explode(',',$request->input('ids'));
            foreach($arr as $sortOrder => $id){
                $menu = Menu::find($id);
                $menu->sort_id = $sortOrder;
                $menu->save();
            }
            return ['success'=>true,'message'=>'Updated'];
        }
    }
}