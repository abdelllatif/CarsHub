<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Location de véhicules simple et rapide pour tous vos besoins.">
    <title>Location de Véhicules - AutoLoc</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Custom styles */
        .loading {
            display: none;
        }
        .loading.active {
            display: block;
        }
    </style>
</head>
<body class="min-h-screen bg-gray-100 flex flex-col">
    





<!-- Navigation -->
    <nav class="bg-white shadow-md fixed w-full z-50">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center h-20">
                <div class="flex items-center space-x-2">
                    <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                    </svg>
                    <span class="text-2xl font-bold text-blue-600">AutoLoc</span>
                </div>

                <div class="hidden md:flex items-center space-x-8">
                    <a href="index.php" class="text-gray-600 hover:text-blue-600">Accueil</a>
                    <a href="#vehicles" class="text-gray-600 hover:text-blue-600">Véhicules</a>
                    <a href="#categories" class="text-gray-600 hover:text-blue-600">Catégories</a>
                    <a href="#contact" class="text-gray-600 hover:text-blue-600">Contact</a>

                    <div class="flex items-center space-x-4">
                        <a href="singin.php">
                        <button id="loginBtn" class="text-gray-600 hover:text-blue-600" aria-label="Connexion">
                            <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"/>
                            </svg>
                            Connexion
                        </button>
                        </a>
                    </div>
                </div>

                <button id="mobileMenuBtn" class="md:hidden" aria-label="Menu mobile">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"/>
                    </svg>
                </button>
            </div>
        </div>
    </nav>



    <!-- Mobile Menu -->
    <div id="mobileMenu" class="hidden md:hidden fixed w-full bg-white shadow-md z-40 top-20">
        <div class="p-4 space-y-4">
            <a href="#" class="block text-gray-600 hover:text-blue-600">Accueil</a>
            <a href="#vehicles" class="block text-gray-600 hover:text-blue-600">Véhicules</a>
            <a href="#categories" class="block text-gray-600 hover:text-blue-600">Catégories</a>
            <a href="#contact" class="block text-gray-600 hover:text-blue-600">Contact</a>
        </div>
    </div>

    <!-- Main Content -->
    <main class="flex-grow pt-20">
        <!-- Hero Section -->
        <section class="bg-gradient-to-r from-blue-600 to-blue- 800 text-white py-20">
            <div class="container mx-auto px-4 text-center">
                <h1 class="text-4xl md:text-5xl font-bold">Bienvenue chez AutoLoc</h1>
                <p class="mt-4 text-lg">Votre solution de location de véhicules rapide et fiable.</p>
                <a href="#vehicles" class="mt-8 inline-block bg-white text-blue-600 px-6 py-3 rounded-lg hover:bg-gray-200">Explorer nos véhicules</a>
            </div>
        </section>

        <!-- Vehicles Section -->
        <section id="vehicles" class="py-16 bg-gray-100">
            <div class="container mx-auto px-4">
                <div class="flex flex-col md:flex-row justify-between items-center mb-8">
                    <h2 class="text-3xl font-bold">Nos Véhicules</h2>
                </div>

                <!-- Search and Filter -->
                <div class="flex gap-4 mb-8">
                    <div class="relative flex-grow">
                        <input type="text" id="searchInput" placeholder="Rechercher un véhicule" class="border border-gray-300 rounded-lg py-2 px-4 w-full" />
                    </div>
                    <select id="categoryFilter" class="border border-gray-300 rounded-lg py-2 px-4">
                        <option value="">Catégorie</option>
                        <option value="suv">SUV</option>
                        <option value="berline">Berline</option>
                        <option value="utilitaire">Utilitaire</option>
                    </select>
                    <button id="filterBtn" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700">Filtrer</button>
                </div>

                <!-- Best Offers Section -->
                <section class="py-16 bg-gray-100">
                    <div class="text-center mb-10">
                        <h2 class="text-3xl font-bold">Meilleures Offres</h2>
                        <p class="text-gray-600">Découvrez nos voitures les mieux notées</p>
                    </div>
                    <div class=" mx-auto px-4 grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                        <div class="  bg-white shadow-md rounded-lg overflow-hidden transform hover:scale-105 transition">
                            <img src="https://www.mercedes-benz.ca/content/dam/mb-nafta/ca/myco/my22/eqb-suv/all-vehicles/MBCAN-2022-EQB350W4-SUV-AVP-DR.png" alt="Voiture 1" class="carcontainer w-full">
                            <div class=" p-6">
                                <h3 class=" text-xl font-semibold">Voiture Modèle 1</h3>
                                <p class=" text-gray-600">À partir de 49€/jour</p>
                                <div class="mt-4 flex justify-between items-center">
                                    <div>
                                    <span class="star cursor-pointer text-gray-300 hover:text-yellow-400" data-value="1">★</span>
                                    <span class="star cursor-pointer text-gray-300 hover:text-yellow-400" data-value="2">★</span>
                                    <span class="star cursor-pointer text-gray-300 hover:text-yellow-400" data-value="3">★</span>
                                    <span class="star cursor-pointer text-gray-300 hover:text-yellow-400" data-value="4">★</span>
                                    <span class="star cursor-pointer text-gray-300 hover:text-yellow-400" data-value="5">★</span>
                                    </div>
                                    <span class="text-gray-600 ml-2">(120 avis)</span><span class="viewReviewsBtn text-sm text-gray-800 py-2 ">Voir les avis</span>

                                </div>
                                <button type="submit" class="reserveBtns mt-6 w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">Réserver</button>
                                </div>
                        </div>
                        <!-- Repeat for other vehicles -->
                    </div>
                </section>


    <!-- Car Details Popup -->
    <div id="carDetailsPopup" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50 flex items-center justify-center">
        <div class="bg-white rounded-lg p-6 max-w-2xl flex">
            <div class="w-1/2">
                <!-- The car image with the animated shadow effect -->
                <img src="https://www.mercedes-benz.ca/content/dam/mb-nafta/ca/myco/my22/eqb-suv/all-vehicles/MBCAN-2022-EQB350W4-SUV-AVP-DR.png" alt="Car Model" class="car-image animate-shadow">
            </div>
            <div class="w-1/2 pl-6">
                <h3 class="text-2xl font-bold mb-2">Modèle: Voiture Modèle 1</h3>
                <p class="text-lg mb-2"><strong>Prix:</strong> À partir de 49€/jour</p>
                <p class="text-lg mb-2"><strong>Disponibilité:</strong> Disponible</p>
                <p class="text-lg mb-4"><strong>Description:</strong> Une voiture confortable et spacieuse, idéale pour les trajets en famille ou entre amis.</p>
               <div class="flex justify-end ">
                 <button id="closeCarDetails" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 mr-4">Fermer</button>
                <button id=""  class=" bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 ">Réserver</button>
                </div>
            </div>
        </div>
    </div>

                <!-- Reviews List Popup -->
                <div id="reviewsListPopup" class="hidden fixed inset-0 bg-black bg-opacity-50 z-50">
                    <div class="bg-white rounded-lg p-6 max-w-lg mx-auto mt-20">
                        <h3 class="text-xl font-bold mb-4">Avis sur Voiture Modèle 1</h3>
                        <div id="reviewsContainer" class="mb-4">
                            <!-- Reviews will be dynamically added here -->
                        </div>
                        <textarea id="newReview" placeholder="Ajouter un avis..." class="border border-gray-300 rounded-lg w-full p-2"></textarea>
                        <div class="flex justify-end gap-4 mt-4">
                            <button id="closeReviews" class="px-4 py-2">Fermer</button>
                            <button id="submitReview" class="bg-blue-600 text-white px-4 py-2 rounded">Ajouter Avis</button>
                        </div>
                    </div>
                </div>
     <!-- Your previous HTML structure -->

    <!-- Reservation Popup -->
    <div id="reservation-popup" class="hidden fixed inset-0 flex items-center justify-center z-50  bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-96">
            <h2 class="text-xl font-bold mb-4">Réservation de Voiture</h2>
            <form id="reservation-form" class="space-y-4">
                <!-- Date de Retour -->
                <div>
                    <label for="returnDate" class="block text-sm font-medium text-gray-700">Date de Retour</label>
                    <input type="date" id="returnDate" name="returnDate" required
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300 focus:outline-none" />
                </div>

                <!-- Adresse -->
                <div>
                    <label for="address" class="block text-sm font-medium text-gray-700">Adresse</label>
                    <textarea id="address" name="address" required rows="3"
                        class="mt-1 block w-full p-2 border border-gray-300 rounded-md focus:ring focus:ring-blue-300 focus:outline-none" placeholder="Entrez votre adresse"></textarea>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-2">
                    <button type="button" id="cancel-button" class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">Annuler</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">Confirmer la Réservation</button>
                </div>
            </form>
        </div>
    </div>

                <!-- Pagination -->
                <div class="flex justify-center mt-8">
                    <button id="prevPage" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700" disabled>Précédent</button>
                    <button id="nextPage" class="bg-blue-600 text-white px-4 py-2 rounded-lg hover:bg-blue-700 ml-4">Suivant</button>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <footer class="bg-gray-800 text-white py-8">
            <div class="container mx-auto px-4 text-center">
                <p>&copy; 2023 AutoLoc. Tous droits réservés.</p>
            </div>
        </footer>
    </main>
    <script>

  
