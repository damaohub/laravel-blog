<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    protected $table = 'blog_article';//竟然要加前缀才行！？

    protected $primaryKey = 'art_id';

    public $timestamps = false;

    public $guarded = [];//空数组，相当于 非
}
