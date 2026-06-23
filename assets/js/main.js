function togglePassword(icon){

    let input = icon.previousElementSibling;

    if(input.type === "password"){

        input.type = "text";

    }else{

        input.type = "password";
    }
}

/* CONFIRM PASSWORD VALIDATION in the client side*/

window.addEventListener("load", function () {

    let form = document.querySelector("form");

    let password =
        document.getElementById("password");

    let confirmPassword =
        document.getElementById("confirm_password");

    if(form && password && confirmPassword){

        form.addEventListener("submit", function (e) {

            if (password.value !== confirmPassword.value) {

                e.preventDefault();

               window.alert("Passwords do not match!");
            }

            if(password.value.length < 6){

                e.preventDefault();

               window.alert("Password must be at least 6 characters!");
            }

        });

    }

});