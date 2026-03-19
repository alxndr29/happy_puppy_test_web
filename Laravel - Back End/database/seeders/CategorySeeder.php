<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
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
                    "name" => "Snack Ringan",
                ],
                [
                    "id" => 2,
                    "name" => "Makanan Berat",
                ],
                [
                    "id" => 3,
                    "name" => "Minuman Hangat",
                ],
            ];

            $now = Carbon::now()->toDateTimeString();

            foreach ($data as $key => $value) {
                Category::updateOrInsert(
                    ["id" => $value["id"]],
                    [
                        "id" => $value["id"],
                        "id_hash" => Str::orderedUuid()->toString(),
                        "name" => $value["name"],
                        "created_at" => $now,
                        "updated_at" => $now,
                    ],
                );
            }

            $lastId = Category::orderBy("id", "desc")->first();
            if (!empty($lastId)) {
                $newLastId = $lastId->id + 1;
                DB::statement(
                    "ALTER SEQUENCE category_id_seq RESTART WITH {$newLastId}",
                );
            }

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            echo $e->getMessage();
        }
    }
}
