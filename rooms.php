<?php
include("includes/db.php");
session_start();

$query = "SELECT * FROM rooms WHERE status='Available'";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Our Rooms</title>
<meta name="viewport" content="width=device-width, initial-scale=1">

<style>

/* GLOBAL STYLES */
body {
    margin: 0;
    padding: 0;
    font-family: "Segoe UI", Arial, sans-serif;
    background: #f9f9f9;
}

h1 {
    text-align: center;
    margin: 60px 0;
    font-size: 2.8rem;
    font-weight: 600;
}

/* ROOMS GRID */
.rooms-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
    gap: 30px;
    max-width: 1200px;
    margin: auto;
    padding: 0 20px 60px;
}

/* ROOM CARD */
.room-card {
    position: relative;
    overflow: hidden;
    border-radius: 18px;
    box-shadow: 0 15px 40px rgba(0,0,0,0.08);
    cursor: pointer;
    transition: transform 0.4s, box-shadow 0.4s;
}

.room-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 25px 55px rgba(0,0,0,0.12);
}

.room-card img {
    width: 100%;
    height: 240px;
    object-fit: cover;
    transition: 0.4s ease;
}

.room-card:hover img {
    transform: scale(1.05);
}

/* TEXT OVERLAY */
.room-info {
    position: absolute;
    bottom: 0;
    left: 0;
    width: 100%;
    background: rgba(0,0,0,0.45);
    color: white;
    padding: 16px 22px;
    text-align: left;
    backdrop-filter: blur(4px);
}

.room-info h3 {
    margin: 0;
    font-size: 20px;
    font-weight: 600;
}

.room-info .price {
    font-size: 16px;
    margin-top: 6px;
    color: #ffd700;
}

.room-info .btn {
    margin-top: 10px;
    display: inline-block;
    padding: 8px 18px;
    background: #ffd700;
    color: black;
    border-radius: 20px;
    font-weight: bold;
    font-size: 14px;
    transition: 0.3s ease;
}

.room-info .btn:hover {
    background: white;
    color: black;
}

</style>
</head>
<body>

<h1>Our Luxury Rooms</h1>

<div class="rooms-grid">
<?php while($row = mysqli_fetch_assoc($result)):
    $img = !empty($row['image']) ? $row['image'] : 'placeholder.jpeg';
?>
    <div class="room-card" onclick="location.href='room-details.php?id=<?php echo $row['id']; ?>'">
        <img src="assets/images/<?php echo $img; ?>" alt="<?php echo $row['room_type']; ?>">
        <div class="room-info">
            <h3><?php echo $row['room_type']; ?></h3>
            <div class="price">KES <?php echo $row['price']; ?>/night</div>
            <span class="btn">View Details</span>
        </div>
    </div>
<?php endwhile; ?>
</div>

</body>
</html>
