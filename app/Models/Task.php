<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Task extends Model
{
    protected $table='tasks';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'desc',
        'due'
    ];

    public function taskDetail():HasMany
    {
        return $this->hasMany(TaskDetail::class,'task_id','id');
    }
}
