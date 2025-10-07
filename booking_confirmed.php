<?php
// booking_confirmed.php
require_once 'config.php';

$booking_reference = isset($_GET['ref']) ? $_GET['ref'] : '';

if (empty($booking_reference)) {
    header("Location: index.html");
    exit();
}

try {
    $stmt = $pdo->prepare("SELECT * FROM bookings WHERE booking_reference = :ref");
    $stmt->execute([':ref' => $booking_reference]);
    $booking = $stmt->fetch(PDO::FETCH_ASSOC);
    
    if (!$booking) {
        header("Location: index.html");
        exit();
    }
} catch(PDOException $e) {
    die("Error: " . $e->getMessage());
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <title>Booking Confirmed | SKYWINGS</title>
    <style>
        .confirmation__container {
            max-width: 800px;
            margin: 6rem auto 2rem;
            padding: 3rem 2rem;
            text-align: center;
        }
        .success__icon {
            font-size: 5rem;
            color: #10b981;
            margin-bottom: 1rem;
        }
        .booking__details {
            background: var(--white);
            padding: 2rem;
            border-radius: 1rem;
            box-shadow: 5px 5px 30px rgba(0, 0, 0, 0.1);
            margin-top: 2rem;
            text-align: left;
        }
        .detail__row {
            display: grid;
            grid-template-columns: 200px 1fr;
            padding: 1rem 0;
            border-bottom: 1px solid var(--extra-light);
        }
        .detail__row:last-child {
            border-bottom: none;
        }
        .detail__label {
            font-weight: 600;
            color: var(--text-dark);
        }
        .detail__value {
            color: var(--text-light);
        }
        .booking__reference {
            display: inline-block;
            padding: 1rem 2rem;
            background: var(--primary-color);
            color: var(--white);
            border-radius: 5px;
            font-size: 1.5rem;
            font-weight: 700;
            margin: 2rem 0;
        }
        @media (max-width: 768px) {
            .confirmation__container {
                margin-top: 5rem;
                padding: 2rem 1rem;
            }
            .detail__row {
                grid-template-columns: 1fr;
                gap: 0.5rem;
            }
        }
    </style>
</head>
<body>
    <nav>
        <div class="nav__header">
            <div class="nav__logo">
                <a href="index.html" class="logo">Skywings</a>
            </div>
        </div>
        <ul class="nav__links">
            <li><a href="index.html#home">HOME</a></li>
            <li><a href="index.html#about">ABOUT</a></li>
            <li><a href="index.html#tour">TOUR</a></li>
            <li><a href="index.html#package">PACKAGE</a></li>
            <li><a href="index.html#contact">CONTACT</a></li>
        </ul>
        <div class="nav__btns">
            <a href="index.html"><button class="btn">BACK TO HOME</button></a>
        </div>
    </nav>

    <div class="confirmation__container">
        <div class="success__icon">
            <i class="ri-checkbox-circle-fill"></i>
        </div>
        <h1 class="section__header">Booking Confirmed!</h1>
        <p class="section__description" style="max-width: 100%;">
            Thank you for choosing Skywings. Your flight has been successfully booked.
        </p>
        
        <div class="booking__reference">
            <?php echo htmlspecialchars($booking['booking_reference']); ?>
        </div>
        
        <p style="color: var(--text-light); margin-bottom: 2rem;">
            Please save this reference number for your records. A confirmation email has been sent to <?php echo htmlspecialchars($booking['email']); ?>
        </p>

        <div class="booking__details">
            <h3 style="margin-bottom: 1.5rem; color: var(--text-dark);">Booking Details</h3>
            
            <div class="detail__row">
                <span class="detail__label">Passenger Name:</span>
                <span class="detail__value"><?php echo htmlspecialchars($booking['full_name']); ?></span>
            </div>
            
            <div class="detail__row">
                <span class="detail__label">Email:</span>
                <span class="detail__value"><?php echo htmlspecialchars($booking['email']); ?></span>
            </div>
            
            <div class="detail__row">
                <span class="detail__label">Phone:</span>
                <span class="detail__value"><?php echo htmlspecialchars($booking['phone']); ?></span>
            </div>
            
            <div class="detail__row">
                <span class="detail__label">Route:</span>
                <span class="detail__value">
                    <?php echo htmlspecialchars($booking['departure_city']) . ' → ' . htmlspecialchars($booking['destination_city']); ?>
                </span>
            </div>
            
            <div class="detail__row">
                <span class="detail__label">Departure Date:</span>
                <span class="detail__value"><?php echo date('F j, Y', strtotime($booking['departure_date'])); ?></span>
            </div>
            
            <?php if ($booking['return_date']): ?>
            <div class="detail__row">
                <span class="detail__label">Return Date:</span>
                <span class="detail__value"><?php echo date('F j, Y', strtotime($booking['return_date'])); ?></span>
            </div>
            <?php endif; ?>
            
            <div class="detail__row">
                <span class="detail__label">Passengers:</span>
                <span class="detail__value"><?php echo htmlspecialchars($booking['passengers']); ?></span>
            </div>
            
            <div class="detail__row">
                <span class="detail__label">Class:</span>
                <span class="detail__value"><?php echo ucfirst(htmlspecialchars($booking['class_type'])); ?></span>
            </div>
            
            <?php if ($booking['special_requests']): ?>
            <div class="detail__row">
                <span class="detail__label">Special Requests:</span>
                <span class="detail__value"><?php echo nl2br(htmlspecialchars($booking['special_requests'])); ?></span>
            </div>
            <?php endif; ?>
            
            <div class="detail__row">
                <span class="detail__label">Booking Date:</span>
                <span class="detail__value"><?php echo date('F j, Y g:i A', strtotime($booking['booking_date'])); ?></span>
            </div>
        </div>

        <div style="margin-top: 2rem;">
            <a href="index.html"><button class="btn" onclick="window.location.href='index.php'" style="padding: 1rem 2rem;">Return to Home</button></a>
        </div>
    </div>

    <footer style="margin-top: 3rem;">
        <div class="footer__bar">
            Copyright © 2024 Web Design Mastery. All rights reserved.
        </div>
    </footer>
</body>
</html>