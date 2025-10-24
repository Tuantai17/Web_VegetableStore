<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes; // ← THÊM DÒNG NÀY

class Post extends Model
{
    use HasFactory, SoftDeletes; // ← THÊM SoftDeletes

    protected $table = 'post';

    protected $fillable = [
        'title',
        'slug',
        'content',
        'description',
        'thumbnail',
        'status',
        'type',
        'topic_id',
    ];
}
