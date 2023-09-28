<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    use HasFactory;

    protected $attributes = [
        'status' => 0,
    ];

    protected $fillable = [
        'list_id', 
        'user_id',
        'title',
        'status'
    ];
    

    public function user(){
        return $this->belongsTo('App\Models\User', 'user_id', 'id');
    }

    public function taskList()
    {
        return $this->belongsToMany('App\Models\Tasks', 'list_id', 'user_id');
        // return $this->belongsTo('App\Tasks', 'list_id', 'id');
    }
}
