<?php 

include "db_connect.php";
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
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
<div class="row">
<?php include('message.php'); ?>



<div class="col-md-7 ms-5">
<h1 class="text-center mt-5">Student Details</h1>

<table class="table table-bordered" style="background-color: white; width:100%" id="myTable">
  <thead class="table-dark">
    <tr>
      <th scope="col">ID</th>
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Department</th>
      <th scope="col">Result</th>
      <th scope="col">Blood Group</th>
      <th scope="col">Actions</th>
     
    </tr>
  </thead>
  <tbody>
     <?php 
      // $sql = "SELECT * FROM `student_details`";

     $query = "SELECT student_details.id,student_details.student_name,student_details.phone,student_details.depertment,student_details.blood_group,result.result FROM student_details JOIN result ON student_details.id = result.id";

      $result = mysqli_query($connection, $query);

      while($row = mysqli_fetch_array($result)){
        ?>
         <tr>

<td><?php echo $row['id']; ?></td>

<td><?php echo $row['student_name']; ?></td>

<td><?php echo $row['phone']; ?></td>

<td><?php echo $row['depertment']; ?></td>

<td><?php echo $row['result']; ?></td>

<td><?php echo $row['blood_group']; ?></td>



<td ><a class="btn btn-primary" href="update.php?id=<?php echo $row['id']; ?>">Edit</a>
<a class='btn btn-danger'  href="delete.php?id=<?php echo $row['id']; ?>" >Delete</a>
</td>

</tr> 


















<?php 
      }
    
    ?>


  </tbody>
</table>
</div>


<div class="col-md-3 ms-5">
<h1 class="text-center mt-4">Input</h1>
  <!-- <a class="btn btn-primary" href="create.php">Add Student</a> -->
  <?php 
include "db_connect.php";
// session_start();

if (isset($_POST['submit'])) {

    $id = $_POST['id'];
    $student_name = $_POST['student_name'];
    $phone = $_POST['phone'];
    $depertment = $_POST['depertment'];
    $result = $_POST['result'];
    $blood_group = $_POST['blood_group'];
    

     if($id && $student_name && $phone && $depertment && $result && $blood_group){
  
      if(!$connection){
        die("Not connected!" );
      }else{
      
  

  $query = "INSERT INTO `student_details`(`id`, `student_name`, `phone`, `depertment`, `blood_group`) VALUES ('$id','$student_name','$phone','$depertment','$blood_group')";
  $query2 = "INSERT INTO `result`(`id`, `result`) VALUES ('$id','$result')";

  $result = mysqli_query($connection,$query);
  $result2 = mysqli_query($connection,$query2);
 
  if(!$result && !$result2){
   die("Data not insert.");
  }
  $_SESSION['message'] = "Data Created Successfully";
  header('Location: view.php');
  exit(0);
      } 
     }else{
        $_SESSION['message'] = "Data Not Created";
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

    
    <div class=" mx-auto">

      <form action="view.php" method="POST">
        <div class="mb-2">
          <label for="exampleInputId" class="form-label">ID</label>
          <input
            type="text"
            name="id"
            class="form-control"
            id="exampleInputId"
          />
        </div>
        <div class="mb-2">
          <label for="exampleInputName" class="form-label">Name</label>
          <input
            type="text"
            name="student_name"
            class="form-control"
            id="exampleInputName"
            aria-describedby="student_nameHelp"
          />
        </div>
        <div class="mb-2">
          <label for="exampleInputphone" class="form-label"
            >Phone Number</label
          >
          <input
            type="text"
            name="phone"
            class="form-control"
            id="exampleInputphone"
            aria-describedby="PhoneHelp"
          />
        </div>
        <div class="mb-2">
          <label for="exampleInputdepartment" class="form-label">Department</label>
          <input
            type="text"
            name="depertment"
            class="form-control"
            id="exampleInputdepartment"
          />
        </div>
        <div class="mb-2">
          <label for="exampleInputdepartment" class="form-label">Result</label>
          <input
            type="text"
            name="result"
            class="form-control"
            id="exampleInputdepartment"
          />
        </div>

        <div class="mb-2">
          <label for="exampleInputbloodgroup" class="form-label">Blood Group</label>
          <input
            type="text"
            name="blood_group"
            class="form-control"
            id="exampleInputbloodgroup"
          />
        </div>
        
        <button name="submit" type="submit" class="btn btn-primary w-100">
          Submit
        </button>
      </form>
    </div>
    
  </body>
</html>








</div>




</div>

<script>

</script>
</body>
</html>