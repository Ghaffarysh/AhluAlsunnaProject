<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        Schema::create('books', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('uuid_generate_v4()'));
            $table->uuid('category_id')->nullable();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('author');
            $table->text('description')->nullable();
            $table->enum('book_type', ['matn', 'sharh', 'reference', 'risala'])->default('reference');
            $table->enum('level', ['beginner', 'intermediate', 'advanced'])->default('intermediate');
            $table->string('cover_image_path')->nullable();
            $table->string('pdf_path')->nullable();
            $table->boolean('allow_online_reading')->default(true);
            $table->boolean('allow_download')->default(true);
            $table->unsignedBigInteger('download_count')->default(0);
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->uuid('created_by');
            $table->uuid('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('created_by')->references('id')->on('admin_users');
            $table->index(['category_id', 'status']);
            $table->index('status');
        });

        DB::statement("
            CREATE INDEX books_fulltext_idx ON books
            USING GIN (
                to_tsvector('simple',
                    coalesce(title,'') || ' ' ||
                    coalesce(author,'') || ' ' ||
                    coalesce(description,'')
                )
            )
        ");
    }
    public function down(): void { Schema::dropIfExists('books'); }
};
