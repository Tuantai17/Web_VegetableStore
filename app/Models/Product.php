<?php

// namespace App\Models;

// use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\SoftDeletes;

// class Product extends Model
// {
//     protected $table ='product';
//     use softDeletes;

// }




namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes; // Đảm bảo sử dụng SoftDeletes đúng

    protected $table = 'product'; // Xác định bảng trong CSDL

    protected $fillable = [
        'name',
        'category_id',
        'brand_id',
        'thumbnail',
        'price',
        'description',
        'status'
    ];

    // Quan hệ với bảng Category
    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    // Quan hệ với bảng Brand
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'id');
    }
}


