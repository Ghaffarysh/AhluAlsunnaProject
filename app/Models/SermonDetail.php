<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;

class SermonDetail extends Model {
    use HasUuids;

    protected $fillable = ['lesson_id', 'sermon_date'];
    protected $casts    = ['sermon_date' => 'date'];

    public function lesson() { return $this->belongsTo(Lesson::class); }
}
