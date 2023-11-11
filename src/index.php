<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require __DIR__ . '/../vendor/autoload.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $to_email = $_POST["to_email"];
    $smtp_host = $_POST["smtp_host"];
    $smtp_username = $_POST["smtp_username"];
    $smtp_password = $_POST["smtp_password"];
    $subject = "Test Subject";
    $message = "This is a test email.";

    // Validate the SMTP credentials and other form data
    // Add your validation logic here

    // Send email using PHPMailer
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->isSMTP();
        $mail->Host       = $smtp_host;  // SMTP server
        $mail->SMTPAuth   = true;
        $mail->Username   = $smtp_username;  // SMTP username
        $mail->Password   = $smtp_password;  // SMTP password
        $mail->SMTPSecure = 'ssl';  // Enable TLS encryption; `ssl` also accepted
        $mail->Port       = 465;  // TCP port to connect to

        //Recipients
        $mail->setFrom($smtp_username, 'Email Tester');
        $mail->addAddress($to_email);

        //Content
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;

        $mail->send();
        echo json_encode(["status" => "success", "message" => "Email sent successfully"]);
    } catch (Exception $e) {
        // Send error response
        echo json_encode(["status" => "error", "message" => $mail->ErrorInfo]);
    }
    exit; // Stop further execution
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Form</title>
    <style>
        body {
            background-color: #1e1e1e;
            color: #fff;
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        header {
            background-color: #333;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }

        h1 {
            margin: 0;
            font-size: 24px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #333;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        input {
            width: 100%;
            padding: 10px;
            margin-bottom: 16px;
            box-sizing: border-box;
            background-color: #444;
            border: 1px solid #555;
            border-radius: 4px;
            color: #fff;
            outline: none;
        }

        input[type="submit"] {
            background-color: #4caf50;
            color: #fff;
            cursor: pointer;
        }

        input[type="submit"]:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h1>Email Sender</h1>
    </header>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="to_email">To Email:</label>
        <input type="email" name="to_email" required>
        <br>
        <label for="smtp_host">SMTP Host:</label>
        <input type="text" name="smtp_host" required>
        <br>
        <label for="smtp_username">SMTP Username:</label>
        <input type="text" name="smtp_username" required>
        <br>
        <label for="smtp_password">SMTP Password:</label>
        <input type="password" name="smtp_password" required>
        <br>
        <input type="submit" value="Send Email">
    </form>
    <!-- Add this line to include SweetAlert from CDN -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        const form = document.querySelector('form');
        
        form.addEventListener('submit', async function (e) {
            e.preventDefault();

            const formData = new FormData(this);

            try {
                const response = await fetch(this.action, {
                    method: this.method,
                    body: formData
                });

                const result = await response.json();

                if (result.status === 'success') {
                    Swal.fire({
                        icon: 'success',
                        title: 'Success',
                        text: result.message,
                    });
                } else {
                    Swal.fire({
                        icon: 'error',
                        title: 'Email sending failed',
                        text: result.message,
                    });
                }
            } catch (error) {
                console.error('Error:', error);
            }
        });
    </script>
</body>
</html>
