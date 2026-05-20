
    function togglePassword() {
    var pass = document.getElementById("password");

    if (pass.type === "password") {
        pass.type = "text";
    } else {
        pass.type = "password";
    }
}
 function isEmailValid() {
        var emailregex=/^[a-z0-9]+@([a-z]+\.)?(just\.edu\.jo)$/;
        var email=document.getElementById("email");
      if(emailregex.test(email.value)){return true;}
          else {window.alert("Email is not in the valid format");return false; } }
function ispasswordvalid(){
    
var password=document.getElementById("password");
var confirmpassword=document.getElementById("confirm_password");
if(password.value.length>=6){
if(password.value==confirmpassword.value){return true;}
else {window.alert("Entered password must be identical");return false;}
}else{ window.alert("Password Length must be at least 6 characters ");return false;}

}

   
     
     
function start(){

    var form = document.querySelector("form");

    form.addEventListener('submit', function(event){

        if (!isEmailValid() || !ispasswordvalid()) {
            event.preventDefault(); 
        }

    });

}
window.addEventListener('load',start);

