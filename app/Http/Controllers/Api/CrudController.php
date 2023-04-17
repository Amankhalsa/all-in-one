<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use App\Models\Country;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CrudController extends Controller
{
    public function index(Request $request )
    {
        try
        {
            $requestdata = $request->all();
            $search = !empty($requestdata['search'])?  $requestdata['search']:null;
            $posts = Blog::where('title','Like' ,"%$search%")->paginate(5);
             return response()->json([
                 'status' => true, 'message' =>'Data Recived successfull', 'data' => $posts
             ]);
        }
        catch(\Exception $ex)
        {
            
            return response()->json([
                'status' => true, 'message' =>$ex->getMessage(), 'data' => Null
            ]);
        }

    }

    public function create(Request $request):JsonResponse
    {
        try{
            $country = Country::all();
            return response()->json([
                'status' => true, 'message' => "Data Recived successfully!", 'post' => $country 
            ], 200);
        }
        catch(\Exception $ex)
        {
            return response()->json([
                'status' => 500, 'message' =>$ex->getMessage(), 'data' => Null
            ]);
        }
    }


    public function store(Request $request)
    {
        try
        {
            $requesteddata  = $request->all();
        
           if(!empty($requesteddata['title'])){
            $fileName = time().'_ad'.$requesteddata['title']->getClientOriginalName();
            $requesteddata['title']->move(public_path('profile/'), $fileName  );

         
            $requesteddata['title']  = $fileName ;
           }
            $blog = Blog::create($requesteddata );
     
            return response()->json([
                'status' => 200,
                'message' => "Post Created successfully!",
                'post' => $blog
            ], 200);
        }
        catch(\Exception $ex)
        {
            return response()->json([
                'status' => 500, 'message' =>$ex->getMessage(), 'data' => Null
            ]);
        }
    }


    public function show($id)
    {
        //
        }


    public function edit($id)
    {
        //
        try{
            $country = Country::all();
            return response()->json([
                'status' => true, 'message' => "Data Recived successfully!", 'post' =>['user_data'=>$id ,'countries'=> $country  ]
            ], 200);
        }
        catch(\Exception $ex)
        {
            return response()->json([
                'status' => 500, 'message' =>$ex->getMessage(), 'data' => Null
            ]);
        }
        }


    public function update(Request $request, $id)
    {
        //
        }


    public function destroy($id)
    {
        $blog = Blog::find($id );
        $blog->delete();
        return response()->json([
            'status' => 200,
            'message' => "Post Deleted successfully!",
        ], 200);
    }
}
