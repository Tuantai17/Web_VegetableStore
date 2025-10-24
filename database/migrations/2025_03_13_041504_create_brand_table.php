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
        Schema::create('brand', function (Blueprint $table) {
            $table->id();
            $table->string('name', 1000);
            $table->string('slug', 1000)->unique()->default('default-slug'); // Thêm giá trị mặc định cho slug
            $table->string('image', 1000)->nullable();
            $table->unsignedInteger('sort_order')->default(0); // Thêm giá trị mặc định cho sort_order
            $table->text('description')->nullable();
            $table->unsignedInteger('created_by');
            $table->unsignedInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes('deleted_at');
            $table->boolean('status');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('brand');
    }
};
