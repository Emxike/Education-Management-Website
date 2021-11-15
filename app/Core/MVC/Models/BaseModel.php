<?php


namespace App\Core\MVC\Models;


use Illuminate\Database\Eloquent\Model;

abstract class BaseModel extends Model
{
    public $timestamps = false;

    protected $guarded = [];
    /**
     * @return mixed
     */
    public static function getTableName() {
        return with(new static())->getTable();
    }
}
