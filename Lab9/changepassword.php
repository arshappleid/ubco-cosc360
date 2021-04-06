<?php
    if ($_REQUEST["username"] && $_REQUEST["oldpassword"] && $_REQUEST["newpassword"]) {
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
                $oldPassword = md5($_POST["oldpassword"]);
                $newPassword = md5($_POST["newpassword"]);
                $sql = $connection->prepare("SELECT username FROM users WHERE username = ? and password = ?");
                $sql->bind_param("ss", $username, $oldPassword);
                $sql->execute();
                $result = $sql->get_result();
                while ($row = $result->fetch_assoc()) {
                    $sql = $connection->prepare("UPDATE users SET password = ? WHERE username = ? and password = ?");
                    $sql->bind_param("sss", $newPassword, $username, $oldPassword);
                    if($sql->execute()) {
                        echo "Successfully changed password!";
                        mysqli_free_result($result);
                        mysqli_close($connection);
                        die;
                    }
                }
                echo "Unable to change password, please try again.";
                echo "<br><br><a href='/lab9/lab9-3.html'>Return to change password</a>";
                mysqli_free_result($result);
                mysqli_close($connection);
                die;
            }
        }
    } else {
        die("Information is not complete!");
    }
?>