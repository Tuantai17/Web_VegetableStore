<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {  // Sửa từ 'user' thành 'users'
            $table->id();
            $table->string('name', 255);
            $table->string('email', 255)->unique();  // Đảm bảo email là duy nhất
            $table->string('phone', 255)->unique();  // Đảm bảo số điện thoại là duy nhất
    
            $table->string('name', 255);  // Không nullable, vì tên là bắt buộc
            $table->string('password', 255);
            $table->string('address', 1000)->nullable();  // Cho phép null nếu không có địa chỉ
            $table->string('avatar', 255)->nullable();  // Có thể không có ảnh đại diện
            $table->enum('roles', ['customer', 'admin'])->default('customer');  // Quyền mặc định là 'customer'
            $table->unsignedBigInteger('created_by')->nullable();  // Người tạo có thể null
            $table->unsignedBigInteger('updated_by')->nullable();  // Người cập nhật có thể null
    
            $table->boolean('status')->default(1);  // Trạng thái mặc định là 1 (hoạt động)
    
            $table->softDeletes();  // Cho phép soft delete
            $table->timestamps();  // Tạo created_at và updated_at
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user');
    }
};
