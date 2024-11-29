document.querySelector(".form").addEventListener("submit", function (event) {
    event.preventDefault();

    const cardType = document.querySelector('input[name="card_type"]:checked');
    const cardNumber = document.getElementById("card_number").value.trim();
    const cardholderName = document.getElementById("cardholder_name").value.trim();
    const expiryDate = document.getElementById("expiry_date").value.trim();
    const cvv = document.getElementById("cvv").value.trim();

   
    let isValid = true;

    
    if (!cardType) {
        alert("Please select a payment method.");
        isValid = false;
    }

const cleanedCardNumber = cardNumber.replace(/\s+/g, "");


if (!/^\d{16}$/.test(cleanedCardNumber)) {
    alert("Card number must be a 16-digit number without spaces.");
    isValid = false;
}

    if (cardholderName === "") {
        alert("Cardholder name cannot be empty.");
        isValid = false;
    }


const expiryRegex = /^(0[1-9]|1[0-2])\/(0[1-9]|[12][0-9]|3[01])$/;
if (!expiryRegex.test(expiryDate)) {
    alert("Expiry date must be in MM/DD format with a valid month (01-12) and day (01-31).");
    isValid = false;
} else {
    const [month, day] = expiryDate.split("/").map(Number); // Convert to numbers

    const daysInMonth = {
        1: 31, 2: 28, 3: 31, 4: 30, 5: 31, 6: 30,
        7: 31, 8: 31, 9: 30, 10: 31, 11: 30, 12: 31,
    };

    if (day > daysInMonth[month]) {
        alert("Invalid day for the given month. " + month + " has a maximum of " + daysInMonth[month] + " days.");

        isValid = false;
    }
}


    if (!/^\d{3}$/.test(cvv)) {
        alert("CVV must be a 3-digit number.");
        isValid = false;
    }

    if (isValid) {
        alert("Form submitted successfully!");
        event.target.submit(); 
    }
});