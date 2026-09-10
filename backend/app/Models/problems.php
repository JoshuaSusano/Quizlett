<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class problems extends Model
{
   protected $fillable = [
        'creator_id',
        'title',
      'description',
      'language',
      'difficulty',
      'input_description',
      'output_description',
      'constraints',
      'starter_code',
      'example_input',
      'example_output',
      'time_limit_ms',
      'memory_limit_kb',
   ];

   public function creator()
   {
      return $this->belongsTo(Users::class, 'creator_id');
   }
}
