<?php
// CSCI 4145: Project, WINTER 2021
// Group members: Jiahao Wang, Yixiao Yuan, Yiping Yao.
// 
// 

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/css/bootstrap.min.css" integrity="sha384-B0vP5xmATw1+K9KRQjQERJvTumQW0nPEzvF6L/Z6nronJ3oUOFUFpCjEUQouq2+l" crossorigin="anonymous">    
    <!-- Bootstrap core JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>    
    <title>Van Kira</title>
</head>

<body>
    <header>
        <!-- <img src="img/title.jpg" class="img-fluid" alt="..."> -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <div class="container">
                <a class="navbar-brand" href="index.php?main=1">Van Kira</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto">
                        <!-- <li class="nav-item active">
                            <a class="nav-link" href="#">Home <span class="sr-only">(current)</span></a>
                        </li> -->
                    </ul>
                    <form class="form-inline my-2 my-lg-0">
                        <input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
                        <button class="btn btn-outline-success my-2 my-sm-0" type="submit" onclick='refreshBlogContainer("search.php");return false;' >Search</button>
                    </form>
                </div>
            </div>
        </nav>
    </header>
    <main id="pg-main-content">
        <div class="container">
            <?php
                if (isset($_SESSION['username'])) {                                    
            ?>

            <div class="row py-3 text-center">
                <div class="col-2 border-right text-center" id="left-col-area">
                    <div class="row">
                        <div class="list-group col-12 " id="list-tab" role="tablist">
                            <a class="list-group-item list-group-item-action active" id="list-home" onclick='refreshArticleContainer("article.php");return false;' href="">Home</a>
                            <a class="list-group-item list-group-item-action" id="list-profile" onclick='refreshArticleContainer("profile.php");return false;' href="">Profile</a>
                            <!-- <a class="list-group-item list-group-item-action" id="list-ilike" onclick='refreshArticleContainer("ilike.php");return false;' href="">I like</a> -->
                            <a class="list-group-item list-group-item-action" id="list-logout" href="logout.php">Logout</a>
                        </div>
                        <?php 
                            if ($_SESSION['user_level'] == 1) {
                        ?>
                        <div class="row mx-auto py-3">
                            <button type="button" class="btn btn-primary" data-toggle="modal"
                                data-target="#postModal" id="new-fiction" name="new-fiction" onclick="get_article(0);return false;">New fiction</button>
                        </div>
                        <?php 
                            }
                        ?>
                    </div>
                    <div class="row p-2">
                        <img src="img/left.jpg" alt="">
                    </div>
                </div>
                <!-- post article -->
                <div class="modal fade" id="postModal" tabindex="-1" data-backdrop="static" aria-labelledby="postModalLabel" aria-hidden="true">
                    <div class="modal-dialog  modal-lg" >
                        <div class="modal-content" >
                            <div class="modal-header mb-1">
                                <h5 class="modal-title" id="ModalLabel" name="ModalLabel">New content</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <form method="post" action="post.php">
                                <div class="modal-body text-left">
                                    <div class="form-group">
                                        <label for="input-title" class="col-form-label">Title:</label>
                                        <input type="text" class="form-control" id="input-title" name="title-text" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="message-text" class="col-form-label">Content:</label><small id="inputsize"></small>
                                        <textarea class="form-control" id="input-textarea" name="message-text" rows="8" required></textarea>
                                        <input type="text" id="article_id" name="article_id" hidden>
                                        <input type="text" id="parent_id" name="parent_id" hidden>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-primary" name="submit-postarticle">Submit</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>

            <?php 
                }
            ?>
