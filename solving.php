<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Review System</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.0.0/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

    <!-- Button to open the "All Avis" popup -->
    <button id="openAllAvisPopup" class="bg-blue-500 text-white px-4 py-2 rounded">All Avis</button>

    <!-- Button to open the "Add Votre Avis" popup -->
    <button id="openAddAvisPopup" class="bg-green-500 text-white px-4 py-2 rounded">Add Votre Avis</button>

    <!-- All Avis Popup (Initially Hidden) -->
    <div id="allAvisPopup" class="popup fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="popup-content bg-white p-6 rounded-lg max-w-lg w-full shadow-lg">
            <h2 class="text-xl font-bold mb-4">All Avis</h2>
            <div id="reviewsList" class="mb-4">
                <!-- Reviews will be dynamically inserted here -->
            </div>
            <button id="closeAllAvisPopup" class="bg-red-500 text-white px-4 py-2 rounded mt-4">Close</button>
        </div>
    </div>

    <!-- Add Votre Avis Popup (Initially Hidden) -->
    <div id="addAvisPopup" class="popup fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
        <div class="popup-content bg-white p-6 rounded-lg max-w-lg w-full shadow-lg">
            <h2 class="text-xl font-bold mb-4">Add Votre Avis</h2>
            <div class="stars flex mb-4">
                <!-- 5 stars for rating -->
                <span class="star text-gray-400 text-3xl cursor-pointer" data-value="1">&#9733;</span>
                <span class="star text-gray-400 text-3xl cursor-pointer" data-value="2">&#9733;</span>
                <span class="star text-gray-400 text-3xl cursor-pointer" data-value="3">&#9733;</span>
                <span class="star text-gray-400 text-3xl cursor-pointer" data-value="4">&#9733;</span>
                <span class="star text-gray-400 text-3xl cursor-pointer" data-value="5">&#9733;</span>
            </div>
            <textarea id="reviewText" placeholder="Your review..." class="w-full p-2 border rounded mb-4"></textarea>
            <button id="submitReview" class="bg-blue-500 text-white px-4 py-2 rounded">Submit</button>
            <button id="closeAddAvisPopup" class="bg-red-500 text-white px-4 py-2 rounded mt-4">Close</button>
        </div>
    </div>

    <!-- Include the JavaScript files -->
    <script >document.addEventListener('DOMContentLoaded', function() {
    const openAllAvisPopupBtn = document.getElementById('openAllAvisPopup');
    const closeAllAvisPopupBtn = document.getElementById('closeAllAvisPopup');
    const allAvisPopup = document.getElementById('allAvisPopup');
    const reviewsList = document.getElementById('reviewsList');

    // Example data for previous reviews
    const reviews = [
        { rating: 5, text: "Excellent! I loved it!" },
        { rating: 4, text: "Very good, but could be improved." },
        { rating: 3, text: "It was fine, not bad." }
    ];

    // Function to display reviews with their ratings
    function displayReviews() {
        reviewsList.innerHTML = '';
        reviews.forEach(review => {
            const reviewElement = document.createElement('div');
            reviewElement.classList.add('review', 'mb-2');
            reviewElement.innerHTML = `
                <div class="stars text-yellow-400 mb-2">
                    ${getStarsHTML(review.rating)}
                </div>
                <p>${review.text}</p>
            `;
            reviewsList.appendChild(reviewElement);
        });
    }

    // Function to generate star rating HTML based on the rating
    function getStarsHTML(rating) {
        let starsHTML = '';
        for (let i = 1; i <= 5; i++) {
            starsHTML += i <= rating ? '★' : '☆';
        }
        return starsHTML;
    }

    // Function to open the "All Avis" popup
    openAllAvisPopupBtn.addEventListener('click', function() {
        allAvisPopup.classList.remove('hidden'); // Make the popup visible
        displayReviews(); // Display all reviews
    });

    // Function to close the "All Avis" popup
    closeAllAvisPopupBtn.addEventListener('click', function() {
        allAvisPopup.classList.add('hidden'); // Hide the popup
    });
});

document.addEventListener('DOMContentLoaded', function() {
    const openAddAvisPopupBtn = document.getElementById('openAddAvisPopup');
    const closeAddAvisPopupBtn = document.getElementById('closeAddAvisPopup');
    const addAvisPopup = document.getElementById('addAvisPopup');
    const submitReviewBtn = document.getElementById('submitReview');
    const reviewText = document.getElementById('reviewText');
    let currentRating = 0;

    // Function to open the "Add Votre Avis" popup
    openAddAvisPopupBtn.addEventListener('click', function() {
        addAvisPopup.classList.remove('hidden'); // Make the popup visible
    });

    // Function to close the "Add Votre Avis" popup
    closeAddAvisPopupBtn.addEventListener('click', function() {
        addAvisPopup.classList.add('hidden'); // Hide the popup
    });

    // Rating system (stars)
    const starElements = document.querySelectorAll('.star');
    starElements.forEach(star => {
        star.addEventListener('click', function() {
            currentRating = parseInt(this.getAttribute('data-value'));
            updateStars(currentRating);
        });
    });

    // Function to update the stars based on rating
    function updateStars(rating) {
        starElements.forEach(star => {
            if (parseInt(star.getAttribute('data-value')) <= rating) {
                star.classList.add('text-yellow-400');
                star.classList.remove('text-gray-400');
            } else {
                star.classList.remove('text-yellow-400');
                star.classList.add('text-gray-400');
            }
        });
    }

    // Function to handle review submission
    submitReviewBtn.addEventListener('click', function() {
        const review = reviewText.value;

        if (currentRating === 0) {
            alert('Please provide a rating!');
        } else if (review === '') {
            alert('Please enter your review text!');
        } else {
            // Submit the review to the server (or process it here)
            alert(`Review submitted! Rating: ${currentRating} stars\nReview: ${review}`);
            addAvisPopup.classList.add('hidden');  // Close the popup after submission
        }
    });
});

</script>
  

</body>
</html>
