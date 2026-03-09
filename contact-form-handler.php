<?php
include_once("includes/db.php");

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $name = $_POST['name'] ?? '';
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';

    if (!empty($name) && !empty($email) && !empty($message)) {
        $stmt = $conn->prepare("INSERT INTO contact_messages (name, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $name, $email, $message);

        if ($stmt->execute()) {
            echo "<script>alert('Message sent successfully!'); window.location.href='index.php#contact';</script>";
        } else {
            echo "<script>alert('Something went wrong. Please try again.'); window.location.href='index.php#contact';</script>";
        }
    } else {
        echo "<script>alert('Please fill all fields.'); window.location.href='index.php#contact';</script>";
    }
}
?>
