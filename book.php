<?php
include("includes/db.php");
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Initialize message
$msg = "";

// Get room details from DB
if (isset($_GET['room_id'])) {
    $room_id = intval($_GET['room_id']);
    $room_query = mysqli_query($conn, "SELECT * FROM rooms WHERE id = $room_id");
    $room = mysqli_fetch_assoc($room_query);
} else {
    die("Room not selected.");
}

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $user_id = $_SESSION['user_id'];
    $check_in = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    $guests = $_POST['guests'];

    $stmt = $conn->prepare("INSERT INTO bookings (user_id, room_id, check_in, check_out, guests, status) 
                            VALUES (?, ?, ?, ?, ?, 'Pending')");
    $stmt->bind_param("iissi", $user_id, $room_id, $check_in, $check_out, $guests);

    if ($stmt->execute()) {
        header("Location: user-bookings.php?success=1");
        exit();
    } else {
        $msg = "Error: Could not complete booking.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Book Room - Luxury Escape</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    body {
      font-family: Arial, sans-serif;
      background: url('assets/images/<?php echo $room['image']; ?>') no-repeat center center/cover;
      margin: 0;
      padding: 0;
    }
    .overlay {
      background: rgba(0,0,0,0.7);
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .form-box {
      background: #fff;
      padding: 30px;
      border-radius: 10px;
      max-width: 400px;
      width: 100%;
      text-align: center;
    }
    .form-box h2 {
      margin-bottom: 20px;
    }
    .form-box input, .form-box select {
      width: 100%;
      padding: 10px;
      margin: 8px 0;
      border: 1px solid #ccc;
      border-radius: 5px;
    }
    .btn {
      background: #333;
      color: #fff;
      padding: 10px 20px;
      border: none;
      cursor: pointer;
      border-radius: 5px;
      margin-top: 10px;
    }
    .btn:hover {
      background: #555;
    }
    .msg {
      color: red;
      margin-top: 10px;
    }
  </style>
</head>
<body>
  <div class="overlay">
    <div class="form-box">
      <h2>Book <?php echo $room['room_type']; ?></h2>
      <form method="post" action="">
        <label>Check-in Date</label>
        <input type="date" name="check_in" required>

        <label>Check-out Date</label>
        <input type="date" name="check_out" required>

        <label>Number of Guests</label>
        <input type="number" name="guests" min="1" required>

        <button type="submit" class="btn">Confirm Booking</button>
      </form>
      <p class="msg"><?php echo $msg; ?></p>
    </div>
  </div>
</body>
</html>
