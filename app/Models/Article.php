<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Article extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'title',
        'short_text',
        'full_text',
        'cover'
    ];

    public function tags(){
        return $this->belongsTo(Tag::class,'name','tags');
    }

    public function comments(){
        return $this->hasMany(Comment::class);
    }
}

