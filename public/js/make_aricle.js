//let csrf = $('meta[name="csrf-token"]').attr('content'); //         var token =  "{{ csrf_token() }}";
//$.ajaxSetup({  headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });

function make_article(title, body, sub_title, category) {
    $.ajax({
        url: "api/auth/article",
        type: 'POST', //contentType:'application/json',
        headers: {
            'Authorization': `Bearer ${token}`
        },
        data: {
            title: title,
            body: body,
            sub_title: sub_title,
            category: category,
        },

        success: function (response) {
            alert('Article Created Successfully ...');
            console.log(response);
        },
        error: function (err) {
            var x = JSON.stringify(err);
            console.log(x);
            alert(x);
        }
    })
}
