<?php

namespace App\Http\Controllers\ApiWeb;

use App\Helpers\ResponseFormatter;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Http\Resources\UserResource;
use App\Interfaces\CategoryInterface;
use App\Interfaces\ProductInterface;
use Illuminate\Http\Request;

class MasterProductController extends Controller
{
    public function __construct(
        private ProductInterface $productRepository,
        private CategoryInterface $categoryRepository,
    ) {}

    /**
     * @OA\Get(
     *   tags={"ApiWeb|Master|Product"},
     *   path="/api-web/master/product",
     *   summary="Product Index",
     *   @OA\Parameter(
     *     name="search",
     *     in="query",
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\Parameter(
     *     name="category_id",
     *     in="query",
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\Parameter(
     *     name="limit",
     *     in="query",
     *     @OA\Schema(type="integer", example="10")
     *   ),
     *   @OA\Parameter(
     *     name="sortBy",
     *     in="query",
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\Parameter(
     *     name="orderBy",
     *     in="query",
     *     @OA\Schema(type="string", enum={"asc","desc"})
     *   ),
     *   @OA\Parameter(
     *     name="page",
     *     in="query",
     *     @OA\Schema(type="integer", example="1")
     *   ),
     *   @OA\Response(response="default", ref="#/components/responses/globalResponse")
     * )
     */
    public function index(Request $request)
    {
        $request->validate([
            "page" => "nullable|numeric",
            "limit" => "nullable|numeric|min:0|max:100",
        ]);

        $users = $this->productRepository->getAll(
            select: ["*"],
            withRelations: ["category"],
            filter: [
                "categoryId" => $request->category_id,
            ],
            search: $request->search,
            sortOption: [
                "orderCol" => $request->sort_by,
                "orderDir" => $request->order_by,
            ],
            paginateOption: [
                "method" => "paginate",
                "length" => $request->limit,
                "page" => $request->page,
            ],
            reformat: function ($model) {
                return tap($model, function ($paginate) {
                    return $paginate
                        ->getCollection()
                        ->transform(function ($row) {
                            return new ProductResource($row);
                        });
                });
            },
        );

        return ResponseFormatter::success($users, "Data berhasil ditampilkan");
    }

    /**
     * @OA\Get(
     *   tags={"ApiWeb|Master|Product"},
     *   path="/api-web/master/product/{id}",
     *   summary="Product show",
     *   @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *
     *     @OA\Schema(type="string")
     *   ),
     *   @OA\Response(response="default", ref="#/components/responses/globalResponse")
     * )
     */
    public function show(Request $request, $id)
    {
        $data = $this->productRepository->findByIdHash($id);

        if (!$data) {
            return ResponseFormatter::error(400, "Data tidak ditemukan");
        }

        $data->load("category");

        return ResponseFormatter::success(
            new ProductResource($data),
            "Data berhasil ditampilkan",
        );
    }

    /**
     * @OA\Post(
     *     tags={"ApiWeb|Master|Product"},
     *     path="/api-web/master/product",
     *     summary="Product store",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(property="name", type="string"),
     *                 @OA\Property(property="categoryId", type="string"),
     *                 @OA\Property(property="price", type="string"),
     *                 @OA\Property(property="stock", type="string")
     *             )
     *         )
     *     ),
     *     @OA\Response(response="default", ref="#/components/responses/globalResponse")
     * )
     */
    public function store(Request $request)
    {
        $request->validate([
            "name" => "required",
            "category_id" => "required|uuid",
            "price" => "required|numeric",
            "stock" => "required|numeric",
        ]);
        $category = $this->categoryRepository->findByIdHash(
            $request->category_id,
        );
        if (!$category) {
            return ResponseFormatter::error(
                400,
                "Data category tidak ditemukan",
            );
        }
        $this->productRepository->create([
            "name" => $request->name,
            "category_id" => $category->id,
            "price" => $request->price,
            "stock" => $request->stock,
        ]);

        return ResponseFormatter::success(null, "Data berhasil ditambahkan");
    }

    /**
     * @OA\Post(
     *     tags={"ApiWeb|Master|Product"},
     *     path="/api-web/master/product/{id}/update",
     *     summary="Product update",
     *     @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="string", example="")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\MediaType(
     *             mediaType="multipart/form-data",
     *             @OA\Schema(
     *                 type="object",
     *                 @OA\Property(property="name", type="string"),
     *                 @OA\Property(property="categoryId", type="string"),
     *                 @OA\Property(property="price", type="string"),
     *                 @OA\Property(property="stock", type="string")
     *             )
     *         )
     *     ),
     *     @OA\Response(response="default", ref="#/components/responses/globalResponse")
     * )
     */
    public function update(Request $request, $id)
    {
        $data = $this->productRepository->findByIdHash($id);

        if (!$data) {
            return ResponseFormatter::error(400, "Data tidak ditemukan");
        }

        $request->validate([
            "name" => "required",
            "category_id" => "required|uuid",
            "price" => "required|numeric",
            "stock" => "required|numeric",
        ]);
        $category = $this->categoryRepository->findByIdHash(
            $request->category_id,
        );
        if (!$category) {
            return ResponseFormatter::error(
                400,
                "Data category tidak ditemukan",
            );
        }
        $this->productRepository->update($data, [
            "name" => $request->name,
            "category_id" => $category->id,
            "price" => $request->price,
            "stock" => $request->stock,
        ]);

        return ResponseFormatter::success(null, "Data berhasil ditambahkan");
    }

    /**
     * @OA\Delete(
     *     tags={"ApiWeb|Master|Product"},
     *     path="/api-web/master/product/{id}",
     *     summary="Product Delete",
     *     @OA\Parameter(
     *     name="id",
     *     in="path",
     *     required=true,
     *     @OA\Schema(type="string")
     *     ),
     *     @OA\Response(response="default", ref="#/components/responses/globalResponse")
     * )
     */
    public function delete(Request $request, $id)
    {
        $user = $this->productRepository->delete($id);
        return ResponseFormatter::success(null, "Berhasil Hapus");
    }
}
