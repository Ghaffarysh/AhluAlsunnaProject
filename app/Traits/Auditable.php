<?php
namespace App\Traits;

use App\Models\AuditLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Request;

trait Auditable {
    public static function bootAuditable(): void {
        static::created(function ($model) {
            static::writeLog('created', null, $model->getAttributes(), $model);
        });
        static::updated(function ($model) {
            static::writeLog('updated', $model->getOriginal(), $model->getChanges(), $model);
        });
        static::deleted(function ($model) {
            static::writeLog('deleted', $model->getOriginal(), null, $model);
        });
        static::restored(function ($model) {
            static::writeLog('restored', null, $model->getAttributes(), $model);
        });
    }

    private static function writeLog(string $action, $before, $after, $model): void {
        try {
            AuditLog::create([
                'admin_user_id' => Auth::guard('admin')->id(),
                'action'        => $action,
                'model_type'    => get_class($model),
                'model_id'      => $model->id,
                'before'        => $before,
                'after'         => $after,
                'ip_address'    => Request::ip(),
                'user_agent'    => Request::userAgent(),
                'created_at'    => now(),
            ]);
        } catch (\Throwable $e) {
            // Never let audit failure break the main operation
            \Illuminate\Support\Facades\Log::error('AuditLog failed: ' . $e->getMessage());
        }
    }
}
