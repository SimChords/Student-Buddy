

<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "ctu_buddy_tssm";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle file upload
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $target_dir = "uploads/";
    $file_name = basename($_FILES["pdfFile"]["name"]);
    $target_file = $target_dir . $file_name;

    // Move uploaded file to uploads directory
    if (move_uploaded_file($_FILES["pdfFile"]["tmp_name"], $target_file)) {
        // Save file info in database
        $sql = "INSERT INTO uploads (file_name) VALUES ('$file_name')";

        if ($conn->query($sql) === TRUE) {
            echo "The file " . $file_name . " has been uploaded.";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
}

$conn->close();
?>
