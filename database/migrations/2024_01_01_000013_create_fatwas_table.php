<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        Schema::create('fatwas', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('uuid_generate_v4()'));
            $table->uuid('scholar_id');
            $table->uuid('category_id')->nullable();
            $table->string('question_title');
            $table->string('slug')->unique();
            $table->text('question_body');
            $table->text('ruling');
            $table->text('evidence');
            $table->text('detail')->nullable();
            $table->date('fatwa_date')->nullable();
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->unsignedBigInteger('view_count')->default(0);
            $table->uuid('created_by');
            $table->uuid('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('scholar_id')->references('id')->on('scholars');
            $table->foreign('category_id')->references('id')->on('categories');
            $table->foreign('created_by')->references('id')->on('admin_users');
            $table->index(['category_id', 'status']);
            $table->index(['scholar_id', 'status']);
        });

        DB::statement("
            CREATE INDEX fatwas_fulltext_idx ON fatwas
            USING GIN (
                to_tsvector('simple',
                    coalesce(question_title,'') || ' ' ||
                    coalesce(question_body,'') || ' ' ||
                    coalesce(ruling,'') || ' ' ||
                    coalesce(detail,'')
                )
            )
        ");
    }
    public function down(): void { Schema::dropIfExists('fatwas'); }
};
