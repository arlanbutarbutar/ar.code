<?php
    date_default_timezone_set('Asia/Jakarta');
    $h=date('H');
    $H_value=$h+1;
    $day=date('l');
    $time=date($H_value.':i:s');
    echo $time;
?>