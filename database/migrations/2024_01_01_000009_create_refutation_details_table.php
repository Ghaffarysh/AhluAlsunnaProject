<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        Schema::create('refutation_details', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('uuid_generate_v4()'));
            $table->uuid('lesson_id')->unique();
            $table->string('refutation_type');
            $table->enum('approval_status', ['pending', 'approved', 'rejected'])->default('pending');
            $table->uuid('reviewed_by')->nullable();
            $table->text('review_note')->nullable();
            $table->timestamp('reviewed_at')->nullable();
            $table->timestamps();
            $table->foreign('lesson_id')->references('id')->on('lessons')->onDelete('cascade');
            $table->foreign('reviewed_by')->references('id')->on('admin_users')->nullOnDelete();
            $table->index('approval_status');
        });
    }
    public function down(): void { Schema::dropIfExists('refutation_details'); }
};
