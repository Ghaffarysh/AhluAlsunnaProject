<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Traits\Auditable;

class Lesson extends Model {
    use HasUuids, SoftDeletes, Auditable;

    protected $fillable = [
        'type',
        'parent_id',
        'scholar_id',
        'category_id',
        'title',
        'slug',
        'body',
        'audio_path',
        'audio_url',
        'audio_duration',
        'sort_order',
        'part_number',
        'status',
        'listen_count',
        'created_by',
        'updated_by',
    ];

    public function scholar()          { return $this->belongsTo(Scholar::class); }
    public function category()         { return $this->belongsTo(Category::class); }
    public function curriculum()       { return $this->belongsTo(Curriculum::class, 'parent_id'); }
    public function lectureGroup()     { return $this->belongsTo(LectureGroup::class, 'parent_id'); }
    public function sermonDetail()     { return $this->hasOne(SermonDetail::class); }
    public function refutationDetail() { return $this->hasOne(RefutationDetail::class); }
    public function createdBy()        { return $this->belongsTo(AdminUser::class, 'created_by'); }

    public function scopePublished($q)         { return $q->where('status', 'published'); }
    public function scopeOfType($q, string $t) { return $q->where('type', $t); }
}