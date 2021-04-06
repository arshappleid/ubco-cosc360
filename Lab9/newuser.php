<?php
    if ($_REQUEST["firstname"] && $_REQUEST["lastname"] && $_REQUEST["username"] && $_REQUEST["email"] && $_REQUEST["password"]) {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            die("Unable to get data!");
        } else if ($_SERVER['REQUEST_METHOD'] == "POST") {
            $host = "localhost";
            $database = "lab9";
            $user = "webuser";
            $password = "P@ssw0rd";

            $connection = mysqli_connect($host, $user, $password, $database);
            $error = mysqli_connect_error();
            if($error != null)
            {
                $output = "<p>Unable to connect to database!</p>";
                exit($output);
            }
            else
            {
                $username = $_POST["username"];
                $firstname = $_POST["firstname"];
                $lastname = $_POST["lastname"];
                $email = $_POST["email"];
                $password = md5($_POST["password"]);
                $sql = $connection->prepare("INSERT INTO users VALUES (?, ?, ?, ?, ?)");
                $sql->bind_param("sssss", $username, $firstname, $lastname, $email, $password);
                if($sql->execute()) {
                    echo "Successfully created user!";
                } else {
                    echo "This user already exists with this username/email.";
                    echo "<br><br><a href='/lab9/lab9-1.html'>Return to user entry</a>";
                }
                mysqli_close($connection);
                die;
            }
        }
    } else {
        die("Information is not complete!");
    }
?>