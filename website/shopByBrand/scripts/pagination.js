document.addEventListener('DOMContentLoaded', function() {
    const itemsPerPage = 10;
    const itemGroup = document.querySelector('.itemGroup');
    const pdiv = document.querySelector('.paginationdiv');
    const resultAmountEl = document.getElementById('resultAmount');
    const items = Array.from(itemGroup.children);
    let currentPage = 1;

    function paginateItems() {
        const startIndex = (currentPage - 1) * itemsPerPage;
        const endIndex = startIndex + itemsPerPage;

        // Hide all items first
        items.forEach(item => item.style.display = 'none');

        // Show items for current page
        items.slice(startIndex, endIndex).forEach(item => {
            item.style.display = 'flex';
        });

        // Update results text
        resultAmountEl.textContent = `Showing ${Math.min(endIndex, items.length)} of ${items.length} results`;

        createPaginationControls();
    }

    function createPaginationControls() {
        // Remove existing pagination if any
        const existingPagination = document.querySelector('.pagination');
        if (existingPagination) {
            existingPagination.remove();
        }

        const totalPages = Math.ceil(items.length / itemsPerPage);
        const paginationContainer = document.createElement('div');
        paginationContainer.classList.add('pagination');

        // Previous button
        if (currentPage > 1) {
            const prevButton = document.createElement('button');
            prevButton.textContent = 'Previous';
            prevButton.addEventListener('click', () => {
                currentPage--;
                paginateItems();
            });
            paginationContainer.appendChild(prevButton);
        }

        // Page numbers
        for (let i = 1; i <= totalPages; i++) {
            const pageButton = document.createElement('button');
            pageButton.textContent = i;
            pageButton.classList.toggle('active', i === currentPage);
            pageButton.addEventListener('click', () => {
                currentPage = i;
                paginateItems();
            });
            paginationContainer.appendChild(pageButton);
        }

        // Next button
        if (currentPage < totalPages) {
            const nextButton = document.createElement('button');
            nextButton.textContent = 'Next';
            nextButton.addEventListener('click', () => {
                currentPage++;
                paginateItems();
            });
            paginationContainer.appendChild(nextButton);
        }

        // Add pagination after item group
        pdiv.appendChild(paginationContainer);
    }

    // Initial pagination setup
    paginateItems();
});