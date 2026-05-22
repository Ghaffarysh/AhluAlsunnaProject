<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void {
        Schema::create('admin_notifications', function (Blueprint $table) {
            $table->uuid('id')->primary()->default(DB::raw('uuid_generate_v4()'));
            $table->uuid('sent_by');
            $table->string('target_role')->nullable();
            $table->uuid('target_user_id')->nullable();
            $table->text('message');
            $table->enum('level', ['info', 'warning', 'urgent'])->default('info');
            $table->timestamp('expires_at')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('sent_by')->references('id')->on('admin_users');
            $table->index(['target_role', 'expires_at']);
        });

        Schema::create('admin_notification_reads', function (Blueprint $table) {
            $table->uuid('notification_id');
            $table->uuid('admin_user_id');
            $table->timestamp('read_at');
            $table->primary(['notification_id', 'admin_user_id']);
        });
    }
    public function down(): void {
        Schema::dropIfExists('admin_notification_reads');
        Schema::dropIfExists('admin_notifications');
    }
};
