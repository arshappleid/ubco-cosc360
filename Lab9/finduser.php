<?php
    if ($_REQUEST["username"]) {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            $host = "localhost";
            $database = "lab9";
            $user = "webuser";
            $password = "P@ssw0rd";

            $connection = mysqli_connect($host, $user, $password, $database);
            $error = mysqli_connect_error();
            if($error != null) {
                $output = "<p>Unable to connect to database!</p>";
                exit($output);
            }
            else {
                $username = $_GET["username"];
                $sql = $connection->prepare("SELECT username, firstname, lastname, email FROM users WHERE username = ?");
                $sql->bind_param("s", $username);
                $sql->execute();
                $result = $sql->get_result();
                while ($row = $result->fetch_assoc()) {
                    echo "
                    <fieldset style='width: 20rem;'>
                        <legend>User: ".$row['username']."</legend>
                        <table>
                            <tr><td>First Name:</td><td>".$row['firstname']."</td></tr>
                            <tr><td>Last Name: </td><td>".$row['lastname']."</td></tr>
                            <tr><td>Email:</td><td>".$row['email']."</td></tr>
                        </table>
                    </fieldset>";
                    mysqli_free_result($result);
                    mysqli_close($connection);
                    die;
                }
                echo "Unable to retrieve user information, please try again.";
                echo "<br><br><a href='/lab9/lab9-4.html'>Return to user search</a>";
                mysqli_free_result($result);
                mysqli_close($connection);
                die;
            }
        } else if ($_SERVER['REQUEST_METHOD'] == "POST") {
            die("Unable to insert data!");
        }
    } else {
        die("Information is not complete!");
    }
?>