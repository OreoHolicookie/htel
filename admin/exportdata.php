<?php

include '../config.php';

// Assuming you have already created the stored procedure named export_roombook_data in your database

// Execute the stored procedure
mysqli_query($conn, "CALL export_roombook_data()");

// Define the filename for the Excel file
$filename = "isekaiinn_roombook_data_" . date('Ymd') . ".xls";

// Set the headers for Excel file download
header("Content-Type: application/vnd.ms-excel");
header("Content-Disposition: attachment; filename=\"$filename\"");
header("Pragma: no-cache");
header("Expires: 0");

// Specify the path to the Excel file
$filepath = "C:/xampp/htdocs/htel/xcel/$filename";

// Output the contents of the Excel file
readfile($filepath);
exit;

?>
