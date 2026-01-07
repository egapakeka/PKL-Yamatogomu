<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('productions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('operator_id');
            $table->unsignedBigInteger('product_id');
            $table->unsignedBigInteger('shift_id');
            $table->date('production_date');
            $table->unsignedInteger('qty_ok')->default(0);
            $table->unsignedInteger('qty_ng')->default(0);
            $table->unsignedInteger('total_qty')->default(0);
            $table->enum('status', ['pending','validated','rejected'])->default('pending');
            $table->unsignedBigInteger('validated_by')->nullable();
            $table->timestamp('validated_at')->nullable();
            $table->text('note')->nullable();
            $table->timestamps();

            $table->foreign('operator_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('product_id')->references('id')->on('products')->onDelete('cascade');
            $table->foreign('shift_id')->references('id')->on('shifts')->onDelete('cascade');
            $table->foreign('validated_by')->references('id')->on('users')->onDelete('set null');

            $table->index(['production_date','operator_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('productions');
    }
};
