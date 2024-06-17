<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use App\Models\User;

//require 'vendor/autoload.php';
use App\Models\Ad;


class UsersController extends Controller
{
    public function index()
    {
        // ユーザー一覧をidの降順で取得
        $users = User::orderBy('id', 'desc')->paginate(10);
        
        // ユーザー一覧ビューでそれを表示
        return view('users.index', [
            'users' => $users
        ]);
    }
    
    public function show($id)
    {
        // idの値でユーザーを検索して取得
        $user = User::findOrFail($id);
        
        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();
        
        // ユーザーの投稿一覧を作成日時の降順で取得
        $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);

        // ユーザー詳細ビューでそれを表示
        return view('users.show', [
            'user' => $user,
            'microposts' => $microposts
        ]);
    }
    
    /**
     * ユーザーのフォロー一覧ページを表示するアクション。
     *
     * @param  $id  ユーザーのid
     * @return \Illuminate\Http\Response
     */
    public function followings($id)
    {
        // idの値でユーザーを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザーのフォロー一覧を取得
        $followings = $user->followings()->paginate(10);

        // フォロー一覧ビューでそれらを表示
        return view('users.followings', [
            'user' => $user,
            'users' => $followings,
        ]);
    }

    /**
     * ユーザーのフォロワー一覧ページを表示するアクション。
     *
     * @param  $id  ユーザーのid
     * @return \Illuminate\Http\Response
     */
    public function followers($id)
    {
        // idの値でユーザーを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザーのフォロワー一覧を取得
        $followers = $user->followers()->paginate(10);

        // フォロワー一覧ビューでそれらを表示
        return view('users.followers', [
            'user' => $user,
            'users' => $followers,
        ]);
    }

     public function favoritings($id)
    {
        // idの値でユーザーを検索して取得
        $user = User::findOrFail($id);

        // 関係するモデルの件数をロード
        $user->loadRelationshipCounts();

        // ユーザーのフォロー一覧を取得
        $microposts = $user->favoritings()->orderBy('created_at', 'desc')->paginate(10);

        // フォロー一覧ビューでそれらを表示
        return view('users.favoritings', [
            'user' => $user,
            'microposts' => $microposts
        ]);
        
    }
    
    // getでtasks/id/editにアクセスされた場合の「更新画面表示処理」
    public function edit($user)
    {
        //if ($user -> id == Auth::user()->id){
        $user = Auth::user();
        // メッセージ編集ビューでそれを表示
        return view('users.useredit', ['user' => $user]);
        
    }
    
    // putまたはpatchでtasks/idにアクセスされた場合の「更新処理」
    public function update(Request $request, $user)
    {
        /*
        // バリデーション
        $request->validate([
            'name' => 'required',
            'content' => 'required|max:255',
        ]);
        */
        
        // メッセージを更新
        if ($request->name != NULL){
            Auth::user()->name = $request->name;
        }
        if ($request->email != NULL){
            Auth::user()->email = $request->email;
        }
        if ($request->password != NULL){
            Auth::user()->password = $request->password;
        }
        
        Auth::user()->save();

        // トップページへリダイレクトさせる
        return redirect('/');
    }
    
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

        //トップページへリダイレクトさせる
        return redirect('/');
    }
}