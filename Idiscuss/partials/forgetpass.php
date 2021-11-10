<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>idisucss - welcome back</title>
</head>

<body>

<!-- forget password request on server -->
    <?php 

        if($_SERVER['REQUEST_METHOD'] == "POST"){
            if(isset($_POST['submit'])){
                include 'dbconnect.php';
                $user_email = $_POST['useremail'];
                $user_name = $_POST['username'];
                $user_question = $_POST['question'];
                $user_answer = $_POST['answer'];
                
                $existsql = "SELECT * FROM `users` WHERE user_names = '$user_name' AND user_email = '$user_email' AND user_question = '$user_question' AND user_answer = '$user_answer'";
                $result = mysqli_query($conn, $existsql);
                $numRows = mysqli_num_rows($result);
                if($numRows == 1){
                    header("Location: changepass.php?username=$user_name");
                    exit();
                }else{
                    header("Location: forgetpass.php?success=false");
                }
                mysqli_close($conn);
             }
        }
        
    ?>

<!-- forget password section -->

    <div class="container">
        <div class="row d-flex justify-content-center" style="margin-top: 60px;">
            <div class="col-8" style="box-shadow: 0px 0px 2px 2px grey;">
                <?php 
                $success = isset($_GET['success']);
                if($success =='false'){
                    echo '<div class="alert alert-warning alert-dismissible fade show" role="alert">
                    <strong>Holy guacamole!</strong> You should check in on some of those fields below.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>';
                } ?>
                <form action="" method="post">
                    <div class="modal-body">
                        <div class="mb-1">
                            <label for="username" class="form-label">Username</label>
                            <input type="text" class="form-control" id="username" name="username" required>
                        </div>
                        <div class="mb-1">
                            <label for="useremail" class="form-label">Email address</label>
                            <input type="email" class="form-control" id="useremail" name="useremail"
                                aria-describedby="emailHelp" required>
                            <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                        </div>
                        <div class="mb-1">
                            <label for="question" class="form-label">Question</label>
                            <select class="form-select" name="question" id="question"
                                aria-label="Default select example">
                                <option selected>Open this select menu</option>
                                <option value="1">What is your favourite book name?</option>
                                <option value="2">What is your favourite sports team?</option>
                                <option value="3">What is your favourite game?</option>
                                <option value="4">What is your hobby?</option>
                                <option value="5">What is your nickname?</option>
                                <option value="6">What is your first school name?</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="answer" class="form-label">Answer</label>
                            <input type="text" class="form-control" id="answer" name="answer" required>
                        </div>
                        <button type="submit" name="submit" class="px-5 py-2 btn btn-primary">Next</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

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