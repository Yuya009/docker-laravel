<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\User;
use Auth;
use Validator;

class PostsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // 全ての投稿を取得
        $posts = Post::get();
        
        if (Auth::check()) {
             //ログインユーザーのお気に入りを取得
             $favo_posts = Auth::user()->favo_posts()->get();
             
              return view('posts',[
                'posts'=> $posts,
                'favo_posts'=>$favo_posts
              ]);
            
        }else{
            
              return view('posts',[
                'posts'=> $posts
              ]);
        }
    }

    public function index_top()
    {
        // 全ての投稿を取得
        $posts = Post::get();
        $favo_posts = array();
        if (Auth::check()) {
             //ログインユーザーのお気に入りを取得
             //$favo_posts = Auth::user()->favo_posts()->get();
             
              return view('top',[
                'posts'=> $posts,
                'favo_posts'=>$favo_posts
              ]);
        // }else{
        //       return view('top',[
        //         'posts'=> $posts
        //       ]);
        }
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
        //バリデーション 
        $validator = Validator::make($request->all(), [
          'post_title' => 'required|max:255',
          'post_desc' => 'required|max:255',
        ]);

        //画像取得
        $upload_image = $request->file('file_image');
        //画像をフォルダに保存
        if(isset($upload_image)) {
          //アップロードされた画像を保存
          $path = $upload_image->store('uploads', "public");
          $image_name = $request->file('file_image')->getClientOriginalName();//画像名前
        } else {
          //なければデフォルト画像使用する
          $path = 'uploads/book_note_empty.png';//保存場所
          $image_name = 'book_note_empty.png';//画像名
        }
      
        //バリデーション:エラー
        if ($validator->fails()) {
          return redirect('/')
              ->withInput()
              ->withErrors($validator);
        }
      
        //以下に登録処理を記述（Eloquentモデル）
        $posts = new Post;
        $posts->post_title = $request->post_title; //投稿のタイトル
        $posts->post_desc = $request->post_desc; //投稿の本文
        $posts->file_name = $image_name;
        $posts->file_path = $path;//ファイルの保存パス
        $posts->user_id = Auth::id();//ここでログインしているユーザidを登録しています
        $posts->save();
        
        return redirect('/');
     
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(post $post)
    {
        //
        return view('content',['post' => $post]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
        return view('postsedit', ['post' => $post]);
    }

    public function update(Request $request) {
      //バリデーション
      $post = Post::find($request->id);
      $post->post_title = $request->post_title;
      $post->post_desc = $request->post_desc;
      $post->save();

      return redirect('/');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

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

    public function favo($post_id)
    {
      //ログイン中のユーザを取得
      $user = Auth::user();

      //お気に入りする記事
      $post = Post::find($post_id);

      //リレーションの登録
      $post->favo_user()->attach($user);

      return redirect('/');
    }
}
