function start(){

    var allQty = document.querySelectorAll(".qty");

    allQty.forEach(function(input){

        input.addEventListener("input", function(){

            var parent = input.closest(".meal-item");

            var price = parseFloat(
                parent.querySelector(".price").dataset.price
            );

            var total = parent.querySelector(".total");

            var quantity = input.value;

            total.innerHTML =
                "Total price: " + (price * quantity).toFixed(2) + " JD";

        });

    });

    
let buttons = document.querySelectorAll(".order-btn");
    let orderContainer = document.getElementById("order-items");
    let totalPrice = document.getElementById("total-price");

    let total = 0;

    buttons.forEach(function(btn){

        btn.addEventListener("click", function(e){

            e.preventDefault();

            let parent = btn.closest(".meal-item");

            let name = btn.dataset.name;
            let price = parseFloat(btn.dataset.price);
            let qty = parent.querySelector(".qty").value;

            let itemTotal = price * qty;

            if(orderContainer.innerHTML.includes("No items yet")){
                orderContainer.innerHTML = "";
            }

         
            orderContainer.innerHTML += `
                <div class="order-item">
                    <span>${name} x ${qty}</span>
                    <span>${itemTotal.toFixed(2)} JD</span>
                </div>
            `;

           
            total += itemTotal;
            totalPrice.innerText = "Total Order Price:   "+total.toFixed(2);

        });

    });


}

window.addEventListener("load", start);
