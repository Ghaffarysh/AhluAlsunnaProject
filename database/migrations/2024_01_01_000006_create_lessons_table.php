<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        Schema::create('lessons', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('uuid_generate_v4()'));
            $table->enum('type', ['curriculum', 'sermon', 'lecture', 'refutation']);
            $table->uuid('parent_id')->nullable();
            $table->uuid('scholar_id');
            $table->uuid('category_id')->nullable();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('body')->nullable();
            $table->string('audio_path')->nullable();
            $table->string('audio_url')->nullable();
            $table->unsignedInteger('audio_duration')->nullable();
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->unsignedBigInteger('listen_count')->default(0);
            $table->uuid('created_by');
            $table->uuid('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('scholar_id')->references('id')->on('scholars');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('created_by')->references('id')->on('admin_users');
            $table->index(['type', 'status']);
            $table->index(['parent_id', 'sort_order']);
            $table->index(['scholar_id', 'type', 'status']);
        });

        DB::statement("
            CREATE INDEX lessons_fulltext_idx ON lessons
            USING GIN (
                to_tsvector('simple',
                    coalesce(title,'') || ' ' || coalesce(body,'')
                )
            )
        ");
    }
    public function down(): void { Schema::dropIfExists('lessons'); }
};
