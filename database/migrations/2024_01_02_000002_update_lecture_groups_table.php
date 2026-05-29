<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('lecture_groups', function (Blueprint $table) {
            // description and total_parts are the only missing columns
            $table->text('description')->nullable()->after('slug');
            $table->unsignedSmallInteger('total_parts')->default(1)->after('is_multi_part');
            // category_id already exists from original migration — skip
        });
    }
    public function down(): void {
        Schema::table('lecture_groups', function (Blueprint $table) {
            $table->dropColumn(['description', 'total_parts']);
        });
    }
};