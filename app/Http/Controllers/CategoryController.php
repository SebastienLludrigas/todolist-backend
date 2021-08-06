<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{

    /**
     * Endpoint permettant de récupérer toutes les catégories
     *
     * @return json
     */
    public function list()
    {

        $categoriesList = Category::all();

        return response()->json($categoriesList);
    }

    public function item($id)
    {
        $categoriesList = [
            1 => [
                'id' => 1,
                'name' => 'Chemin vers O\'clock',
                'status' => 1
            ],
            2 => [
                'id' => 2,
                'name' => 'Courses',
                'status' => 1
            ],
            3 => [
                'id' => 3,
                'name' => 'O\'clock',
                'status' => 1
            ],
            4 => [
                'id' => 4,
                'name' => 'Titre Professionnel',
                'status' => 1
            ],
            5 => [
                'id' => 5,
                'name' => 'Coucou',
                'status' => 1
            ]
        ];

        // @copyright  Gregory
        return response()->json($categoriesList[$id]);
    }
}
