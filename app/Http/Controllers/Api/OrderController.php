<?php

namespace App\Http\Controllers\Api;

use DB;
use App\Order;
use App\Http\Controllers\Controller;
use App\Http\Controllers\ApiControllerTrait;
use App\Http\Requests\OrderRequest as Request;
use App\Services\OrderService as Service;
use Illuminate\Http\JsonResponse;

class OrderController extends Controller
{
    protected $model;
    protected $relationships = ['user', 'product.category'];
    use ApiControllerTrait;

    public function __construct(Order $model) {
        $this->model = $model;
    }

        /**
     * Armazena um recurso recém criado.
     * Método sobrescrito da Trait
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Service $service)
    {
        try {
            if (! $service->stockValidation()) {
                return response()->json(
                    ['errors' => 
                        [ 
                            'quantity' =>  'Saldo Insuficiente para saída deste produto' 
                        ]
                        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY
                );
            }

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
    public function update(Service $service, Request $request, $id)
    {
        DB::beginTransaction();
        try {
            if (!$service->backStock($id)) {
                DB::rollback();
                return response()->json(
                    ['errors' => 
                        [ 
                            'quantity' =>  'Problema em delvolver Produto para o Estoque.' 
                        ]
                        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY
                );
            }

            if (! $service->stockValidation()) {
                DB::rollback();
                return response()->json(
                    ['errors' => 
                        [ 
                            'quantity' =>  'Saldo Insuficiente para saída deste produto' 
                        ]
                        ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY
                );
            }
            
            $result = $this->model->findOrFail($id);
            $result->update($request->all());

            DB::commit();
            return response()->json($result, JsonResponse::HTTP_NO_CONTENT);
        } catch (QueryException $e) {
            DB::rollback();
            abort(403, 'Tentativa de alterar Pedido, sem sucesso');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Service $service, $id)
    {
        if (!$service->backStock($id)) {
            return response()->json(
                ['errors' => 
                    [ 
                        'quantity' =>  'Problema em delvolver Produto para o Estoque.' 
                    ]
                    ], JsonResponse::HTTP_UNPROCESSABLE_ENTITY
            );
        }
        $result = $this->model->findOrFail($id);
        $result->delete();

        return response()->json($result, JsonResponse::HTTP_NO_CONTENT);
    }
}
