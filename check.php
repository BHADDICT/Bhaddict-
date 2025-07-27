<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Autoload via Composer
require 'vendor/autoload.php';

$status = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = htmlspecialchars($_POST['name']);
    $email = htmlspecialchars($_POST['email']);
    $order = htmlspecialchars($_POST['order']);

    $mail = new PHPMailer(true);

    try {
        // Server settings
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';        // SMTP server
        $mail->SMTPAuth = true;
        $mail->Username = 'masitamaramsa@gmail.com';   // 🔴 Your Gmail address
      $mail->Password = 'ukepdinogzecdsnw';
  // 🔴 Use App Password from Gmail
        $mail->SMTPSecure = 'tls';
        $mail->Port = 587;

        // Recipients
       $mail->setFrom('masitamaramsa@gmail.com', 'Order Form');
 // Sender
        $mail->addAddress('masitamaramsa@gmail.com');        // Receiver

        // Content
        $mail->isHTML(false);
        $mail->Subject = "New Order from $name";
        $mail->Body = "Name: $name\nEmail: $email\nOrder Details:\n$order";

        $mail->send();
        $status = "✅ Order submitted successfully!";
    } catch (Exception $e) {
        $status = "❌ Error: {$mail->ErrorInfo}";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Checkout</title>
  <style>
    body {
      font-family: Arial, sans-serif;
      background: #f6f6f6;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    form {
      background: white;
      padding: 30px;
      border-radius: 8px;
      box-shadow: 0 0 10px rgba(0,0,0,0.1);
      width: 300px;
    }
    input, textarea, button {
      width: 100%;
      margin: 10px 0;
      padding: 10px;
      font-size: 16px;
    }
    button {
      background: black;
      color: white;
      border: none;
      cursor: pointer;
    }
    .message {
      margin-top: 10px;
      font-weight: bold;
      color: green;
    }
  </style>
</head>
<body>
  <form method="POST" action="">
    <h2>Place Order</h2>
    <input type="text" name="name" placeholder="Your Name" required>
    <input type="email" name="email" placeholder="Your Email" required>
    <textarea name="order" placeholder="Order Details" rows="4" required></textarea>
    <button type="submit">Send Order</button>

    <?php if (!empty($status)): ?>
      <div class="message"><?php echo $status; ?></div>
    <?php endif; ?>
  </form>
</body>
</html>
