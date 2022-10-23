<?php 

include "db_connect.php"; 

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    $sql = "DELETE FROM `student_details` WHERE `id`='$id'";

    //  $result = $con->query($sql);
     $result = mysqli_query($connection, $sql);

     if ($result == TRUE) {


        $_SESSION['message'] = "Data Deleted Successfully";
        header("Location: view.php");
        exit(0);
        $_SESSION['message'] = "Data Not Deleted";
        header("Location: view.php");
        exit(0);

        }

    }else{

        echo "Error:" . $sql . "<br>" . $connection->error;

    }



?>