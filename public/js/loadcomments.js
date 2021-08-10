function load_comments(article_id,token)
{
    $.ajax({
        url: "api/auth/listcomments",
        type: 'POST', //contentType:'application/json',
        headers: {
            'Authorization': `Bearer ${token}`
        },
        data: {art_id:article_id},

        success: function (response)
        {
            var arr = [];

            for (let i = 0; i < response.length; i++) { arr[i] = response[i]; }

            $("[comments='true']").remove();

            for (let i = 0; i < arr.length; i++)
            {
                var indiv = document.createElement("div");
                indiv.setAttribute("class", "card-body");
                indiv.setAttribute("id", arr[i].id);
                indiv.setAttribute("comments","true");

                var h5 = document.createElement("h5");
                h5.setAttribute("class", "card-title");
                h5.innerHTML = "User ID:" + arr[i].user_id;
                indiv.appendChild(h5);

                var p = document.createElement("p");
                p.setAttribute("class", "card-text");
                p.innerHTML = arr[i].body;
                indiv.appendChild(p);

                var bigdiv = document.createElement("div");
                bigdiv.setAttribute("class", "bg-white overflow-hidden shadow-sm sm:rounded-lg");

                var smalldiv = document.createElement("div");
                smalldiv.setAttribute("class", "collapse");
                smalldiv.setAttribute("id", "collapseExample"+i+"x");
                bigdiv.appendChild(smalldiv);

                var artdiv = document.createElement("div");
                artdiv.setAttribute("class", "bg-white overflow-hidden shadow-sm sm:rounded-lg");
                artdiv.setAttribute("id", "article");
                smalldiv.appendChild(artdiv);

                var br = document.createElement("br");
                artdiv.appendChild(br);

                indiv.appendChild(bigdiv);

                if(article_id != null)
                {
                    document.getElementById(article_id).appendChild(indiv);

                }
            }
         },
        error: function (err)
        {
            console.log(err.status);
            console.log(err.responseText);
        }
    })
}
