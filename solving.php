<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>

    <title>Document</title>
</head>
<body>
    <!-- Button to Open the Popup -->
    <button class="reserveBtn mt-6 w-full bg-blue-600 text-white py-2 rounded-lg hover:bg-blue-700">Réserver</button>

 <!-- Popup Form -->
 <div id="reservation-popup" class="fixed inset-0 flex items-center justify-center z-50 hidden bg-black bg-opacity-50">
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
                <script>



 // Open the popup
 document.getElementsByClassName("reserveBtn").addEventListener("click", function() {
            document.getElementById("reservation-popup").classList.remove("hidden");
        });

        // Close the popup
        document.getElementById("cancel-button").addEventListener("click", function() {
            document.getElementById("reservation-popup").classList.add("hidden");
        });

        // Handle form submission
        document.getElementById("reservation-form").addEventListener("submit", function(event) {
            event.preventDefault(); // Prevent the default form submission
            // Here you can handle the form data, e.g., send it to the server
            alert("Réservation confirmée !");
            document.getElementById("reservation-popup").classList.add("hidden"); // Close the popup
        });

                </script>
</body>

</html>