<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class SummernoteController extends Controller
{
    //summernoteのページ
    public function create(){
        return view('summernote.create');
    }

    //summernoteの内容を保存
    public function store(Request $request){
        $posts = new Post();
        $posts->title = $request->title;
        $posts->body = $request->body;
        
        $posts->save();
        return back()->with('message','投稿しました');
    }

    //画像の保存
    public function image(Request $request){
        $result = $request->file('image')->isValid();
        if($result){
            $original = request()->file('image')->getClientOriginalName();
            $name = $original.'_'.date('Ymd_His');
            request()->file('image')->move('temp',$name);
            echo '/temp/'.$name;
        }
    }

    //summernoteの内容を表示
    public function show(){
        $contents = Post::all();
        
        return view('summernote.show',compact('contents'));
    }

    public function delete($id){
        Post::destroy($id);
        return back();
    }
}
