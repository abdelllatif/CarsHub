<?php
require_once 'classes/reviewclass.php';

if (isset($_GET['carId'])) {
    $carId = $_GET['carId'];
    $review = new Review();
    $reviews = $review->getReviewsByVehicle($carId);

    if ($reviews) {
        foreach ($reviews as $review) {
            echo "<div class='bg-gray-100 p-2 mb-2 rounded'>";
            echo "<p><strong>" . htmlspecialchars($review['firstName'] . ' ' . $review['lastName']) . "</strong> - Rating: " . str_repeat('★', $review['rating']) . "</p>";
            echo "<p>" . htmlspecialchars($review['comment']) . "</p>";
            echo "</div>";
        }
    } else {
        echo "<p>No reviews yet.</p>";
    }
} else {
    echo "<p>Error: No car ID provided.</p>";
}
?>