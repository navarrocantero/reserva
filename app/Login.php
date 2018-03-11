<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    public $timestamps = false;

    protected $fillable = ['id','user_agent', 'user_ip', 'user_id', 'login', 'created_at'];

}
