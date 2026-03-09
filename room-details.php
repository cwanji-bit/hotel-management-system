<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);

include("includes/db.php");

if(!isset($_GET['id'])){
    die("Room not found.");
}

$id = intval($_GET['id']);
$query = mysqli_query($conn, "SELECT * FROM rooms WHERE id=$id");

if(mysqli_num_rows($query) == 0){
    die("Room not found.");
}

$room = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $room['room_name']; ?> - Room Details</title>

    <!-- Font Awesome Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">

    <style>
        body{
            font-family: Arial, sans-serif;
            margin:0;
            padding:0;
            background:#f8f8f8;
        }

        .container{
            width:85%;
            margin:50px auto;
            background:#fff;
            padding:40px;
            border-radius:8px;
            box-shadow:0 4px 15px rgba(0,0,0,0.08);
        }

        .room-image{
            width:100%;
            max-height:400px;
            object-fit:cover;
            border-radius:8px;
        }

        h1{
            margin-top:25px;
            font-size:28px;
        }

        .price{
            font-size:20px;
            color:#c5a253;
            margin:10px 0 20px;
        }

        .description{
            line-height:1.6;
            color:#555;
        }

        .section-title{
            font-size:22px;
            margin-top:50px;
            margin-bottom:30px;
            position:relative;
        }

        .section-title::after{
            content:"";
            width:60px;
            height:3px;
            background:#c5a253;
            position:absolute;
            left:0;
            bottom:-8px;
        }

        .amenities-container{
            display:grid;
            grid-template-columns:repeat(auto-fit, minmax(220px,1fr));
            gap:40px;
        }

        .amenity-category h3{
            font-size:17px;
            margin-bottom:15px;
            border-bottom:1px solid #eee;
            padding-bottom:8px;
        }

        .amenity-category h3 i{
            margin-right:8px;
            color:#c5a253;
        }

        .amenity-item{
            padding:6px 0;
            font-size:14px;
            color:#555;
        }

        .amenity-item i{
            margin-right:6px;
            color:#c5a253;
            font-size:12px;
        }

        .book-btn{
            display:inline-block;
            margin-top:40px;
            padding:12px 25px;
            background:#c5a253;
            color:#fff;
            text-decoration:none;
            border-radius:5px;
            transition:0.3s;
        }

        .book-btn:hover{
            background:#a8853e;
        }
    </style>
</head>

<body>

<div class="container">

    <img src="assets/images/<?php echo $room['image']; ?>" class="room-image">

    <h1><?php echo $room['room_type']; ?></h1>

    <div class="price">
        KES <?php echo $room['price']; ?> / night
    </div>

    <div class="description">
        <?php echo $room['description']; ?>
    </div>

    <!-- Amenities Section -->
    <h2 class="section-title">Room Amenities</h2>

    <?php
    $amenitiesRaw = isset($room['amenities']) ? $room['amenities'] : '';
    $amenities = explode(',', $amenitiesRaw);

    $comfort = [];
    $bathroom = [];
    $technology = [];
    $services = [];

    foreach($amenities as $item){
        $item = trim($item);
        $lower = strtolower($item);

        if($item == "") continue;

        if(strpos($lower,'bed')!==false || strpos($lower,'air')!==false || strpos($lower,'balcony')!==false){
            $comfort[] = $item;
        }
        elseif(strpos($lower,'shower')!==false || strpos($lower,'bath')!==false || strpos($lower,'toilet')!==false){
            $bathroom[] = $item;
        }
        elseif(strpos($lower,'wifi')!==false || strpos($lower,'tv')!==false){
            $technology[] = $item;
        }
        else{
            $services[] = $item;
        }
    }
    ?>

    <div class="amenities-container">

        <?php if(!empty($comfort)): ?>
        <div class="amenity-category">
            <h3><i class="fa-solid fa-bed"></i> Comfort</h3>
            <?php foreach($comfort as $item): ?>
                <div class="amenity-item">
                    <i class="fa-solid fa-check"></i> <?php echo $item; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if(!empty($bathroom)): ?>
        <div class="amenity-category">
            <h3><i class="fa-solid fa-bath"></i> Bathroom</h3>
            <?php foreach($bathroom as $item): ?>
                <div class="amenity-item">
                    <i class="fa-solid fa-check"></i> <?php echo $item; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if(!empty($technology)): ?>
        <div class="amenity-category">
            <h3><i class="fa-solid fa-tv"></i> Technology</h3>
            <?php foreach($technology as $item): ?>
                <div class="amenity-item">
                    <i class="fa-solid fa-check"></i> <?php echo $item; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <?php if(!empty($services)): ?>
        <div class="amenity-category">
            <h3><i class="fa-solid fa-concierge-bell"></i> Services</h3>
            <?php foreach($services as $item): ?>
                <div class="amenity-item">
                    <i class="fa-solid fa-check"></i> <?php echo $item; ?>
                </div>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

    </div>

    <a href="book.php?room_id=<?php echo $room['id']; ?>" class="book-btn">
        Book This Room
    </a>

</div>

</body>
</html>