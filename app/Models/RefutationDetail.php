<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class RefutationDetail extends Model {
    use HasUuids;

    protected $fillable = [
        'lesson_id', 'refutation_type', 'approval_status',
        'reviewed_by', 'review_note', 'reviewed_at'
    ];

    protected $casts = ['reviewed_at' => 'datetime'];

    public function lesson()     { return $this->belongsTo(Lesson::class); }
    public function reviewedBy() { return $this->belongsTo(AdminUser::class, 'reviewed_by'); }
}
