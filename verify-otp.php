<?php
session_start();

$maxAttempts = 3;

$timeFrame = 60;

$ipAddress = $_SERVER['REMOTE_ADDR'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_SESSION['verification_attempts'][$ipAddress])) {
        $_SESSION['verification_attempts'][$ipAddress] = 1;
        $_SESSION['verification_start_time'][$ipAddress] = time();
    } else {
        if (time() - $_SESSION['verification_start_time'][$ipAddress] < $timeFrame) {
            $_SESSION['verification_attempts'][$ipAddress]++;
        } else {
            $_SESSION['verification_attempts'][$ipAddress] = 1;
            $_SESSION['verification_start_time'][$ipAddress] = time();
        }
    }

    if(!isset($_SESSION['otp'])){
        echo '<script language="javascript">';
        echo 'alert("Please send otp first!")';
        echo '</script>';
    } else {
        if ($_SESSION['verification_attempts'][$ipAddress] > $maxAttempts) {
            echo '<script language="javascript">';
            echo 'alert("Too many attempts. Please wait before trying again!")';
            echo '</script>';
        } else {

            $enteredOtp = $_POST['otp'];

            // Lấy otp và sđt từ phiên
            $storedOtp = $_SESSION['otp'];

            if ($enteredOtp == $storedOtp) {
                echo '<script language="javascript">';
                echo 'alert("OTP verified successfully!");';
                echo '</script>';
                unset($_SESSION['otp']);
            } else {
                echo '<script language="javascript">';
                echo 'alert("Invalid OTP. Please try again!")';
                echo '</script>';
            }
        }
    }

    
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify</title>
    <!-- Link to Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

</head>

<body>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <form method="post" action="">
                    <div class="mb-3">
                        <label for="otp" class="form-label">Enter OTP:</label>
                        <input type="text" class="form-control" id="otp" name="otp" required>
                    </div>
                    <button type="submit" class="btn btn-primary" name="submit">Verify OTP</button>
                </form>
            </div>
        </div>
    </div>

    <!-- Link to Bootstrap JS and Popper.js (required for Bootstrap components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
</body>

</html>
