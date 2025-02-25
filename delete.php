<?php
include 'config.php';
$id = $_GET['id'];
$sql = "DELETE FROM students WHERE id= $id";//sql query delete the student record from the student table on the provided id

if($conn->query($sql) === TRUE){   //sql query if successful display message student deleleted
    echo "Student Deleted Successfully";

}else{
    echo " Error:" . $conn->error;   //if error displays error message
}
?>
