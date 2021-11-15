<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable
{
    use HasFactory, Notifiable;

    const LOCK = 1;
    const UNLOCK = 0;

    protected $table = "dtb_members";

    protected $guarded = [];

    public $timestamps = false;
    /**
     * @return mixed
     */
    public static function getTableName() {
        return with(new static())->getTable();
    }
}
