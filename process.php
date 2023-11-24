<?php
if (isset($_POST['submit'])) {
    // Get form data
    $name = $_POST['name'];
    $phone_number = $_POST['phone_number'];
    $email = $_POST['email'];
    $choice = $_POST['choice'];
    $description = $_POST['description'];

    // Database connection parameters
    $host = 'localhost';
    $user = 'root';
    $pass = '';
    $dbname = 'test';

    // Create connection
    $conn = mysqli_connect($host, $user, $pass, $dbname);

    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    // Use prepared statements to prevent SQL injection
    $sql = "INSERT INTO user_data(name, phone_number, email, choice, description) VALUES (?, ?, ?, ?, ?)";

    // Prepare and check for errors
    $stmt = mysqli_prepare($conn, $sql);
    if (!$stmt) {
        die("Error in statement preparation: " . mysqli_error($conn));
    }

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "sssss", $name, $phone_number, $email, $choice, $description);

    // Execute the statement and check for errors
    if (mysqli_stmt_execute($stmt)) {
        echo "Record inserted successfully";

        // Send email
        $to = 'ishabhama1@gmail.com';
        $subject = 'New Form Submission';
        $message = "Name: $name\nPhone Number: $phone_number\nEmail: $email\nChoice: $choice\nDescription: $description";

        // Additional headers
        $headers = 'From: webmaster@example.com' . "\r\n" .
            'Reply-To: webmaster@example.com' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();

        // Send email
        mail($to, $subject, $message, $headers);
    } else {
        echo "Error in statement execution: " . mysqli_error($conn);
    }

    // Close the statement and connection
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
?>
