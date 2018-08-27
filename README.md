# Schemaum

## Install

`composer require roger-russel/schemaum`

## API

```
/**
 * @param string $databaseLike [ like string on database ]
 * @param string $userLik [ like string on database ]
 * @param function [This function is the very same which is required on Laravel]
 */
Schemas::table($databaseLike, $userLik, function(Blueprint $table){});
```

## Usage

```
use Schemaum\Schemas;
Schemas::table('database_%','users_%', function(Blueprint $table){
    $table->string('phone');
});
```

### Example of use

```
<?php

use Schemaum\Schemas; // use Schemas instead of Laravel Schema
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterSomeTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //Firts parameter is database like, and the second one is table like
        Schemas::table('database_%','users_%', function(Blueprint $table){
            $table->string('phone');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //Firts parameter is database like, and the second one is table like
        Schemas::table('database_%','users_%',function(Blueprint $table){
            $table->dropColumn('phone');
        });
    }
}
