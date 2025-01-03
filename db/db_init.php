<?php
$sql_file_path = 'db/init.sql';
try {
    $db = new Database();
} catch (PDOException $e) {
    try {
        $db_create = new database('localhost', '', 'root', '');
        $sql = file_get_contents($sql_file_path);
        // dd($sql);
        if ($sql === false) {
            die("Error: can't read sql file: " . $sql_file_path);
        }
        $db_create->query($sql);
        $db = new database();
    } catch (PDOException $ex) {
        die("Error while database creation : " . $ex->getMessage());
    }
}
