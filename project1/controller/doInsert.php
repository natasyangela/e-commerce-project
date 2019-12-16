<?php
session_start();
unset($_SESSION["error"]);
include "../database/dbProduct.php";

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
        $id = $_POST["id"];
        
        $nama = $_POST["nama"];
        $jumlah = $_POST["jumlah"];
        $price = $_POST["harga"];
        $image = $_FILES["gambar"];

        //var_dump($image);
    // die();
        $image_name = $image["name"];
        $image_type = $image["type"];
        $image_path = $image["tmp_name"];
        $image_size = $image["size"];

        $filetype= ['image/jpeg', 'image/png', 'image/jpg'];


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

        if(!in_array( $image_type, $filetype))
        {
            $_SESSION["error"]= "Image type must be ‘jpeg’ , ‘jpg’ or ‘png’";
        }
        if(!ctype_alnum($nama) && $nama != trim($nama))
        {
            $_SESSION["error"]= "Type must be alphabet or numeric or alphanumeric";
        }
        
        if(!isset($_SESSION["error"]))
        {
            $query="INSERT INTO product(nama, harga, stock, gambar) VALUES('$nama','$price','$jumlah', '$image_name')";
            $result=$connection->query($query);
            if($result)
            {
                //die("h");
                header("Location:../home.php");
            }
        }
        else{
                    //$_SESSION["err-ins"]="Insert failed";
                    header("Location:../insert.php");
                }
    }
}

?>