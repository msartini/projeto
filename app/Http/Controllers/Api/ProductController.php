<?php

namespace App\Http\Controllers\Api;

use App\Product;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiControllerTrait;
use App\Http\Requests\ProductRequest as Request;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    protected $model;
    protected $relationships = ['category'];
    use ApiControllerTrait;

    public function __construct(Product $model) {
        $this->model = $model;
    }

        /**
     * Armazena um recurso recém criado.
     * Método sobrescrito da Trait
     *
     * @param  App\Http\Requests\ProductRequest $request
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
