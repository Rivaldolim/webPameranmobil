<?php
// Database connection settings
$host = 'localhost'; // Database host
$dbname = 'fumeo_showroom'; // Database name
$username = 'root'; // Database fullname
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
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    // Prepare and execute SQL query to insert user data
    $sql = "INSERT INTO tickets (fullname, email, message) VALUES (:fullname, :email, :message)";
    $stmt = $conn->prepare($sql);
    
    // Bind parameters and execute the statement
    $stmt->bindParam(':fullname', $fullname);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':message', $message);

    try {
        $stmt->execute();
        // echo "User registered successfully!";
        // Redirect to login page or other destination
        echo '<script type="text/javascript">

            alert("Welcome to Geeks for Geeks")

        </script>';

        header("Location: home.php");
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
}
?>
