function validateForm() {
    const newCategory= document.querySelector('input[name="category"]').value.trim();
    const productCategory = document.querySelector('select[name="body"]');

    if (!newCategory) {
        alert("Please fill out the new product Category field.");
        return false;
    }


    return true;
}

function confirmDelete() {
    return confirm("Are you sure you want to delete this product? This action cannot be undone.");
}

const addCategoryForm = document.querySelector('form[action="../managecategories/managecategories.php"]');
if (addCategoryForm) {
    addCategoryForm.onsubmit = validateForm;
}


document.querySelectorAll('form[onsubmit="return confirmDelete()"]').forEach(form => {
    form.onsubmit = confirmDelete;
});
