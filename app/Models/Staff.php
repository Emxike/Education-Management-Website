<?php

namespace App\Models;

use App\Core\MVC\Models\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Staff extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $table = "dtb_staff";

    protected $guarded = [];

    public $timestamps = false;
    /**
    * @return mixed
    */
    public static function getTableName() {
        return with(new static())->getTable();
    }
}
