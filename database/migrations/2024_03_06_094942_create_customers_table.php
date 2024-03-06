<?php

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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('kana')->nullable();
            $table->string('tel')->unique()->nullable();
            $table->string('email')->nullable();
            $table->string('postcode')->nullable();
            $table->string('address')->nullable();
            $table->date('birthday')->nullable();
            $table->tinyInteger('gender')->nullable(); // 0: 男 1: 女性 2: その他
            $table->text('memo')->nullable();
            $table->timestamp('created_at')->nullable()->useCurrent();
            $table->timestamp('updated_at')->nullable()->useCurrent()->useCurrentOnUpdate();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
