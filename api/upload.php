<?php
// d) Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    // e) Check if the 'image' element exists in the $_FILES array
    if (isset($_FILES['image'])) {
        // Print the contents of the uploaded file's array
        
        print_r($_FILES['image']);
        $destination = 'img/webcam.jpg';
        if (move_uploaded_file($_FILES['image']['tmp_name'], $destination)) {
            echo "Image uploaded successfully to $destination.";
        } else {
            echo "Error: Failed to move the uploaded file.";
        }
        
    } else {
        // 'image' key not found in uploaded files
        echo "Error: No file uploaded with the name 'image'.";
    }

} else {
    // Request method is not POST
    echo "Error: This endpoint only accepts POST requests.";
}
?>
