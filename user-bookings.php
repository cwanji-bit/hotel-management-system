<?php
include_once("includes/db.php");
session_start();

// Make sure user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['user_id'];

// Active bookings (Pending/Approved)
$activeResult = mysqli_query($conn, "
    SELECT b.*, r.room_type, r.price 
    FROM bookings b 
    JOIN rooms r ON b.room_id = r.id 
    WHERE b.user_id=$userId AND b.status IN ('Pending','Approved')
    ORDER BY b.id DESC
");

// Booking history (Rejected or past Approved)
$historyResult = mysqli_query($conn, "
    SELECT b.*, r.room_type, r.price 
    FROM bookings b 
    JOIN rooms r ON b.room_id = r.id 
    WHERE b.user_id=$userId AND b.status='Rejected'
    ORDER BY b.id DESC
");
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>My Bookings - Luxury Escape</title>
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
body {
    font-family: 'Segoe UI', Arial, sans-serif;
    background: linear-gradient(to right, #f0f4f7, #e0e7ed);
    margin: 0;
    padding: 0;
    color: #333;
}
.navbar { background:#16213e; padding:15px 30px; color:#fff; display:flex; justify-content:space-between; }
.navbar a { color:#fff; margin-left:20px; text-decoration:none; font-weight:bold; }
.container { max-width:1200px; margin:auto; padding:30px; }
h2 { text-align:center; margin-bottom:30px; color:#16213e; }
.table { width:100%; border-collapse: collapse; background:#fff; border-radius:10px; overflow:hidden; box-shadow:0 4px 15px rgba(0,0,0,0.1); }
.table th, .table td { padding:12px; text-align:center; }
.table th { background:#16213e; color:#fff; }
.table tr:hover { background:#f1f1f1; transform: translateY(-2px); transition: 0.2s; }
.status { padding:5px 12px; border-radius:12px; font-weight:bold; display:inline-block; font-size:0.9rem; }
.Pending { background:#f9d71c; color:#000; }
.Approved { background:#28a745; color:#fff; }
.Rejected { background:#dc3545; color:#fff; }
.action-btn { padding:6px 14px; margin:2px; border:none; border-radius:6px; cursor:pointer; color:#fff; font-weight:bold; transition:0.2s; }
.approve { background:#28a745; }
.approve:hover { background:#218838; transform: scale(1.05); }
.reject { background:#dc3545; }
.reject:hover { background:#c82333; transform: scale(1.05); }
.table img { width:80px; height:60px; object-fit:cover; border-radius:6px; }
.section-title { text-align:left; color:#16213e; margin-bottom:15px; }
</style>
</head>
<body>

<header class="navbar">
  <div class="logo">Luxury Escape</div>
  <nav>
    <a href="index.php">Home</a>
    <a href="rooms.php">Rooms</a>
    <a href="book.php">Book</a>
    <a href="logout.php">Logout (<?php echo htmlspecialchars($_SESSION['user_name']); ?>)</a>
  </nav>
</header>

<div class="container">
<h2>Active Bookings</h2>
<?php if(mysqli_num_rows($activeResult) > 0): ?>
<table class="table">
<tr>
    <th>#</th>
    <th>Room</th>
    <th>Price</th>
    <th>Check In</th>
    <th>Check Out</th>
    <th>Status</th>
</tr>
<?php $i=1; while($row = mysqli_fetch_assoc($activeResult)): ?>
<tr>
    <td><?php echo $i; ?></td>
    <td><?php echo htmlspecialchars($row['room_type']); ?></td>
    <td>$<?php echo number_format($row['price'],2); ?></td>
    <td><?php echo $row['check_in']; ?></td>
    <td><?php echo $row['check_out']; ?></td>
    <td><span class="status <?php echo $row['status']; ?>"><?php echo $row['status']; ?></span></td>
</tr>
<?php $i++; endwhile; ?>
</table>
<?php else: ?>
<p>No active bookings found.</p>
<?php endif; ?>

<h2 class="section-title">Booking History</h2>
<?php if(mysqli_num_rows($historyResult) > 0): ?>
<table class="table">
<tr>
    <th>#</th>
    <th>Room</th>
    <th>Price</th>
    <th>Check In</th>
    <th>Check Out</th>
    <th>Status</th>
</tr>
<?php $i=1; while($row = mysqli_fetch_assoc($historyResult)): ?>
<tr>
    <td><?php echo $i; ?></td>
    <td><?php echo htmlspecialchars($row['room_type']); ?></td>
    <td>$<?php echo number_format($row['price'],2); ?></td>
    <td><?php echo $row['check_in']; ?></td>
    <td><?php echo $row['check_out']; ?></td>
    <td><span class="status <?php echo $row['status']; ?>"><?php echo $row['status']; ?></span></td>
</tr>
<?php $i++; endwhile; ?>
</table>
<?php else: ?>
<p>No booking history found.</p>
<?php endif; ?>
</div>

</body>
</html>
