<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    protected $table ='category';
    use softDeletes;
    protected $fillable = ['name', 'slug', 'description'];
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
