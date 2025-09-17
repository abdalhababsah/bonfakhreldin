<?php

use App\Models\Category;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->after('description_ar', function (Blueprint $table) {
                $table->foreignIdFor(Category::class)->nullable()->constrained()->cascadeOnDelete();
                $table->string('image')->nullable();
            });
        });
    }
};
