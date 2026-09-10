<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class submissions_test_results extends Model
{
    protected $fillable = [
        'submission_id',
        'test_case_id',
        'passed',
        'actual_output',
        'execution_time_ms',
    ];

    protected function casts(): array
    {
        return ['passed' => 'boolean'];
    }

    public function submission()
    {
        return $this->belongsTo(submissions::class, 'submission_id');
    }

    public function testCase()
    {
        return $this->belongsTo(test_cases::class, 'test_case_id');
    }
}
