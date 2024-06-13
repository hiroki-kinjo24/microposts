<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

//require 'vendor/autoload.php';
use App\Models\Ad;


class AdController extends Controller
{
    
    // getでtasks/id/editにアクセスされた場合の「更新画面表示処理」
    public function ad($user)
    {
        $user = Auth::user();
        // メッセージ編集ビューでそれを表示
        return view('users.ad', ['user' => $user]);
        
    }
    
    // putまたはpatchでtasks/idにアクセスされた場合の「更新処理」
    public function addad(Request $request)
    {
        // バリデーション
        
        $request->validate([
            'account' => 'required',
            'content' => 'required',
        ]);
        
        
        
        //画像の処理
        $image = $request->file('image');//file()で受け取る
        if($request->hasFile('image') && $image->isValid()){//画像があるないで条件分岐
            $image = $image->getClientOriginalName();//storeAsで指定する画像名を作成
        }
        else{
            return;
        }
    
        // メッセージを作成
        $ad = new Ad;
        $ad->account = $request->account;
        $ad->content = $request->content;
        $ad->image = $request->file('image')->storeAs('public/strage/images',$image);
        $ad->save();
        
        // ユーザー一覧をidの降順で取得
        $users = User::orderBy('id', 'desc')->paginate(10);
       // ユーザー一覧ビューでそれを表示
        return view('users.index', [
            'users' => $users
        ]);
    }
    
    public function show()
    {
        // メソッドの内容
    }
}
