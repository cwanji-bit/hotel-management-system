<?php
include_once("includes/db.php");
session_start();

$msg = "";
$status = ""; // success | error

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $full_name = $_POST['full_name'] ?? '';
  $email = $_POST['email'] ?? '';
  $password = $_POST['password'] ?? '';
  $confirm_password = $_POST['confirm_password'] ?? '';

  if ($password !== $confirm_password) {
    $msg = "❌ Passwords do not match.";
    $status = "error";
  } else {
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    $check = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $check->bind_param("s", $email);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
      $msg = "❌ This email is already registered.";
      $status = "error";
    } else {
      $stmt = $conn->prepare(
        "INSERT INTO users (full_name, email, password, role) VALUES (?, ?, ?, 'user')"
      );
      $stmt->bind_param("sss", $full_name, $email, $hashedPassword);

      if ($stmt->execute()) {
        $_SESSION['user_id'] = $stmt->insert_id;
        $_SESSION['user_name'] = $full_name;
        $_SESSION['user_email'] = $email;

        $msg = "✅ Registration successful!";
        $status = "success";
      } else {
        $msg = "❌ Registration failed. Please try again.";
        $status = "error";
      }
    }
  }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Register - Luxury Escape Hotel</title>
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
      top: 0;
      left: 0;
      width: 100%;
      height: 100%;
      background: rgba(0, 0, 0, 0.6);
      z-index: -1;
    }

    .form-box {
      background: #fff;
      padding: 40px;
      border-radius: 15px;
      box-shadow: 0 8px 30px rgba(0, 0, 0, 0.2);
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
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.3);
    }

    .msg {
      margin: 10px 0;
      font-weight: bold;
      color: green;
    }

    .msg.error {
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

   .password-box {
  position: relative;
}
.password-box input {
  padding-right: 45px;
}
.toggle {
  position: absolute;
  right: 12px;
  top: 50%;
  transform: translateY(-50%);
  cursor: pointer;
  font-size: 1.1rem;
  user-select: none;
  z-index: 2;
}

   .popup {
  position: fixed;
  inset: 0;
  background: rgba(0,0,0,0.6);
  display: none; /* hidden by default */
  justify-content: center;
  align-items: center;
  z-index: 999;
}

.popup-content {
  background: white;
  padding: 30px 25px;
  border-radius: 12px;
  text-align: center;

  width: 300px;
  height: 100px;
  font-weight: bold;
  font-size: 1rem;
  border-top: 5px solid green; /* green for success, red for error */
}

.popup-content.error {
  border-top-color: red;
  margin-top: 30px;
}

  </style>
</head>

<body>
  <div class="overlay"></div>

  <div class="form-box">
    <h2>Create Account</h2>
    <?php if ($msg): ?>
      <p class="msg"><?php echo $msg; ?></p>
    <?php endif; ?>
    <form method="post" action="">
      <input type="text" name="full_name" placeholder="👤 Full Name" required>
      <input type="email" name="email" placeholder="📧 Email Address" required>
     <div class="password-box">
  <input type="password" id="password" name="password" placeholder="🔒 Password" required>
  <span class="toggle" onclick="togglePassword(this, 'password')">👁</span>
</div>

<div class="password-box">
  <input type="password" id="confirm_password" name="confirm_password" placeholder="🔒 Confirm Password" required>
  <span class="toggle" onclick="togglePassword(this, 'confirm_password')">👁</span>
</div>

      <button type="submit" class="btn">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login</a></p>
  </div>

  <div id="popup" class="popup">
  <div id="popup-content" class="popup-content"></div>
</div>


<script>
function togglePassword(icon, fieldId) {
  const input = document.getElementById(fieldId);

  if (input.type === "password") {
    input.type = "text";
    icon.classList.replace("fa-eye", "fa-eye-slash");
    icon.setAttribute("aria-label", "Hide password");
  } else {
    input.type = "password";
    icon.classList.replace("fa-eye-slash", "fa-eye");
    icon.setAttribute("aria-label", "Show password");
  }
}

function showPopup(message, type = "success") {
  const popup = document.getElementById("popup");
  const popupContent = document.getElementById("popup-content");

  popupContent.textContent = message;
  popupContent.className = "popup-content " + (type === "error" ? "error" : "success");
  popup.style.display = "flex";

  // Auto-hide after 10 seconds
  setTimeout(() => {
    popup.style.display = "none";
    if(type === "success"){
      window.location.href = "index.php"; // redirect after success
    }
  }, 5000);
}

// Trigger popup if PHP set a message
<?php if($msg): ?>
showPopup("<?php echo $msg; ?>", "<?php echo $status; ?>");
<?php endif; ?>
</script>

</html>