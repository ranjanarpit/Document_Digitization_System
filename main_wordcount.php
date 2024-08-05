<!DOCTYPE html>
<html lang="en"> 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Word Count</title>
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

        .search-btn, .upload-btn, .logout-btn, .article-btn, .history-btn, .awards-btn, .future_plan-btn, .operation-btn, .major_units-btn {
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
        .search-btn img {
            vertical-align: middle; /* Align the icon vertically with the text */
            margin-right: 5px; /* Space between the icon and the text */
            height: 25px;
        }
        .upload-btn img {
            vertical-align: middle; /* Align the icon vertically with the text */
            margin-right: 5px; /* Space between the icon and the text */
            height: 32px;
        }
        .logout-btn img{
            vertical-align: middle; /* Align the icon vertically with the text */
            margin-right: 5px; /* Space between the icon and the text */
            height: 25px;
        }
        .search-btn:hover, .upload-btn:hover, .article-btn:hover, .history-btn:hover, .awards-btn:hover, .future_plan-btn:hover, .operation-btn:hover, .major_units-btn:hover {
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
            width:600px;
            background:white;
            border-radius:10px;
        }
        .center h1{
            text-align:center;
            padding:0 0 20px 0;
            border-bottom:1px solid silver;
        }
        p{
            margin-left:10px;
        }
        strong{
            margin-left:10px;
        }
        h4{
            margin-left:10px;
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
            <a href="main_upload_form.php" class="upload-btn"><img src="icons/doc_upload_icon.png" alt="Logo"></a>
            <a href="logout.php" class="logout-btn"><img src="icons/logout_icon.png" alt="Logo"></a>
        </div>
    </div>
    <div class="center">
        <h1>Searchable Keywords</h1>
        <?php
        session_start();

        // Check if the user is authenticated
        if (!isset($_SESSION["user_id"])) {
            header("Location: main_login.php"); // Redirect to the login page if not authenticated
            exit();
        }

        $user_id = $_SESSION["user_id"];
        echo "<p>File uploaded successfully</p>";

        $insert_id = $_SESSION["insert_id"];
        // echo "Insert ID: $insert_id.<br><br>";

        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "digitization";

        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }

        $sql = "SELECT DocumentURL from TBL_DocumentStorage where DocumentID = $insert_id";
        $result = $conn->query($sql);
        $url = $result->fetch_assoc()["DocumentURL"];
        // echo "The url: $url.";


        // code to read pdf file
        $pdfFilePath = $url;
        // echo "The target file: ". $pdfFilePath;

        // Use the pdftotext class to extract text from the PDF
        class PdfToText
        {
            protected $pdfFilePath;
            public function __construct($pdfFilePath)
            {
                $this->pdfFilePath = $pdfFilePath;
            }
            public function getText()
            {
                // Use shell_exec to execute the pdftotext command
                $command = 'pdftotext ' . escapeshellarg($this->pdfFilePath) . ' -';
                $output = shell_exec($command);
                return $output;
            }
        }

        // Create an instance of the PdfToText class
        $pdfToText = new PdfToText($pdfFilePath);

        // Get the text from the PDF
        $pdfText = $pdfToText->getText();

        // // Display the extracted text
        // echo "the PDF text is: ";
        // echo $pdfText;

        function countWords($str) {
            // Convert the string to lowercase to make the comparison case-insensitive
            $str = strtolower($str);

            // Use str_word_count to get an array of words
            $words = str_word_count($str, 1);

            // Arrays of words to exclude
            $pronouns = array("i", "you", "he", "she", "it", "we", "they", "me", "him", "her", "us", "them", "my", "your", "his", "her", "its", "our", "their", "theirs", "this", "that", "these", "those", "who", "whom", "which", "what", "whose", "all", "any", "each", "every", "no one", "none", "some", "anybody", "anyone", "anything", "each other", "one another", "myself", "yourdelf", "himself",  "herself", "itself", "ourselves", "themselves","myself", "yourself", "himself", "herself", "itself", "ourselves", "themselves"); 
            $adjectives = array("more","successfully", "most", "good", "bad", "happy", "sad", "big", "small", "accurate", "acceptable", "colorful", "creative", "famous", "healthy", "honest", "neat", "nice", "obedient", "powerful", "qiet", "responsible", "rich", "poor", "smart", "serious", "strong", "unique", "useful", "wise", "average", "old", "new", "important", "first", "second", "third", "fourth", "fifth", "sixth", "seventh", "eighth", "nineth", "tenth");
            $verbs = array("is", "are","complete", "completed", "am", "was", "were", "be", "been", "have", "do", "make", "go", "take", "come", "see", "see", "get", "give", "know", "think", "find", "say", "tell", "use", "look", "work", "call", "try", "ask", "leave", "feel", "put", "mean", "keep", "let", "help", "talk", "start", "show", "move", "like", "believe", "bring", "write", "read", "listen", "understand", "skip", "draw", "become", "appear", "remain", "sound", "grow", "stay", "can", "should", "must", "will", "could", "would", "may", "might", "shall", "should");
            $adverbs = array("not", "very", "too", "always", "never", "almost", "usually", "occasionally", "regularly", "never", "rarely", "hardly", "often", "generally", "particularly", "recently", "immediately", "soon", "truly", "completely", "mostly", "perfectly", "frequently", "normally", "extremely", "quite", "rather", "slightly", "highly", "partially", "fully", "nearly", "deeply", "carefully", "easily", "quickly", "slowly", "loudly", "softly", "accurately", "everywhere", "here", "anywhere", "anyplace", "somewhere", "nowhere", "abroad", "outdoors", "upstairs", "downstairs", "inside", "underground", "across", "throughout", "above", "below", "sometimes", "previous", "previously", "simultaneous", "simultaneously", "previously", "furthermore", "also", "consequently", "otherwise", "moreover", "thus", "accordingly", "instead", "similar", "similarly", "consequently", "hence", "therefore", "subsequently", "where", "when", "why", "what", "how");
            $conjunctions = array("and", "nor", "but", "or", "even", "for", "yet", "so", "although", "because", "if", "unless", "until", "while", "as", "since", "after", "before", "though", "whether", "once", "either", "neither", "not", "only", "also");
            $prepositions = array("in","about","has", "like", "unlike", "on", "at", "by", "with", "from", "to", "into", "onto", "upon", "over", "under", "between", "among", "through", "across", "around", "during");
            $articles = array("the", "a", "an");
            $numbers = array("one", "two", "three", "four", "five", "six", "seven", "eight", "nine", "ten");

            // Combine exclusion arrays
            $excludedWords = array_merge($pronouns, $adjectives, $verbs, $adverbs, $conjunctions, $prepositions, $articles, $numbers);

            // Remove excluded words from the array
            $filteredWords = array_diff($words, $excludedWords); 

            // Use array_count_values to count the occurrences of each word
            $wordCount = array_count_values($filteredWords);

            $sort_order = $wordCount;
            asort($sort_order);

            $length = count($sort_order);
            
            if (empty($sort_order)) {
                $items = "No text in the file";
            }
            elseif ($length <= 3) {
                $items = array_slice($sort_order, 0, 1);
            }
            else {
                $items = array_slice($sort_order, 0, 3);
            }

            return $items;
        }

        // Example usage:
        $string = $pdfText;
        $wordCounts = countWords($string);

        // Display the word counts
        // if (gettype($wordCounts) == 'array') {
        //     echo "<strong>Keywords:-</strong><br>";
        //     $i = 1;
        //     foreach ($wordCounts as $word => $count) {
        //         echo "$i. $word<br>";
        //         $i++;
        //     }
        // } else {
        //     echo $wordCounts;
        // }
        if (gettype($wordCounts) == 'array') {
            // echo "Original String: $string <br>";
            
            // Initialize an array to hold keywords
            $keywords = array();
        
            foreach ($wordCounts as $word => $count) {
                // Append each keyword to the array
                $keywords[] = $word;
            }
        
            // Convert the array of keywords to a comma-separated string
            $keywordsString = implode(', ', $keywords);

            $updateSql = "UPDATE TBL_DocumentStorage SET SuggestedKeywords = '$keywordsString' WHERE DocumentID = $insert_id";
            $result = $conn->query($updateSql);
            // echo $result;
        
            // Display the keywords in the specified format
            // echo "Keywords: [$keywordsString] <br>";
            echo "<h4>Keywords:-</h4>";
            $i = 1;
            foreach ($wordCounts as $word => $count) {
                echo "<p>$i. $word</p>";
                $i++;
            }
        }
        else {
            echo $wordCounts;
        }
        ?>
    </div>
</body>
</html>

