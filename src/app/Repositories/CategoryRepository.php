<?php

namespace App\Repositories;

use App\Category;
use App\Contracts\RepositoryContract;
use App\Http\Resources\CreateCategory;
use App\Http\Resources\DeleteCategory;
use App\Http\Resources\ReadCategory;
use App\Http\Resources\UpdateCategory;
use App\Product;
use App\ProductCategory;
use Illuminate\Database\QueryException;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use phpDocumentor\Reflection\Types\Collection;

class CategoryRepository extends Repository implements RepositoryContract
{
    public function create(Request $request) {
        $category = new Category();
        $category->name = $request->post('name');
        return CreateCategory::collection([
            'status' => $category->save()
        ]);
    }

    public function read(Request $request) {
        return ReadCategory::collection(
            Category::query()
                ->select()
                ->orderBy(
                    DB_PRIMARY_KEY_DEFAULT,
                    DB_DIRECTION_DEFAULT
                )
                ->get()
        );
    }

    public function update(Request $request) {
        return UpdateCategory::collection(
            Category::query()
                ->findOrFail($request->input('id'))
                ->update([
                    'name' => $request->input('name'),
                ])
        );
    }

    public function delete(Request $request) {
        $isCatWithProd = ProductCategory::query()
            ->where('cats_id', '=' , $request->get('id'))
            ->count();
        if ($isCatWithProd > 0) {
            throw new \Error('Category related to the product сannot be deleted.');
        }

        return DeleteCategory::collection(Category::destroy($request->input('id')));
    }
}
