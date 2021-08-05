// CSCI 4145: Project, WINTER 2021
// Group members: Jiahao Wang, Yixiao Yuan, Yiping Yao.
// 
// Code by: Yixiao Yuan 

$("#left-col-area").css("height",$(window).height()-90);

function refreshArticleContainer(phpfile) {
    //form : https://www.w3schools.com/jquery/jquery_ajax_get_post.asp
    //date : 2021-03-21
    $.get(phpfile, function (data) {
        $("#article_container").html(data);
    });
}

//
function input_textarea_size(){
    var maxsize = 4096;
    var inputtext = $("#input-textarea").val();
    var inputsize = inputtext.length;
    $("#inputsize").html("&nbsp&nbsp&nbsp&nbsp&nbsp&nbspWords: "+String(inputsize)+"/"+String(maxsize));
}

$("#input-textarea").on("keyup",function() {
    input_textarea_size();
});

$("#input-textarea").on("mousedown",function() {
    input_textarea_size();
});

//
function get_article(id) {
    if (id == 0 ) {
        set_modal(0,"","",0);
    }else{
        $.get('includes/getarticle.php?id='+id,function(data){
            var words = data.split("^^^vv^^^");
            set_modal(words[0],words[1],words[2],words[3]);
        });
    }
    $("#ModalLabel").text("Edit content");
};
//
function set_modal(id,title,content,parent_id){
    $("#article_id").val(id);
    $("#parent_id").val(parent_id);
    $("#input-title").val(title);
    $("#input-textarea").html(content);
}
// 
function del_article(id,parent_id) {
    $.get('includes/delete.php?id='+id,function(data){
        refreshArticleContainer("article.php?id="+parent_id);
    });

    $('#staticBackdrop').modal('hide');
    $('.modal-backdrop').remove();
};

//
function parent_article(parent_id){
    set_modal(0,"","",parent_id);
    $("#ModalLabel").text("New content");
}

// ----------
function showNext(id){
    var obj = "#nextAera";
    if ($(obj).css('display')=='none') {
        $.get('includes/next.php?id='+id,function(data){
            $(obj).html(data);
        });
        $(obj).fadeIn();
    } else {
        $(obj).fadeOut();;        
    }
}

// -------------
function changeLikeID(id){
    var obj = "#like_count";
    $.get('includes/like.php?id='+id,function(data){
        $(obj).text(data);
    });
    
}


