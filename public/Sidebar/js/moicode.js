  
function hide_syntax(tag)
{
    all = document.querySelectorAll('[kind="subdiv"]')
    all.forEach( element =>  element.style.display="none" )
    const element = document.querySelector(`#${tag}`);
    element.style.display = "inline-block";
}