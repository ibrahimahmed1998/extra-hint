function login(email, password) {
    $.ajax({
        url: "api/auth/login",
        type: 'POST',
        data: { email: email, password: password },

        success: function (response) {
            var token = response["token"];
            var type = response["type"];
            var name = response["fname"];

            localStorage.setItem('token', token);
            localStorage.setItem('type', type);
            localStorage.setItem('name', name);

            if (type == 1) { window.location.href = '/admin'; }
            else if (type == 2) { window.location.href = '/visitor'; }

        },
        error: (err) => {
            var x = JSON.stringify(err);
            console.log(x);
            alert(x);
        }
    })
}
