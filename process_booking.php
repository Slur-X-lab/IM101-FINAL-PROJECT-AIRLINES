<?php
require_once 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Generate unique booking reference
    $booking_reference = 'SKY' . strtoupper(substr(uniqid(), -8));
    
    // Sanitize and get form data
    $full_name = trim($_POST['full_name']);
    $email = trim($_POST['email']);
    $phone = trim($_POST['phone']);
    $departure_city = trim($_POST['departure_city']);
    $destination_city = trim($_POST['destination_city']);
    $departure_date = $_POST['departure_date'];
    $return_date = !empty($_POST['return_date']) ? $_POST['return_date'] : NULL;
    $passengers = intval($_POST['passengers']);
    $class_type = $_POST['class_type'];
    $special_requests = isset($_POST['special_requests']) ? trim($_POST['special_requests']) : '';
    
    try {
        $sql = "INSERT INTO bookings (full_name, email, phone, departure_city, destination_city, 
                departure_date, return_date, passengers, class_type, special_requests, booking_reference) 
                VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
        
        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            $full_name,
            $email,
            $phone,
            $departure_city,
            $destination_city,
            $departure_date,
            $return_date,
            $passengers,
            $class_type,
            $special_requests,
            $booking_reference
        ]);
        
        // Redirect to confirmation page
        header("Location: booking_confirmed.php?ref=" . urlencode($booking_reference));
        exit();
        
    } catch(PDOException $e) {
        die("Booking Error: " . $e->getMessage() . "<br><br><a href='booking.php'>Go Back</a>");
    }
} else {
    header("Location: booking.php");
    exit();
}
?>