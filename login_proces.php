<?php
session_start();

// Database connection settings
$host = 'localhost'; // Database host
$dbname = 'fumeo_showroom'; // Database name
$username = 'root'; // Database username
$password = ''; // Database password

// Connect to MySQL database
try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare SQL query to retrieve user data
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();

    // Check if user exists
    if ($stmt->rowCount() > 0) {
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        $stored_password = $user['password'];

        // Verify password
        if (password_verify($password, $stored_password)) {
            // Password is correct, set session variables
            $_SESSION['username'] = $username;
            // header("Location: login.php?username=$username&password=$password"); // Redirect to welcome page
            header("Location: home.php");
            exit;
        } else {
            // Password is incorrect
            header("Location: login.php?error=Invalid password");
            exit;
        }
    } else {
        // User not found
        header("Location: login.php?error=User not found");
        exit;
    }
}
?>
