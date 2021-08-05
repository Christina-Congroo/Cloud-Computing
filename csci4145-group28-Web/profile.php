<?php
// CSCI 4145: Project, WINTER 2021
// Group members: Jiahao Wang, Yixiao Yuan, Yiping Yao.
// 
//  Story 2 : View my profile after I have logged in

if (!isset($_SESSION)){
    session_start();
}

// Check whether the user login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    die();
}
// Get the user's id, name, etc.
$username = $_SESSION['username']; //first name + " " + last name
$authorname = $_SESSION['authorname']; //author name
$userid = $_SESSION['user_id'];// user id
$userlevel = $_SESSION['user_level'];// user level

require_once "includes/db.php";
?>

<?php

$querySQL="SELECT U.* FROM users U WHERE U.userid = {$userid}";
$result = $dbconnection->query($querySQL);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
?>
    <br>
    <div class = "row m-2 py-3  shadow border ">
        <div class="col col-sm-2"></div>
        <div class="col col-sm-8">
            <div class="form-group row py-2">
                <label for="inputFirstname" class="col-sm-3 col-form-label text-center">User name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="inputFirstname" value= '<?php echo $row["username"]; ?>' readonly>
                </div>
            </div>
            <div class="form-group row py-2">
                <label for="inputUsername" class="col-sm-3 col-form-label text-center">Author name</label>
                <div class="col-sm-9">
                    <input type="text" class="form-control" name="inputUsername" value= '<?php echo $row["authorname"]; ?>' readonly>
                </div>
            </div>

            <div class="form-group row py-2">
                <label for="inputEmail" class="col-sm-3 col-form-label text-center">Email</label>
                <div class="col-sm-9">
                    <input type="email" class="form-control" name="inputEmail" value= '<?php echo $row["email"]; ?>' readonly>
                </div>
            </div>
        </div>
        <div class="col col-sm-3"></div>
    </div>
    <br>
<?php
}
?>
<!--  -->
<?php
$querySQL="SELECT A.*,U.* FROM `articles` A, users U WHERE U.userid = A.user_id and U.userid = {$userid}";
$result = $dbconnection->query($querySQL);

if ($result->num_rows > 0) {
    $index = 0;
?>
    <div class = "row m-2 py-3  shadow border ">
<?php

    while ($row = $result->fetch_assoc()) {
        $index += 1;
        $title = $row["title"];
        $like_count = $row["like_count"];
?>
        <div class="col-2 mb-2"><?php echo $index; ?></div>
        <div class="col-10 mb-2 text-left"><a onclick='refreshArticleContainer("article.php?id=<?php echo $row["id"]; ?>");return false;' href=""><?php echo $title; ?></a></div>

        <!-- <div class="col-2 mt-2">Like (<?php //echo $like_count ?>)</div> -->
<?php
    }
?>
    </div>    
    <br>

<?php
}
?>

