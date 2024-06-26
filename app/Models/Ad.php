<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ad extends Model
{
    use HasFactory;

    protected $fillable = [
        'account',
        'content',
        'image',
        'url',
        'imp',
        'click'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
