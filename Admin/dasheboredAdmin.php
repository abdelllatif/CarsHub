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
        <!-- Sidebar -->
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
            <!-- Top Navigation -->
            <header class="bg-white shadow">
                <div class="flex items-center justify-between px-6 py-4">
                    <h1 class="text-2xl font-semibold text-gray-900" id="section-title">Dashboard Overview</h1>
                    <div class="flex items-center">
                        <span class="text-gray-700 mr-4">Welcome to your dashboard!</span>
                        <a href="singin.php"><button class="px-4 py-2 bg-red-600 text-white rounded hover:bg-red-700">Logout</button></a>
                    </div>
                </div>
            </header>

            <!-- Content Sections -->
            <main class="p-6">
                <!-- Dashboard Overview Section -->
                <section id="dashboard" class="section-content">
                    <div class="grid grid-cols-1 md:grid-cols-4 gap-6 mb-6">
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-gray-500 text-sm font-medium">Total Vehicles</h3>
                            <p class="text-3xl font-bold text-gray-900">150</p>
                        </div>
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-gray-500 text-sm font-medium">Total Reservations</h3>
                            <p class="text-3xl font-bold text-gray-900">120</p>
                        </div>
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-gray-500 text-sm font-medium">Total Reviews</h3>
                            <p class="text-3xl font-bold text-gray-900">80</p>
                        </div>
                        <div class="bg-white rounded-lg shadow p-6">
                            <h3 class="text-gray-500 text-sm font-medium">Total Users</h3>
                            <p class="text-3xl font-bold text-gray-900">200</p>
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
                    <!-- More vehicle rows can be added here -->
                </tbody>
            </table>
        </div>
    </div>

    <!-- Add New Vehicle Form (Popup) -->
    <div id="addVehicleForm" class="fixed inset-0 flex items-center justify-center z-50 hidden bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-96">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Add New Vehicle</h3>
            <form id="newVehicleForm" class="space-y-4">
                <!-- Input Group: Model and Brand -->
                <div class="flex space-x-4">
                    <div class="flex flex-col w-full">
                        <label class="text-sm font-medium text-gray-700 mb-1">Model</label>
                        <input type="text" id="model" required 
                            class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                    <div class="flex flex-col w-full">
                        <label class="text-sm font-medium text-gray-700 mb-1">Brand</label>
                        <input type="text" id="brand" required 
                            class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                </div>

                <!-- Input Group: Description and Price Per Day -->
                <div class="flex space-x-4">
                   
                    <div class="flex flex-col w-full">
                        <label class="text-sm font-medium text-gray-700 mb-1">Price Per Day (DH)</label>
                        <input type="number" id="pricePerDay" required 
                            class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                </div>
 <div class="flex flex-col w-full">
                        <label class="text-sm font-medium text-gray-700 mb-1">Description</label>
                        <textarea id="description" required rows="3" 
                            class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
                    </div>
                <!-- Input Group: Category ID and Status -->
                <div class="flex space-x-4">
                    <div class="flex flex-col w-full">
                        <label class="text-sm font-medium text-gray-700 mb-1">Category ID</label>
                        <input type="number" id="categoryId" required 
                            class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                    <div class="flex flex-col w-full">
                        <label class="text-sm font-medium text-gray-700 mb-1">Status</label>
                        <select id="status" required 
                            class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                            <option value="available">Available</option>
                            <option value="unavailable">Unavailable</option>
                        </select>
                    </div>
                </div>

                <!-- Input Group: Characteristics and Image URL -->
                <div class="flex space-x-4">
                    <div class="flex flex-col w-full">
                        <label class="text-sm font-medium text-gray-700 mb-1">Characteristics</label>
                        <textarea id="characteristics" required rows="3" 
                            class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none"></textarea>
                    </div>
                    <div class="flex flex-col w-full">
                    <label for="image" class="text-sm font-medium text-gray-700 mb-1">Image</label>
                <input type="file" id="image" required 
                    class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                    </div>
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="hideAddVehicleForm()" 
                        class="px-4 py-2 bg-gray-400 text-white rounded-md shadow-sm hover:bg-gray-500 transition">
                        Cancel
                    </button>
                    <button type="submit" 
                        class="px-4 py-2 bg-blue-600 text-white rounded-md shadow-sm hover:bg-blue-700 transition">
                        Add Vehicle
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add New Category Form (Popup) -->
    <div id="addCategoryForm" class="fixed inset-0 flex items-center justify-center z-50 hidden bg-black bg-opacity-50">
        <div class="bg-white rounded-lg shadow-lg p-6 w-96">
            <h3 class="text-lg font-bold text-gray-800 mb-4">Add New Category</h3>
            <form id="newCategoryForm" class="space-y-4">
                <div class="flex flex-col w-full">
                    <label class="text-sm font-medium text-gray-700 mb-1">Category Name</label>
                    <input type="text" id="categoryName" required 
                        class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <div class="flex flex-col w-full">
                    <label class="text-sm font-medium text-gray-700 mb-1">Category Description</label>
                    <input type="text" id="categorydescription" required 
                        class="w-full p-2 border border-gray-300 rounded-md shadow-sm focus:ring-2 focus:ring-blue-500 focus:outline-none">
                </div>
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="hideAddCategoryForm()" 
                        class="px-4 py-2 bg-gray-400 text-white rounded-md shadow-sm hover:bg-gray-500 transition">
                        Cancel
                    </button>
                    <button type="submit" 
                        class="px-4 py-2 bg-green-600 text-white rounded-md shadow-sm hover:bg-green-700 transition">
                        Add Category
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>

                </section>

                <!-- Manage Reservations Section -->
                <section id="reservations" class="section-content hidden">
                    <div class="bg-white rounded-lg shadow">
                        <div class="p-6 border-b">
                            <h2 class="text-xl font-semibold">Reservation Management</h2>
                        </div>
                        <div class="p-6">
                            <table class="w-full">
                                <thead>
                                    <tr>
                                        <th class="text-left p-3">User  Name</th>
                                        <th class="text-left p-3">Vehicle</th>
                                        <th class="text-left p-3">Start Date</th>
                                        <th class="text-left p-3">End Date</th>
                                        <th class="text-left p-3">Status</th>
                                        <th class="text-left p-3">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="p-3">Alice Smith</td>
                                        <td class="p-3">Toyota Corolla</td>
                                        <td class="p-3">2024-01-20</td>
                                        <td class="p-3">2024-01-25</td>
                                        <td class="p-3">
                                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-sm">Confirmed</span>
                                        </td>
                                        <td class="p-3">
                                            <button class="text-blue-600 hover:text-blue-900">Edit</button>
                                            <button class="text-red-600 hover:text-red-900 ml-2">Cancel</button>
                                        </td>
                                    </tr>
                                    <!-- More reservation rows can be added here -->
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
        document.addEventListener('DOMContentLoaded', function() {
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

    // Event listener for the Add Vehicle form submission
    document.getElementById('newVehicleForm').addEventListener('submit', function(event) {
        event.preventDefault();
        // Add logic to handle form submission, e.g., sending data to the server
        hideAddVehicleForm();
    });

    // Event listener for the Add Category form submission
    document.getElementById('newCategoryForm').addEventListener('submit', function(event) {
        event.preventDefault();
        // Add logic to handle form submission, e.g., sending data to the server
        hideAddCategoryForm();
    });
    </script>
</body>
</html>