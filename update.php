<?php 
session_start();
require 'db_connect.php';

if(isset($_POST['update'])){
  $id = $_POST['id'];
  $student_name = $_POST['student_name'];
  $phone = $_POST['phone'];
  $depertment = $_POST['depertment'];
  $result = $_POST['result'];
  $blood_group = $_POST['blood_group'];
 

  $query = "UPDATE student_details SET id='$id',student_name='$student_name',phone='$phone',depertment='$depertment',blood_group='$blood_group' where id='$id'";

  $query2 = "UPDATE result SET id='$id',result='$result' where id='$id'";

  $result = mysqli_query($connection,$query);
  $result2 = mysqli_query($connection,$query2);

  if($result && $result2){
    $_SESSION['message'] = "Data Updated Successfully";
    header('Location: view.php');
        exit(0);
    
  }else{
    $_SESSION['message'] = "Student Not Updated";
    header("Location: create.php");
    exit(0);
  }
}


?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta student_name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Erp Task</title>
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-Zenh87qX5JnK2Jl0vWa8Ck2rdkQ2Bzep5IDxbcnCeuOxjzrPF/et3URy9Bv1WTRi"
      crossorigin="anonymous"
    />
    <script
      src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.2/dist/js/bootstrap.bundle.min.js"
      integrity="sha384-OERcA2EqjJCMA+/3y+gxIOqMEjwtxJY7qPCqsdltbNJuaOe923+mo//f6V8Qbsw3"
      crossorigin="anonymous"
    ></script>
  </head>
  <body>
  <?php include('message.php'); ?>

    <h1 class="text-center">Student Details</h1>
    <?php 
    if(isset($_GET['id'])){
       $id= mysqli_real_escape_string($connection,$_GET['id']);
        $query = "SELECT * FROM student_details where id='$id'";

        $query2 = "SELECT * FROM result where id='$id'";

        $result = mysqli_query($connection,$query);
        $result2 = mysqli_query($connection,$query2);

        if(mysqli_num_rows($result) && mysqli_num_rows($result2)  > 0){

            $student = mysqli_fetch_array($result);
            $gpa = mysqli_fetch_array($result2);
           ?>
 <div class="w-25 mx-auto">

<form action="update.php" method="POST">
  <div class="mb-3">
    <label for="exampleInputId" class="form-label">ID</label>
    <input
      type="text"
      name="id"
      class="form-control"
      id="exampleInputId"
      value="<?=$student['id']; ?>"
    />
  </div>
  <div class="mb-3">
    <label for="exampleInputName" class="form-label">Name</label>
    <input
      type="text"
      name="student_name"
      class="form-control"
      value="<?=$student['student_name']; ?>"
      id="exampleInputName"
      aria-describedby="student_nameHelp"
    />
  </div>
  <div class="mb-3">
    <label for="exampleInputPhone" class="form-label"
      >Phone</label
    >
    <input
      type="phone"
      name="phone"
      value="<?=$student['phone']; ?>"
      class="form-control"
      id="exampleInputphone"
      aria-describedby="phoneHelp"
    />
  </div>
  <div class="mb-3">
    <label for="exampleInputdepertment" class="form-label">Depertment</label>
    <input
      type="text"
      name="depertment"
      value="<?=$student['depertment']; ?>"
      class="form-control"
      id="exampleInputdepertment"
    />
  </div>

  <div class="mb-3">
    <label for="exampleInputdepertment" class="form-label">Result</label>
    <input
      type="text"
      name="result"
      value="<?=$gpa['result']; ?>"
      class="form-control"
      id="exampleInputResult"
    />
  </div>

  <div class="mb-3">
    <label for="exampleInputdepartment" class="form-label">Blood Group</label>
    <input
      type="text"
      name="blood_group"
      value="<?=$student['blood_group']; ?>"
      class="form-control"
      id="exampleInputbloodgroup"
    />
  </div>

  <button name="update" type="submit" class="btn btn-primary w-100">
    Update
  </button>
</form>
</div>
           <?php
        }else{
            echo "<h4>No such id found!</h4>";
        }
    }
    ?>

   
    
  </body>
</html>