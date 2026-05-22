<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        Schema::create('lecture_groups', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('uuid_generate_v4()'));
            $table->string('title');
            $table->string('slug')->unique();
            $table->uuid('scholar_id');
            $table->uuid('category_id')->nullable();
            $table->boolean('is_multi_part')->default(false);
            $table->enum('status', ['draft', 'published', 'archived'])->default('draft');
            $table->uuid('created_by');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('scholar_id')->references('id')->on('scholars');
            $table->foreign('created_by')->references('id')->on('admin_users');
            $table->index(['scholar_id', 'status']);
        });
    }
    public function down(): void { Schema::dropIfExists('lecture_groups'); }
};
