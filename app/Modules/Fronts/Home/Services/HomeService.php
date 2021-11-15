<?php

namespace App\Modules\Fronts\Home\Services;

use Illuminate\Http\Request;

interface HomeService
{
    function getCategories();
    function getIdea(Request $request, $my = false);
    function getIdeaDetail($id);
    function getCommentByIdea($id);
    function postIdea(Request $request);
    function postComment(Request $request);
    function saveProfile(Request $request);
    function saveChangePassword(Request $request);
    function checkView($id);
}
