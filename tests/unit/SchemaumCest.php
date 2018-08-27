<?php

use EntropyMigration\Laravel\Schemaum;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Capsule\Manager as DB;

class SchemaumCest
{
    public function _before(UnitTester $I) {
      global $DB;
      return;
      for ( $i  = 1 ; $i < 6 ; $i++ ) {
        DB::schema()->create('test_' . $i, function ($table) {
            $table->increments('id');
            $table->string('email')->unique();
            $table->timestamps();
        });
      }

    }

    public function _after(UnitTester $I) {

      for ( $i  = 1 ; $i < 6 ; $i++ ) {
        DB::schema()->dropIfExists('test_' . $i);
      }

    }

    // tests
    public function tryToTest(UnitTester $I)
    {

      Schemaum::table('test', 'test_%', function(Blueprint $table){
        $table->string('name');
      });

    }
}
