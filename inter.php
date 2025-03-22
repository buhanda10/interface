<?php
$host = "localhost";
$user = "root";
$password = "root";
$dbname = "furry";

$conn = new mysqli($host, $user, $password, $dbname);

if ($conn->connect_error) {
    die("Echec de la connexion : " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = trim($_POST['password']);

    if (!empty($email) && !empty($password)) {
        $sql = "INSERT INTO users (email, password) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("ss", $email, $password);

        if ($stmt->execute()) {
            header("Location : https://www.apple.com/");
            exit();
        } else {
            echo "Erreur lors de l' enregistrement.";
        }
        $stmt->close();
    } else {
        echo "<p style='color:red;'>Tous les champs doivent etre remplis.</p>";
    }
}
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="style.css">
    <title>Inscription</title>
</head>
<body>
    <div class="container">
        <div class="form">
            <img src="logo.png" alt="furry" class="logo">
            <h2>Sign Up for Furry</h2>
            <form action="#" method="POST">
                <label for="email">Email address</label>
                <input type="email" name="email" placeholder="Enter your email" required>

                <label for="password">Password</label>
                <input type="password" name="password" placeholder="Enter your password" required>

                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="" placeholder="Confirm your password" required>

                <div class="terms">
                    <input type="checkbox" id="terms" required>
                    <label for="terms">I've read and agree to the <a href="#">terms of service</a>.</label>
                </div>
                <div class="captcha">
                        <input type="checkbox" id="captcha" required>
                        <label for="captcha">Verifiez que vous etes un humain</label>
                </div>
                
                <button type="submit" class="sign-btn">Sign Up</button>

            </form>
        </div>
    </div>
</body>
</html>