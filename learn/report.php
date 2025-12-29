<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "backend";

$conn = mysqli_connect($servername, $username, $password, $dbname);
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$table="CREATE TABLE IF NOT EXISTS issue_reports (
    id INT AUTO_INCREMENT PRIMARY KEY,

    name VARCHAR(100),

    criminal TINYINT(1) DEFAULT 0,
    social_issue TINYINT(1) DEFAULT 0,
    health_related TINYINT(1) DEFAULT 0,
    other_issue TINYINT(1) DEFAULT 0,

    other_specify VARCHAR(255),

    issue_description TEXT NOT NULL,
    address TEXT NOT NULL,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP




);";

 mysqli_query($conn, $table);

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $name = trim($_POST['name']);

    $criminal = isset($_POST['criminal']) ? 1 : 0;
    $social_issue = isset($_POST['social']) ? 1 : 0;
    $health_related = isset($_POST['related']) ? 1 : 0;
    $other_issue = isset($_POST['other']) ? 1 : 0;

    $other_specify = $_POST['specify'] ?? '';
    $issue_description = $_POST['issue'];
    $address = trim($_POST['address']);

    $sql = "INSERT INTO issue_reports
            (name, criminal, social_issue, health_related, other_issue, other_specify, issue_description, address)
            VALUES
            ('$name', '$criminal', '$social_issue', '$health_related', '$other_issue', '$other_specify', '$issue_description', '$address')";

    if (mysqli_query($conn, $sql)) {
       
        header("Location: done.html");
        exit();
    } else {
        echo "Failed: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
