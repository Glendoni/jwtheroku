<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pagetranslation extends Model
{
    /**
     * Get the user that owns the phone.
     */
    
    protected $table = 'pages_default_pages_translations';
    
    
      
    
     public function hasones()
    {
        
         return $this->hasOne('App\Page','id', 'id');
        
    }
    
    public function hasmanys()
    {
        
         return $this->hasMany('App\Page','parent_id');
        
    }
       public function belongsToManys()
    {
        return $this->belongsToMany('App\Page', 'id', 'entry_id');
    }
}