$(document).ready(function () {

    $('#choose_cat').on('change',function () {
        var category_id = $(this).val();
        //console.log(category_id);
        
    });

    $('.category_delete').on('click', function(){
        var category_id = $(this).attr('data-id');
        $('.del').attr('action',"delete/"+category_id+"");
    })

    $('.category_edit').on('click', function(){
        var category_id = $(this).attr('data-id');
        var new_category = $(this).parent().parent().text();
        $('.edit').attr('action', "editCategory/"+category_id+"");
        $('.edit_category').val(new_category);
    })

    $('.post_edit').on('click', function(){
        var post_id = $(this).attr('data-id');
        var new_post = $(this).parent().parent().find('.post').text(); 
        $('.editPost').attr('action', "editPost/"+post_id+"");
        $('.edit_post').val(new_post);
    })

    $('.post_delete').on('click', function(){
        var post_id = $(this).attr('data-id');
        $('.delete').attr('action',"deletePost/"+post_id+"");
    })

})