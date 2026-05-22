<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        Schema::create('sermon_details', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('uuid_generate_v4()'));
            $table->uuid('lesson_id')->unique();
            $table->date('sermon_date')->nullable();
            $table->timestamps();
            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');
        });
    }
    public function down(): void { Schema::dropIfExists('sermon_details'); }
};
