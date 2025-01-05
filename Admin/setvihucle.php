<?php
require_once '../classes/classvihcule.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    try {
        $vehicle = new Vehicle();
        
        $modelData = isset($_POST['model'][0]) ? $_POST['model'][0] : '';
        $brandData = isset($_POST['brand'][0]) ? $_POST['brand'][0] : '';
        $descriptionData = isset($_POST['description'][0]) ? $_POST['description'][0] : '';
        $pricePerDayData = isset($_POST['pricePerDay'][0]) ? $_POST['pricePerDay'][0] : '';
        $statusData = isset($_POST['status'][0]) ? $_POST['status'][0] : '';
$categoryId = isset($_POST['categoryname'][0]) ? $_POST['categoryname'][0] : '';

        if (isset($_FILES['image'])) {
            $imageData = [
                'name' => $_FILES['image']['name'][0],
                'type' => $_FILES['image']['type'][0],
                'tmp_name' => $_FILES['image']['tmp_name'][0],
                'error' => $_FILES['image']['error'][0],
                'size' => $_FILES['image']['size'][0]
            ];
            $vehicle->uploadImage($imageData);
        }
        
        
        $characteristicsData = json_encode([
            'model' => $modelData,
            'brand' => $brandData
        ]);
        
        
        $currentDate = date("Y-m-d H:i:s");
        
        $result = $vehicle->save(
            $modelData,
            $brandData,
            $descriptionData,
            $pricePerDayData,
            $statusData,
            $categoryId,
            $characteristicsData,
            $vehicle->image,  // This is set by uploadImage method
            $currentDate
        );
        
        if ($result) {
            echo "Vehicle saved successfully!";
        } else {
            echo "Error saving vehicle.";
        }
        
    } catch (Exception $e) {
        echo "Error: " . $e->getMessage();
        // For debugging:
        error_log("Vehicle Save Error: " . $e->getMessage());
    }
}
?>