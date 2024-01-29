<?php
$host = "startrek-payroll-mysql";
$db_name = $_SERVER["MYSQL_DATABASE"];
$db_username = $_SERVER["MYSQL_USER"];
$db_password = $_SERVER["MYSQL_PASSWORD"];

$conn = new mysqli($host, $db_username, $db_password, $db_name);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if (!isset($_POST['s'])) {
    ?>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Cek Payroll</title>
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
        <style>
            body {
                background-color: #f8f9fa;
                padding-top: 50px;
            }

            form {
                max-width: 400px;
                margin: 0 auto;
                padding: 15px;
                background-color: #ffffff;
                border: 1px solid #dee2e6;
                border-radius: 5px;
                margin-top: 50px;
            }

            h2 {
                text-align: center;
                margin-bottom: 20px;
            }

            .container {
                margin-top: 50px;
            }

            .result-container {
                max-width: 600px;
                margin: 0 auto;
                margin-top: 50px;
            }

            .result-table {
                margin-top: 20px;
            }
        </style>
    </head>

    <body>
        <div class="container">
            <form id="loginForm">
                <h2>Cek Payroll</h2>
                <div class="form-group">
                    <label for="user">User:</label>
                    <input type="text" class="form-control" name="user" required>
                </div>
                <div class="form-group">
                    <label for="password">Password:</label>
                    <input type="password" class="form-control" name="password" required>
                </div>
                <button type="button" class="btn btn-primary" id="loginBtn">OK</button>
            </form>
        </div>

        <div id="resultContainer" class="container result-container"></div>

        <script>
            $(document).ready(function () {
                $("#loginBtn").click(function () {
                    $.ajax({
                        type: "POST",
                        url: "process_login.php", // Update this with the correct file path or endpoint
                        data: $("#loginForm").serialize(),
                        success: function (response) {
                            $("#resultContainer").html(response);
                        }
                    });
                });
            });
        </script>
    </body>

    </html>

    <?php
} else {
    // If you want to handle the login logic in the same file, you can place it here.
}
?>

