# Document_Digitization_System
Introduction<br>
Welcome to the Document Digitization System repository, developed specifically for Steel Authority of India Limited (SAIL). This project aims to streamline document management by providing a robust platform for digitizing documents, extracting text content, identifying unique keywords, and facilitating efficient retrieval.<br><br>

Vision<br>
Our vision is to modernize document handling within SAIL by leveraging technology to improve accessibility, searchability, and overall efficiency in managing vast amounts of information. Through automated text extraction and keyword analysis, we aim to enhance productivity and decision-making processes across departments.<br><br>

Mission<br>
Our mission is to develop a user-friendly system that integrates seamlessly into SAIL's existing infrastructure, offering personnel a simple yet powerful tool for document digitization, storage, and retrieval. By providing comprehensive search, preview, and download functionalities, we empower users to access critical information quickly and securely.<br><br>

Project Details<br>
Technologies Used: HTML, CSS (Frontend), PHP, MySQL (Backend)<br>
Key Features:<br>
a) User Authentication: Secure signup and login functionality.<br>
b) Document Upload: Capability to upload PDF documents.<br>
c) Text Extraction: Automated extraction of text content from uploaded documents.<br>
d) Keyword Analysis: Identification of unique keywords for efficient document retrieval.<br>
e) Navigation Bar: Provides essential information about SAIL and easy access to system features.<br>
f) Search Functionality: Enables users to search for documents based on keywords.<br>
g) Preview and Download: Allows users to preview documents and download them as needed.<br><br>

Usage<br>
a) To deploy and use the Document Digitization System:<br>
b) Clone the repository to your local environment.<br>
c) Set up a MySQL database (provided in support section) and import the provided schema.<br>
d) Configure database credentials in the PHP files.<br>
e) Host the project on a PHP-enabled web server.<br>
f) Access the system through a web browser and start using its features.<br><br>

Support<br>
1. Download and install Xampp server (apache and MySQL)<br><br>
2. Ensure to download Poppler library (v23.11.0) for pdf-to-text conversion.<br><br> 
3. Database Schema- create a database “digitization” with the following tables:<br><br>
a) tbl_users: Stores user credentials.<br>
CREATE TABLE tbl_users (
UserId INT AUTO_INCREMENT PRIMARY KEY,
Username VARCHAR(50) NOT NULL UNIQUE,
Password VARCHAR(255) NOT NULL
);<br><br>
b) tbl_documentstorage: Stores document details and extracted Keywords.<br>
CREATE TABLE tbl_documentstorage (
DocumentID INT AUTO_INCREMENT PRIMARY KEY,
DocumentTitle VARCHAR(255) NOT NULL,
SuggestedKeywords VARCHAR(255),
DocumentURL VARCHAR(255) NOT NULL,
Active BOOLEAN DEFAULT TRUE,
CreatedBy INT,
CreatedOn TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
UpdatedBy INT,
UpdatedOn TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON
UPDATE CURRENT_TIMESTAMP
);<br><br>
4. For any inquiries or issues related to this project, please contact on email address mentioned above or submit an issue through GitHub's issue tracker.<br><br>

Contributors<br>
Developer: Arpit Ranjan<br>
Contact: arpitranjan204@gmail.com<br>
LinkedIn: https://www.linkedin.com/in/arpit-ranjan-86100822b/<br>
GitHub: https://github.com/ranjanarpit<br><br>
