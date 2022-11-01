<?php
include_once realpath(dirname(__FILE__)).'/DatabaseObjects.php';

class Association extends DatabaseObjects
{
    protected static string $tableName = "association";
}
?>