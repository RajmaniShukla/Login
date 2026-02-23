<?php
/**
 * Database Configuration Template
 * 
 * Copy this file to use in session.php and login.php
 * Replace the hardcoded credentials with these includes
 * 
 * Usage: include('db.php'); // Then use $connection
 */

$db_host = 'localhost';
$db_user = 'your_username';
$db_pass = 'your_password';
$db_name = 'company';

$connection = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$connection) {
    error_log("Database connection failed: " . mysqli_connect_error());
    die("Connection failed. Please try again later.");
}

mysqli_set_charset($connection, "utf8mb4");

/**
 * SECURE VERSION - Use this in production:
 * 
 * // Start session with secure settings
 * session_set_cookie_params([
 *     'lifetime' => 3600,
 *     'path' => '/',
 *     'secure' => true,
 *     'httponly' => true,
 *     'samesite' => 'Strict'
 * ]);
 * session_start();
 * 
 * // For login verification, use prepared statements:
 * $stmt = $connection->prepare("SELECT id, password FROM login WHERE username = ?");
 * $stmt->bind_param("s", $username);
 * $stmt->execute();
 * $result = $stmt->get_result();
 * $user = $result->fetch_assoc();
 * 
 * if ($user && password_verify($password, $user['password'])) {
 *     session_regenerate_id(true);
 *     $_SESSION['login_user'] = $username;
 *     $_SESSION['user_id'] = $user['id'];
 * }
 */
?>
