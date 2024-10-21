<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class GlobalModel extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'model',
        'url_prefix',
        'icon',
        'add_title',
        'edit_title',
    ];

   public static function findByUrlPrefix($url_prefix)
    {
        return self::where('url_prefix', $url_prefix)->firstOrFail();
    }

}
