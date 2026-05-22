<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        Schema::create('curricula', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('uuid_generate_v4()'));
            $table->uuid('scholar_id');
            $table->uuid('category_id');
            $table->string('book_title');
            $table->string('book_author');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->enum('level', ['beginner', 'intermediate', 'advanced'])->default('intermediate');
            $table->string('cover_image_path')->nullable();
            $table->string('book_pdf_path')->nullable();
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->uuid('created_by');
            $table->uuid('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('scholar_id')->references('id')->on('scholars');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('created_by')->references('id')->on('admin_users');
            $table->index(['category_id', 'status']);
            $table->index(['scholar_id', 'status']);
            $table->index('status');
        });
    }
    public function down(): void { Schema::dropIfExists('curricula'); }
};
