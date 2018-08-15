<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OauthAccount extends Model
{
    //
    protected $fillable = [
        'user_id',
        'oauth_id',
        'type',
    ];
}
