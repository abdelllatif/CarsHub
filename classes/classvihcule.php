<?php
require_once 'connectiondatabase.php';  

class Vehicle extends Data {
    // Define the vehicle properties
    protected $id;  // Added vehicle ID
    protected $model;
    protected $brand;
    protected $description;
    protected $pricePerDay;
    public $status;
    public $categoryname;
    public $categoryId; 
    public $characteristics;
    protected $image;
    protected $reviews;
    protected $createdAt;

    public function __construct($model, $brand, $description, $pricePerDay, $status, $categoryname, $characteristics, $reviews) {
        $this->pdo = $this->connextion(); 
        
        $this->model = $model;
        $this->brand = $brand;
        $this->description = $description;  
        $this->pricePerDay = $pricePerDay;  
        $this->status = $status;
        $this->categoryname = $categoryname;
        $this->characteristics = $characteristics;
        $this->reviews = $reviews;
        $this->createdAt = date("Y-m-d H:i:s");  
        
        $this->categoryId = $this->getCategoryIdByName($categoryname);
    }

    private function getCategoryIdByName($categoryname) {
        $query = "SELECT id FROM categories WHERE name = :categoryname LIMIT 1";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":categoryname", $categoryname);
        $stmt->execute();
        
        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result ? $result['id'] : null;  
    }

    public function uploadImage($file) {
        $fileName = $file['name'];
        $fileTmpName = $file['tmp_name'];
        $fileSize = $file['size'];
        $fileError = $file['error'];
        $fileType = $file['type'];

        if ($fileError === 0) {
            $allowed = ['image/jpeg', 'image/png', 'image/gif'];
            if (in_array($fileType, $allowed)) {
                if ($fileSize < 5000000) {
                    $fileNewName = uniqid('', true) . "." . strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
                    $fileDestination = 'uploads/' . $fileNewName;

                    if (move_uploaded_file($fileTmpName, $fileDestination)) {
                        echo "File uploaded successfully!";
                        $this->image = $fileDestination;  
                    } else {
                        echo "Error moving the file.";
                    }
                } else {
                    echo "File is too large!";
                }
            } else {
                echo "Invalid file type. Only JPEG, PNG, and GIF are allowed.";
            }
        } else {
            echo "There was an error uploading your file.";
        }
    }

    public function save() {
        $query = "INSERT INTO vehicles (model, brand, description, pricePerDay, status, categoryId, characteristics, image, createdAt)
                  VALUES (:model, :brand, :description, :pricePerDay, :status, :categoryId, :characteristics, :image, :createdAt)";
        $stmt = $this->pdo->prepare($query);

        $stmt->bindParam(":model", $this->model);
        $stmt->bindParam(":brand", $this->brand);
        $stmt->bindParam(":description", $this->description);
        $stmt->bindParam(":pricePerDay", $this->pricePerDay);
        $stmt->bindParam(":status", $this->status);
        $stmt->bindParam(":categoryId", $this->categoryId);  
        $stmt->bindParam(":characteristics", $this->characteristics);
        $stmt->bindParam(":image", $this->image); 
        $stmt->bindParam(":createdAt", $this->createdAt);

        return $stmt->execute();
    }

    public function checkAvailability($startDate, $endDate) {
        $query = "SELECT * FROM vehicles WHERE status = 'available' AND createdAt BETWEEN :startDate AND :endDate";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":startDate", $startDate);
        $stmt->bindParam(":endDate", $endDate);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);  
    }

    public function updateStatus($status) {
        $query = "UPDATE vehicles SET status = :status WHERE id = :id";  // Changed 'model' to 'id'
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":status", $status);
        $stmt->bindParam(":id", $this->id);  // Changed to use 'id'
        
        return $stmt->execute(); 
    }

    public function getReviews() {
        $query = "SELECT * FROM reviews WHERE vehicle_id = :vehicle_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":vehicle_id", $this->id);  // Changed 'model' to 'id'
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);  
    }

    public function getAverageRating() {
        $query = "SELECT AVG(rating) AS average_rating FROM reviews WHERE vehicle_id = :vehicle_id";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":vehicle_id", $this->id);  // Changed 'model' to 'id'
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);
        return $result['average_rating']; 
    }

    public function searchByModel($model) {
        $query = "SELECT * FROM vehicles WHERE model LIKE :model";  // Changed 'vihcule' to 'vehicles'
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":model", "%$model%");
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }

    // Function to get available vehicles considering the start and end dates
    public function getAvailableVehicles($startDate, $endDate) {
        $query = "
            SELECT * 
            FROM vehicles v
            WHERE v.status = 'available' AND NOT EXISTS (
                SELECT 1 
                FROM reservations r
                WHERE r.vehicleId = v.id
                AND (
                    (r.startDate <= :endDate AND r.endDate >= :startDate)  -- overlap check
                )
            )
        ";

        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":startDate", $startDate);
        $stmt->bindParam(":endDate", $endDate);
        $stmt->execute();

        $vehicles = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $vehicles;
    }

    public function paginateVehicles($page, $limit) {
        $offset = ($page - 1) * $limit;
        $query = "SELECT * FROM vehicles LIMIT :limit OFFSET :offset";  // Changed 'vihcule' to 'vehicles'
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":limit", $limit, PDO::PARAM_INT);
        $stmt->bindParam(":offset", $offset, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC); 
    }
}
?>
