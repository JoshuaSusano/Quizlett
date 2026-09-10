<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class test_cases extends Model
{
    protected $fillable = [
        'problem_id',
        'input',
        'expected_output',
        'is_hidden',
    ];

    protected function casts(): array
    {
        return ['is_hidden' => 'boolean'];
    }

    public function problem()
    {
        return $this->belongsTo(problems::class, 'problem_id');
    }
}
