<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class RefutationDetail extends Model {
    use HasUuids;

    protected $fillable = [
        'lesson_id',
        'refutation_type',   // bida | deviant_sect | shubhat | atheism | contemporary
        'approval_status',   // pending | approved | rejected
        'reviewed_by',
        'review_note',
        'rejection_reason',
        'reviewed_at',
    ];

    protected $casts = ['reviewed_at' => 'datetime'];

    public function lesson()     { return $this->belongsTo(Lesson::class); }
    public function reviewedBy() { return $this->belongsTo(AdminUser::class, 'reviewed_by'); }

    public function scopePending($q)  { return $q->where('approval_status', 'pending'); }
    public function scopeApproved($q) { return $q->where('approval_status', 'approved'); }
    public function scopeRejected($q) { return $q->where('approval_status', 'rejected'); }
}