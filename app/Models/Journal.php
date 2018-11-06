<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Journal extends Model
{
	protected $table = 'journal';
    protected $primaryKey = 'id';

    protected $fillable = [
        'less30min',
        'area_id',
        'equipment_id',
        'disrepair_description',
        'continues_used',
        'manufacture_member_id',
        'time_fixed',
        'service_member_id',
        'work_comment',
        'worktypes_id',
        'master_comment',
        'service_comment',
        'status',
    ];

    public function area()
    {
        return $this->belongsTo(Area::class);
    }

    public function equipment()
    {
        return $this->belongsTo(Equipment::class);
    }

    public function worktypes()
    {
        return $this->belongsTo(WorkTypes::class);
    }

    public function servicemember()
    {
        return $this->belongsTo(User::class, 'service_member_id', 'id');
    }

    public function manufacturemember()
    {
        return $this->belongsTo(User::class, 'manufacture_member_id', 'id');
    }

    public function users()
    {
        return $this->belongsTo(User::class);
    }
}