// Filter button click event
document.getElementById('filterBtn').addEventListener('click', function() {
    const searchQuery = document.getElementById('searchInput').value.toLowerCase();
    const category = document.getElementById('categoryFilter').value;
    
    // Filtering logic (simple example: hiding non-matching vehicles)
    document.querySelectorAll('.carcontainer').forEach(car => {
        const carName = car.querySelector('.carcontainer h3').textContent.toLowerCase();
        const carCategory = car.dataset.category.toLowerCase();
        
        const matchesSearch = carName.includes(searchQuery);
        const matchesCategory = category ? carCategory === category : true;
        
        if (matchesSearch && matchesCategory) {
            car.style.display = 'block';
        } else {
            car.style.display = 'none';
        }
    });
});

// Show car details popup
document.querySelectorAll('.carcontainer').forEach(car => {
    car.addEventListener('click', () => {
        document.getElementById('carDetailsPopup').classList.remove('hidden');
    });
});

// Close car details popup
document.getElementById('closeCarDetails').addEventListener('click', () => {
    document.getElementById('carDetailsPopup').classList.add('hidden');
});

// Review Popup
document.querySelectorAll('.viewReviewsBtn').forEach(button => {
    button.addEventListener('click', () => {
        document.getElementById('reviewsListPopup').classList.toggle('hidden');
        loadReviews(); // Placeholder function to load reviews
    });
});

