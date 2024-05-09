<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<?php

include '../config.php';

$id = $_GET['id'];

// Call the stored procedure
$sql = "CALL ProcessRoomBooking($id)";
$result = mysqli_query($conn, $sql);

if ($result) {
    // Fetch the result of the stored procedure
    $row = mysqli_fetch_assoc($result);
    
    // Display appropriate message based on the result
    echo $row['message'];

    echo '<script>
            setTimeout(function() {
                window.location.href = "roombook.php";
            }, 3000); // Redirect after 3 seconds (adjust as needed)
          </script>';
    // Optionally, you can also use $row['icon'] to determine the icon for displaying the message
} else {
    // Handle error if the stored procedure call fails
    echo "Error: Unable to process booking.";
}

mysqli_close($conn);

?>