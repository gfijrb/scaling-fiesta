<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateCategoryRequest;
use App\Http\Requests\DeleteCategoryRequest;
use App\Http\Requests\ReadCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Repositories\CategoryRepository;

/**
 * Class CategoryController
 * @package App\Http\Controllers
 */
class CategoryController extends Controller
{
    protected $repository;

    /**
     * CategoryController constructor.
     * @param CategoryRepository $repository
     */
    public function __construct(CategoryRepository $repository)
    {
        $this->repository = $repository;
    }

    /**
     * @param CreateCategoryRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function create(CreateCategoryRequest $request)
    {
        try {
            $result = $this->repository->create($request);
        } catch (\Exception $exception) {
            if ((int) $exception->getCode() === 23000) {
                return response()->json(['error' => 'Mysql error: duplicate value'], 409);
            } else {
                return response()->json(['error' => 'Mysql error'], $exception->getCode());
            }
        }

        return response()->json(['result' => $result], 201);
    }

    /**
     * @param ReadCategoryRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function read(ReadCategoryRequest $request)
    {
        try {
            $result = $this->repository->read($request);
        } catch (\Exception $exception) {
            return response()->json(['error' => 'Mysql error'], $exception->getCode());
        }

        return response()->json(['result' => $result], 201);
    }

    /**
     * @param UpdateCategoryRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateCategoryRequest $request)
    {
        try {
            $result = $this->repository->update($request);
        } catch (\Exception $exception) {
            return response()->json(['error' => 'Mysql error'], $exception->getCode());
        }

        return response()->json(['result' => $result], 204);
    }

    /**
     * @param DeleteCategoryRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete(DeleteCategoryRequest $request)
    {
        try {
            $result = $this->repository->delete($request);
        } catch (\Exception $exception) {
            return response()->json(['error' => 'Mysql error'], $exception->getCode());
        }

        return response()->json(['result' => $result], 204);
    }
}
