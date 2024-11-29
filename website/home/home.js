document.addEventListener("DOMContentLoaded", () => {
    const brandLinks = document.querySelectorAll(".brand-link");
    const productLists = document.querySelectorAll(".product-list");

    // Show "all" products by default when page is loaded
    productLists.forEach(list => {
        if (list.classList.contains("all")) {
            list.style.display = "block";
        } else {
            list.style.display = "none";
        }
    });

    brandLinks.forEach(link => {
        link.addEventListener("click", (e) => {
            e.preventDefault();
            brandLinks.forEach(item => item.classList.remove("active"));
            link.classList.add("active");

            const selectedBrand = link.getAttribute("data-brand");
            productLists.forEach(list => {
                if (list.classList.contains(selectedBrand)) {
                    list.style.display = "block";
                } else {
                    list.style.display = "none";
                }
            });
        });
    });

    let scrollContainer = document.querySelector(".testimonials-container");
    let backBtn = document.querySelector("#back-btn");
    let nextBtn = document.querySelector("#next-btn");
    let testimonial = document.querySelector(".testimonial"); 

    if (scrollContainer && backBtn && nextBtn && testimonial) {
        const testimonialWidth = testimonial.offsetWidth; 

        scrollContainer.addEventListener("wheel", function (event) {
            event.preventDefault();
            scrollContainer.scrollLeft += event.deltaY;
            scrollContainer.style.scrollBehavior = "smooth";
        });

        backBtn.addEventListener("click", function () {
            scrollContainer.style.scrollBehavior = "smooth";
            scrollContainer.scrollLeft -= testimonialWidth; 
        });

        nextBtn.addEventListener("click", function () {
            scrollContainer.style.scrollBehavior = "smooth";
            scrollContainer.scrollLeft += testimonialWidth; 
        });
    }
});
