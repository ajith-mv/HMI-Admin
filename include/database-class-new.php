<?php

include_once("include/config_db.php");
class Databasequerynew {

    public $conn;

    function __construct($host=db_host, $user=db_username, $pass=db_password, $db= db_name){
        $this->conn = new mysqli($host, $user, $pass, $db);
    }



    function  get_a_line($sqlqry){

        $result = $this->conn->query($sqlqry);
        
        $result_row = mysqli_fetch_array($result, MYSQLI_BOTH);

        return $result_row;
    }

    function insert($insqry){

        $result_row = $this->conn->query($insqry);

        return $result_row;

    }

    function get_rsltset($sqlqry){

        $result = $this->conn->query($sqlqry);

        //$rows = mysqli_fetch_array($result, MYSQLI_BOTH);
        $rows = mysqli_fetch_all ($result, MYSQLI_ASSOC);

        return $rows;

    }





    function insert_log($operation,$table,$id="",$comments="",$module="",$query=""){

    }

  }