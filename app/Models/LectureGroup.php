<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Traits\Auditable;

class LectureGroup extends Model {
    use HasUuids, SoftDeletes, Auditable;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'scholar_id',
        'category_id',
        'is_multi_part',
        'total_parts',
        'status',
        'created_by',
    ];

    protected $casts = ['is_multi_part' => 'boolean'];

    public function scholar()  { return $this->belongsTo(Scholar::class); }
    public function category() { return $this->belongsTo(Category::class); }

    public function parts() {
        return $this->hasMany(Lesson::class, 'parent_id')
                    ->where('type', 'lecture')
                    ->orderBy('part_number')
                    ->orderBy('sort_order');
    }

    public function scopePublished($q) { return $q->where('status', 'published'); }
}