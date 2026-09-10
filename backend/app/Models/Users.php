<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Users extends Authenticatable
{
	use Notifiable;

	protected $hidden = [
		'password',
		'remember_token',
	];

	protected $fillable = [
		'name',
		'email',
		'password',
		'role',
	];

	protected function casts(): array
	{
		return [
			'password' => 'hashed',
		];
	}
}
