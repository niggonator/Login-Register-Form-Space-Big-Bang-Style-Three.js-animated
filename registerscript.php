<?php
// Connect DB
$dbhost = 'localhost';
$dbuser = 'xy';
$dbpass = 'xy';
$dbname = 'xy';

$conn = new mysqli($dbhost, $dbuser, $dbpass, $dbname);

if ($conn->connect_error) {
    die("Connection failed." . $conn->connect_error);
}

$email = $_POST['email'];
$password = $_POST['password'];
$username = $_POST['username'];

if (isset($_POST['checkEmail'])) {
    $email = $_POST['checkEmail'];

    // Check if email is already taken
    $stmt = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
        http_response_code(409); // Set HTTP status to 409(Conflict)
        echo "E-Mail already taken.";
    } else {
        echo "E-Mail available";
    }
    $stmt->close();
    $conn->close();
    exit;
}

// Check if username is already taken
$stmt = $conn->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows > 0) {
    die("Username already taken.");
}
$stmt->close();

// Hash pwd
$hashed_password = password_hash($password, PASSWORD_DEFAULT);

// Insert user to DB
$stmt = $conn->prepare("INSERT INTO users (email, password, username) VALUES (?, ?, ?)");
$stmt->bind_param("sss", $email, $hashed_password, $username);
if ($stmt->execute()) {
    session_start();

    // Get user_id of new user
    $user_id = $conn->insert_id;

    // Save user information in session
    $_SESSION['userid'] = $user_id;
    $_SESSION['user_email'] = $email;
    $_SESSION['user_username'] = $username;
    
    // Pass data to external server (optional)
    //$command = escapeshellcmd("python3 paramiko_script_register.py $user_id $email");
    //$output = shell_exec($command);

    echo "Registration complete. Click to continue";
} else {
    echo "Registration failed.";
}

$stmt->close();
$conn->close();
?>
