<!DOCTYPE html>
<html>
<head>
<title>Login</title>
</head>

<body>

<h2>Login Page</h2>

<form method="POST">
    Username: <input type="text" name="username" required><br><br>
    Password: <input type="password" name="password" required><br><br>
    <button type="submit">Login</button>
</form>

<?php

$conn = new mysqli("localhost","root","","SocialMediaDB");

$message = "";

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

if($_SERVER["REQUEST_METHOD"]=="POST"){

    $username = $_POST["username"];
    $password = $_POST["password"];

    $stmt = $conn->prepare("SELECT password_hash FROM Users WHERE username = ?");
    $stmt->bind_param("s",$username);
    $stmt->execute();
    $result = $stmt->get_result();

    if($result->num_rows > 0){

        $row = $result->fetch_assoc();

        if(password_verify($password,$row["password_hash"])){
            $message = "Login Successful";
        }
        else{
            $message = "Login Unsuccessful";
        }

    }
    else{
        $message = "Login Unsuccessful";
    }

}

?>

<p style="color:red;">
<?php echo $message; ?>
</p>

</body>
</html>