function logout(token) {
    $.ajax({
        url: "api/auth/logout",
        type: 'POST', //contentType:'application/json',
        headers: { 'Authorization': `Bearer ${token}` },

        success: function (response) {

            localStorage.removeItem("token");
            localStorage.removeItem("type");
            localStorage.removeItem("name");

            alert('Logout Successfully ...');
            window.location.href = '/';

        },
        error: function (err){

            localStorage.removeItem("token");
            localStorage.removeItem("type");
            localStorage.removeItem("name");

            var x = JSON.stringify(err);
            console.log(x);
            alert(x);
        }
    });
}
