<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TaskController extends Controller
{
    /**
     * Endpoint permettant de récupérer toutes les tâches
     *
     * @return json
     */
    public function list()
    {
        $tasksList = Task::all();

        return response()->json($tasksList);
    }

    /**
     * Endpoint permettant de créer une nouvelle tâche
     *
     * @return void
     */
    public function add(Request $request)
    {
        // La méthode filled permet de de vérifier qu'un (ou plusieurs) champ est présent ET non vide.
        // On fait un test pour savoir si nos champs sont bien remplis.
        if ($request->filled(['title', 'status', 'categoryId'])) {

            // Récupération des différents champs passés avec la requête
            $title = $request->input('title');
            $categoryId = $request->input('categoryId');
            $status = $request->input('status');

            if ($request->has('completion')) {
                $completion = $request->input('completion');
            }

            // Création d'une nouvelle tâche

            $task = new Task;
            $task->title = $title;
            $task->status = $status;
            $task->category_id = $categoryId;

            // Si le champ completion existe
            if (isset($completion)) {
                $task->completion = $completion;
            }
            // On sauvegarde la tâche et on fait une condition sur le fait que la sauvegarde ait marché ou non.
            if ($task->save()) {
                // On renvoie la tâche fraîchement créée avec un code 201 (created)
                return response()->json($task, 201);
            } else {
                // Sinon on envoie un code 500, qui indique une erreur.
                return response()->json('', 500);
            }
        } else {
            return response()->json(['errors' => 'Il manque au moins un champ !'], 400);
        }
    }

    /**
     * Méthode permettant de modifier obligatoirement tous les champs de la tâche
     *
     * @param Request $request
     * @param string $id
     * @return json
     */
    public function update(Request $request, $id)
    {
        // Récupération de la tâche ayant l'ID fourni en paramètre
        // La méthode findOrFail récupère l'entité si elle existe. Sinon elle renvoie directement une 404 (page non trouvée)
        $task = Task::findOrFail($id);

        // On vient vérifier la méthode de la requête. Si c'est en PATCH, on modifie uniquement les champs fournis. Sinon c'est en PUT, et on modifie tous les champs
        if ($request->isMethod('patch')) {

            $inputs = $request->all();

            // Si on ne reçoit aucun champ, alors on envoie une erreur 400 (bad request)
            if (empty($inputs)) {
                return response()->json(['errors' => 'Il manque des champs'], 400);
            }

            // Si on passe une champ title, on vient modifier le champ title
            if ($request->has('title')) {
                $task->title = $request->input('title');
            }

            if ($request->has('status')) {
                $task->status = $request->input('status');
            }

            if ($request->has('completion')) {
                $task->completion = $request->input('completion');
            }

            if ($request->has('categoryId')) {
                $task->category_id = $request->input('categoryId');
            }
        } else {

            // Si on récupère tous les champs dans has, alors on procède à la modification de la tâche.
            if ($request->has(['title', 'categoryId', 'completion', 'status'])) {

                $task->title = $request->input('title');
                $task->completion = $request->input('completion');
                $task->status = $request->input('status');
                $task->category_id = $request->input('categoryId');
            } else {
                return response()->json(['errors' => 'Il manque des champs'], 400);
            }
        }

        if ($task->save()) {
            // On renvoie la tâche fraîchement modifiée avec un code 200
            return response()->json($task);
        } else {
            // Sinon on envoie un code 500, qui indique une erreur.
            return response()->json('', 500);
        }
    }

    public function delete($id) {

        $taskDestroyed = Task::destroy($id);

        if($taskDestroyed) {
            return response()->json('La suppression a marché !', 200);
        } else {
            return response()->json('Oups...Something wrong !');
        }
    }
}
