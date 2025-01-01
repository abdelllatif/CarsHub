<?php
require_once 'connectiondatabase.php';  

class Categorie extends Data {
    protected $id;
    protected $name;
    protected $description;

    // Constructor to initialize properties and establish database connection
    public function __construct($id = null, $name = null, $description = null) {
        $this->pdo = $this->connextion();  // Get the PDO connection from the Data class
        $this->id = $id;
        $this->name = $name;
        $this->description = $description;
    }

    // Method to get available vehicles for a specific category
    public function getAvailableVehicles() {
        $query = "SELECT * FROM vehicles WHERE categoryId = :categoryId AND status = 'available'";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":categoryId", $this->id);  // Bind the categoryId
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Return the list of available vehicles in this category
    }

    // Method to get the count of vehicles in a category
    public function getVehicleCount() {
        $query = "SELECT COUNT(*) AS vehicle_count FROM vehicles WHERE categoryId = :categoryId";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":categoryId", $this->id);  // Bind the categoryId
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['vehicle_count'];  // Return the count of vehicles in this category
    }

    // Method to filter vehicles by specific criteria (e.g., price, model, etc.)
    public function filterVehicles($criteria) {
        $query = "SELECT * FROM vehicles WHERE categoryId = :categoryId";
        
        // Add conditions based on the criteria
        if (isset($criteria['priceMin'])) {
            $query .= " AND pricePerDay >= :priceMin";
        }
        if (isset($criteria['priceMax'])) {
            $query .= " AND pricePerDay <= :priceMax";
        }
        if (isset($criteria['model'])) {
            $query .= " AND model LIKE :model";
        }

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":categoryId", $this->id);

        // Bind dynamic parameters
        if (isset($criteria['priceMin'])) {
            $stmt->bindParam(":priceMin", $criteria['priceMin']);
        }
        if (isset($criteria['priceMax'])) {
            $stmt->bindParam(":priceMax", $criteria['priceMax']);
        }
        if (isset($criteria['model'])) {
            $stmt->bindParam(":model", "%{$criteria['model']}%");
        }

        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);  // Return the filtered list of vehicles in this category
    }
}
?>
