<?php
include 'config.php';//database connection
$message = ""; //to store success and error mssg

if ($_SERVER["REQUEST_METHOD"] == "POST") { //checks form was posted by POST method
    // Trim input values to remove any extra spaces
    $name   = trim($_POST["name"]);
    $email  = trim($_POST["email"]);
    $phone  = trim($_POST["phone"]);
    $course = trim($_POST["course"]);

    // Check if any field is empty
    if(empty($name) || empty($email) || empty($phone) || empty($course)) {
        $message = "Error: All fields are required.";
    } else {
        // SQL query to insert the student
        $sql = "INSERT INTO students (name, email, phone, course) VALUES ('$name', '$email', '$phone', '$course')";
        if($conn->query($sql) === TRUE) { //execute query and handle results
            $message = "Student added successfully";
        } else {
            $message = "Error: " . $conn->error;
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Add Student</title>
  <style>
      body {
          font-family: Arial, sans-serif;
          background-color: #f2f2f2;
          margin: 0;
          padding: 20px;
      }
      h2 {
          text-align: center;
          color: #333;
      }
      .container {
          max-width: 500px;
          margin: 20px auto;
          background-color: #fff;
          padding: 30px;
          border-radius: 8px;
          box-shadow: 0 2px 10px rgba(0,0,0,0.1);
      }
      .message {
          text-align: center;
          margin-bottom: 20px;
          color: #333;
      }
      form input[type="text"],
      form input[type="email"] {
          width: 100%;
          padding: 10px;
          margin: 10px 0;
          border: 1px solid #ccc;
          border-radius: 4px;
          box-sizing: border-box;
      }
      form button {
          width: 100%;
          padding: 10px;
          background-color: rgb(48, 37, 113);
          color: white;
          border: none;
          border-radius: 4px;
          cursor: pointer;
          font-size: 16px;
      }
      form button:hover {
          background-color: #45a049;
      }
  </style>

</head>
<body>
  <h2>Add Student</h2>
  <div class="container">
      <?php if($message != ""): ?>
          <div class="message"><?php echo $message; ?></div>
      <?php endif; ?>
      <form method="POST">
          <input type="text" name="name" placeholder="Name" >
          <input type="email" name="email" placeholder="Email" >
          <input type="text" name="phone" placeholder="Phone" >
          <input type="text" name="course" placeholder="Course" >
          <button type="submit">Add Student</button>
          <button type="button" class="back-button" onclick="window.location.href='index.php';">Back to Index</button>
      </form>
  </div>
</body>
</html>
