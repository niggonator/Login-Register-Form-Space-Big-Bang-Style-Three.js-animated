

<?php
// Connect to DB
$dbhost = 'localhost';
$dbuser = 'xy';
$dbpass = 'xy';      
$dbname = 'xy';

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
    die("Connection error: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get email and pwd from AJAX request
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Check if email is free in DB
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Check if user exists, check pwd
        $row = $result->fetch_assoc();
        if (password_verify($password, $row['password'])) {
            // Pwd verified, start session
            session_start();
            $_SESSION['userid'] = $row['userid'];
            $_SESSION['user_email'] = $row['email'];
            $_SESSION['user_username'] = $row['username'];
            

            // Response success to AJAX request
            echo "success";
        } else {
            http_response_code(401); // Unauthorized
            echo "Wrong password.";
        }
    } else {
        http_response_code(404); // Not Found
        echo "User not found.";
    }

    $stmt->close();
}

$conn->close();
?>
