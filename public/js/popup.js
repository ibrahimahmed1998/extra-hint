function myFunction(ccode) {
    // Get the snackbar DIV
    console.log(ccode);

    var x = document.getElementById("snackbar");

    const data = { ccode : ccode};

    axios.post("list_course",data)  // axios(url,data)
     .then( response =>  get_dep(response.data)    )    // response.data.map( elm => "sec id" + elm.Sec_id )
     .catch(error =>{
       this.errorMessage = error.message;
       console.error("There was an error!", error);
     });


    // Add the "show" class to DIV
    x.className = "show";

    // After 3 seconds, remove the show class from DIV
    setTimeout(function(){ x.className = x.className.replace("show",""); }, 3000);
  }
