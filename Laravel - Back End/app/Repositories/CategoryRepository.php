<?php

namespace App\Repositories;

use App\Interfaces\CategoryInterface;
use App\Models\Category;
use Illuminate\Support\Facades\DB;

class CategoryRepository extends BaseRepository implements CategoryInterface
{
    public function __construct(Category $model)
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

        $model->select("category.*");

        if (!empty($withRelations)) {
            $model->with($withRelations);
        }

        if (is_callable($where)) {
            $model->where($where);
        }

        $model->when(strtolower($search), function ($query, $search) {
            $query->where(function ($query) use ($search) {
                $query->where(
                    DB::raw("LOWER(category.name)"),
                    "LIKE",
                    "%{$search}%",
                );
            });
        });
        $model->orderBy(
            strtosnake(
                $this->input($sortOption, "orderCol", "category.created_at"),
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
