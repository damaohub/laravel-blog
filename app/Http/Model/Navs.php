<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Navs extends Model
{
    protected $table = 'navs';//竟然要加前缀才行！？

    protected $primaryKey = 'nav_id';

    public $timestamps = false;

    public $guarded = [];//空数组，相当于 非
}
