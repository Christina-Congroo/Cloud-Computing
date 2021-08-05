<?php
// CSCI 4145: Project, WINTER 2021
// Group members: Jiahao Wang, Yixiao Yuan, Yiping Yao.
// 
//  Story 4 : See a list of all the article
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

$querySQL="";
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $querySQL="SELECT A.*,U.* FROM `articles` A, users U WHERE U.userid = A.user_id and A.id = {$id}";
    $_SESSION['current_id'] = $id;
}else{
    if ($_SESSION['current_id']>0) {
        $id = $_SESSION['current_id'];
        $querySQL="SELECT A.*,U.* FROM `articles` A, users U WHERE U.userid = A.user_id and A.id = {$id}";
        $_SESSION['current_id'] = $id;
    }else{
        $querySQL="SELECT A.*,U.* FROM `articles` A, users U WHERE U.userid = A.user_id and A.parent_id = 0";
    }
}


$result = $dbconnection->query($querySQL);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
?>
                        <section class="py-3">
                            <div class="row  mx-auto  p-2 bg-light align-items-center">
                                <div class="col text-left">
                                    <?php echo $row["date"] ?>
                                </div>
                                <div class="col text-right">
                                    <a href="#"><?php echo $row["username"] ?></a>
                                </div>
                                <?php 
                                    if ($userlevel == 1) {
                                ?>
                                <div class="col-3 text-right">
                                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal"
                                        data-target="#postModal" id="new-fiction" name="new-fiction" onclick="parent_article(<?php echo $row['id']; ?> );return false;">Add</button>
                                    <button type="button" class="btn btn-secondary btn-sm" data-toggle="modal"
                                            data-target="#postModal" id="edit-fiction" name="edit-fiction" onclick="get_article(<?php echo $row['id']; ?>);return false;">Edit</button>
                                    <!-- <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#postModal" id="del-fiction" name="del-fiction" onclick="get_article(<?php echo $row['id']; ?>);return false;">Delete</button> -->

                                    <button type="button" class="btn btn-danger btn-sm" data-toggle="modal" data-target="#staticBackdrop" id="del-fiction" name="del-fiction">Delete</button>                                            
                                </div>
                                <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Del fiction</h5>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body">
                                            Confirm to delete content?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            <button type="button" class="btn btn-primary"  onclick='del_article(<?php echo $row["id"].",".$row["parent_id"] ;?>); return false;'>OK</button>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <?php 
                                    }
                                ?>
                            </div>
                            <div class="row border-top mx-auto pl-3 pt-3 pb-1 text-justify">
                                <?php  
                                    $str = $row["title"];
                                    $str = str_replace(PHP_EOL, '<br>', $str);
                                    echo "<h6>".$str."</h6>";
                                ?>
                            </div>
                            <div class="row border-top mx-auto p-3 text-justify">
                                <?php  
                                    $str = $row["content"];
                                    $str = str_replace(PHP_EOL, '<br>', $str);
                                    echo $str;
                                ?>
                            </div>
                            <div class="row mx-auto py-2" id="nextAera" style="display:none">
                            </div>
                            <div class="row border-top border-bottom mx-auto py-2 mt-3">
                                <div class="col">
                                    <?php
                                        if ($row["parent_id"]>0) {
                                    ?>
                                    <a onclick='refreshArticleContainer("article.php?id=<?php echo $row["parent_id"]; ?>");return false;' href="#">Back</a>
                                    <?php
                                        }
                                    ?>
                                </div>
                                <div class="col">
                                    <!-- <a href="#" onclick="changeLikeID(<?php echo $row['id']; ?>);">Like</a><span id="like_count"><?php echo " (".$row["like_count"].")" ?></span> -->
                                </div>
                                <div class="col">
                                    <a href="#" onclick="showNext(<?php echo $row['id']; ?>);">Next</a>
                                </div>
                            </div>
                        </section>
<?php
    }
}
?>