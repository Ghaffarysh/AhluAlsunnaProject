<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('lessons', function (Blueprint $table) {
            // Part number for multi-part lectures (null = single lecture)
            $table->unsignedSmallInteger('part_number')->nullable()->after('sort_order');
        });
    }
    public function down(): void {
        Schema::table('lessons', function (Blueprint $table) {
            $table->dropColumn('part_number');
        });
    }
};