document.addEventListener("DOMContentLoaded", function () {
    
    const subtotalElement = document.querySelector(".spa");
    const totalElement = document.querySelector(".total");
    const deliveryFee = 100; 

    
    function updateTotals() {
        let overallSubtotal = 0;

        
        document.querySelectorAll(".item").forEach(item => {
            const price = parseFloat(item.querySelector(".details p").textContent.replace("LKR ", ""));
            const quantityElement = item.querySelector(".amount p");
            const quantity = parseInt(quantityElement.textContent);
            const itemSubtotal = price * quantity;

    
            item.querySelector(".subtotal p").textContent = `LKR ${itemSubtotal.toFixed(2)}`;
            overallSubtotal += itemSubtotal;
        });

        
        subtotalElement.textContent = `LKR ${overallSubtotal.toFixed(2)}`;
        totalElement.textContent = `LKR ${(overallSubtotal + deliveryFee).toFixed(2)}`;
    }


    document.querySelectorAll(".item").forEach(item => {
        const plusButton = item.querySelector(".plus");
        const minusButton = item.querySelector(".minus");
        const quantityElement = item.querySelector(".amount p");

        let hiddenQuantityInput = item.querySelector('.quantityInput');

        
        plusButton.addEventListener("click", function () {
            let quantity = parseInt(quantityElement.textContent);
            quantityElement.textContent = quantity + 1;
            let newQuantity = parseInt(quantityElement.textContent);
            hiddenQuantityInput.value = newQuantity;
            updateTotals();
        });
        
        
        minusButton.addEventListener("click", function () {
            let quantity = parseInt(quantityElement.textContent);
            if (quantity > 1) {
                quantityElement.textContent = quantity - 1;
                let newQuantity = parseInt(quantityElement.textContent);
                hiddenQuantityInput.value = newQuantity; 
                updateTotals();
            }
        });
        
    });

    
    updateTotals();
});
