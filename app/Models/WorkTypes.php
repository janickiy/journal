<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkTypes extends Model
{
	protected $table = 'worktypes';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'code',
    ];
}
