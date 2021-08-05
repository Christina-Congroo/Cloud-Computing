<?php
// CSCI 4145: Project, WINTER 2021
// Group members: Jiahao Wang, Yixiao Yuan, Yiping Yao.
// 
if (!isset($_SESSION)){
    session_start();
}

// Check whether the user login
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    die();
}

require_once "db.php";
?>

<?php
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $querySQL="SELECT A.*,U.* FROM `articles` A, users U WHERE U.userid = A.user_id and A.parent_id = {$id}";
    $result = $dbconnection->query($querySQL);
    if ($result->num_rows > 0) {
?>
                                <div class="row col-12 ml-0 py-1 shadow bg-light">
<?php
        $index = 0;
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
<?php
    }
}

?>
