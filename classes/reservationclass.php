<?php
require_once 'connectiondatabase.php'; 

class Reservation extends data { 
    public $pdo; 
  protected $createdAt;
    public function __construct() {
        $this->pdo = $this->connextion(); 
    }

    public function createReservation($vehicleId, $startDate, $endDate, $location, $clientId) {
        $totalPrice = $this->calculatePrice($vehicleId, $startDate, $endDate); 
        $this->createdAt = date("Y-m-d H:i:s"); 

        $query = "INSERT INTO reservations (vehicleId, clientId, startDate, endDate, pickupLocation, totalPrice, status, createdAt)
                  VALUES (:vehicleId, :clientId, :startDate, :endDate, :location, :totalPrice, 'pending', :createdAt)";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":vehicleId", $vehicleId);
        $stmt->bindParam(":clientId", $clientId);
        $stmt->bindParam(":startDate", $startDate);
        $stmt->bindParam(":endDate", $endDate);
        $stmt->bindParam(":location", $location);
        $stmt->bindParam(":totalPrice", $totalPrice);

        if ($stmt->execute()) { 
            return "Reservation successfully created!";
        } else {
            return "Error creating reservation.";
        }
    }

    public function calculatePrice($vehicleId, $startDate, $endDate) {
        $query = "SELECT pricePerDay FROM vehicles WHERE id = :vehicleId"; 
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":vehicleId", $vehicleId);
        $stmt->execute();
        $vehicle = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($vehicle) {
            $pricePerDay = $vehicle['pricePerDay'];
            $start = new DateTime($startDate);
            $end = new DateTime($endDate); 
            $interval = $start->diff($end); 
            $days = $interval->days;

            return $pricePerDay * $days; 
        }
      else{
        return 0; 
    }
        
    }

    public function confirmReservation($reservationId) {
        $query = "UPDATE reservations SET status = 'confirmed' WHERE id = :reservationId";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":reservationId", $reservationId);

        if ($stmt->execute()) {
            return "Reservation confirmed!";
        } else {
            return "Error confirming reservation.";
        }
    }

    public function cancelReservation($reservationId) {
        $query = "UPDATE reservations SET status = 'cancelled' WHERE id = :reservationId";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":reservationId", $reservationId);

        if ($stmt->execute()) {
            return "Reservation cancelled!";
        } else {
            return "Error cancelling reservation.";
        }
    }

    public function updateStatus($reservationId, $status) {
        $query = "UPDATE reservations SET status = :status WHERE id = :reservationId"; 
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":reservationId", $reservationId);
        $stmt->bindParam(":status", $status);

        if ($stmt->execute()) {
            return "Reservation status updated!";
        } else {
            return "Error updating reservation status.";
        }
    }

    public function getReservationById($reservationId) {
        $query = "SELECT * FROM reservations WHERE id = :reservationId";
        $stmt = $this->pdo->prepare($query);
        $stmt->bindParam(":reservationId", $reservationId);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC); 
    }
}
?>
