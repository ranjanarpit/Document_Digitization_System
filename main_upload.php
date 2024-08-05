<?php
session_start();

// Check if the user is authenticated
// || !isset($SESSION["username"]) added 
if (!isset($_SESSION["user_id"])) {
    header("Location: main_login.php"); // Redirect to the login page if not authenticated
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "digitization";
    $document_table = "TBL_DocumentStorage";

    $conn = new mysqli($servername, $username, $password, $dbname);

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $user_id = $_SESSION["user_id"];
    $loginusername = $_SESSION["username"];

    if (isset($_FILES["document"]) && $_FILES["document"]["error"] == 0) {
        $target_dir = "uploads/";
        $timestamp = date("dmYHis"); // Get the current timestamp in the format DDMMYYYYHHmmss
        $originalfilename = basename($_FILES["document"]["name"]);
        $filenameWithoutExtension = pathinfo($originalfilename, PATHINFO_FILENAME);
        $fileExtension = pathinfo($originalfilename, PATHINFO_EXTENSION);
        $allowedExtensions = array("pdf");

        $newfilename = $filenameWithoutExtension . "_" . $timestamp . "." .$fileExtension;
        $target_file = $target_dir . $newfilename;
        
        if (in_array(strtolower($fileExtension), $allowedExtensions)) {
            if (move_uploaded_file($_FILES["document"]["tmp_name"], $target_file)) {
            $sql = "INSERT INTO $document_table (DocumentTitle, DocumentURL, Active, CreatedBy, UpdatedBy, CreatedOn, UpdatedOn) 
            VALUES ('$originalfilename', '$target_file', 1, '$user_id', '$user_id', now(), now() )";
            
            if ($conn->query($sql) === TRUE) {
                echo "File uploaded successfully by user_id: $user_id.";
                $last_inserted_id = $conn->insert_id;
                $_SESSION["insert_id"] = $last_inserted_id;
                header("Location: main_wordcount.php");
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
        } else {
            echo "Invalid file extension. Allowed extensions are: " . implode(", ", $allowedExtensions);
        }
        
    } else {
        echo "Error: " . $_FILES["document"]["error"];
    }

}
?>
