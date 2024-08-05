<?php
session_start();

if (!isset($_SESSION["user_id"])) {
    header("Location: main_login.php"); // Redirect to the login page if not authenticated
    exit();
}

$con=mysqli_connect('localhost','root','','digitization');
if(!$con){
    die(mysqli_error("Error"+$con));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Search</title>
    <style>
        body {
            margin:0;
            padding:0;
            font-family:calibri;
            /* background: linear-gradient(120deg, #2980b9, #8e44ad); */
            background-image:url('images/sail.jpg');
            background-size:100% 100%;
            background-repeat:no-repeat;
            background-attachment:fixed;
            height:150vh;
            overflow:hidden;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
        .top-bar {
            width: 100%;
            background: white;
            color: #2691d9;
            padding: 20px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            position: fixed;
            top: 0;
            left: 0;
            z-index: 1000;
        }
        .logo {
            margin-left: 20px;
        }
        .logo img {
            height: 50px;
        }
        .button-container {
            display: flex;
            align-items: center;
        }

        .upload-btn, .logout-btn, .article-btn, .history-btn, .awards-btn, .future_plan-btn, .operation-btn, .major_units-btn {
            padding: 10px 20px;
            /* border: 1px solid transparent; */
            background-color: transparent;
            color: black;
            /* border-radius: 25px; */
            font-size: 18px;
            font-weight: 700;
            text-decoration: none;
            cursor: pointer;
            transition: color 0.5s, border-color 0.5s;
            margin-right: 10px; /* Optional: add margin-right to only the first button if needed */
        }
        .upload-btn img {
            vertical-align: middle; /* Align the icon vertically with the text */
            margin-right: 5px; /* Space between the icon and the text */
            height: 35px;
        }
        .logout-btn img{
            vertical-align: middle; /* Align the icon vertically with the text */
            margin-right: 5px; /* Space between the icon and the text */
            height: 25px;
        }
        .upload-btn:hover, .article-btn:hover, .history-btn:hover, .awards-btn:hover, .future_plan-btn:hover, .operation-btn:hover, .major_units-btn:hover {
            color: #2691d9;
            border-color: #2691d9;
        }
        .logout-btn:hover{
            color: red;
        }
        .container {
            margin-top: 105px; /* Ensures it is not overlapped by the top bar */
            width: 70%;
            max-width: 1000px; /* To prevent it from being too wide on large screens */
            background: white;
            border-radius: 10px;
            padding: 20px;
            text-align: center;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
            text-align:center;
        }
        .container img {
            width: 80px; /* Adjust the size as needed */
            margin-bottom: 0px;
        }
        .container h1 {
            text-align: center;
            padding: 0 0 20px 0;
            border-bottom: 1px solid silver;
        }
        .container form {
            padding: 0 40px;
            box-sizing: border-box;
        }
        input[type="text"] {
            padding: 10px;
            width: 60%;
            border-radius: 50px;
            border: 1px solid #ccc;
            margin-bottom: 10px;
        }
        input[type="submit"], input[type="button"] {
            padding: 10px 20px;
            border: none;
            background-color: #007bff;
            color: white;
            border-radius: 50px;
            cursor: pointer;
        }
        input[type="submit"]:hover, input[type="button"]:hover {
            background-color: #0056b3;
        }
        .result-container {
            max-height: 300px;
            overflow-y: scroll;
            border: 1px solid #ccc;
            padding: 10px;
            margin-top: 20px;
            border-radius: 5px;
        }
        .result-container table {
            width: 100%;
        }
        .result-container th, .result-container td {
            padding: 8px;
            border-bottom: 1px solid #ddd;
        }
        .result-container th {
            background-color: #f2f2f2;
        }
        .result-container td {
            text-align: center;
        }
        .download-button {
            margin-top: 20px;
            background-color: #007bff;
            color: white;
        }
    </style>

</head>
<body>
    <div class="top-bar">
        <div class="logo">
            <img src="icons/company_icon.png" alt="Logo"> <!-- Add your logo image here -->
        </div>
        <div class="button-container">
            <a href="main_upload_form.php" class="upload-btn"><img src="icons/doc_upload_icon.png" alt="Logo"></a>
            <a href="logout.php" class="logout-btn"><img src="icons/logout_icon.png" alt="Logo"></a>
        </div>
    </div>
    <div class="container">
        <img src="icons/doc_search_icon.png" alt="Logo">
        <h1>Search Document</h1>
        <form action="#" method="POST">
            <input type="text" name="search" placeholder="Enter keywords">
            <input type="submit" name="submit" value="Search">
        </form>
        <div class="result-container">
            <!-- This is where search results will be displayed -->
            <table class="table">
                <?php
                if(isset($_POST['submit'])){
                    $search=$_POST['search'];
                    $sql="SELECT * from `tbl_documentstorage` where SuggestedKeywords like '%$search%' ";
                    $result=mysqli_query($con,$sql);
                    if($result){
                        if(mysqli_num_rows($result)>0){
                           echo '<thead>
                           <tr>
                           <th>Document Title</th>
                           <th>Preview</th>
                           <th>Download</th>
                           </tr></thead>
                           ';
                           while($row=mysqli_fetch_assoc($result)){
                            echo '<tbody>
                           <tr>
                                <td>'.$row['DocumentTitle'].'</td>
                                <td><a href="preview.php?document_id='.$row['DocumentID'].'" target="_blank"><button style="cursor:pointer;">Preview</button></a></td>
                                <td><a href="download.php?document_id='.$row['DocumentID'].'"><button style="cursor:pointer;">Download</button></a></td>
                           </tr>
                           </tbody>';
                           }
                        }else{
                            echo '<h2 class=text-danger>Data not found</h2>';
                        }
                    }
                }
                ?>  
            </table>
        </div>
    </div>
</body>
</html>

