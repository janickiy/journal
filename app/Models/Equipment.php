<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
	protected $table = 'equipment';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'status',
        'description',
        'area_id',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
