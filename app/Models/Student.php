<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Student extends Authenticatable
{
    protected $table='students';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'name',
        'username',
        'password',
        'status',
        'school_id',
        'lab_id'
    ];

    public function lab():BelongsTo
    {
        return $this->belongsTo(Lab::class,'lab_id','id');
    }

    public function school():BelongsTo
    {
        return $this->belongsTo(School::class,'school_id','id');
    }

    public function taskDetail():HasMany
    {
        return $this->hasMany(TaskDetail::class,'student_id','id');
    }
}
