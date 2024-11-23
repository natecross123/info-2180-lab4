window.addEventListener('load',()=>{
    console.log("NEW WORLD JS LOADED")
    let button1=document.getElementById("lookup");
    let button2=document.getElementById("lookupCities");
    let input=document.querySelector("#country");
    let result=document.getElementById("result");

    const httpRequest =new XMLHttpRequest;
    
    button1.addEventListener("click",()=>{
        console.log("Button 1 Clicked");
        let url="http://localhost/info2180-lab5/world.php?query="+input.value;
        httpRequest.onreadystatechange=function1;
        httpRequest.open('GET',url);
        httpRequest.send();

    });
    button2.addEventListener("click",()=>{
        console.log("Button 2 Clicked");
        let url="http://localhost/info2180-lab5/world.php?query="+input.value+"&lookup=cities";
        console.log(url);
        httpRequest.onreadystatechange=function2;
        httpRequest.open('GET',url);
        httpRequest.send();

    });

    function function1() {
        
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
         if (httpRequest.status === 200) {
         let response = httpRequest.responseText;
         //alert(response);
         console.log(response);
         result.innerHTML=response;
         } else {
         alert('There was a problem with the request.');
         }
        }
        }
        
        function function2() {
        
            if (httpRequest.readyState === XMLHttpRequest.DONE) {
             if (httpRequest.status === 200) {
             let response = httpRequest.responseText;
             //alert(response);
             console.log(response);
             result.innerHTML=response;
             } else {
             alert('There was a problem with the request.');
             }
            }
            }
    
        
});