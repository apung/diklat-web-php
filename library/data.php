<?php
/**
 * Copyright (c) 2019
 * Author Abdul Gaffur A Dama <apung.dama@gmail.com>
 */

/**
 * CONTOH PENGGUNAAN
 * $db = new DatabaseSaya($db_host, $db_user, $db_pass, $db_name);
 * $db->query('SELECT * FROM berita');
 * echo "<pre>";
 * print_r($db->isinya());
 * echo "</pre>";
 */

$db_host = '127.0.0.1'; // sesuaikan
$db_user = 'username_db'; // sesuaikan
$db_pass = 'password_db'; // sesuaikan
$db_name = 'latihan1'; // sesuaikan

class DatabaseSaya {
    var $db_host;
    var $db_user;
    var $db_pass;
    var $db_name;
    protected static $link;
    protected static $res;

    function __construct($db_host, $db_user, $db_pass, $db_name){
        $this->db_host = $db_host;
        $this->db_user = $db_user;
        $this->db_pass = $db_pass;
        $this->db_name = $db_name;

    }

    function buka() {
        self::$link = mysqli_connect($this->db_host, $this->db_user, $this->db_pass, $this->db_name);

        if (!self::$link) {
            echo "<br /><br />Error: Gak bisa konek ke MySQL.<br />" . PHP_EOL;
            echo "Massalahnya di: " . mysqli_connect_error() . " (". mysqli_connect_errno() . ") ". PHP_EOL;
            exit;
        }
    }

    function tutup(){
        mysqli_close(self::$link);
    }

    function query($sql) {
        $this->buka();
        self::$res = mysqli_query(self::$link, $sql);
        $this->tutup();
        return self::$res;
    }

    function jumlah(){
        return self::$res->num_rows;
    }

    function isinya() {
        $data = array();
        while ($row = self::$res->fetch_assoc() ){
           array_push($data, $row);
        }

        return $data;
    }
}

