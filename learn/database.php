<?php
    $servername="localhost";
    $username="root";
    $password="";

    $conn=mysqli_connect($servername,$username,$password);

    if(!$conn){
        die("Error connecting".mysqli_connect_errno());
    }

    else{
        echo "Connected successfully";
    }


    $sql="CREATE DATABASE backend";

    if(mysqli_query($conn,$sql)){
        echo "Created database successfully";
    }

    else{
        echo "Failed".mysqli_error($conn);
    }

    mysqli_close($conn);
?>