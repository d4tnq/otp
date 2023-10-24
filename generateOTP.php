<?php 
function generateKey () {
    $characters = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    
    for ($i = 0; $i < 20; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    
    return $randomString;
}
function generateOTP() {
    $secretKey = generateKey(); // tạo khóa bí mật
    $TIME_STEP = 60; // tạo bước thời gian
    $DIGITS = 6; // Khai báo số chữ số của OTP

    $keyBytes = base64_decode($secretKey);
    $timestamp = time() / $TIME_STEP; // Lấy thời gian hiện tại và chia cho TIME_STEP

    $msg = pack("J", $timestamp);
    $hash = hash_hmac("sha1", $msg, $keyBytes, true); // Tạo thông điệp mã hóa p

    // Lấy giá trị của bit cuối cùng để tạo giá trị cho offset
    $offset = ord(substr($hash, -1)) & 0x0F;

    // Lấy giá trị của 4 byte đầu tiên tính từ byte thứ offset (A,B,C,D), trong 4 byte này  
    // Thực hiện thao tác bit AND (&) với 7F cho byte đầu tiên
    // Các byte còn lại ta thực hiện thao tác bit AND với FF
    // Sau khi thực hiện xong ta nối các byte lại với nhau
    $binary = (ord(substr($hash, $offset, 1)) & 0x7F) << 24 |
              ord(substr($hash, $offset + 1, 1)) << 16 |
              ord(substr($hash, $offset + 2, 1)) << 8 |
              ord(substr($hash, $offset + 3, 1));

    // Rút gọn và biến đổi để có được OTP
    $otp = $binary % pow(10, $DIGITS);
    return sprintf("%0" . $DIGITS . "d", $otp);
}
?>