<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Topic extends Model
{
    
        use SoftDeletes;
    
        protected $table = 'uttt_topic';
    
        // Thêm dòng này nếu chưa có
        protected $fillable = ['name', 'slug', 'description', 'status', 'created_by', 'updated_by'];
    
    

}
