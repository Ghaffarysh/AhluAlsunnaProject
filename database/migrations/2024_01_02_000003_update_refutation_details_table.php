<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::table('refutation_details', function (Blueprint $table) {
            // Rejection reason — shown to admin who submitted
            $table->text('rejection_reason')->nullable()->after('review_note');

            // Refutation type now matches UI categories exactly
            // Values: bida | deviant_sect | shubhat | atheism | contemporary
            // Column already exists as string — update comment only via index rename trick
            // We just add an index for faster filtering by type
            $table->index('refutation_type', 'refutation_details_type_idx');
        });
    }
    public function down(): void {
        Schema::table('refutation_details', function (Blueprint $table) {
            $table->dropIndex('refutation_details_type_idx');
            $table->dropColumn('rejection_reason');
        });
    }
};