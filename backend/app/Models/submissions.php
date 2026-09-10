<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class submissions extends Model
{
    protected $fillable = [
        'user_id',
        'problem_id',
        'language',
        'source_code',
        'status',
        'score',
        'execution_time_ms',
        'memory_used_kb',
    ];

    protected function casts(): array
    {
        return ['score' => 'decimal:2'];
    }

    public function user()
    {
        return $this->belongsTo(Users::class, 'user_id');
    }

    public function problem()
    {
        return $this->belongsTo(problems::class, 'problem_id');
    }
}
