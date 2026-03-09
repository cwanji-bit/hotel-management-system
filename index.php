<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<title>Luxury Escape Hotel</title>
<link rel="stylesheet" href="assets/css/style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
<style>
html {
  scroll-behavior: smooth;
}
/* ================= NAVBAR ================= */
.navbar {
  position: sticky;
  top: 0;
  background: rgba(22,33,62,0.95);
  padding: 15px 40px;
  display: flex;
  justify-content: space-between;
  align-items: center;
  z-index: 1000;
}
.logo { font-size: 1.7rem; font-weight: bold; color: gold; }
.nav-links { display: flex; gap: 20px; align-items:center; }
.nav-links a {
  color: white;
  text-decoration: none;
  font-weight: 500;
  transition: 0.3s;
}
.nav-links a:hover { color: gold; }

.login-btn {
  padding: 8px 18px;
  border-radius: 25px;
  font-weight: bold;
}
.user-btn { background: gold; color:#16213e; }
.admin-btn { border:2px solid gold; color: gold; }
.user-btn:hover { background: white; color: gold; }


/* Hero Section with Video */
.hero-bg {
  position: relative;
  height: 100vh;
  display: flex;
  justify-content: center;
  align-items: center;
  color: white;
  text-align: center;
  overflow: hidden;
}
.hero-bg video {
  position: absolute;
  top: 0; left: 0;
  width: 100%; height: 100%;
  object-fit: cover;
  z-index: -1;
}
.hero-bg .overlay {
  position: absolute;
  top: 0; left: 0;
  width: 100%; height: 100%;
  background: rgba(0,0,0,0.45);
}
.hero-content {
  position: relative;
  z-index: 2;
}
.hero-content h1 {
  font-size: 3.5em;
  font-weight: bold;
  margin-bottom: 20px;
  background: linear-gradient(to right, gold, #ffefba);
  -webkit-background-clip: text;
  -webkit-text-fill-color: transparent;
}
.hero-content p {
  font-size: 1.3em;
  font-style: italic;
}
.btn-small {
  display: inline-block;
  background: gold;
  color: #16213e;
  padding: 12px 25px;
  border-radius: 25px;
  margin-top: 15px;
  text-decoration: none;
  font-weight: bold;
  transition: transform 0.3s;
}
.btn-small:hover {
  transform: scale(1.05);
}

/* Sections */
.section {
  padding: 80px 20px;
  text-align: center;
}
.section-title {
  font-size: 2.5rem;
  color: #16213e;
  margin-bottom: 30px;
}
.section p {
  font-size: 1.1rem;
  max-width: 800px;
  margin: auto;
  line-height: 1.6;
  color: #444;
}

/* Services Cards */
.room-cards {
  display: flex;
  flex-wrap: wrap;
  gap: 25px;
  justify-content: center;
  padding: 20px 0;
}
.room-card {
  background-color: #fff;
  border-radius: 15px;
  padding: 15px;
  width: 300px;
  box-shadow: 0 2px 10px rgba(0,0,0,0.1);
  text-align: center;
  transition: all 0.3s ease;
}
.room-card:hover {
  transform: translateY(-8px);
  box-shadow: 0 6px 20px rgba(0,0,0,0.15);
}
.room-card img {
  width: 100%;
  height: 200px;
  object-fit: cover;
  border-radius: 10px;
  transition: transform 0.4s ease;
}
.room-card:hover img {
  transform: scale(1.05);
}

/* Contact */
.contact-icons {
  display: flex;
  justify-content: center;
  gap: 30px;
  margin: 20px 0;
}
.contact-icons div {
  font-size: 1.2rem;
  color: #16213e;
}
.contact-icons i {
  color: gold;
  margin-right: 10px;
}
.contact-form input,
.contact-form textarea {
  width: 100%;
  padding: 12px;
  margin: 8px 0;
  border-radius: 8px;
  border: 1px solid #ccc;
  font-size: 1rem;
}
.contact-form button {
  background: linear-gradient(90deg, #c49b63, #b68b4c);
  color: white;
  padding: 12px 24px;
  border-radius: 30px;
  font-weight: bold;
  border: none;
  cursor: pointer;
  transition: all 0.3s ease;
}
.contact-form button:hover {
  transform: scale(1.05);
  box-shadow: 0 4px 12px rgba(0,0,0,0.3);
}

/* Footer */
footer {
  text-align: center;
  padding: 15px;
  background: #16213e;
  color: #fff;
  margin-top: 40px;
}

.whatsapp-float {
  position: fixed;
  bottom: 25px;
  right: 25px;
  background: #25D366;
  color: white;
  padding: 14px 20px;
  border-radius: 40px;
  display: flex;
  align-items: center;
  gap: 12px;
  font-size: 16px;
  font-weight: 600;
  text-decoration: none;
  box-shadow: 0 4px 12px rgba(0,0,0,0.3);
  z-index: 9999;
  transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.whatsapp-float i {
  font-size: 28px;
}

.whatsapp-float:hover {
  transform: scale(1.05);
  box-shadow: 0 6px 18px rgba(0,0,0,0.4);
}

/* ===== Added Service Enhancements ===== */
.service-tags {
  display: flex;
  justify-content: center;
  gap: 12px;
  margin-bottom: 35px;
  flex-wrap: wrap;
}

.service-tags span {
  padding: 6px 16px;
  background: #16213e;
  color: #fff;
  border-radius: 20px;
  font-size: 0.9rem;
}

.service-btn {
  margin-top: 12px;
  padding: 8px 18px;
  border-radius: 20px;
  border: none;
  background: linear-gradient(90deg, gold, #ffefba);
  color: #16213e;
  font-weight: bold;
  cursor: pointer;
  transition: 0.3s ease;
}

.service-btn:hover {
  transform: scale(1.05);
  box-shadow: 0 4px 12px rgba(0,0,0,0.2);
}

.room-card h3 i {
  color: gold;
  margin-right: 8px;
}

/* ===== Professional About Section Additions ===== */
.about-grid {
  display: grid;
  grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
  gap: 30px;
  margin-top: 40px;
}

.about-card {
  background: #fff;
  padding: 25px;
  border-radius: 15px;
  box-shadow: 0 4px 15px rgba(0,0,0,0.1);
  transition: 0.3s ease;
}

.about-card:hover {
  transform: translateY(-6px);
}

.about-card i {
  font-size: 32px;
  color: gold;
  margin-bottom: 15px;
}

.about-card h3 {
  color: #16213e;
  margin-bottom: 10px;
}

.about-stats {
  display: flex;
  justify-content: center;
  gap: 40px;
  margin-top: 50px;
  flex-wrap: wrap;
}

.stat-box {
  text-align: center;
}

.stat-box h2 {
  font-size: 2.5rem;
  color: gold;
}

.stat-box p {
  font-weight: bold;
  color: #16213e;
}

</style>
</head>
<body>

<!-- ================= NAVBAR ================= -->
<header class="navbar">
  <div class="logo">Luxury Escape</div>

  <div class="nav-links">
    <a href="#home">Home</a>
    <a href="rooms.php">Rooms</a>
    <a href="user-bookings.php">My Bookings</a>
    <a href="#about">About</a>
    <a href="#services">Services</a>
    <a href="#contact">Contact</a>

   <?php if(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'admin'): ?>
    <a href="/hotel-management/admin/sidebar.php" class="login-btn admin-btn">Admin Panel</a>
    <a href="/hotel-management/logout.php" class="login-btn user-btn">Logout</a>

<?php elseif(isset($_SESSION['user_role']) && $_SESSION['user_role'] === 'user'): ?>
    <a href="/hotel-management/user-bookings.php" class="login-btn user-btn">My Bookings</a>
    <a href="/hotel-management/logout.php" class="login-btn admin-btn">Logout</a>

<?php else: ?>
    <a href="/hotel-management/login.php" class="login-btn user-btn">User Login</a>
    <a href="/hotel-management/admin/login.php" class="login-btn admin-btn">Admin Login</a>
<?php endif; ?>
>

  </div>
</header>


<!-- Hero with Video -->
<section id="home" class="hero-bg">
  <video autoplay muted loop>
    <source src="assets/videos/hotel.mp4" type="video/mp4">
    Your browser does not support video.
  </video>
  <div class="overlay"></div>
  <div class="hero-content">
    <h1>Welcome to Luxury Escape Hotel</h1>
    <p>Your ultimate comfort and relaxation destination</p>
    <a href="rooms.php" class="btn-small">View Rooms</a>
  </div>
</section>

<!-- Services -->
<section id="services" class="section">
  <h2 class="section-title">Our Services</h2>
  <p style="max-width:800px;margin:0 auto 30px;color:#555;">
  Enjoy a full range of luxury, business, and leisure services designed for your comfort.
</p>

<div class="service-tags">
  <span>Wellness</span>
  <span>Dining</span>
  <span>Business</span>
  <span>Transport</span>
  <span>Leisure</span>
</div>

  <div class="room-cards">
    <div class="room-card">
      <img src="assets/images/spa.jpeg" alt="Spa">
      <h3>Spa & Wellness</h3>
      <p>Relax and rejuvenate with our world-class spa treatments.</p>
    </div>
    <div class="room-card">
      <img src="assets/images/restaurant.jpeg" alt="Restaurant">
      <h3>Fine Dining</h3>
      <p>Enjoy gourmet meals prepared by our expert chefs.</p>
    </div>
    <div class="room-card">
      <img src="assets/images/pool.jpeg" alt="Pool">
      <h3>Swimming Pool</h3>
      <p>Take a refreshing dip in our indoor and outdoor pools.</p>
    </div>
    <div class="room-card">
      <img src="assets/images/gym.jpeg" alt="Gym">
      <h3>Fitness Center</h3>
      <p>Stay fit during your stay with modern gym equipment.</p>
    </div>

    <div class="room-card">
  <img src="assets/images/airport.jpg" alt="Airport Transfer">
  <h3> Airport Transfers</h3>
  <p>Comfortable airport pickup and drop-off services.</p>

</div>

<div class="room-card">
  <img src="assets/images/conference.jpg" alt="Conference Rooms">
  <h3> Conference & Meetings</h3>
  <p>Modern meeting rooms for corporate and private events.</p>
  
</div>

<div class="room-card">
  <img src="assets/images/room-service.webp" alt="Room Service">
  <h3> 24/7 Room Service</h3>
  <p>Order meals and services directly to your room.</p>
  
</div>

<div class="room-card">
  <img src="assets/images/laundry.jpg" alt="Laundry Service">
  <h3> Laundry & Dry Cleaning</h3>
  <p>Professional same-day laundry services.</p>
</div>

<div class="room-card">
  <img src="assets/images/tour.jpg" alt="Tour Desk">
  <h3> Tour & Travel Desk</h3>
  <p>Book city tours, safaris, and travel assistance.</p>
 
</div>

  </div>
</section>

<!-- About -->
<section id="about" class="section">
  <h2 class="section-title">About Us</h2>
  <p>Luxury Escape Hotel is dedicated to providing the ultimate comfort and relaxation experience. 
     Our luxurious rooms, friendly staff, and premium services ensure your stay is unforgettable.</p>

     <div class="about-grid">

  <div class="about-card">
    <i class="fas fa-hotel"></i>
    <h3>Who We Are</h3>
    <p>
      Luxury Escape Hotel is a modern hospitality destination combining luxury accommodation,
      technology-driven services, and exceptional customer care.
    </p>
  </div>

  <div class="about-card">
    <i class="fas fa-bullseye"></i>
    <h3>Our Mission</h3>
    <p>
      To deliver world-class hospitality by integrating comfort, efficiency, and personalized
      guest experiences through smart hotel management systems.
    </p>
  </div>

  <div class="about-card">
    <i class="fas fa-eye"></i>
    <h3>Our Vision</h3>
    <p>
      To become a leading luxury hotel brand recognized for innovation, service excellence,
      and sustainable hospitality solutions.
    </p>
  </div>

  <div class="about-card">
    <i class="fas fa-handshake"></i>
    <h3>Our Values</h3>
    <p>
      Customer satisfaction, professionalism, integrity, innovation, and continuous
      improvement in service delivery.
    </p>
  </div>

</div>

<!-- Hotel Statistics -->
<div class="about-stats">

  <div class="stat-box">
    <h2>120+</h2>
    <p>Luxury Rooms</p>
  </div>

  <div class="stat-box">
    <h2>15+</h2>
    <p>Premium Services</p>
  </div>

  <div class="stat-box">
    <h2>98%</h2>
    <p>Guest Satisfaction</p>
  </div>

  <div class="stat-box">
    <h2>24/7</h2>
    <p>Customer Support</p>
  </div>

</div>

</section>

<!-- Contact -->
<section id="contact" class="section">
  <h2 class="section-title">Contact Us</h2>
  <div class="contact-icons">
    <div><i class="fas fa-phone"></i> +254 746 540 901</div>
    <div><i class="fas fa-envelope"></i> info@luxuryescape.com</div>
    <div><i class="fas fa-map-marker-alt"></i> Nairobi, Kenya</div>
  </div>
</section>

<!-- Footer -->
<footer>
  <p>&copy; <?php echo date("Y"); ?> Luxury Escape Hotel. All rights reserved.</p>
</footer>


<a href="https://wa.me/254746540901" class="whatsapp-float" target="_blank">
  <i class="fab fa-whatsapp"></i> Chat with us
</a>

</body>
</html>

</body>
</html>
