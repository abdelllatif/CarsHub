<?php
require_once 'connectiondatabase.php'; 

class Review extends data{
    public $pdo; 
    protected $createdAt;
      public function __construct() {
          $this->pdo = $this->connextion(); 
      }

    public function addReview($vehicleId, $clientId, $rating, $comment) {
        try {
            $stmt = $this->pdo->prepare("INSERT INTO reviews (vehicleId, clientId, rating, comment) VALUES (?, ?, ?, ?)");
            return $stmt->execute([$vehicleId, $clientId, $rating, $comment]);
        } catch(PDOException $e) {
            return false;
        }
    }
    public function getallvihucle() {
        try {
            $stmt = $this->pdo->prepare("
                SELECT * id
                FROM vihucle ;
               
            ");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return false;
        }
    }
    public function getReviewsByVehicle($vehicleId) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT r.*, c.firstName, c.lastName 
                FROM reviews r 
                JOIN clients c ON r.clientId = c.id 
                WHERE r.vehicleId = ? 
                ORDER BY r.createdAt DESC
            ");
            $stmt->execute([$vehicleId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return false;
        }
    }
    public function getRecentRating($vehicleId) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT rating
                FROM reviews
                WHERE vehicleId = ?
                ORDER BY createdAt DESC
                LIMIT 1
            ");
            $stmt->execute([$vehicleId]);
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return false;
        }
    }

    public function getTotalReviews($vehicleId) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT COUNT(*) as total
                FROM reviews
                WHERE vehicleId = ?
            ");
            $stmt->execute([$vehicleId]);
            $result = $stmt->fetch(PDO::FETCH_ASSOC);
            return $result['total'];
        } catch(PDOException $e) {
            return 0;
        }
    }
    public function getUserReviews($userId) {
        try {
            $stmt = $this->pdo->prepare("
                SELECT r.*, v.brand, v.model 
                FROM reviews r 
                JOIN vehicles v ON r.vehicleId = v.id 
                WHERE r.clientId = ? 
                ORDER BY r.createdAt DESC
            ");
            $stmt->execute([$userId]);
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            return false;
        }
    }

    public function deleteReview($reviewId, $userId = null) {
        try {
            $sql = "DELETE FROM reviews WHERE id = ?";
            $params = [$reviewId];
            
            if ($userId !== null) {
                $sql .= " AND clientId = ?";
                $params[] = $userId;
            }
            
            $stmt = $this->pdo->prepare($sql);
            return $stmt->execute($params);
        } catch(PDOException $e) {
            return false;
        }
    }

    public function updateReview($reviewId, $userId, $rating, $comment) {
        try {
            $stmt = $this->pdo->prepare("
                UPDATE reviews 
                SET rating = ?, comment = ? 
                WHERE id = ? AND clientId = ?
            ");
            return $stmt->execute([$rating, $comment, $reviewId, $userId]);
        } catch(PDOException $e) {
            return false;
        }
    }
}
?>