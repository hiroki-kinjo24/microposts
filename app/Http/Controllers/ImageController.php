<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Image;

class ImageController extends Controller
{
    public function index()
    {
     $images = Image::all();//レコード取得
     //return view('image/index',compact('images')); //一覧ページ表示
     return view('image/index', $images); //一覧ページ表示
     }

    public function form()
    {
    return view('image/form');//投稿フォーム表示
    }

    //保存処理がちょい複雑かもぉ(o_o)「
    public function store(Request $request){
        //画像の処理
        $image = $request->file('image');//file()で受け取る
        if($request->hasFile('image') && $image->isValid()){//画像があるないで条件分岐
            $image = $image->getClientOriginalName();//storeAsで指定する画像名を作成
        }
        else{
            return;
        }
        
        $user = \Auth::user();
        $user->image = $request->file('image')->storeAs('public/strage/images',$image);
        //$user->image = $request->file('image');
        $user->save();
        
        //Image::create(['image' => $request->file('image')->storeAs('public/images',$image),]);
        //storage/app/public/images(imagesは作られる)に保存
        
        // トップページへリダイレクトさせる
        return redirect('/');
        
        //return redirect('image.index');
    }
    
    public function show()
    {
        // メソッドの内容
    }
}