document.getElementById('submitReview').onclick = () => {
    const newReview = document.getElementById('newReview').value;
    if (newReview) {
        // Display the review
        const reviewElement = document.createElement('p');
        reviewElement.classList.add("text-lg", "rounded-lg", "border-2", "border-black");
        reviewElement.textContent = newReview;
        document.getElementById('reviewsContainer').appendChild(reviewElement);
        document.getElementById('newReview').value = ''; // Clear input
    } else {
        alert('Veuillez entrer un avis.');
    }
};

// Close reviews list popup
document.getElementById('closeReviews').addEventListener('click', () => {
    document.getElementById('reviewsListPopup').classList.add('hidden');
});

// Rating System (Stars)
const stars = document.querySelectorAll('.star');
const ratingInput = document.getElementById('ratingInput');

stars.forEach((star, index) => {
    star.addEventListener('click', () => {
        const rating = parseInt(star.getAttribute('data-value')); 
        ratingInput.value = rating; 
        updateStarColors(rating);
    });

    // Highlight stars on hover
    star.addEventListener('mouseover', () => {
        updateStarColors(index + 1);
    });

    // Reset star colors after hover
    star.addEventListener('mouseout', () => {
        const rating = parseInt(ratingInput.value);
        updateStarColors(rating);
    });
});

// Function to update the star colors based on the rating
function updateStarColors(rating) {
    stars.forEach((s, i) => {
        if (i < rating) {
            s.classList.remove('text-gray-300');
            s.classList.add('text-yellow-400');
        } else {
            s.classList.remove('text-yellow-400');
            s.classList.add('text-gray-300');
        }
    });
}

// Cancel and reset rating
document.getElementById('cancelRating').addEventListener('click', () => {
    document.getElementById('reviewPopup').classList.add('hidden');
    ratingInput.value = 0;
    updateStarColors(0);
});

// Submit rating
document.getElementById('submitRating').addEventListener('click', () => {
    const rating = parseInt(ratingInput.value);
    if (rating > 0) {
        alert(`Merci pour votre évaluation de ${rating} étoiles!`);
        document.getElementById('reviewPopup').classList.add('hidden');
    } else {
        alert('Veuillez sélectionner une note.');
    }
});

// Pagination and Other Button Actions
document.getElementById('nextPage').addEventListener('click', function() {
    alert('Next page functionality to be implemented.');
});

document.getElementById('prevPage').addEventListener('click', function() {
    alert('Previous page functionality to be implemented.');
});

// Open the popup for all reservation buttons
document.querySelectorAll('.reserveBtns').forEach(button => {
    button.addEventListener('click', () => {
        document.getElementById('reservation-popup').classList.remove('hidden');
    });
});

// Close reservation popup
document.getElementById('cancel-button').addEventListener('click', () => {
    document.getElementById('reservation-popup').classList.add('hidden');
});

// Handle form submission (optional)
document.getElementById('reservation-form').addEventListener('submit', function(event) {
    event.preventDefault();
    alert('Réservation confirmée!');
    document.getElementById('reservation-popup').classList.add('hidden');
});


</script>

</body>
</html>