<?php

namespace App\Models;


use App\Core\MVC\Models\BaseModel;

class Menu extends BaseModel
{
    protected $table = 'mtb_menu';

    function permission(){
        return $this->hasOne(Permission::class, "menu_id", "id");
    }
}
