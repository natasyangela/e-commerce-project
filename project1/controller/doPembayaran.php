<?php
session_start();
unset($_SESSION["error"]);
include "../database/dbPembelian.php";

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
    if($_SERVER["REQUEST_METHOD"]=="POST")
    {
        // $query="INSERT INTO pembayaran.pembayaran(nama_produk,jumlah,harga) SELECT nama_produk,jumlah,harga FROM pembelian.pembelian WHERE username='$uname'"
        // $res=$con->query($query);
        // die("!");
        $uname = $_SESSION["username"];
        $total= $_SESSION['total'];
        //klo ketemu
        //passing username, total harga, gambar bukti trf

        $image = $_FILES["gambar"];

        $image_name = $image["name"];
        $image_type = $image["type"];
        $image_path = $image["tmp_name"];
        $image_size = $image["size"];

        $filetype= ['image/jpeg', 'image/png', 'image/jpg'];

        //validasi image yg diperbolehkan
        if ($image_size > 10000000){
            $_SESSION["error"] = "Image size must be less than 10MB";
        }

        if(!in_array( $image_type, $filetype))
        {
            $_SESSION["error"]= "Image type must be ‘jpeg’ , ‘jpg’ or ‘png’";
        }
        //gua ada bikin folder bukti transfer, dlm folder itu ada subdirectory lagi
        //klo blm ada folder dg nama si user, bikin foldernya
        if(!file_exists("../bukti transfer/$uname"))
        {
            mkdir("../bukti transfer/$uname", 777);
        }

        //validasi biar image name nya gaada yg sama
        if(!file_exists("../bukti transfer/$uname/$image_name"))
        {
            if(move_uploaded_file($image_path, "../bukti transfer/$uname/$image_name"))
            {
            if(!isset($_SESSION["error"]))
            {
                $query = "SELECT * FROM pembelian WHERE username = '$uname'";
                $result = $conn->query($query);
                
                if( $result->num_rows > 0){
                    include "../database/dbpembayaran.php";
                    while ($row = $result->fetch_assoc())
                    {
                        $namaproduk=$row["nama_produk"];
                        $jml=$row["jumlah"];
                        $hrg=$row["harga"];
                        $query="INSERT INTO pembayaran(username, nama_produk, jumlah, harga, totalharga, bukti_trf) VALUES('$uname','$namaproduk', '$jml','$hrg', '$total', '$image_name')";
                        $res=$con->query($query);
                    }
                }
                $_SESSION["success"]="Upload Success";
                $query= "DELETE FROM pembelian WHERE username='$uname'";
                $result=$conn->query($query);
                header("Location:../pendingpayment.php");

            }
            }

        }  
        else{
                $_SESSION["error"]="Please change the image name";
                header("Location:../pembayaran.php");
        }
        
    }
}


?>