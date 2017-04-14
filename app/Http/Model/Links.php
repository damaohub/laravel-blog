<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Links extends Model
{
    protected $table = 'links';//竟然要加前缀才行！？

    protected $primaryKey = 'id';

    public $timestamps = false;

    public $guarded = [];//空数组，相当于 非
}
