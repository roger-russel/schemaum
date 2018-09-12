<?php

namespace Schemaum;

use Exception;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

Class Schemas {

  protected static function getTableList($databaseLike, $tableLike) {

    $databaseLike = addslashes($databaseLike);
    $tableLike = addslashes($tableLike);

    $query = "SELECT
                table_schema,
                table_name
              FROM
                information_schema.tables
              WHERE
                    table_schema LIKE '{$databaseLike}'
                AND table_name LIKE '{$tableLike}'";

    return DB::select($query);

  }

  public static function table($databaseLike, $tableLike, $callback){

    $tableList = self::getTableList($databaseLike, $tableLike);
    $previus = '';

    foreach( $tableList as $list ) {

      try {

        if($previus !==  $list->table_schema)
          DB::unprepared('USE ' . $list->table_schema);

        Schema::table($list->table_name, $callback);
        $previus = $list->table_schema;

      } catch( Exception $e ) {

        echo $list->table_schema . '.' . $list->table_name . ' error:' . $e->getMessage() . PHP_EOL;

      }
    }
  }
}
