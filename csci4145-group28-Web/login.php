<?php
// CSCI 4145: Project, WINTER 2021
// Group members: Jiahao Wang, Yixiao Yuan, Yiping Yao.
// 
// Story 1:  Login to the website

session_start();

if (isset($_SESSION['username'])) {
    header("Location: index.php");
    die();
}

require_once "includes/header.php";
require_once "includes/db.php";
?>

<?php
    if (isset($_GET['op']) && $_GET['op'] == 'register') {
?>                    
            <!-- register -->
            <div class = "row py-4 mx-auto">
                <div class="col text-center">
                    <h2>Please register</h2>
                </div>
            </div>
            <div class = "row py-3">
                <div class="col col-sm-3"></div>
                <div class="col col-sm-6">
                    <form method="post" action="includes/register.php">
                        <div class="form-group row py-2">
                            <label for="inputFirstname" class="col-sm-3 col-form-label text-center">First name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="inputFirstname" required autofocus>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="inputLastname" class="col-sm-3 col-form-label text-center">Last name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="inputLastname" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <label for="inputUsername" class="col-sm-3 col-form-label text-center">Author name</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="inputUsername" required>
                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <label for="inputPassword" class="col-sm-3 col-form-label text-center">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="inputPassword" required>
                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <label for="inputEmail" class="col-sm-3 col-form-label text-center">Email</label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="inputEmail" placeholder="name@domian.com" required>
                            </div>
                        </div>
                        <div class="form-group row py-2">
                            <div class="col-sm-9"></div>
                            <div class="col-sm-3">
                                <button type="submit" class="btn btn-primary" name="submit-register">Submit</button>
                            </div>
                        </div>

                        <?php
                            if (isset($_GET['registererror']) && $_GET['registererror'] == '1') {
                        ?>
                        <div class="py-2 alert alert-danger" id= "alertMessage" role="alert">
                            User registration failed, the author name already exists!
                        </div>
                        <?php
                            }
                        ?>
                    </form>
                </div>
                <div class="col col-sm-3"></div>
            </div>
            <!--  -->        
<?php
    }else {
?>                    
            <!-- Sign in  -->
            <div class = "row py-4 mx-auto">
                <div class="col text-center">
                    <h2>Please sign in</h2>
                </div>
            </div>
            <div class = "row py-3">
                <div class="col col-sm-4"></div>
                <div class="col col-sm-4">
                    <form method="post" action="includes/login.php">
                        <div class="form-group row py-2">
                            <label for="inputUsername" class="col-sm-3 col-form-label text-center">Username</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" name="inputUsername" required autofocus>
                            </div>
                        </div>

                        <div class="form-group row py-2">
                            <label for="inputPassword" class="col-sm-3 col-form-label text-center">Password</label>
                            <div class="col-sm-9">
                                <input type="password" class="form-control" name="inputPassword" required>
                            </div>
                        </div>

                        <div class="form-group row py-2 text-right">
                            <div class="col-sm-8 text-center ">
                                <button type="button" class="btn btn-primary" onclick="window.location.href='login.php?op=register'" >Create an Account</button>
                            </div>
                            <div class="col-sm-4">
                                <button type="submit" class="btn btn-primary" name="submit-login">Sign in</button>
                                </div>
                        </div>

                        <?php
                            if (isset($_GET['loginerror']) && $_GET['loginerror'] == '1') {
                        ?>
                        <div class="py-2 alert alert-danger" id= "alertMessage" role="alert">
                            Wrong password! please enter again!
                        </div>
                        <?php
                            }
                        ?>

                        <?php
                            if (isset($_GET['loginerror']) && $_GET['loginerror'] == '2') {
                        ?>
                        <div class="py-2 alert alert-danger" id= "alertMessage" role="alert">
                            Username does not exist! Enter again!
                        </div>
                        <?php
                            }
                        ?>

                        <?php
                            if (isset($_GET['registerok']) && $_GET['registerok'] == '1') {
                        ?>
                        <div class="py-2 alert alert-danger" id= "alertMessage" role="alert">
                            User registration successful. Please login!
                        </div>
                        <?php
                            }
                        ?>


                    </form>
                </div>
                <div class="col col-sm-4"></div>
            </div>
            <!--  -->
<?php
    }
?>                    

<?php
    require_once "includes/footer.php";
?>