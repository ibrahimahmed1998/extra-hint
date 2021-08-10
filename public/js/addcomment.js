
function addcomment(body, id) {
    $.ajax({
        url: "api/auth/addcomment",
        type: 'POST',   //contentType:'application/json',
        headers: { 'Authorization': `Bearer ${token}` },
        data: { body: body, articles_id: id },
        success: function (response) {
            alert('Comment Added Successfully ...');
            console.log(response);
        },
        error: function (err) { var x = JSON.stringify(err); alert(x); }
    })
}
