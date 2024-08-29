<?php
// Database connection settings
$servername = "localhost";
$username = "root"; // Default XAMPP username
$password = ""; // Default XAMPP password
$dbname = "invest"; // Your database name

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve and sanitize form input
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $confirm_password = mysqli_real_escape_string($conn, $_POST['confirm_password']);

    // Simple validation
    if ($password !== $confirm_password) {
        echo "Passwords do not match!";
    } else {
        // Hash the password
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Insert data into the database
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            echo "New record created successfully";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    }
}

// Close the connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign-Up</title>
    <link rel="icon" type="image/x-icon" href="img/favicon.ico">
    <style>
        :root {
            /* COLORS */
            --white: #e9e9e9;
            --gray: #333;
            --blue: #0367a6;
            --lightblue: #008997;

            /* RADII */
            --button-radius: 0.7rem;

            /* SIZES */
            --max-width: 758px;
            --max-height: 420px;

            font-size: 16px;
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, Oxygen, Ubuntu, Cantarell, "Open Sans", "Helvetica Neue", sans-serif;
        }

        body {
            align-items: center;
            background-color: var(--white);
            background: url("img/in.jpg");
            background-attachment: fixed;
            background-position: center;
            background-repeat: no-repeat;
            background-size: cover;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
        }

        .container__form {
            background-color: rgba(255, 255, 255, 0.9);
            border-radius: var(--button-radius);
            box-shadow: 0 0.9rem 1.7rem rgba(0, 0, 0, 0.25), 0 0.7rem 0.7rem rgba(0, 0, 0, 0.22);
            width: 90%;
            max-width: 500px;
            padding: 20px;
            margin: 20px;
        }

        .form__title {
            font-weight: bolder;
            margin: 0;
            color: var(--gray);
            margin-bottom: 1.25rem;
        }

        .btn {
            background-color: var(--blue);
            background-image: linear-gradient(90deg, var(--blue) 0%, var(--lightblue) 74%);
            border-radius: 20px;
            border: 1px solid var(--blue);
            color: var(--white);
            cursor: pointer;
            font-size: 0.8rem;
            font-weight: bold;
            letter-spacing: 0.1rem;
            padding: 0.9rem 4rem;
            text-transform: uppercase;
            transition: transform 80ms ease-in;
            width: 100%;
            box-sizing: border-box;
        }

        .btn:active {
            transform: scale(0.95);
        }

        .btn:focus {
            outline: none;
        }

        .form {
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            width: 100%;
        }

        .input {
            background-color: #fff;
            border: none;
            padding: 0.9rem;
            margin: 0.5rem 0;
            width: 100%;
            box-sizing: border-box;
            font-weight: bolder;
            outline: none;
            border-radius: var(--button-radius);
        }

        a {
            text-decoration: none;
            color: red;
        }

        @media (min-width: 768px) {
            .container__form {
                width: 400px;
                padding: 30px;
            }
        }
    </style>
</head>
<body>
    <!-- Sign up form -->
    <div class="container__form container--signin">
        <form action="" method="post" class="form" id="form2">
            <h2 class="form__title">SIGN UP</h2>
            <input type="text" placeholder="Username" id="username" name="username" class="input" required />
            <input type="email" placeholder="Email" id="email" name="email" class="input" required />
            <input type="password" placeholder="Password" id="password" name="password" class="input" required />
            <input type="password" placeholder="Confirm Password" id="confirm_password" name="confirm_password" class="input" required />
            <button type="submit" class="btn">Sign Up</button>
            <h3>I already have an account? <a href="signin.html">Sign-In</a></h3>
        </form>
    </div>
</body>
</html>
