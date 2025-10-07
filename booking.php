<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/remixicon@4.3.0/fonts/remixicon.css" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <title>Book Your Flight | SKYWINGS</title>
    <style>
        .booking__container {
            max-width: 800px;
            margin: 6rem auto 2rem;
            padding: 3rem 2rem;
            background: var(--white);
            border-radius: 1rem;
            box-shadow: 5px 5px 30px rgba(0, 0, 0, 0.1);
        }
        .booking__form {
            display: grid;
            gap: 1.5rem;
        }
        .form__group {
            display: flex;
            flex-direction: column;
            gap: 0.5rem;
        }
        .form__group label {
            font-weight: 600;
            color: var(--text-dark);
        }
        .form__group input,
        .form__group select,
        .form__group textarea {
            padding: 0.75rem;
            font-size: 1rem;
            border: 1px solid var(--text-light);
            border-radius: 5px;
            font-family: "DM Sans", sans-serif;
        }
        .form__group textarea {
            resize: vertical;
            min-height: 100px;
        }
        .form__row {
            display: grid;
            gap: 1.5rem;
            grid-template-columns: 1fr 1fr;
        }
        @media (max-width: 768px) {
            .form__row {
                grid-template-columns: 1fr;
            }
            .booking__container {
                margin-top: 5rem;
                padding: 2rem 1rem;
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

    <div class="booking__container">
        <h2 class="section__header" style="text-align: left; margin-bottom: 2rem;">Book Your Flight</h2>
        
        <form class="booking__form" method="POST" action="process_booking.php">
            <div class="form__row">
                <div class="form__group">
                    <label for="full_name">Full Name *</label>
                    <input type="text" id="full_name" name="full_name" required>
                </div>
                <div class="form__group">
                    <label for="email">Email Address *</label>
                    <input type="email" id="email" name="email" required>
                </div>
            </div>

            <div class="form__group">
                <label for="phone">Phone Number *</label>
                <input type="tel" id="phone" name="phone" required>
            </div>

            <div class="form__row">
                <div class="form__group">
                    <label for="departure_city">Departure City *</label>
                    <input type="text" id="departure_city" name="departure_city" required>
                </div>
                <div class="form__group">
                    <label for="destination_city">Destination City *</label>
                    <input type="text" id="destination_city" name="destination_city" required>
                </div>
            </div>

            <div class="form__row">
                <div class="form__group">
                    <label for="departure_date">Departure Date *</label>
                    <input type="date" id="departure_date" name="departure_date" required>
                </div>
                <div class="form__group">
                    <label for="return_date">Return Date (Optional)</label>
                    <input type="date" id="return_date" name="return_date">
                </div>
            </div>

            <div class="form__row">
                <div class="form__group">
                    <label for="passengers">Number of Passengers *</label>
                    <input type="number" id="passengers" name="passengers" min="1" max="10" required>
                </div>
                <div class="form__group">
                    <label for="class_type">Class *</label>
                    <select id="class_type" name="class_type" required>
                        <option value="">Select Class</option>
                        <option value="economy">Economy</option>
                        <option value="business">Business</option>
                        <option value="first">First Class</option>
                    </select>
                </div>
            </div>

            <div class="form__group">
                <label for="special_requests">Special Requests (Optional)</label>
                <textarea id="special_requests" name="special_requests" placeholder="Any special requirements or requests..."></textarea>
            </div>

            <button type="submit" class="btn" style="width: 100%; padding: 1rem; margin-top: 1rem;">
                Complete Booking <i class="ri-arrow-right-line"></i>
            </button>
        </form>
    </div>

    <footer style="margin-top: 3rem;">
        <div class="footer__bar">
            Copyright © 2024 Web Design Mastery. All rights reserved.
        </div>
    </footer>
</body>
</html>