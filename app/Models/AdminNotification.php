<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class AdminNotification extends Model {
    use HasUuids, SoftDeletes;

    protected $fillable = [
        'sent_by', 'target_role', 'target_user_id',
        'message', 'level', 'expires_at'
    ];

    protected $casts = ['expires_at' => 'datetime'];

    public function sentBy() { return $this->belongsTo(AdminUser::class, 'sent_by'); }
}