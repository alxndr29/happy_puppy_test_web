<?php

namespace App\Repositories;

use App\Interfaces\ProductInterface;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ProductRepository extends BaseRepository implements ProductInterface
{
    public function __construct(Product $model)
    {
        $this->model = $model;
    }

    public function getAll(
        $select = [],
        $withRelations = [],
        $join = [],
        $filter = [],
        $where = null,
        $search = null,
        $sortOption = [],
        $paginateOption = [],
        $reformat = null,
    ) {
        $model = $this->model->query();

        $model->select("product.*");

        if (!empty($withRelations)) {
            $model->with($withRelations);
        }

        if (is_callable($where)) {
            $model->where($where);
        }

        $model->when(strtolower($search), function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where(
                    DB::raw("LOWER(product.name)"),
                    "LIKE",
                    "%{$search}%",
                );
            });
        });

        if ($this->filled($filter, "categoryId")) {
            $model->join("category", "category.id", "product.category_id");
            $model->where("category.id_hash", $filter["categoryId"]);
        }

        $model->orderBy(
            strtosnake(
                $this->input($sortOption, "orderCol", "product.created_at"),
            ),
            strtolower($this->input($sortOption, "orderDir")) === "desc"
                ? "desc"
                : "asc",
        );

        $length = $this->input($paginateOption, "length", 10);
        if (strtolower($this->input($paginateOption, "method", "paginate"))) {
            $model = $model->paginate(
                $length,
                ["*"],
                "page",
                $this->input($paginateOption, "page"),
            );
        } else {
            $model = $model->limit($length)->get();
        }

        if (is_callable($reformat)) {
            $model = $reformat($model);
        }

        return $model;
    }
}
