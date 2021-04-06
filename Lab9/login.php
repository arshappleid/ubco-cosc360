<?php
    if ($_REQUEST["username"] && $_REQUEST["password"]) {
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
                $password = md5($_POST["password"]);
                $sql = $connection->prepare("SELECT username FROM users WHERE username = ? and password = ?");
                $sql->bind_param("ss", $username, $password);
                $sql->execute();
                $result = $sql->get_result();
                while ($row = $result->fetch_assoc()) {
                    echo "Successfully logged in ".$row['username']."!";
                    mysqli_free_result($result);
                    mysqli_close($connection);
                    die;
                }
                echo "Unable to log in with this username and/or password.";
                echo "<br><br><a href='/lab9/lab9-2.html'>Return to log in page</a>";
                mysqli_free_result($result);
                mysqli_close($connection);
                die;
            }
        }
    } else {
        die("Information is not complete!");
    }
?>