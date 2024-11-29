function validateForm() {
    const productName = document.querySelector('input[name="product-name"]').value.trim();
    const productDescription = document.querySelector('input[name="product-descript"]').value.trim();
    const productPrice = document.querySelector('input[name="product-price"]').value.trim();
    const brand = document.querySelector('select[name="brand"]');
    const bodyType = document.querySelector('select[name="body"]');
    const category = document.querySelector('select[name="category"]');
    const quantity = document.querySelector('input[name="quantity"]').value.trim();
    const image = document.querySelector('input[name="image"]').value;


    if (!productName || !productDescription || !productPrice || !quantity || !image) {
        alert("Please fill out all fields.");
        return false;
    }

 
    if (isNaN(productPrice)) {
        alert("Product price must be a number.");
        return false;
    }

    if (isNaN(quantity)) {
        alert("Quantity must be a number.");
        return false;
    }

    return true;
}

function confirmDelete() {
    return confirm("Are you sure you want to delete this product? This action cannot be undone.");
}

const addProductForm = document.querySelector('form[action="<?php echo $_SERVER["PHP_SELF"]; ?>"]');
if (addProductForm) {
    addProductForm.onsubmit = validateForm;
}


document.querySelectorAll('form[onsubmit="return confirmDelete()"]').forEach(form => {
    form.onsubmit = confirmDelete;
});
