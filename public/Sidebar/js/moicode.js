var x = 1;

function profile(){
    const item = document.querySelector('#profile');
    const item2 = document.querySelector('#adduser');

    if (x > 0) {
        item.style.display = "inline-block";
        item2.style.display = "inline-block";

    } else{
        item.style.display = "none";
        item2.style.display = "none";

    }
    x = x * -1;
}