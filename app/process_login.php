<?php
$host = "startrek-payroll-mysql";
$db_name = $_SERVER["MYSQL_DATABASE"];
$db_username = $_SERVER["MYSQL_USER"];
$db_password = $_SERVER["MYSQL_PASSWORD"];

$conn = new mysqli($host, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_POST) {
    // Handle login logic here (replace the following lines with your actual logic)
    $user = $_POST['user'];
    $pass = $_POST['password'];

    $sql = "SELECT username, CONCAT(first_name, ' ', last_name), salary FROM users WHERE username = '$user' AND password = '$pass'";
    error_log("QUERY:" . $sql);

    if ($conn->multi_query($sql)) {
        do {
            echo "<div class='container result-container'>";
            echo "<h2 class='text-center'>Welcome, " . $user . "</h2><br>";
            echo "<table class='table table-bordered result-table'>";
            echo "<thead class='thead-light'><tr><th>Username</th><th>Salary</th></tr></thead><tbody>";

            if ($result = $conn->store_result()) {
                while ($row = $result->fetch_assoc()) {
                    $keys = array_keys($row);
                    echo "<tr>";
                    foreach ($keys as $key) {
                        echo "<td>" . $row[$key] . "</td>";
                    }
                    echo "</tr>\n";
                }
                $result->free();
            }

            if (!$conn->more_results()) {
                echo "</tbody></table></div>";
            }

        } while ($conn->next_result());
    }
}
?>

