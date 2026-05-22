<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Traits\Auditable;

class Curriculum extends Model {
    use HasUuids, SoftDeletes, Auditable;
    protected $fillable = [
        'scholar_id','category_id','book_title','book_author','slug',
        'description','level','cover_image_path','book_pdf_path','status','created_by','updated_by'
    ];
    public function scholar()   { return $this->belongsTo(Scholar::class); }
    public function category()  { return $this->belongsTo(Category::class); }
    public function createdBy() { return $this->belongsTo(AdminUser::class, 'created_by'); }
    public function lessons() {
        return $this->hasMany(Lesson::class, 'parent_id')
                    ->where('type', 'curriculum')
                    ->orderBy('sort_order');
    }
    public function scopePublished($q) { return $q->where('status', 'published'); }
}