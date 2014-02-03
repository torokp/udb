<?php

function udb_load($filename, $primarykey = "") {
    //if (!file_exists($filename))
    //	return array();
    if (!($fp = fopen($filename, "r"))) {
        return array();
    }
    $columns = fgetcsv($fp, 0, ";", '"');
    $database = array();
    while ($data = fgetcsv($fp, 0, ";", '"')) {
        $row = array();
        foreach ($columns as $id => $col) {
            $row[$col] = $data[$id];
        }
        if ($primarykey != "") {
            $database[$row[$primarykey]] = $row;
        } else {
            $database[] = $row;
        }
    }
    return $database;
}

function udb_save($filename, $array) {
    $fp = fopen($filename, "w");
    $row0 = array_shift($array);
    $columns = array_keys($row0);
    fputcsv($fp, $columns, ";", '"');
    fputcsv($fp, $row0, ";", '"');
    foreach ($array as $row) {
        fputcsv($fp, $row, ";", '"');
    }
}

?>
