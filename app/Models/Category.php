<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    /**
     * On explicite la relation entre notre catégorie et les tâches.
     * Ici, une catégorie peut avoir plusieurs tâches assignées.
     *
     * @return void
     */
    public function tasks()
    {
        return $this->hasMany('App\Models\Task');
    }
}
