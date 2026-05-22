<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class FatwaQuestion extends Model {
    use HasUuids, SoftDeletes;

    protected $fillable = [
        'title', 'question_body', 'sender_name', 'sender_email',
        'sender_ip', 'status', 'assigned_to', 'fatwa_id'
    ];

    public function assignedTo() { return $this->belongsTo(AdminUser::class, 'assigned_to'); }
    public function fatwa()      { return $this->belongsTo(Fatwa::class); }
    public function scopeNew($q) { return $q->where('status', 'new'); }
}
