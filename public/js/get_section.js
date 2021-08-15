function get_section(dep_id)
{
  console.log("Department ID: "+dep_id);

  $( "#course_layout" ).remove();

  const data = { dep_id : dep_id };

   axios.post("list_section",data)  // axios(url,data)
    .then(  response =>  get_sec(response.data)    )    // response.data.map( elm => "sec id" + elm.Sec_id )
    .catch(error =>{
      this.errorMessage = error.message;
      console.error("There was an error!", error);
    });
}

function get_sec(data)
{
  this.data = data ;
//   console.log(this.data);
  var sec = document.getElementById("get_section").innerHTML=this.data;
//   console.log(sec);

}

