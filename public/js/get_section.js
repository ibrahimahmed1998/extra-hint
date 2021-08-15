function get_section(dep_id)  // axios(url , data)
{
  console.log("Department ID: "+dep_id);
  const data = { dep_id : dep_id };

   axios.post("list_section",data)
    .then(  response =>  getdata(response.data)    )    // response.data.map( elm => "sec id" + elm.Sec_id )
    .catch(error =>{
      this.errorMessage = error.message;
      console.error("There was an error!", error);
    });

}

function getdata(data)
{
  this.data = data ;
  var sec = document.getElementById("get_section").innerHTML = this.data;
}

