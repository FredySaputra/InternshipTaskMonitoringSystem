<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TaskDetail extends Model
{
     protected $table='task_details';
    protected $primaryKey = 'id';
    protected $keyType = 'int';
    public $incrementing = true;
    public $timestamps = true;

    protected $fillable = [
        'proof',
        'sub_stat',
        'task_id',
        'student_id'
    ];

    public function student():BelongsTo
    {
        return $this->belongsTo(Student::class,'student_id','id');
    }

    public function task():BelongsTo
    {
        return $this->belongsTo(Task::class,'task_id','id');
    }
}
