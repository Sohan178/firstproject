<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "backend";


$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$create_table = "CREATE TABLE IF NOT EXISTS data (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(50),
    email VARCHAR(50) UNIQUE,
    phone VARCHAR(15),
    user_password VARCHAR(255)
)";
mysqli_query($conn, $create_table);


if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name  = trim($_POST['name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $pass  = password_hash(trim($_POST['password']), PASSWORD_DEFAULT);

    
    $stmt = mysqli_prepare($conn, "INSERT INTO data (name, email, phone, user_password) VALUES (?, ?, ?, ?)");
    mysqli_stmt_bind_param($stmt, "ssss", $name, $email, $phone, $pass);

    if (mysqli_stmt_execute($stmt)) {
        
        header("Location: login.html");
        exit();
    } else {
        echo "Signup failed: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
