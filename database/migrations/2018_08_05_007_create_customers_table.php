<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
      public function up()
      {
            Schema::create('customers', function (Blueprint $table) {
                  $table->unsignedInteger('dni', 30);
                  $table->integer('type_dni')->unsigned();
                  $table->foreign('type_dni')->references('id')->on('identifications')->onUpdate('cascade');
                  $table->string('last_name');
                  $table->string('first_name');
                  $table->string('slug');
                  $table->string('phone')->nullable();
                  $table->string('landline')->nullable();
                  $table->string('email', 60)->unique();
                  $table->string('address', 100);
                  $table->integer('country_id')->unsigned();
                  $table->foreign('country_id')->references('id')->on('countries')
                        ->onUpdate('cascade');
                  $table->integer('departament_id')->unsigned();
                  $table->foreign('departament_id')->references('id')->on('departaments')
                        ->onUpdate('cascade');
                  $table->integer('municipality_id')->unsigned();
                  $table->foreign('municipality_id')->references('id')->on('municipalities')
                        ->onUpdate('cascade');
                  $table->integer('location_id')->unsigned();
                  $table->foreign('location_id')->references('id')->on('locations')
                        ->onUpdate('cascade');
                  $table->integer('neighborhood_id')->unsigned();
                  $table->foreign('neighborhood_id')->references('id')->on('neighborhoods')
                        ->onUpdate('cascade');
                  $table->string('latitude')->nullable();
                  $table->string('longitude')->nullable();
                  $table->date('birthdate');
                  $table->enum('state_customer', ['Activo', 'Inactivo', 'Suspendido'])->default('Inactivo');
                  $table->timestamps();
                  $table->softDeletes();
            });
      }

      /**
       * Reverse the migrations.
       *
       * @return void
       */
      public function down()
      {
            Schema::dropIfExists('customers');
      }
}
