<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the database connection file
    include_once "db_connection.php";
    
    // Escape user inputs for security
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    
    // Validate input
    if (empty($username) || empty($password)) {
        echo "Please fill all fields.";
    } else {
        // Attempt to insert user into database
        $sql = "INSERT INTO tbl_users (username, password) VALUES ('$username', '$password')";
        if (mysqli_query($conn, $sql)) {
            echo "Registration successful!";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
    }
    
    // Close connection
    mysqli_close($conn);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Registration</title>
    <style>
    body {
        margin: 0;
        padding: 0;
        font-family: calibri;
        background-image: url('images/sail.jpg');
        background-size: 100% 100%;
        background-repeat: no-repeat;
        background-attachment: fixed;
        height: 100vh;
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
    .article-btn, .history-btn, .awards-btn, .future_plan-btn, .operation-btn, .major_units-btn {
        margin-right: 10px;
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
    }
    .login-btn {
        display:flex;
        align-items: center;
    }
    .login-btn img {
            vertical-align: middle; /* Align the icon vertically with the text */
            margin-right: 28px; /* Space between the icon and the text */
            height: 50px; /* Adjust the icon size as needed */
    }
    .login-btn:hover, .article-btn:hover, .history-btn:hover, .awards-btn:hover, .future_plan-btn:hover, .operation-btn:hover, .major_units-btn:hover {
        color: #2691d9;
        border-color: #2691d9;
    }

    .center {
        margin-top: 10px; /* Adjusted to ensure the form is not under the top bar */
        width: 400px;
        background: white;
        border-radius: 10px;
        padding: 40px;
        box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
    }
    .center img {
        width: 50px; /* Adjust the size as needed */
        margin-bottom: 0px;
    }
    .center h1 {
        text-align: center;
        padding: 0 0 20px 0;
        border-bottom: 1px solid silver;
    }
    .center form {
        padding: 0 40px;
        box-sizing: border-box;
    }
    form .txt_field {
        position: relative;
        border-bottom: 2px solid #adadad;
        margin: 30px 0;
    }
    .txt_field input {
        width: 100%;
        padding: 0 5px;
        height: 40px;
        font-size: 16px;
        border: none;
        background: none;
        outline: none;
    }
    .txt_field label {
        position: absolute;
        top: 50%;
        left: 5px;
        color: #adadad;
        transform: translateY(-50%);
        font-size: 16px;
        pointer-events: none;
        transition: 0.5s;
    }
    .txt_field span::before {
        content: '';
        position: absolute;
        top: 40px;
        left: 0;
        width: 0%;
        height: 2px;
        background: #2691d9;
        transition: 0.5s;
    }
    .txt_field input:focus ~ label,
    .txt_field input:valid ~ label {
        top: -5px;
        color: #2691d9;
    }
    .txt_field input:focus ~ span::before,
    .txt_field input:valid ~ span::before {
        width: 100%;
    }
    input[type="submit"] {
        width: 100%;
        height: 40px;
        border: 1px solid;
        background: #2691d9;
        border-radius: 25px;
        font-size: 18px;
        color: #e9f4fb;
        font-weight: 700;
        cursor: pointer;
        outline: none;
    }
    input[type="submit"]:hover {
        border-color: #2691d9;
        transition: 0.5s;
    }
    p {
        text-align: center;
    }
</style>

</head>
<body>
    <div class="top-bar">
        <div class="logo">
            <img src="icons/company_icon.png" alt="Logo"> <!-- Add your logo image here -->
        </div>
        <div class="button-container">
            <a class="article-btn" href="articles.html">Articles</a>
            <a class="history-btn" href="history.html">History</a>
            <a class="major_units-btn" href="major_units.html">Major Units</a>
            <a class="operation-btn" href="operations.html">Operations</a>
            <a class="awards-btn" href="awards.html">Awards</a>
            <a class="future_plan-btn" href="Future_plans.html">Future Plans</a>
            <a class="login-btn" href="main_login.php"><img src="icons/login_icon.jpg" alt="logo"></a>
        </div>
    </div>
    <div class="center">
        <img src="icons/signup_icon.png" alt="Logo">
        <h1>Signup</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
            <div class="txt_field">
                <input type="username" name="username" id="username" required>
                <span></span>
                <label>username(companyID)</label>
            </div>
            <div class="txt_field">
                <input type="password" name="password" id="password" required>
                <span></span>
                <label>password</label>
            </div>
            <input type="submit" value="Register">
        </form>
    </div>
</body>
</html>
