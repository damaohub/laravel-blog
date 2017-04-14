<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    protected $table = 'blog_user';//竟然要加前缀才行！？

    protected $primaryKey = 'user_id';

    public $timestamps = false;
}
