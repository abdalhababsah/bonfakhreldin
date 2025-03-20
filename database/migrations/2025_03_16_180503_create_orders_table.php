<?php

use App\Enums\OrderDeliverableEnums;
use App\Enums\OrderStatusEnums;
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
            $table->string('status', 12)->default(OrderStatusEnums::Pending);
            $table->string('deliverable', 12)->default(OrderDeliverableEnums::Delivery);
            $table->decimal('total_price', 10, 2);
            $table->text('notes')->nullable();
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
