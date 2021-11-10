<!-- Modal -->
<div class="modal fade" id="signmodal" tabindex="-1" aria-labelledby="signmodalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="signmodalLabel">Signup to iDiscuss</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="partials/handlesignup.php" method="post">
                <div class="modal-body">
                    <div class="mb-1">
                        <label for="fullname" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="fullname" name="fullname" required>
                    </div>
                    <div class="mb-1">
                        <label for="validationCustomUsername" class="form-label">Username</label>
                        <input type="text" class="form-control" id="validationCustomUsername" name="username" required>
                    </div>
                    <div class="mb-1">
                    <label for="question" class="form-label">Question</label>
                        <select class="form-select" name="question" id="question" aria-label="Default select example">
                            <option selected>Open this select menu</option>
                            <option value="1">What is your favourite book name?</option>
                            <option value="2">What is your favourite sports team?</option>
                            <option value="3">What is your favourite game?</option>
                            <option value="4">What is your hobby?</option>
                            <option value="5">What is your nickname?</option>
                            <option value="6">What is your first school name?</option>
                        </select>
                    </div>
                    <div class="mb-1">
                        <label for="answer" class="form-label">Answer</label>
                        <input type="text" class="form-control" id="answer" name="answer" required>
                        <div id="textHelp" class=" mb-1 form-text">We'll never change your password if you fargot answer</div>
                    </div>
                    <div class="mb-1">
                        <label for="signupEmail" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="signupEmail" name="signupEmail"
                            aria-describedby="emailHelp" required>
                        <!-- <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div> -->
                    </div>
                    <div class="mb-1">
                        <label for="exampleInputPassword1" class="form-label">Password</label>
                        <input type="password" class="form-control" id="signupPassword" name="signupPassword" required>
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="signupcPassword" name="signupcPassword"
                            required>
                    </div>
                    
                    <!-- <?php

                    echo '<script type=text/JavaScript>
                        let pass = document.getElementById("signupPassword");
                        let cpass = document.getElementById("signupcPassword");
                        
                    </script>';

                    ?> -->
                    <button type="submit" class="btn btn-primary">Signup</button>
                </div>
            </form>
        </div>
    </div>
</div>