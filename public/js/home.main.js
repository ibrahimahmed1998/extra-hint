var stored_data = localStorage.getItem("user_data")
stored_data = JSON.parse(stored_data) ;  // console.log(stored_data.length);
const loginbtn = document.querySelector('#loginbtn');
const logout = document.querySelector('#logout');
const user_serivce = document.querySelector('#user_serivce');


 if(stored_data.length){ 
    loginbtn.style.display = "none";

    // console.log(stored_data);

 }
else{
    logout.style.display = "none";
    user_serivce.style.display = "none";
}