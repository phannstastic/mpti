<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
  // ..._create_order_items_table.php
public function up(): void
{
    Schema::create('order_items', function (Blueprint $table) {
        $table->id();
        $table->foreignId('order_id')->constrained()->cascadeOnDelete();
        $table->foreignId('menu_item_id')->constrained()->cascadeOnDelete();
        $table->integer('quantity');
        $table->decimal('price', 15, 2); // Harga per item saat dipesan
        $table->timestamps();
    });
}
};
