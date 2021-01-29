<?php
    require "../../../application/controller_ads/functions.php";
    $income=mysqli_query($conn, "SELECT SUM(pemasukan) AS total FROM mdata_nota_harian");
    if(mysqli_num_rows($dataReport_income)>0){
        if($row=mysqli_fetch_assoc($dataReport_income)){
            echo "Rp. ".number_format($row['total']);
        }
    }