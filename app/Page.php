<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Page extends Authenticatable
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    
    protected $table = 'pages_pages';
    
    protected $fillable = [
        '',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */

       protected $hidden = [
        '',
    ];
   
}
