<?php
    // class database{
        // $arcode_=mysqli_connect("localhost","ugdhpcom_arcode","ArlanBB270899","ugdhpcom_ar.code");
        $arcode_=mysqli_connect("localhost","root","","ar.code");
        $conn=$arcode_;
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        // $arcode_arc=mysqli_connect("localhost","ugdhpcom_arcode","ArlanBB270899","ugdhpcom_arcode");
        // $arcode_arc=mysqli_connect("localhost","root","","arcode");
        // $conn_arc=$arcode_arc;
        // if ($conn_arc->connect_error) {
        //     die("Connection failed: " . $conn_arc->connect_error);
        // }
    // }