# Document_Digitization_System
Introduction
Welcome to the Document Digitization System repository, developed specifically for Steel Authority of India Limited (SAIL). This project aims to streamline document management by providing a robust platform for digitizing documents, extracting text content, identifying unique keywords, and facilitating efficient retrieval.

Vision
Our vision is to modernize document handling within SAIL by leveraging technology to improve accessibility, searchability, and overall efficiency in managing vast amounts of information. Through automated text extraction and keyword analysis, we aim to enhance productivity and decision-making processes across departments.

Mission
Our mission is to develop a user-friendly system that integrates seamlessly into SAIL's existing infrastructure, offering personnel a simple yet powerful tool for document digitization, storage, and retrieval. By providing comprehensive search, preview, and download functionalities, we empower users to access critical information quickly and securely.

Project Details
Technologies Used: HTML, CSS (Frontend), PHP, MySQL (Backend)
Key Features:
User Authentication: Secure signup and login functionality.
Document Upload: Capability to upload PDF documents.
Text Extraction: Automated extraction of text content from uploaded documents.
Keyword Analysis: Identification of unique keywords for efficient document retrieval.
Navigation Bar: Provides essential information about SAIL and easy access to system features.
Search Functionality: Enables users to search for documents based on keywords.
Preview and Download: Allows users to preview documents and download them as needed.

Usage
To deploy and use the Document Digitization System:
Clone the repository to your local environment.
Set up a MySQL database (provided in support section) and import the provided schema.
Configure database credentials in the PHP files.
Host the project on a PHP-enabled web server.
Access the system through a web browser and start using its features.

Contributors
Developer: Arpit Ranjan
Contact: arpitranjan204@gmail.com
LinkedIn: https://www.linkedin.com/in/arpit-ranjan-86100822b/
GitHub: https://github.com/ranjanarpit

Support
For any inquiries or issues related to this project, please contact on email address mentioned above or submit an issue through GitHub's issue tracker.

Database Schema:
Create a database “digitization” with the following tables:

a) tbl_users: Stores user credentials.
CREATE TABLE tbl_users (
UserId INT AUTO_INCREMENT PRIMARY KEY,
Username VARCHAR(50) NOT NULL UNIQUE,
Password VARCHAR(255) NOT NULL
);

b) tbl_documentstorage: Stores document details and extracted Keywords.
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
);
