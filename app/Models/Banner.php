<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banner extends Model
{
    use SoftDeletes;

    protected $table = 'uttt_banner';

    protected $fillable = [
        'name', 'image', 'position', 'sort_order', 'status',
        'created_by', 'updated_by'
    ];

    protected $dates = ['deleted_at'];
}
