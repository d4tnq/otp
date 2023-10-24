<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>OTP Sender</title>
    <!-- Link to Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>

    <div class="container mt-5">
        <h1>OTP Sender</h1>
        <!-- Nav tabs -->
        <ul class="nav nav-tabs" id="otpTabs" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link active" id="sms-tab" data-bs-toggle="tab" href="#sms" role="tab" aria-controls="sms" aria-selected="true">Send OTP via SMS</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="email-tab" data-bs-toggle="tab" href="#email" role="tab" aria-controls="email" aria-selected="false">Send OTP via Email</a>
            </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content mt-2">
            <!-- Tab: Send OTP via SMS -->
            <div class="tab-pane fade show active" id="sms" role="tabpanel" aria-labelledby="sms-tab">
                <div class="mb-3">
                    <form action="send-otp-sms.php" method="POST">
                        <label for="phone_number" class="form-label">Phone Number</label>
                        <input type="tel" name="phone_number" class="form-control" id="phone_number" placeholder="Enter your phone number">
                        <br>
                        <input type="submit" class="btn btn-primary" value="Send OTP via SMS">
                    </form>
                </div>
            </div>
            <!-- Tab: Send OTP via Email -->
            <div class="tab-pane fade" id="email" role="tabpanel" aria-labelledby="email-tab">
                <div class="mb-3">
                    <form action="send-otp-email.php" method="POST">
                        <label for="emailAddress" class="form-label">Email Address</label>
                        <input type="email" name="email" class="form-control" id="emailAddress" placeholder="Enter your email address">
                        <br>
                        <input type="submit" class="btn btn-primary" value="Send OTP via Email">
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Link to Bootstrap JS and Popper.js (required for Bootstrap components) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>

</html>
