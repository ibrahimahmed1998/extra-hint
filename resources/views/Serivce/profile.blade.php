 <script>
     var stored_data = localStorage.getItem("user_data")

     //  if(stored_data){ console.log(stored_data)}

     var mydata = JSON.parse(stored_data);
     delete mydata[0];
     delete mydata[1];
     delete mydata[6];

     console.log(mydata)
 </script>

 <h1 id="fruit"></h1>
 <script>
     var text = "";
     var i;

     mydata.forEach((item, ind, arr) => {

         for (var key in item) {
             console.log(key, item[key]);
             text += key + ` : ` + item[key] + "<br>"
         }
      })

     document.getElementById("fruit").innerHTML = text;
 </script>
