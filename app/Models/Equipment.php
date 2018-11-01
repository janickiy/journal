<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
	protected $table = 'equipment';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'status'
    ];

    /**
     * @param $query
     * @return mixed
     */
    public function scopePublished($query)
    {
        return $query->where('status', 1);
    }

    public function getStatusAttribute()
    {
        return $this->attributes['status'] ? 'опубликован' : 'не опубликован';
    }

}
