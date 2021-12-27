<?php

use Illuminate\Database\Capsule\Manager as Capsule;

class m0001_initial
{
    public function up(Capsule $capsule)
    {
        Capsule::schema()->create('users', function ($table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->timestamps();
        });
    }

    public function down(Capsule $capsule)
    {
        
    }
}