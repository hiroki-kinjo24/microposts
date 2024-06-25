<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    use HasFactory;

    protected $fillable = ['content', 'postimage'];

    /**
     * この投稿を所有するユーザー。（ Userモデルとの関係を定義）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    public function loadRelationshipCounts()
    {
        $this->loadCount(['favoriters']);
        //$this->loadCount(['microposts', 'followings', 'followers']);
    }
    
    public function favoriters()
    {
        //(相手側のクラス,中間テーブル名,こっちがわのidに対応する中間テーブルのid名,相手側のidに対応する中間テーブルのid名)
        return $this->belongsToMany(User::class, 'favorites', 'micropost_id', 'user_id')->withTimestamps();
    }
    
}
