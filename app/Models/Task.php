<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * On explicite la relation entre notre tâche et sa catégorie
     *
     * @return void
     */
    public function category()
    {
        return $this->belongsTo('App\Models\Category');
    }
}
