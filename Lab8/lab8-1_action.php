<?php
    $data = fopen("data.txt", "r+") or die("Sorry, server is under maintenance.");
    $dataArray = Array();
    while (!feof($data)) {
        $dataArray[] = explode(",", fgets($data));
    }

    if ($_REQUEST["firstname"] && $_REQUEST["key"]) {
        if ($_SERVER['REQUEST_METHOD'] == "GET") {
            foreach ($dataArray as $dataValues) {
                if ($dataValues[0] == $_GET["key"] && $dataValues[1] == $_GET["firstname"]) {
                    echo "<h1>".$dataValues[1]."'s Coffee Choice</h1>";
                    echo "<figure><img src=\"".$dataValues[3]."\" alt=\"image\"><figcaption>".$dataValues[2]."</figcaption></figure>";
                }
            }
        } else if ($_SERVER['REQUEST_METHOD'] == "POST") {
            echo "Submitting your information...";
        }
    } else {
        die("Information is not complete");
    }

    fclose($data)
?>