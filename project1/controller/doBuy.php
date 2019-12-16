<?php

session_start();
include "../database/dbProduct.php";

unset($_SESSION["error"]);

if(isset($_POST['csrf_token']))
{
    $csrfErr = "";
    if($_SESSION['csrf_token'] === $_REQUEST['csrf_token'])
    {
        $csrfErr = "";
    }
    else {
        $csrfErr = "error";
    }
}

if(isset($csrfErr) && empty($csrfErr))
{
    if ($_SERVER['REQUEST_METHOD'] == "POST"){
        
        $id = $_POST["id"];
        $uname=$_SESSION["username"];
    
        //dapetin info product where id=$id
        $query= "SELECT * from product WHERE id='$id'";
        $result=$connection->query($query);
        if($result->num_rows>0)
        {
            $row=$result->fetch_assoc();
            $harga=$row["harga"];
            $nama=$row["nama"];
            $image=$row["gambar"];
    
        }
    
        //klo mau beli tp jumlah produk yag dibeli lebih banyak dr stock yg tersedia
        if($_POST["jumlah"]>$row["stock"])
        {
            $_SESSION["error"]='Jumlah melebihi stok';
            header("Location:../buy.php?id=$id");
        }
        else
        {
            $jumlah=$_POST["jumlah"];
            include_once "../database/dbPembelian.php";
            //masukkin ke db pembelian sesuai username
            $total = $harga*$jumlah;
            //$harga = $harga*$jumlah;
            $query="INSERT INTO pembelian(username,nama_produk,jumlah,harga,gambar) VALUES('$uname', '$nama', '$jumlah', '$total', '$image')";
            $result=$conn->query($query);
            header("Location:../cart.php");
        }
    }

}

?>