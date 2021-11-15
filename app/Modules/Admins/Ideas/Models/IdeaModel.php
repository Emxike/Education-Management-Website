<?php

namespace App\Modules\Admins\Ideas\Models;

use App\Models\Idea;

class IdeaModel extends Idea
{
    function category() {
        return $this->belongsTo(CategoryModel::class);
    }
}
