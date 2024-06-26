<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

use App\Models\Micropost;
use App\Models\Image;
use App\Models\Ad;

class MicropostsController extends Controller
{
    public function index()
    {
        $data = [];
        if (\Auth::check()) { // 認証済みの場合
            // 認証済みユーザーを取得
            $user = \Auth::user();
            
            /*
            // ユーザーの投稿の一覧を作成日時の降順で取得
            // （後のChapterで他ユーザーの投稿も取得するように変更しますが、現時点ではこのユーザーの投稿のみ取得します）
            $microposts = $user->microposts()->orderBy('created_at', 'desc')->paginate(10);
            */
            
            // ユーザーとフォロー中ユーザーの投稿の一覧を作成日時の降順で取得
            $microposts = $user->feed_microposts()->orderBy('created_at', 'desc')->paginate(10);
            $microposts->loadCount(['favoriters']);
            
            $data = [
                'user' => $user,
                'microposts' => $microposts,
            ];
            
            $ads = Ad::all(); // 広告の取得
            
            // dashboardビューでそれらを表示
            //return view('dashboard', $mergedArray);
            // メッセージ一覧ビューでそれを表示
            return view('dashboard', [
                'ads' => $ads,
                'user' => $user,
                'microposts' => $microposts,
            ]); 
            
        }
        
        return view('dashboard');
    }
    
    public function store(Request $request)
    {
        // バリデーション
        $request->validate([
            'content' => 'required|max:255',
        ]);
        
        $image = $request->file('image');//file()で受け取る
        if($request->hasFile('image') && $image->isValid()){//画像があるないで条件分岐
            $image = $image->getClientOriginalName();//storeAsで指定する画像名を作成
            
            // 認証済みユーザー（閲覧者）の投稿として作成（リクエストされた値をもとに作成）
            $request->user()->microposts()->create([
                'content' => $request->content,
                'postimage'=> $request->file('image')->storeAs('public/strage/images',$image)
                //'postimage' => "postimage",
            ]);
            
            //Image::create(['image' => $request->file('image')->storeAs('public/strage/images',$image),]);
        }
        else{
            // 認証済みユーザー（閲覧者）の投稿として作成（リクエストされた値をもとに作成）
            $request->user()->microposts()->create([
                'content' => $request->content,
            ]);
        }
        
        // 前のURLへリダイレクトさせる
        return back();
    }
    
    public function destroy(string $id)
    {
        // idの値で投稿を検索して取得
        $micropost = Micropost::findOrFail($id);
        
        // 認証済みユーザー（閲覧者）がその投稿の所有者である場合は投稿を削除
        if (\Auth::id() === $micropost->user_id) {
            $micropost->delete();
            return back()
                ->with('success','Delete Successful');
        }

        // 前のURLへリダイレクトさせる
        return back()
            ->with('Delete Failed');
    }
}