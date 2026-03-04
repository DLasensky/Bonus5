<!DOCTYPE html>
<html>
    <head>
        <title>Login</title>
    </head>
    <body>

    <h2>Login Page</h2>

    <form method ="POST">
        Username: <input type ="text" name ="username" required><br><br>
        Password: <input type ="password" name ="password" required><br><br>
        <button type="submit">Login</button>
    </form>

    <?php
        $conn = new mysqli("localhost","root","","SocialMediaDB");

        $message ="";

        if($_SERVER["REQUEST_METHOD"]=="POST"){

            $username =$_POST["username"];
            $password =$_POST["password"];

            $sql = "SELECT * FROM Users where 
            username='$username' and password ='$password'";

            $result = $conn->query($sql);

            if($result->num_rows>0){
                $message ="Login Successful";
            }
            else
                $message ="Login Unsuccessful";
        }

        echo "<p style='color:red;'>$message</p>";

        // function to show results in a table
        function showTable($result){
            if($result->num_rows > 0){
                echo "<table border='1'>";
                
                $fields = $result->fetch_fields();
                echo "<tr>";
                foreach($fields as $field){
                    echo "<th>".$field->name."</th>";
                }
                echo "</tr>";

                while($row = $result->fetch_assoc()){
                    echo "<tr>";
                    foreach($row as $value){
                        echo "<td>".$value."</td>";
                    }
                    echo "</tr>";
                }

                echo "</table>";
            }
            else{
                echo "No results<br>";
            }
        }

        echo "<h3>NATURAL JOIN</h3>";
        $q1 = "SELECT * FROM Users NATURAL JOIN UserDetails";
        $r1 = $conn->query($q1);
        showTable($r1);

        echo "<h3>INNER JOIN</h3>";
        $q2 = "SELECT * FROM Users INNER JOIN UserDetails ON Users.username = UserDetails.username";
        $r2 = $conn->query($q2);
        showTable($r2);

        echo "<h3>LEFT OUTER JOIN</h3>";
        $q3 = "SELECT * FROM Users LEFT OUTER JOIN UserDetails ON Users.username = UserDetails.username";
        $r3 = $conn->query($q3);
        showTable($r3);

        echo "<h3>RIGHT OUTER JOIN</h3>";
        $q4 = "SELECT * FROM Users RIGHT OUTER JOIN UserDetails ON Users.username = UserDetails.username";
        $r4 = $conn->query($q4);
        showTable($r4);

        echo "<h3>FULL OUTER JOIN (using UNION)</h3>";
        $q5 = "
        SELECT * FROM Users
        LEFT JOIN UserDetails ON Users.username = UserDetails.username
        UNION
        SELECT * FROM Users
        RIGHT JOIN UserDetails ON Users.username = UserDetails.username
        ";
        $r5 = $conn->query($q5);
        showTable($r5);

    ?>

</body>
</html>