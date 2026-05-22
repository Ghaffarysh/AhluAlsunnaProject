<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        Schema::create('fatwa_questions', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('uuid_generate_v4()'));
            $table->string('title');
            $table->text('question_body');
            $table->string('sender_name')->nullable();
            $table->string('sender_email')->nullable();
            $table->string('sender_ip', 45)->nullable();
            $table->enum('status', ['new', 'under_review', 'answered', 'rejected'])->default('new');
            $table->uuid('assigned_to')->nullable();
            $table->uuid('fatwa_id')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('assigned_to')->references('id')->on('admin_users')->nullOnDelete();
            $table->index('status');
            $table->index('created_at');
        });
    }
    public function down(): void { Schema::dropIfExists('fatwa_questions'); }
};
