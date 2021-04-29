<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskList extends Model
{
    use HasFactory;

    protected $fillable = ['title'];

    public function tasks()
    {
        return $this->hasMany(Task::class, 'list_id');
    }
}
