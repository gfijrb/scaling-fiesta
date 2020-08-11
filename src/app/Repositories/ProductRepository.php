<?php

namespace App\Repositories;

use App\Http\Resources\Product\CreateProduct;
use App\Http\Resources\Product\DeleteProduct;
use App\Http\Resources\Product\ReadProduct;
use App\Http\Resources\Product\UpdateProduct;
use App\Product;
use App\Contracts\RepositoryContract;
use App\ProductCategory;
use ErrorException;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductRepository extends Repository implements RepositoryContract
{
    const DEF_PRICE_FROM = 0.01;

    const DEF_PRICE_TO = 1000000.00;

    const PRICE = 1000000.00;

    public function create(Request $request)
    {
        $product = new Product();
        $productCategery = new ProductCategory();
        $result = false;
        try {
            DB::transaction(function() use(
                $request,
                $product,
                $productCategery,
                $result,
                &$id
            ) {
                $id = DB::table($product->getTable())->insertGetId(
                    [
                        'title' => $request->title,
                        'price' => $request->price,
                        'discount' => $request->discount,
                        'description' => $request->description,
                        'created_at' => now(),
                        'updated_at' => now(),
                        'deleted_at' => 0,
                    ]
                );

                $genres = preg_split("/[,]+/", $request->genre);
                $glen = count((array) $genres);
                if ($glen < 2 && $glen > 10) {
                    throw new \Error("Validation fail, 'genre' field must include from 2 to 10 categories.");
                }

                $genresInsert = [];
                foreach ($genres as $key){
                    $genresInsert[] = [
                        'movie_id' => $id,
                        'genre_id' => $key
                    ];
                }

                $result = DB::table($productCategery->getTable())->insert($genresInsert);
            });
        } catch (QueryException $queryException) {
            throw new \ErrorException($queryException->getMessage(), 422);
        }

        return CreateProduct::collection($result);
    }

    public function read(Request $request)
    {
        $searchTerm = $request->get('q', null);
        $paginate = $request->get('pag', 200);
        $priceFrom = $request->get('price_from', self::DEF_PRICE_FROM);
        $priceTo = $request->get('price_to', self::DEF_PRICE_TO);
        $column = $request->get('col', DB_PRIMARY_KEY_DEFAULT);
        $direction = $request->get('dir', DB_DIRECTION_DEFAULT);
        $withDeleted = $request->get('with_deleted', false);

        $query = Product::query();

        if (!is_null($searchTerm)) {
            $query
                ->where('title', 'LIKE', "%{$searchTerm}%", 'and')
                ->orWhere('description', 'LIKE', "%{$searchTerm}%");
        }

        if ($priceFrom && $priceTo) {
            $query->whereBetween('price', [$priceFrom, $priceTo]);
        }

        if ($withDeleted) {
            $query->where('deleted_at', '!=', null);
        }

        $query->orderBy($column, $direction);

        if ($paginate) {
            $query->paginate($paginate);
        }

        return ReadProduct::collection(
            $query->get()
        );
    }

    public function update(Request $request)
    {
        return UpdateProduct::collection(
            Product::query()
                ->findOrFail($request->input('id'))
                ->update([
                    'name' => $request->input('name'),
                ])
        );
    }

    public function delete(Request $request)
    {
        return DeleteProduct::collection(Product::destroy($request->input('id')));
    }
}
