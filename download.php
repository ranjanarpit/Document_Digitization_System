<?php
$con = mysqli_connect('localhost', 'root', '', 'digitization');
if (!$con) {
    die(mysqli_error("Error" + $con));
}

if (isset($_GET['document_id'])) {
    $document_id = $_GET['document_id'];
    $sql = "SELECT * FROM `tbl_documentstorage` WHERE DocumentID = '$document_id'";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $document_title = $row['DocumentTitle'];
        $document_path = $row['DocumentURL'];

        // Download the document
        $file_path = "C:/xampp/htdocs/digitization/" . $document_path; // Change this path to the actual path where your documents are stored
        echo "File path: " . $file_path; // Add this line for debugging
        if (file_exists($file_path)) {
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($file_path) . '"');
            readfile($file_path);
            exit;
        } else {
            echo "File not found.";
        }
    } else {
        echo "Error: " . mysqli_error($con);
    }
} else {
    echo "Document ID not provided.";
}
?>
