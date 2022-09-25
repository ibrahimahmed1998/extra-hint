  
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
        console.log(row);

        row.forEach( element =>  element.style.display="" )  
        break; 

        case 1:      row = document.querySelectorAll(`[user_type="1"]`);
        row.forEach( element =>  element.style.display="none" )  

         break;

        case 2:      row = document.querySelectorAll(`[user_type="2"]`);
        row.forEach( element =>  element.style.display="none" )  

         break;
        case 3:      row = document.querySelectorAll(`[user_type="3"]`);
        row.forEach( element =>  element.style.display="none" )  

         break;
    }
    

 console.log(row);
 
 
}