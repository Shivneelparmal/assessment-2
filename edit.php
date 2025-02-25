
<?php
include 'config.php';

// Validate and retrieve the student ID from the URL.
//check if the id is provided in the url
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = intval($_GET['id']);
} else {
    die("Invalid or missing student ID.");
}

// Direct SQL query for selecting the student details.
$sql = "SELECT * FROM students WHERE id = $id"; // sql query to fetch the student detail from the database
$result = mysqli_query($conn, $sql);

if (!$result) { // check for errors .. if query fails stop and display error
    die("Error: " . mysqli_error($conn));
}

$row = mysqli_fetch_assoc($result); //fetches student data as associative array $row 
                                           // so you display in the  form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the form data.
    $name   = $_POST['name'];
    $email  = $_POST['email'];
    $phone  = $_POST['phone'];
    $course = $_POST['course'];

    // Direct SQL query for updating the student record.
    $sql = "UPDATE students SET 
                name = '$name', 
                email = '$email', 
                phone = '$phone', 
                course = '$course' 
            WHERE id = $id";
    
    if (mysqli_query($conn, $sql)) { //query runs if succes display Students
        echo "Student updated successfully";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Edit Student</title>
        <style>
            button.back-button {
                margin-top: 10px;
                background-color: #ccc;
                color: #333;
                border: none;
                padding: 10px 20px;
                border-radius: 4px;
                cursor: pointer;
            }
            button.back-button:hover {
                background-color: #bbb;
            }
        </style>
    </head>
    <body>
        <h2>Edit Student</h2>
        <form method="POST">
          <input type="text" name="name" placeholder="Name" value="<?php echo htmlspecialchars($row['name']); ?>" required>
          <input type="email" name="email" placeholder="Email" value="<?php echo htmlspecialchars($row['email']); ?>" required>
          <input type="text" name="phone" placeholder="Phone" value="<?php echo htmlspecialchars($row['phone']); ?>" required>
          <input type="text" name="course" placeholder="Course" value="<?php echo htmlspecialchars($row['course']); ?>" required>
          <button type="submit">Update</button>
          <!-- Back to Index button -->
          <button type="button" class="back-button" onclick="window.location.href='index.php';">Back to Index</button>
      </form>
    </body>
</html>
