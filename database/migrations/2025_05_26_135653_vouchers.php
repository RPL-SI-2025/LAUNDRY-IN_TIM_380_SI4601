<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
       Schema::create('vouchers', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('description');
            $table->decimal('discount_amount', 10, 2);
            $table->datetime('valid_until');
            $table->boolean('is_active')->default(true);
            $table->integer('max_uses')->default(0);
            $table->integer('current_uses')->default(0);
            $table->timestamps();
    });
    }

    public function down()
    {
        Schema::dropIfExists('vouchers');
    }
};