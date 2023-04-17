<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    //
    public function index()
    {
        $posts = Post::orderBy('order','ASC')->get();
        return view('post',compact('posts'));
    }

    public function update(Request $request)
    {
        $posts = Post::all();
        foreach ($posts as $post) {
            foreach ($request->order as $order) {
                if ($order['id'] == $post->id) {
                    $post->update(['order' => $order['position']]);
                }
            }
        }
        return response('Update Successfully.', 200);
    }


    public function show_post($id){

        $post =   Post::find($id);

        return view('showpost',compact('post'));
    }


    public function allDelete(Request $request ){
        $ids = $request->get('ids');
        // dd($ids);
        foreach($ids as $val){
            DB::table('posts')->where('id', $val)->delete();
        }
        return redirect()->back()->with('success' ,'Data deleted success');
}

}
