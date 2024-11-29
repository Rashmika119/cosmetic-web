const messageElement = document.getElementById("message");
const payHere = document.getElementById("payHere");
const cashOnDelivery = document.getElementById("cash");


payHere.addEventListener("click", function () {
    messageElement.style.display = "block";
});


cashOnDelivery.addEventListener("click", function () {
    messageElement.style.display = "none";
});

const confirmdetails = document.getElementById("confirmdetails");

let times = parseInt(localStorage.getItem("confirmdetails") || "0");

confirmdetails.addEventListener("click", function () {
    times++;
    localStorage.setItem("confirmdetails", times);
    console.log("Confirm details clicked", times, "times");
});

const placeOrderButton = document.querySelector('.place-order-button');
const cashRadio = document.getElementById('cash');
const payHereRadio = document.getElementById('payHere');


placeOrderButton.addEventListener('click', function (event) {
    event.preventDefault();
    if (times === 0) {
        alert('Please confirm your details before placing the order.');
    } else {
       
        if (cashRadio.checked) {
            localStorage.removeItem("confirmdetails");

            let amount = document.getElementById("subtotal-amount").innerText;
            //alert(`Amount to be paid: ${amount}`);
            window.location.href = `../confirm/confirm.php?type=cash&amount=${amount}`;
            


        } else if (payHereRadio.checked) {
            localStorage.removeItem("confirmdetails");

            window.location.href = '../card/card.php';

        } else {
            alert('Please select a payment method before placing the order.');
        }
    }
});

