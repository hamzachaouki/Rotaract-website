
<!DOCTYPE html>

<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Submission</title>
</head>
<body>
    <h1>Form Submitted Successfully!</h1>
    <?php
    require('connection.php');
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Sanitize and retrieve POST data
        $name = htmlspecialchars($_POST['name']);
        $email = htmlspecialchars($_POST['email']);
        $subject = htmlspecialchars($_POST['subject']);
        $message = htmlspecialchars($_POST['message']);

        // Display the submitted data
        echo "<p>Name: $name</p>";
        echo "<p>Email: $email</p>";
        echo "<p>Subject: $subject</p>";
        echo "<p>Message: $message</p>";

        // Insert data into the database
        $stmt = $conn->prepare("INSERT INTO rotaract (nom, email, subject, message) VALUES (?, ?, ?, ?)");
        $stmt->bind_param("ssss", $name, $email, $subject, $message);

        if ($stmt->execute()) {
            echo "<p>Data inserted successfully into the database.</p>";
        } else {
            echo "<p>Error: " . $stmt->error . "</p>";
        }

        // Close the statement and connection
        $stmt->close();
        $conn->close();
    } else {
        echo "<p>Invalid request.</p>";
    }
    ?>
</body>
</html>
