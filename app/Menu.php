<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    /**
     * Indicates if the model should be timestamped.
     *
     * @var bool
     */

    const STATUS_ARRAY = [];
    const VISIBILITY_ARRAY = [];
    public $timestamps = false;

    public function parent()
    {
        return $this->hasOne('App\Menu', 'id', 'parent_id');
    }

    public function children()
    {
        return $this->hasMany('App\Menu', 'parent_id', 'id');
    }

    public function groups()
    {
        return $this->belongsToMany('App\Group', 'group_menu');
    }
}
