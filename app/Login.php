<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Login extends Model
{
    protected $fillable = ['id','user_agent', 'user_ip', 'user_id', 'created_at', 'updated_at'];

}
