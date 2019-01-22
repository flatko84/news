function del(id){
    $('#del-form').attr('action', '/post/' + id);
    var confirmation = confirm("Delete article?");
    if (confirmation == true){
    $('#del-form').submit();
    }
}