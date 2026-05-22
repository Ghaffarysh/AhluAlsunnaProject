<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Traits\Auditable;

class Fatwa extends Model {
    use HasUuids, SoftDeletes, Auditable;
    protected $fillable = [
        'scholar_id','category_id','question_title','slug','question_body',
        'ruling','evidence','detail','fatwa_date','status','view_count','created_by','updated_by'
    ];
    protected $casts = ['fatwa_date' => 'date'];
    public function scholar()   { return $this->belongsTo(Scholar::class); }
    public function category()  { return $this->belongsTo(Category::class); }
    public function createdBy() { return $this->belongsTo(AdminUser::class, 'created_by'); }
    public function scopePublished($q) { return $q->where('status', 'published'); }
}