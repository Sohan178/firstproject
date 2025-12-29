<?php
// Database connection
$conn = mysqli_connect("localhost", "root", "", "backend");
if (!$conn) {
    die("Database connection failed");
}

// Run only when form is submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $email    = trim($_POST['email']);
    $password = trim($_POST['password']);

    // Get user by email
    $sql = "SELECT user_password FROM data WHERE email = ?";
    $stmt = mysqli_prepare($conn, $sql);
    mysqli_stmt_bind_param($stmt, "s", $email);
    mysqli_stmt_execute($stmt);
    $result = mysqli_stmt_get_result($stmt);

    if ($result && mysqli_num_rows($result) === 1) {

        $row = mysqli_fetch_assoc($result);

        // Verify password
        if (password_verify($password, $row['user_password'])) {
            // Login success
            header("Location: report.html");
            exit();
        } else {
            echo "❌ Incorrect password";
        }

    } else {
        echo "❌ Email not found";
    }
}

mysqli_close($conn);
?>
