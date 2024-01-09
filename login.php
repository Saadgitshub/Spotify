<?php
include_once 'classes/Client.php';
include_once 'classes/connection.php';




    $connection = new Connection();
    $connection->selectDatabase('MUSIC_PHP_PROJ');
    $url = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $email = $_POST["email"];
        $password = $_POST["password"];
        $name = "irre"; // Fix the typo here
        $clientBool = new Client($name, $email, $password);

        if ($clientBool->verifyClientCreds($connection->conn)) {
            
            $name = $clientBool->getClientName($connection->conn);
            session_start();    
            $_SESSION['username'] = $name;
            echo "OUIIIII";
            echo "<!DOCTYPE html>";
            echo "<html lang='en'>";
            echo "<head>";
            echo "<meta charset='UTF-8'>";
            echo "<meta http-equiv='refresh' content=1;url='mainpage/mainpage.php'>";
            echo "<title>Redirection automatique</title>";
            echo "</head>";
            echo "<body>";
            echo "</body>";
            echo "</html>";
            
            
        } else {
            
            echo "<!DOCTYPE html>";
            echo "<html lang='en'>";
            echo "<head>";
            echo "<meta charset='UTF-8'>";
            echo "<title>Redirection automatique</title>";
            echo "</head>";
            echo "<body>";
            echo "<p style='color: black'>INFORMATION ERRONEE,VEUILLEZ REESSAYER</p>";
            echo "</body>";
            echo "</html>";
            
            
        }
    }



?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Sign Up Form by Colorlib</title>

    <!-- Font Icon -->
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">

    <!-- Main css -->
    <link rel="stylesheet" href="css/style.css">
</head>

<body>

    <div class="main">

        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <form method="POST" action="login.php" id="signup-form" class="signup-form">
                        <h2 class="form-title">Log into your account</h2>
                        <div class="form-group">
                            <input type="email" class="form-input" name="email" id="email" placeholder="Your Email"/>
                        </div>
                        <div class="form-group">
                            <input type="password" class="form-input" name="password" id="password" placeholder="Password"/>
                        </div>
                        <div class="form-group">
                            <input type="submit" name="submit" id="submit" class="form-submit" value="Sign in"/>
                        </div>
                    </form>
                </div>
            </div>
        </section>

    </div>

    <!-- JS -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>