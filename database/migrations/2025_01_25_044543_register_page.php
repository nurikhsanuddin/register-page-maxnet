<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('register_customer', function (Blueprint $table) {
            $table->string('register_id', 20)->primary();
            $table->string('name', 100)->charset('utf8mb4')->collation('utf8mb4_0900_ai_ci')->nullable();
            $table->string('email', 100)->charset('utf8mb4')->collation('utf8mb4_0900_ai_ci')->nullable();
            $table->string('password', 100)->charset('utf8mb4')->collation('utf8mb4_0900_ai_ci')->nullable();
            $table->string('serv_id', 50)->charset('utf8mb4')->collation('utf8mb4_0900_ai_ci')->nullable();
            $table->string('phone', 100)->charset('utf8mb4')->collation('utf8mb4_0900_ai_ci')->nullable();
            $table->string('ktp_number', 100)->nullable();
            $table->string('ktp_file', 200)->charset('utf8mb4')->collation('utf8mb4_0900_ai_ci')->nullable();
            $table->string('address', 200)->charset('utf8mb4')->collation('utf8mb4_0900_ai_ci')->nullable();
            $table->string('location', 200)->charset('utf8mb4')->collation('utf8mb4_0900_ai_ci')->nullable();
            $table->integer('group')->nullable();
            $table->timestamps();
            $table->string('home_file', 200)->charset('utf8mb4')->collation('utf8mb4_0900_ai_ci')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('register_customer');
    }
};
