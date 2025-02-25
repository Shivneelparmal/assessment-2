<?php
include 'config.php';
$search = "";

//this code fetches student data from the database
//allows to search for student by name email or course using a search term
//if no search term is provided it displays all students
if(isset($_GET["search"]) && $_GET["search"] != "") {
    $search = $_GET["search"];
    $sql = "SELECT * FROM students WHERE name LIKE '%$search%' OR email LIKE '%$search%' OR course LIKE '%$search%'";
} else{
    $sql = "SELECT * FROM students";
}
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Student Management</title>
  <style>
      body {
          font-family: Arial, sans-serif;
          background-color: #f2f2f2;
          margin: 0;
          padding: 20px;
      }
      h2 {
          color: #333;
      }
      form {
          margin-bottom: 20px;
      }
      input[type="text"] {
          padding: 10px;
          border: 1px solid #ccc;
          border-radius: 4px;
          width: 300px;
      }
      button {
          padding: 10px 15px;
          background-color: #4CAF50;
          color: white;
          border: none;
          border-radius: 4px;
          cursor: pointer;
          margin-left: 10px;
      }
      button:hover {
          background-color:rgb(13, 14, 17);
      }
      a {
          text-decoration: none;
          color: #4CAF50;
      }
      a:hover {
          color:rgb(19, 20, 19);
      }
      .add-student {
          display: inline-block;
          margin-bottom: 20px;
          padding: 10px 15px;
          background-color: #2196F3;
          color: white;
          border-radius: 4px;
      }
      .add-student:hover {
          background-color: #1976D2;
      }
      table {
          width: 100%;
          border-collapse: collapse;
          background-color: #fff;
      }
      th, td {
          padding: 12px;
          text-align: left;
          border: 1px solid #ddd;
      }
      th {
          background-color:rgb(63, 50, 116);
          color: white;
      }
      tr:nth-child(even) {
          background-color: #f9f9f9;
      }
      tr:hover {
          background-color: #f1f1f1;
      }
      .action-links a {
          margin-right: 10px;
      }
  </style>
</head>
<body>
  <h2>Student List</h2>
  <form method="GET">
      <input type="text" name="search" placeholder="Search by name, email, or course" value="<?php echo $search; ?>">
      <button type="submit">Search</button>
  </form>
  <a class="add-student" href="add.php">Add Student</a>
  <table>
      <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Email</th>
          <th>Phone</th>
          <th>Course</th>
          <th>Action</th>
      </tr>
      <!--loop through student goes through each student datafrom database-->
      <?php while($row = $result->fetch_assoc()) { ?> 
      <tr>
        <!--displays the student detail id name email, phone, course in table cell--> 
          <td><?php echo $row['id']; ?></td>
          <td><?php echo $row['name']; ?></td>
          <td><?php echo $row['email']; ?></td>
          <td><?php echo $row['phone']; ?></td>
          <td><?php echo $row['course']; ?></td>
          <td class="action-links">
              <a href="edit.php?id=<?php echo $row['id']; ?>">Edit</a>
              <a href="delete.php?id=<?php echo $row['id']; ?>">Delete</a>
          </td>
      </tr>
      <?php } ?>
  </table>
</body>
</html>
