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
                [
                    "id" => 4,
                    "name" => "Indomie Goreng",
                    "price" => 3500,
                    "stock" => 50,
                    "category_id" => 2,
                ],
                [
                    "id" => 5,
                    "name" => "Teh Manis Hangat",
                    "price" => 4000,
                    "stock" => 40,
                    "category_id" => 3,
                ],
                [
                    "id" => 6,
                    "name" => "Aqua Botol",
                    "price" => 3000,
                    "stock" => 200,
                    "category_id" => 3,
                ],
                [
                    "id" => 7,
                    "name" => "Lays Original",
                    "price" => 6000,
                    "stock" => 80,
                    "category_id" => 1,
                ],
                [
                    "id" => 8,
                    "name" => "Mie Ayam",
                    "price" => 12000,
                    "stock" => 15,
                    "category_id" => 2,
                ],
                [
                    "id" => 9,
                    "name" => "Es Teh Manis",
                    "price" => 3000,
                    "stock" => 60,
                    "category_id" => 3,
                ],
                [
                    "id" => 10,
                    "name" => "Pocari Sweat",
                    "price" => 7000,
                    "stock" => 30,
                    "category_id" => 3,
                ],
                [
                    "id" => 11,
                    "name" => "Qtela Singkong",
                    "price" => 5500,
                    "stock" => 70,
                    "category_id" => 1,
                ],
                [
                    "id" => 12,
                    "name" => "Sate Ayam",
                    "price" => 20000,
                    "stock" => 12,
                    "category_id" => 2,
                ],
                [
                    "id" => 13,
                    "name" => "Cappuccino",
                    "price" => 10000,
                    "stock" => 20,
                    "category_id" => 3,
                ],
                [
                    "id" => 14,
                    "name" => "Taro Snack",
                    "price" => 5000,
                    "stock" => 90,
                    "category_id" => 1,
                ],
                [
                    "id" => 15,
                    "name" => "Bakso",
                    "price" => 15000,
                    "stock" => 18,
                    "category_id" => 2,
                ],
                [
                    "id" => 16,
                    "name" => "Jus Jeruk",
                    "price" => 8000,
                    "stock" => 25,
                    "category_id" => 3,
                ],
                [
                    "id" => 17,
                    "name" => "Chiki Balls",
                    "price" => 4500,
                    "stock" => 100,
                    "category_id" => 1,
                ],
                [
                    "id" => 18,
                    "name" => "Nasi Ayam Geprek",
                    "price" => 18000,
                    "stock" => 14,
                    "category_id" => 2,
                ],
                [
                    "id" => 19,
                    "name" => "Es Kopi Susu",
                    "price" => 9000,
                    "stock" => 35,
                    "category_id" => 3,
                ],
                [
                    "id" => 20,
                    "name" => "Pringles",
                    "price" => 12000,
                    "stock" => 45,
                    "category_id" => 1,
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
