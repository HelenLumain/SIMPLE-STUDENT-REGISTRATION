<?php
include ('db.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize inputs to prevent SQL injection and XSS attacks (crucial!)
    $student_id = mysqli_real_escape_string($conn, $_POST['student_id']);
    $first_name = mysqli_real_escape_string($conn, $_POST['first_name']);
    $middle_initial = mysqli_real_escape_string($conn, $_POST['middle_initial']);
    $last_name = mysqli_real_escape_string($conn, $_POST['last_name']);
    $date_of_birth = mysqli_real_escape_string($conn, $_POST['date_of_birth']);
    $gender = mysqli_real_escape_string($conn, $_POST['gender']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);


    $sql = "INSERT INTO basic_information (student_id, first_name, middle_initial, last_name, date_of_birth, gender, email, phone) 
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

    $stmt = $conn->prepare($sql); // Removed unnecessary 'query:'

    if ($stmt === false) {
        die("Prepare failed: (" . $conn->errno . ") " . $conn->error);
    }

    // Correct bind_param usage
    $stmt->bind_param("isssssss", $student_id, $first_name, $middle_initial, $last_name, $date_of_birth, $gender, $email, $phone);


    if ($stmt->execute()) {
        echo "<script>alert('Student Registered Successfully!'); window.location.href='index.php';</script>";
    } else {
        // More informative error handling
        die("Execute failed: (" . $stmt->errno . ") " . $stmt->error);
    }

    $stmt->close();
    // $conn->close();  // Consider keeping the connection open for efficiency if multiple queries are needed.
}
?>