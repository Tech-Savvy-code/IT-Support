<?php
header("Content-Type: application/json");

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "contact_db";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    echo json_encode(["status" => "error", "message" => "Connection failed: " . $conn->connect_error]);
    exit();
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $formType = $_POST['form_type'] ?? '';

    if ($formType === "contact") {
        // Handle contact form
        $name = $conn->real_escape_string($_POST['name']);
        $email = $conn->real_escape_string($_POST['email']);
        $subject = $conn->real_escape_string($_POST['subject']);
        $message = $conn->real_escape_string($_POST['message']);

        $sql = "INSERT INTO contacts (name, email, subject, message) VALUES ('$name', '$email', '$subject', '$message')";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(["status" => "success", "message" => "Contact form submitted successfully!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
        }
    } elseif ($formType === "order") {
        // Handle order form
        $name = $conn->real_escape_string($_POST['orderName']);
        $email = $conn->real_escape_string($_POST['orderEmail']);
        $details = $conn->real_escape_string($_POST['orderDetails']);

        $sql = "INSERT INTO order_service (name, email, details) VALUES ('$name', '$email', '$details')";

        if ($conn->query($sql) === TRUE) {
            echo json_encode(["status" => "success", "message" => "Order form submitted successfully!"]);
        } else {
            echo json_encode(["status" => "error", "message" => "Error: " . $conn->error]);
        }
    } else {
        echo json_encode(["status" => "error", "message" => "Invalid form type!"]);
    }
} else {
    echo json_encode(["status" => "error", "message" => "Invalid request method!"]);
}

$conn->close();
?>
