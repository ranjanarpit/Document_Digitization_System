<?php
session_start();



// Check if the user is authenticated
if (!isset($_SESSION["user_id"])) {
    header("Location: main_login.php"); // Redirect to the login page if not authenticated
    exit();
}


?>
<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document Upload Form</title>
    <style>
        body{
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
        }
        .top-bar {
            width: 100%;
            background: white;
            color: #2691d9;
            padding: 20px 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
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

        .search-btn, .logout-btn, .article-btn, .history-btn, .awards-btn, .future_plan-btn, .operation-btn, .major_units-btn {
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
        .search-btn img, .logout-btn img {
            vertical-align: middle; /* Align the icon vertically with the text */
            margin-right: 5px; /* Space between the icon and the text */
            height: 25px; /* Adjust the icon size as needed */
        }
        .search-btn:hover, .article-btn:hover, .history-btn:hover, .awards-btn:hover, .future_plan-btn:hover, .operation-btn:hover, .major_units-btn:hover {
            color: #2691d9;
            border-color: #2691d9;
        }
        .logout-btn:hover{
            color: red;
        }
        .center{
            position:absolute;
            top:50%;
            left:50%;
            transform:translate(-50%, -50%);
            width:400px;
            background:white;
            border-radius:10px;
            text-align:center;
        }
        .center img {
            width: 80px; /* Adjust the size as needed */
            margin-bottom: 0px;
        }
        .center h1{
            text-align:center;
            padding:0 0 20px 0;
            border-bottom:1px solid silver;
        }
        .center form{
            padding:0 40px;
            box-sizing:border-box;
        }
        label {
            display: block;
            margin-bottom: 10px;
        }
        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 4px;
            box-sizing: border-box;
        }
        input[type="submit"]{
            width:100%;
            height:40px;
            border:1px solid;
            background:#2691d9;
            border-radius:25px;
            font-size:18px;
            color:#e9f4fb;
            font-weight:700;
            cursor:pointer;
            outline:none;
        }
        input[type="submit"]:hover{
            border-color:#2691d9;
            transition:0.5s;
        }
        p{
            text-align:center;
        }
    </style>
</head>
<body>
    <div class="top-bar">
        <div class="logo">
            <img src="icons/company_icon.png" alt="Logo"> <!-- Add your logo image here -->
        </div>
        <div class="button-container">
            <a href="search.php" class="search-btn"><img src="icons/doc_search_icon.png" alt="Logo"></a>
            <a href="logout.php" class="logout-btn"><img src="icons/logout_icon.png" alt="Logo"></a>
        </div>
    </div>
    <div class="center">
        <img src="icons/doc_upload_icon.png" alt="Logo">
        <h1>Upload Document</h1>
        <form action="main_upload.php" method="post" enctype="multipart/form-data">
            <label for="document">Select Document:</label>
            <input type="file" name="document" id="document" accept=".pdf">
            <br>
            <input type="submit" value="Upload">
        </form>
        <p>Upload Documents in PDF Format *</p>
    </div>
</body>
</html>
