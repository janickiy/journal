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
        'time_weight',
        'area_id',
    ];

    /**
     * @param $query
     * @return mixed
     */
    public function scopeStatus($query)
    {
        return $query->where('status', 1);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function area()
    {
        return $this->belongsTo(Area::class);
    }
}
