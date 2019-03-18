<?php

namespace App\Http\Controllers\Api;

use App\Category;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiControllerTrait;
use App\Http\Requests\CategoryRequest as Request;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    protected $model;
    use ApiControllerTrait;

    public function __construct(Category $model) {
        $this->model = $model;
    }

    /**
     * Armazena um recurso recém criado.
     * Método sobrescrito da Trait
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $result = $this->model->create($request->all());

            return response()->json($result, JsonResponse::HTTP_CREATED);
        } catch (QueryException $e) {
           abort(403, 'Tentativa de duplicar registro');
        }
    }

    /**
     * Atualiza um recurso específico.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int                      $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $result = $this->model->findOrFail($id);
        $result->update($request->all());

        return response()->json($result, JsonResponse::HTTP_NO_CONTENT);
    }
}
