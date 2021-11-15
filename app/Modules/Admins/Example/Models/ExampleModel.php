<?php


namespace App\Modules\Admins\Example\Models;


use App\Models\Example;

class ExampleModel extends Example
{
    protected $fillable = [
        'name', 'content', 'created_by', 'created_at'
    ];

    protected $hidden = [
        'updated_at', 'deleted_at', 'updated_by', 'deleted_by',
    ];
}
