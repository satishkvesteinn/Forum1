<?php include '../partials/dbconnect.php';?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>admin - welcome back</title>
</head>

<body>
    <?php
    session_start();
    if(isset($_SESSION['loggedin']) && ($_SESSION['loggedin'] == true)){
    include '../partials/dbconnect.php';
    if(isset($_GET['threadid'])){
    $id = $_GET['threadid'];
     $sql1 =  "DELETE FROM `threads` WHERE thread_id= $id";
     $result1 = mysqli_query($conn, $sql1);
     if($result1){
     header("Location: /idiscuss/admin/allquestions.php");
     echo "success";
    }else{
      header("Location: /idiscuss/admin/allquestions.php");
      echo "failed";
     }
    }
    }else{
      header("Location: /idiscuss/admin/index.php");
    }

?>


<!-- all user there -->
<div class="container d-flex justify-content-center mt-3 mb-3 bg-info"><h3><strong>All Questions</strong></h3></div>
<div class="container d-flex justify-content-center" style="box-shadow: 0px 0px 2px 2px grey;">
    
<?php 
    include '../partials/dbconnect.php';
    $i = 1;
    $sum = 0;
    $sql = "SELECT thread_id, thread_tittle , thread_desc FROM threads";
    $result = mysqli_query($conn, $sql);
  if (mysqli_num_rows($result) > 0) {
    echo '<table class="table">
  <thead>
    <tr>
      <th scope="col">S. NO.</th>
     
      <th scope="col">Tittle</th>
      <th scope="col">Answer</th>
      <th scope="col">User Name</th>
      <th scope="col">Delete</th>
    </tr>
  </thead>';
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
    //   echo "id: " . $row["sno"]. " - Name: " . $row["firstname"]. " " . $row["lastname"]. "<br>";
      echo '<tbody>
      <tr>
        <th>'. $i .'</th>
        <td>'. $row["thread_tittle"].'</td>
        <td>'. $row["thread_desc"].'</td>
        <td>'. $row["thread_id"] .'</td>
        <td class="p-1 align-self-center align-items-center"><a href="allquestions.php?threadid='.$row["thread_id"].'" class="btn btn-primary" role="button" type="button" >Delete</a></td>
        
      </tr>
        
     </tbody>';
     $sum = $sum + 1;
      $i++;
    }
  } else {
    echo '<div class="jumbotron jumbotron-fluid p-5 mt-3">
    <div class="container">
      <h1 class="display-4">No Questions are found</h1>
      <p class="lead">This is a modified jumbotron that occupies the entire horizontal space of its parent.</p>
    </div>
  </div>';
  }
  
echo '</table>';


echo '</div>
<div class="container p-0 mt-3 d-flex justify-content-end">
<span class="btn me-2 btn-info">Total Questions = '. $sum.'</span>
                    <a class="btn btn-primary" role="button" href="index.php">Go back</a>
                </div>';
                ?>



    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous">
    </script>
    

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js" integrity="sha384-7+zCNj/IqJ95wo16oMtfsKbZ9ccEh31eOz1HGyDuCQ6wgnyJNSYdrPa03rtR1zdB" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js" integrity="sha384-QJHtvGhmr9XOIpI6YVutG+2QOK9T+ZnN4kzFN1RtK3zEFEIsxhlmWl5/YESvpZ13" crossorigin="anonymous"></script>
    -->
</body>

</html>