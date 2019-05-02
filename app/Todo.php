<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\User;

class Todo extends Model
{
    protected $table = 'todos';

    protected $fillable = [
        'title',
        'description',
        'deadline',
        'completed',
    ];

    protected $cast = [
        'title' => 'array',
        'description' => 'array',
        'deadline' => 'array',
        'completed' => 'array',
    ];


    public function getDescription ($description)
    {
        return ! is_null($description)
        ? $description
        : '';
    }

    // public function owner ()
    // {
    // 	return $this->belongsTo(User::class, 'user_id');
    // }
    
}
