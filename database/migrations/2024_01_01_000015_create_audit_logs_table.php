<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        Schema::create('audit_logs', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('uuid_generate_v4()'));
            $table->uuid('admin_user_id')->nullable();
            $table->string('action');
            $table->string('model_type');
            $table->uuid('model_id');
            $table->jsonb('before')->nullable();
            $table->jsonb('after')->nullable();
            $table->string('ip_address', 45)->nullable();
            $table->string('user_agent')->nullable();
            $table->timestamp('created_at');
            $table->foreign('admin_user_id')->references('id')->on('admin_users')->nullOnDelete();
            $table->index(['model_type', 'model_id']);
            $table->index(['admin_user_id', 'created_at']);
            $table->index('action');
            $table->index('created_at');
        });
    }
    public function down(): void { Schema::dropIfExists('audit_logs'); }
};
