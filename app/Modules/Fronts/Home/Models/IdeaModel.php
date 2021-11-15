<?php

namespace App\Modules\Fronts\Home\Models;

use App\Models\Comment;
use App\Models\Idea;
use App\Models\View;

class IdeaModel extends Idea
{
    public function views() {
        return $this->hasMany(View::class, "idea_id", "id");
    }

    public function comments() {
        return $this->hasMany(Comment::class, "idea_id", "id");
    }

}
