function get_course(dep_id,sec_id)
{
  console.log("Department ID: "+ dep_id + " sec ID : "+ sec_id);

  const data = { sec_id : sec_id , dep_id : dep_id };

   axios.post("list_course",data)  // axios(url,data)
    .then( response =>  get_dep(response.data)    )    // response.data.map( elm => "sec id" + elm.Sec_id )
    .catch(error =>{
      this.errorMessage = error.message;
      console.error("There was an error!", error);
    });
}

function get_dep(data)
{
  this.data = data ;
//    console.log(this.data);
  document.getElementById("get_course").innerHTML = this.data;
 }
