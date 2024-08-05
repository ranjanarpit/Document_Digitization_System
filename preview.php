<?php
$con = mysqli_connect('localhost', 'root', '', 'digitization');
if (!$con) {
    die(mysqli_error("Error" + $con));
}

if (isset($_GET['document_id'])) {
    $document_id = $_GET['document_id'];
    $sql = "SELECT * FROM `tbl_documentstorage` WHERE DocumentID = $document_id";
    $result = mysqli_query($con, $sql);
    if ($result) {
        $row = mysqli_fetch_assoc($result);
        $document_title = $row['DocumentTitle'];
        $document_url = $row['DocumentURL'];

        // Display the PDF using an iframe covering the full screen
        echo "<h2>Preview of Document: $document_title</h2>";
        echo "<iframe src='$document_url' style='width: 100%; height: 100vh; border: none;'></iframe>";
    } else {
        echo "Error: " . mysqli_error($con);
    }
} else {
    echo "Document ID not provided.";
}
?>

