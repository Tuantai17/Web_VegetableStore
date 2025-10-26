<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
// BẬT SoftDeletes chỉ khi bảng có cột deleted_at. Nếu KHÔNG có, hãy xoá dòng dưới và trait trong class.
use Illuminate\Database\Eloquent\SoftDeletes;

class User extends Authenticatable
{
    use Notifiable;
    // use SoftDeletes;

    protected $table = 'user';      // ✅ bảng thực tế là 'user' (không có 's')
    protected $primaryKey = 'id';
    public $incrementing = true;
    protected $keyType = 'int';

    public $timestamps = true;      // ❗ Đổi thành false nếu bảng không có created_at/updated_at

    protected $fillable = [
        'name',
        'username',
        'email',
        'password',
        'phone',
        'address',
        'avatar',
        'roles',
        'created_by',
        'updated_by',
        'status',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'status'            => 'boolean',
    ];

    // Ví dụ quan hệ
    // public function orders()
    // {
    //     return $this->hasMany(Order::class);
    // }


    public function orders()
{
    return $this->hasMany(Order::class);
}

}
