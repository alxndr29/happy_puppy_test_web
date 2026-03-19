<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::beginTransaction();
        try {
            $data = [
                [
                    "id" => 1,
                    "name" => "Chitato Rumput Laut",
                    "price" => 5000,
                    "stock" => 100,
                    "category_id" => 1,
                ],
                [
                    "id" => 2,
                    "name" => "Nasi Goreng Telor",
                    "price" => 15000,
                    "stock" => 10,
                    "category_id" => 2,
                ],
                [
                    "id" => 3,
                    "name" => "Kopi Susu Panas",
                    "price" => 7500,
                    "stock" => 25,
                    "category_id" => 3,
                ],
            ];

            $now = Carbon::now()->toDateTimeString();

            foreach ($data as $key => $value) {
                Product::updateOrInsert(
                    ["id" => $value["id"]],
                    [
                        "id" => $value["id"],
                        "id_hash" => Str::orderedUuid()->toString(),
                        "name" => $value["name"],
                        "price" => $value["price"],
                        "stock" => $value["stock"],
                        "category_id" => $value["category_id"],
                        "created_at" => $now,
                        "updated_at" => $now,
                    ],
                );
            }

            $lastId = Product::orderBy("id", "desc")->first();
            if (!empty($lastId)) {
                $newLastId = $lastId->id + 1;
                DB::statement(
                    "ALTER SEQUENCE product_id_seq RESTART WITH {$newLastId}",
                );
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
        }
    }
}
