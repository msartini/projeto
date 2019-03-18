<?php
namespace app\Http\Controllers;

use App\Http\Requests\StandardRequest as Request;
use Illuminate\Database\QueryException;
use Illuminate\Http\JsonResponse;

trait ApiControllerTrait
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $limit = $request->all()['limit'] ?? 15;

        $order = $request->all()['order'] ?? null;

        if ($order !== null) {
            $order = explode(',', $order);
        }

        $order[0] = $order[0] ?? 'id';
        $order[1] = $order[1] ?? 'asc';

        $where = $request->all()['where'] ?? [];
        $like = $request->all()['like'] ?? null;

        if ($like) {
            $like = explode(',', $like);
            $like[1] = '%' . $like[1] . '%';
        }

        $result = $this->model->orderBy($order[0], $order[1])
            ->where(
                function ($query) use ($like) {
                    if ($like) {
                        return $query->where($like[0],  'like', $like[1]);
                    }

                    return $query;
                }
            )
        ->where($where)
        //relacao desabilitada para a listagem
        ->with($this->relationships())
        ->paginate($limit);

        return  response()->json($result, JsonResponse::HTTP_OK);
    }

    /**
     * Armazena um recurso recém criado.
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
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $result = $this->model->with($this->relationships())->findOrFail($id);

        return response()->json($result, JsonResponse::HTTP_OK);
    }

    /**
     * Update the specified resource in storage.
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = $this->model->findOrFail($id);
        $result->delete();

        return response()->json($result, JsonResponse::HTTP_NO_CONTENT);
    }

    protected function relationships()
    {
        if (isset($this->relationships)) {
            return $this->relationships;
        }
        return [];
    }
}

