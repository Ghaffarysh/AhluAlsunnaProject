<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class AuditLog extends Model {
    use HasUuids;

    public $timestamps = false;

    protected $fillable = [
        'admin_user_id', 'action', 'model_type', 'model_id',
        'before', 'after', 'ip_address', 'user_agent', 'created_at'
    ];

    protected $casts = [
        'before'     => 'array',
        'after'      => 'array',
        'created_at' => 'datetime',
    ];

    public function admin() {
        return $this->belongsTo(AdminUser::class, 'admin_user_id');
    }
}
