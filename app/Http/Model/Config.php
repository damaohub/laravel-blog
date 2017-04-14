<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Config extends Model
{
    protected $table = 'blog_config';//竟然要加前缀才行！？

    protected $primaryKey = 'conf_id';

    public $timestamps = false;

    public $guarded = [];//空数组，相当于 非
}
