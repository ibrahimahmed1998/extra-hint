var head = document.getElementById("head");
var s1 = document.createElement("script");
s1.setAttribute("src", "https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js");

var s2 = document.createElement("script");
s2.setAttribute("src", "https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js");
s2.setAttribute("integrity", "sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM");
s2.setAttribute("crossorigin", "anonymous");

var s3 = document.createElement("script");
s3.setAttribute("src", "js/logout.js");

var l1 = document.createElement("link");
l1.setAttribute("rel", "stylesheet");
l1.setAttribute("href", "https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css");
l1.setAttribute("integrity", "sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO");
l1.setAttribute("crossorigin", "anonymous");

var l2 = document.createElement("link");
l2.setAttribute("rel", "stylesheet");
l2.setAttribute("href", "https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css");
l2.setAttribute("integrity", "sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC");
l2.setAttribute("crossorigin", "anonymous");

head.appendChild(s1);
head.appendChild(s2);
head.appendChild(s3);
head.appendChild(l1);
head.appendChild(l2);
