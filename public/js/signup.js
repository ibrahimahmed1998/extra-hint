    // $.ajaxSetup({  headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') } });
    function signup(fn,ln,phone1,email1,pass)
    {
        $.ajax({
            url:  "api/auth/add_user"  ,
            type: 'POST',
            data:{ fname:fn,  lname:ln, phone:phone1,  email:email1, password:pass   },

            success:function(response) {  alert('Joined Successfully ^_^ ') ;   var w = window.open('/')  },

            error: function(response){ var x =JSON.stringify(response) ; alert(x); } })

    }
