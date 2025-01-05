<?php 
session_start();
require_once '../classes/reservationclass.php';
require_once '../classes/reviewclass.php';

if (!isset($_SESSION['user_email'])) {
    header("Location: ../connexion/singin.php");
    exit();
}

$reservation = new Reservation();
$review = new Review();
$userId = $_SESSION['user_id'];

// ... (keep the existing code for handling reservation status updates)

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- ... (keep existing head content) -->
</head>
<body>
    <!-- ... (keep existing body content up to the reservation loop) -->
    
    <?php 
    if (!$reservations) {
        echo "<tr><td colspan='9' class='p-3 text-center'>No reservations found.</td></tr>";
    } else {
        foreach ($reservations as $reservation) {
            echo "<tr>";
            // ... (keep existing reservation details)
            echo "<td class='p-3'>";
            if ($reservation['status'] == 'confirmed') {
                echo "<button class='add-review-btn bg-green-500 text-white px-2 py-1 rounded' data-reservation-id='" . $reservation['id'] . "'>Add Review</button>";
            }
            echo "</td>";
            echo "</tr>";
            echo "<tr><td colspan='9'>";
            // Add the review form here (use the HTML provided earlier)
            echo "</td></tr>";
            
            // Display existing reviews
            $reviews = $review->getReviewsByVehicle($reservation['vehicleId']);
            if ($reviews) {
                echo "<tr><td colspan='9'><h3 class='font-bold mt-4'>Reviews:</h3>";
                foreach ($reviews as $rev) {
                    echo "<div class='bg-gray-100 p-2 mb-2 rounded'>";
                    echo "<p><strong>" . htmlspecialchars($rev['firstName'] . ' ' . $rev['lastName']) . "</strong> - Rating: " . str_repeat('★', $rev['rating']) . "</p>";
                    echo "<p>" . htmlspecialchars($rev['comment']) . "</p>";
                    echo "</div>";
                }
                echo "</td></tr>";
            }
        }
    }
    ?>
    
    <!-- ... (keep existing closing tags) -->
    
    <script>
    // ... (add the JavaScript code provided earlier)
    </script>
</body>
</html>