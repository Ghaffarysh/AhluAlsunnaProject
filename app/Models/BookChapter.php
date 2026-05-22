<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class BookChapter extends Model {
    use HasUuids, SoftDeletes;

    protected $fillable = ['book_id', 'title', 'sort_order', 'content'];

    public function book() { return $this->belongsTo(Book::class); }
}
