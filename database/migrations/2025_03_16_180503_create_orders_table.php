<?php

use App\Enums\OrderStatusEnums;
use App\Models\Area;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number')->unique();
            $table->string('name', 100);
            $table->string('email', 100)->nullable();
            $table->string('phone', 20);
            $table->string('status')->default(OrderStatusEnums::Pending);
            $table->decimal('total_price', 10, 2);
            $table->decimal('delivery_fee', 10, 2);
            $table->text('notes')->nullable();
            $table->text('address');
            $table->foreignIdFor(Area::class);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
