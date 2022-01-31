<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Domain\Contracts\CheckContract;

class CreateChecksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create(CheckContract::TABLE, function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger(CheckContract::USER_ID);

            $table->foreign(CheckContract::USER_ID)
                  ->references('id')
                  ->on('users')
                  ->onUpdate('cascade')
                  ->onDelete('cascade');

            $table->string(CheckContract::IMAGE);
            $table->enum(CheckContract::TYPE,['обычный', 'призовой'])->default('обычный');
            $table->string(CheckContract::CODE)
                    ->nullable();
            $table->enum(CheckContract::STATUS,['Принят', 'Отклонен'])->default('Отклонен');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists(CheckContract::TABLE);
    }
}
