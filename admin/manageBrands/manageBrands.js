function validateForm() {
    const newBrand= document.querySelector('input[name="brand"]').value.trim();

    if (!newCategory) {
        alert("Please fill out the new product Brand field.");
        return false;
    }

    return true;
}

function confirmDelete() {
    return confirm("Are you sure you want to delete this product? This action cannot be undone.");
}

const addBrandForm = document.querySelector('form[onsubmit="return validateForm()"]');
if (addBrandForm) {
    addBrandForm.onsubmit = validateForm;
}


document.querySelectorAll('form[onsubmit="return confirmDelete()"]').forEach(form => {
    form.onsubmit = confirmDelete;
});
