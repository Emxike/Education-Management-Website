<?php


namespace App\Core\MVC\Services;


use Illuminate\Http\Request;

interface BaseService
{
    function list(Request $request);
    function add(Request $request);
    function update(Request $request, $id);
    function delete(Request $request);
    function fetchById($id);
    function validation($form);
}
