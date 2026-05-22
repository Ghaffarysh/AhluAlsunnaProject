<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Traits\Auditable;

class Scholar extends Model {
    use HasUuids, SoftDeletes, Auditable;

    protected $fillable = [
        'name', 'title', 'bio', 'photo_path', 'specialization', 'is_active'
    ];

    protected $casts = ['is_active' => 'boolean'];

    public function curricula() { return $this->hasMany(Curriculum::class); }
    public function lessons()   { return $this->hasMany(Lesson::class); }
    public function fatwas()    { return $this->hasMany(Fatwa::class); }
}
