<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        Schema::create('book_chapters', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('uuid_generate_v4()'));
            $table->uuid('book_id');
            $table->string('title');
            $table->unsignedSmallInteger('sort_order')->default(0);
            $table->text('content')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('book_id')->references('id')->on('books')->onDelete('cascade');
            $table->index(['book_id', 'sort_order']);
        });
    }
    public function down(): void { Schema::dropIfExists('book_chapters'); }
};
