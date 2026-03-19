<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create("product", function (Blueprint $table) {
            $table->id();
            $table->uuid("id_hash")->unique();

            $table->string("name");
            $table
                ->foreignId("category_id")
                ->constrained("category")
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->integer("price")->unique();
            $table->integer("stock")->unique();

            $table->softDeletes();
            $table->timestamps();
            $table->unsignedBigInteger("created_by")->nullable();
            $table->unsignedBigInteger("updated_by")->nullable();
            $table->unsignedBigInteger("deleted_by")->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists("product");
    }
};
