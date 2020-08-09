<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateProductRequest;
use App\Http\Requests\DeleteProductRequest;
use App\Http\Requests\ReadProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Repositories\ProductRepository;

/**
 * Class ProductController
 * @package App\Http\Controllers
 */
class ProductController extends Controller
{
    protected $repository;

    /**
     * ProductController constructor.
     * @param ProductRepository $repository
     */
    public function __construct(ProductRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param CreateProductRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(CreateProductRequest $request)
    {
        try {
            $result = $this->repository->create($request);
        } catch (\Exception $exception) {
            if ((int) $exception->getCode() === 23000) {
                return response()->json(['error' => 'Mysql error: duplicate value'], 409);
            } else {
                return response()->json(['error' => $exception->getMessage()], $exception->getCode());
            }
        }

        return response()->json(['result' => $result], 201);
    }

    /**
     * @param ReadProductRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function read(ReadProductRequest $request)
    {
        try {
            $result = $this->repository->read($request);
        } catch (\Exception $exception) {
            return response()->json([
                'error' => $exception->getMessage(),
                //'trace' => $exception->getTrace(),
                ],
                ($exception->getCode() >= 200) ? $exception->getCode() : 404
            );
        }

        return response()->json(['result' => $result], 201);
    }

    /**
     * @param UpdateProductRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateProductRequest $request)
    {
        try {
            $result = $this->repository->update($request);
        } catch (\Exception $exception) {
            return response()->json(['error' => 'Mysql error'], $exception->getCode());
        }

        return response()->json(['result' => $result], 204);
    }

    /**
     * @param DeleteProductRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(DeleteProductRequest $request)
    {
        try {
            $result = $this->repository->delete($request);
        } catch (\Exception $exception) {
            return response()->json(['error' => 'Mysql error'], $exception->getCode());
        }

        return response()->json(['result' => $result], 204);
    }
}
