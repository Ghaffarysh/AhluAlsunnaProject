<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Traits\Auditable;

class Book extends Model {
    use HasUuids, SoftDeletes, Auditable;
    protected $fillable = [
        'category_id','title','slug','author','description','book_type','level',
        'cover_image_path','pdf_path','allow_online_reading','allow_download',
        'download_count','status','created_by','updated_by'
    ];
    protected $casts = [
        'allow_online_reading' => 'boolean',
        'allow_download'       => 'boolean',
    ];
    public function category() { return $this->belongsTo(Category::class); }
    public function chapters() { return $this->hasMany(BookChapter::class)->orderBy('sort_order'); }
    public function scopePublished($q) { return $q->where('status', 'published'); }
}