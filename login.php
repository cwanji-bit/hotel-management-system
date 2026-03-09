<?php
session_start();
require_once __DIR__ . "/includes/db.php";

$msg = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $email    = trim($_POST['email'] ?? '');
    $password = $_POST['password'] ?? '';

    if ($email && $password) {
        $stmt = $conn->prepare(
            "SELECT id, full_name, email, password, role
             FROM users
             WHERE email = ? AND role = 'user'
             LIMIT 1"
        );
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $res  = $stmt->get_result();
        $user = $res->fetch_assoc();
        $stmt->close();

        if ($user && password_verify($password, $user['password'])) {
            session_regenerate_id(true);

            $_SESSION['user_id']    = (int)$user['id'];
            $_SESSION['user_name']  = $user['full_name'];
            $_SESSION['user_email'] = $user['email'];
            $_SESSION['user_role']  = 'user';

            header("Location: index.php");
            exit;
        } else {
            $msg = "❌ Invalid email or password.";
        }
    } else {
        $msg = "❌ Please fill in all fields.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Login - Luxury Escape Hotel</title>
  <link rel="stylesheet" href="assets/css/style.css">
  <style>
    body {
      margin: 0;
      padding: 0;
      font-family: 'Segoe UI', Arial, sans-serif;
      background: url('assets/images/hero-room.jpeg') no-repeat center center/cover;
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .overlay {
      position: fixed;
      top: 0; left: 0;
      width: 100%; height: 100%;
      background: rgba(0,0,0,0.6);
      z-index: -1;
    }
    .form-box {
      background: #fff;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 8px 30px rgba(0,0,0,0.2);
      text-align: center;
      width: 380px;
    }
    .form-box h2 {
      margin-bottom: 20px;
      color: #16213e;
    }
    .form-box input {
      width: 100%;
      padding: 12px;
      margin: 10px 0;
      border-radius: 8px;
      border: 1px solid #ccc;
      font-size: 1rem;
    }
    .btn {
      width: 100%;
      padding: 12px;
      background: linear-gradient(90deg, #c49b63, #b68b4c);
      color: white;
      border: none;
      border-radius: 30px;
      font-weight: bold;
      cursor: pointer;
      transition: all 0.3s ease;
    }
    .btn:hover {
      transform: scale(1.05);
      box-shadow: 0 4px 12px rgba(0,0,0,0.3);
    }
    .msg {
      margin: 10px 0;
      font-weight: bold;
      color: red;
    }
    .form-box p {
      margin-top: 15px;
      font-size: 0.95rem;
    }
    .form-box a {
      color: #c49b63;
      text-decoration: none;
      font-weight: bold;
    }
  </style>
</head>
<body>
<div class="overlay"></div>

<div class="form-box">
    <h2>Welcome Back</h2>
    <?php if($msg): ?>
      <p class="msg"><?php echo $msg; ?></p>
    <?php endif; ?>
    <form method="post" action="">
        <input type="email" name="email" placeholder="📧 Email Address" required>
        <input type="password" name="password" placeholder="🔒 Password" required>
        <button type="submit" class="btn">Login</button>
    </form>
    <p>Don't have an account? <a href="register.php">Register</a></p>
</div>

</body>
</html>
