function myFunction(ccode) {
    // Get the snackbar DIV
    console.log(ccode);

    var x = document.getElementById("snackbar");

    const data = { ccode : ccode};

    axios.post("couuse_data",data)  // axios(url,data)
     .then( response =>  course_data(response.data)    )    // response.data.map( elm => "sec id" + elm.Sec_id )
     .catch(error =>{
       this.errorMessage = error.message;
       console.error("There was an error!", error);
     });

     function course_data(data)
        {
        this.data = data ;
        console.log(this.data);
        var sec = document.getElementById("snackbar").innerHTML=this.data;

        }
    // Add the "show" class to DIV
    x.className = "show";

    // After 3 seconds, remove the show class from DIV
    setTimeout(function(){ x.className = x.className.replace("show",""); }, 3000);
  }
