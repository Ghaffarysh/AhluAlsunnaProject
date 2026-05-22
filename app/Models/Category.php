<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Traits\Auditable;

class Category extends Model {
    use HasUuids, SoftDeletes, Auditable;

    protected $fillable = [
        'name', 'slug', 'type', 'color', 'icon', 'sort_order', 'is_active'
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function scopeOfType($query, string $type) {
        return $query->where('type', $type)
                     ->where('is_active', true)
                     ->orderBy('sort_order');
    }
}
