  
function hide_syntax(tag)
{
    all = document.querySelectorAll('[kind="subdiv"]')
    all.forEach( element =>  element.style.display="none" )
    const element = document.querySelector(`#${tag}`);
    element.style.display = "inline-block";
}

function showonly(user_type){
    
    switch (user_type) {
        case 'All':  row = document.querySelectorAll("[gold]"); 
        row.forEach( element =>  element.style.display="" )  
        break; 

        case 'student': row = document.querySelectorAll(`[user_type=${user_type}]`);
        row.forEach( element =>  element.style.display="none" )  
         break;

        case 'advisor': row = document.querySelectorAll(`[user_type=${user_type}]`);
        row.forEach( element =>  element.style.display="none" )  
         break;

        case 'admin': row = document.querySelectorAll(`[user_type=${user_type}]`);
        row.forEach( element =>  element.style.display="none" )  
         break;
    }
    

 console.log(row);
 
 
}