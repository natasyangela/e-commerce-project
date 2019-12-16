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
        
        $nama = $_POST["nama"];
        $jumlah = $_POST["jumlah"];
        $price = $_POST["harga"];
        $image = $_FILES["gambar"];

        // var_dump($image);
        $image_name = $image["name"];
        $image_type = $image["type"];
        $image_path = $image["tmp_name"];
        $image_size = $image["size"];

        if ($nama == ""){
            $_SESSION["error"] = "Nama must be filled";
        }
        if ($jumlah == ""){
            $_SESSION["error"] = "Jumlah must be filled";
        }
        if ($price == ""){
            $_SESSION["error"] = "Harga must be filled";
        }
    
        if (!is_numeric($price)){
            $_SESSION["error"] = "Price must be numeric";
        }
    
        if ($image_size > 10000000){
            $_SESSION["error"] = "Image size must be less than 10MB";
        }
        
        $file_arr = ["image/jpeg","image/jpg","image/png"];
        if (!in_array($image_type,$file_arr)){
            $_SESSION["error"] = "Image type must be ‘jpeg’ , ‘jpg’ or ‘png";
        }

        if (isset($_SESSION["error"])){
            // unset($_SESSION["error"]);
            header("Location: ../update.php?id=$id");
            
        }else{
            
            $query = "UPDATE product SET nama = '$nama', stock = '$jumlah', harga = '$price', gambar = '$image_name' WHERE id = $id";
            $result = $connection->query($query);
            // die($id);
            header("Location: ../home.php");
        }

    }
}

?>