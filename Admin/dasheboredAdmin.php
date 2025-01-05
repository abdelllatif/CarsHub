
<?php 
session_start();
require_once 'getstatistique.php';
require_once '../classes/reservationclass.php';
require_once '../classes/categorieclass.php';

// First check authentication
if (!isset($_SESSION['user_email']) || $_SESSION['user_id'] != 1) {
    header("Location: ../connexion/singin.php");
    exit();
}

// Then handle the status update
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['reservation_id']) && isset($_POST['status'])) {
    $reservationId = $_POST['reservation_id'];
    $status = $_POST['status'];
    $reservation = new Reservation(); // Create instance of Reservation class
    $result = $reservation->updateStatus($reservationId, $status);
    // Optionally redirect or show a success message
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tailwindcss/2.2.19/tailwind.min.js"></script>
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-gray-100">
    <div class="min-h-screen flex">
        <div class="w-64 bg-gray-800 text-white">
            <div class="p-4">
                <h2 class="text-2xl font-bold">Admin Dashboard</h2>
            </div>
            <nav class="mt-4" id="sidebar-nav">
                <a href="#" data-section="dashboard" class="block py-3 px-4 text-gray-300 hover:bg-gray-700 hover:text-white active">
                    Dashboard Overview
                </a>
                <a href="#" data-section="vehicles" class="block py-3 px-4 text-gray-300 hover:bg-gray-700 hover:text-white">
                    Manage Vehicles
                </a>
                <a href="#" data-section="reservations" class="block py-3 px-4 text-gray-300 hover:bg-gray-700 hover:text-white">
                    Manage Reservations
                </a>
                <a href="#" data-section="reviews" class="block py-3 px-4 text-gray-300 hover:bg-gray-700 hover:text-white">
                    Manage Reviews
                </a>
                <a href="#" data-section="statistics" class="block py-3 px-4 text-gray-300 hover:bg-gray-700 hover:text-white">
                    Statistics
                </a>
            </nav>
        </div>

        <!-- Main Content -->
        <div class="flex-1">
            <header class="bg-white shadow">
                <div class="flex items-center justify-between px-6 py-4">
                    <h1 class="text-2xl font-semibold text-gray-900" id="section-title">Dashboard Overview</h1>
                    <div class="flex items-center">
                        <span class="text-gray-700 mr-4">Welcome to your dashboard!</span>
                        <a href="../connexion/logout.php"><button class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Logout </button></a>
                    </div>
                </div>
            </header>

            <main class="p-6">
                <section id="dashboard" class="section-content">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-gray-500 text-sm font-medium">Total Vehicles</h3>
                            <p class="text-3xl font-bold text-gray-900"><?php
                           echo $total2;
                            ?></p>
                        </div>
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-gray-500 text-sm font-medium">Total Reservations</h3>
                            <p class="text-3xl font-bold text-gray-900"><?php
                           echo $total3;
                            ?></p>
                        </div>
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-gray-500 text-sm font-medium">Total Reviews</h3>
                            <p class="text-3xl font-bold text-gray-900"><?php
                           echo $total4;
                            ?></p>
                        </div>
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-gray-500 text-sm font-medium">Total Users</h3>
                            <p class="text-3xl font-bold text-gray-900"><?php
                           echo $total1;
                            ?></p>
                        </div>
                    </div>
                </section>

                <!-- Manage Vehicles Section -->
<section id="vehicles" class="section-content hidden">
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b flex justify-between items-center">
            <h2 class="text-xl font-semibold">Vehicle Management</h2>
            <button onclick="showAddVehicleForm()" class="px-4 py-2 bg-blue-600 text-white rounded hover:bg-blue-700">Add New Vehicle</button>
            <button onclick="showAddCategoryForm()" class="px-4 py-2 bg-green-600 text-white rounded hover:bg-green-700">Add New Category</button>
        </div>
        <div class="p-6">
            <table class="w-full">
                <thead>
                    <tr>
                        <th class="text-left p-3">Model</th>
                        <th class="text-left p-3">Price</th>
                        <th class="text-left p-3">Availability</th>
                        <th class="text-left p-3">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="p-3">Toyota Corolla</td>
                        <td class="p-3">300 DH</td>
                        <td class="p-3">Available</td>
                        <td class="p-3">
                            <button class="text-blue-600 hover:text-blue-900">Edit</button>
                            <button class="text-red-600 hover:text-red-900 ml-2">Delete</button>
                        </td>
                    </tr>
                    <!-- More vehicle -->
                </tbody>
            </table>
        </div>
    </div>

   <!-- Add New Vehicle -->
<div id="addVehicleForm" class="fixed inset-0 flex items-center justify-center z-50 hidden bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-96">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Add New Vehicle</h3>
        <form id="newVehicleForm" action="setvihucle.php" method="POST" class="space-y-4"  enctype="multipart/form-data">
            <div id="vehicleFields">
                <!-- Dynamic vehicle form fields will appear here -->
                <div class="vehicle-field flex space-x-4 mb-4">
                    <div class="flex flex-col w-full">
                        <label class="text-sm font-medium text-gray-700 mb-1">Model</label>
                        <input type="text" name="model[]" required 
                            class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                    <div class="flex flex-col w-full">
                        <label class="text-sm font-medium text-gray-700 mb-1">Brand</label>
                        <input type="text" name="brand[]" required 
                            class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                </div>

                <div class="vehicle-field flex space-x-4 mb-4">
                    <div class="flex flex-col w-full">
                        <label class="text-sm font-medium text-gray-700 mb-1">Price Per Day (DH)</label>
                        <input type="number" name="pricePerDay[]" required 
                            class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                </div>

                <div class="vehicle-field flex space-x-4 mb-4">
                    <div class="flex flex-col w-full">
                        <label class="text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea name="description[]" required rows="3" 
                            class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
                    </div>
                </div>
                <div class="flex flex-col w-full">
                    <label for="image" class="text-sm font-medium text-gray-700 mb-1">Image</label>
                <input type="file" name="image[]" id="image" required 
                    class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                <div class="vehicle-field flex space-x-4 mb-4">
                    <div class="flex flex-col w-full">
                        <label class="text-sm font-medium text-gray-700 mb-1">Category</label>
                        <select name="categoryname[]" required 
                            class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <?php 
                            foreach ($categories as $category) {
                                echo '<option value="' . htmlspecialchars($category['id']) . '">' . htmlspecialchars($category['name']) . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                    <div class="flex flex-col w-full">
                        <label class="text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select name="status[]" required 
                            class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <option value="available">Available</option>
                            <option value="unavailable">Unavailable</option>
                        </select>
                    </div>
                </div>
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button" onclick="hideAddVehicleForm()" 
                    class="px-4 py-2 bg-gray-400 text-white rounded-md shadow-sm hover:bg-gray-500 transition">
                    Cancel
                </button>
                <button type="button" onclick="addNewVehicleField()" 
                    class="px-4 py-2 bg-blue-600 text-white rounded-md shadow-sm hover:bg-blue-700 transition">
                    Add More Vehicles
                </button>
                <button type="submit" 
                    class="px-4 py-2 bg-green-600 text-white rounded-md shadow-sm hover:bg-green-700 transition">
                    Add Vehicle
                </button>
            </div>
        </form>
    </div>
</div>

<!-- Add New Category -->
<div id="addCategoryForm" class="fixed inset-0 flex items-center justify-center z-50 hidden bg-black bg-opacity-50">
    <div class="bg-white rounded-lg shadow-lg p-6 w-96">
        <h3 class="text-lg font-bold text-gray-800 mb-4">Add New Category</h3>
        <form id="newCategoryForm" action="setcategorie.php" method="POST" class="space-y-4">
            <div id="categoryFields">
                <div class="category-field flex flex-col w-full mb-4">
                    <label class="text-sm font-medium text-gray-700 mb-1">Category Name</label>
                    <input type="text" name="name[]" id="categoryName" required 
                        class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <div class="category-field flex flex-col w-full mb-4">
                    <label class="text-sm font-medium text-gray-700 mb-1">Category Description</label>
                    <input type="text" name="description[]" id="categorydescription" required 
                        class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
            </div>

            <div class="flex justify-end space-x-2">
                <button type="button" onclick="hideAddCategoryForm()" 
                    class="px-4 py-2 bg-gray-400 text-white rounded-md shadow-sm hover:bg-gray-500 transition">
                    Cancel
                </button>
                <button type="button" onclick="addNewCategoryField()" 
                    class="px-4 py-2 bg-blue-600 text-white rounded-md shadow-sm hover:bg-blue-700 transition">
                    Add More Categories
                </button>
                <button type="submit" 
                    class="px-4 py-2 bg-green-600 text-white rounded-md shadow-sm hover:bg-green-700 transition">
                    Add Category
                </button>
            </div>
        </form>
    </div>
</div>
    <div class="p-6">
    <table class="w-full">
        <thead>
            <tr>
                <th class="text-left p-3">Category Name</th>
                <th class="text-left p-3">Description</th>
                <th class="text-left p-3">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $category = new Categorie();
            $categories = $category->getAllCategories();
            
            foreach($categories as $cat) {
                echo "<tr>";
                echo "<td class='p-3'>" . htmlspecialchars($cat['name']) . "</td>";
                echo "<td class='p-3'>" . htmlspecialchars($cat['description']) . "</td>";
                echo "<td class='p-3'>
                        <button class='text-blue-600 hover:text-blue-900' onclick='editCategory(" . $cat['id'] . ")'>Edit</button>
                        <button class='text-red-600 hover:text-red-900 ml-2' onclick='deleteCategory(" . $cat['id'] . ")'>Delete</button>
                    </td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</div>
</section>

                </section>


<!-- Manage Reservations Section -->
    <!-- Manage Reservations Section -->
   
                <!-- Manage Reservations Section -->
                <section id="manage-reservations" class="section-content">
                    <div class="bg-white rounded-lg shadow">
                        <div class="p-6 border-b">
                            <h2 class="text-xl font-semibold">Reservation Management</h2>
                        </div>
                        <div class="p-6">
                            <table class="w-full">
                                <thead>
                                    <tr>
                                        <th class="text-left p-3">User Name</th>
                                        <th class="text-left p-3">Vehicle</th>
                                        <th class="text-left p-3">Start Date</th>
                                        <th class="text-left p-3">End Date</th>
                                        <th class="text-left p-3">Pickup Location</th>
                                        <th class="text-left p-3">Dropoff Location</th>
                                        <th class="text-left p-3">Total Price</th>
                                        <th class="text-left p-3">Status</th>
                                        <th class="text-left p-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php 
                                     $reservation = new Reservation();

                                     $reservations = $reservation->getAllReservations();
                                   
                                        foreach ($reservations as $reservation) {
                                            echo "<tr>";
                                            echo "<td class='p-3'>" . htmlspecialchars($reservation['user_name']) . " " . htmlspecialchars($reservation['user_lastname']) . "</td>";
                                            echo "<td class='p-3'>" . htmlspecialchars($reservation['vehicle']) . " " . htmlspecialchars($reservation['v_brand']) . "</td>";
                                            echo "<td class='p-3'>" . htmlspecialchars($reservation['startDate']) . "</td>";
                                            echo "<td class='p-3'>" . htmlspecialchars($reservation['endDate']) . "</td>";
                                            echo "<td class='p-3'>" . htmlspecialchars($reservation['pickupLocation']) . "</td>";
                                            echo "<td class='p-3'>" . htmlspecialchars($reservation['dropoffLocation']) . "</td>";
                                            echo "<td class='p-3'>" . htmlspecialchars($reservation['totalPrice']) . " DH</td>";
                                            echo "<td class='p-3'>";
                                            echo "<span class='px-2 py-1 " . ($reservation['status'] == 'confirmed' ? 'bg-green-100 text-green-800' : 'bg-yellow-100 text-yellow-800') . " rounded-full text-sm'>" . htmlspecialchars($reservation['status']) . "</span>";
                                            echo "</td>";

                                            echo "<td class='p-3'>";
                                                // Show confirm/refuse buttons
                                echo "<form method='POST' class='inline'>";
                                echo "<input type='hidden' name='reservation_id' value='" . htmlspecialchars($reservation['id']) . "'>";
                                echo "<input type='hidden' name='status' value='confirmed'>";
                                echo "<button type='submit' class='text-blue-600 hover:text-blue-900'>Confirm</button>";
                                echo "</form>";

                                            echo "<form method='POST' class='inline'>";
                                            echo "<input type='hidden' name='reservation_id' value='" . htmlspecialchars($reservation['id']) . "'>";
                                            echo "<input type='hidden' name='status' value='refused'>";
                                            echo "<button type='submit' class='bg-red-300 rounded-lg p-1 text-blue-600 hover:text-blue-900'>refused</button>";
                                            echo "</form>";
                                        
                                            echo "</td>";
                                            echo "</tr>";
                                        }
                                    
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div> 
                  </section>




                <!-- Manage Reviews Section -->
                <section id="reviews" class="section-content hidden">
                    <div class="bg-white rounded-lg shadow">
                        <div class="p-6 border-b">
                            <h2 class="text-xl font-semibold">Review Management</h2>
                        </div>
                        <div class="p-6">
                            <table class="w-full">
                                <thead>
                                    <tr>
                                        <th class="text-left p-3">User </th>
                                        <th class="text-left p-3">Vehicle</th>
                                        <th class="text-left p-3">Rating</th>
                                        <th class="text-left p-3">Comment</th>
                                        <th class="text-left p-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="p-3">John Doe</td>
                                        <td class="p-3">Honda Civic</td>
                                        <td class="p-3">5</td>
                                        <td class="p-3">Great experience!</td>
                                        <td class="p-3">
                                            <button class="text-blue-600 hover:text-blue-900">Edit</button>
                                            <button class="text-red-600 hover:text-red-900 ml-2">Delete</button>
                                        </td>
                                    </tr>
                                    <!-- More review rows can be added here -->
                                </tbody>
                            </table>
                        </div>
                    </div>
                </section>

                <!-- Statistics Section -->
                <section id="statistics" class="section-content hidden">
    <div class="bg-white rounded-lg shadow">
        <div class="p-6 border-b">
            <h2 class="text-xl font-semibold">Statistics Overview</h2>
        </div>
        <div class="p-6 grid grid-cols-1 md:grid-cols-2 gap-6">
            <!-- Total Rentals Over Time -->
            <div>
                <h3 class="text-lg font-semibold">Total Rentals Over Time</h3>
                <canvas id="rentalsChart"></canvas>
            </div>
            <!-- Most Popular Vehicles -->
            <div>
                <h3 class="text-lg font-semibold">Most Popular Vehicles</h3>
                <canvas id="popularVehiclesChart"></canvas>
            </div>
            <!-- Revenue Generated -->
            <div>
                <h3 class="text-lg font-semibold">Revenue Generated</h3>
                <p class="text-3xl font-bold text-gray-900">100,000 DH</p>
            </div>
            <!-- User Demographics -->
            <div>
                <h3 class="text-lg font-semibold">User  Demographics</h3>
                <canvas id="demographicsChart"></canvas>
            </div>
        </div>
    </div>
</section>
            </main>
        </div>
    </div>

    <script>
        document.addEventListener('click', function() {
            const navLinks = document.querySelectorAll('#sidebar-nav a');
            const sections = document.querySelectorAll('.section-content');
            const sectionTitle = document.getElementById('section-title');

            function showSection(sectionId) {
                sections.forEach(section => {
                    section.classList.add('hidden');
                });
                document.getElementById(sectionId).classList.remove('hidden');
                
                navLinks.forEach(link => {
                    link.classList.remove('bg-blue-600');
                    if(link.dataset.section === sectionId) {
                        link.classList.add('bg-blue-600');
                        sectionTitle.textContent = link.textContent.trim();
                    }
                });
            }

            navLinks.forEach(link => {
                link.addEventListener('click', (e) => {
                    e.preventDefault();
                    const sectionId = link.dataset.section;
                    showSection(sectionId);
                });
            });
        });
// Function to show the Add Vehicle form
function showAddVehicleForm() {
        document.getElementById('addVehicleForm').classList.remove('hidden');
    }

    // Function to hide the Add Vehicle form
    function hideAddVehicleForm() {
        document.getElementById('addVehicleForm').classList.add('hidden');
    }

    // Function to show the Add Category form
    function showAddCategoryForm() {
        document.getElementById('addCategoryForm').classList.remove('hidden');
    }

    // Function to hide the Add Category form
    function hideAddCategoryForm() {
        document.getElementById('addCategoryForm').classList.add('hidden');
        
    }

    document.getElementById('newVehicleForm').addEventListener('submit', function(event) {
        // Add logic to handle form submission, e.g., sending data to the server
        hideAddVehicleForm();
    });

    // Event listener for the Add Category form submission
    document.getElementById('newCategoryForm').addEventListener('submit', function(event) {
        // Add logic to handle form submission, e.g., sending data to the server
        hideAddCategoryForm();
    });


    document.getElementById('newVehicleForm').addEventListener('submit', function(event) {
            // Add logic to handle form submission, e.g., sending data to the server
            hideAddVehicleForm();
        });

        // Event listener for the Add Category form submission
        document.getElementById('newCategoryForm').addEventListener('submit', function(event) {
            // Add logic to handle form submission, e.g., sending data to the server
            hideAddCategoryForm();
        });


    
    </script>
</body>
</html>