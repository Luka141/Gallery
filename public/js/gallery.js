document.addEventListener("DOMContentLoaded", function () {
    const filterButtons = document.querySelectorAll(".filter-btn");

    filterButtons.forEach((button) => {
        button.addEventListener("click", function () {
            const filterValue = this.getAttribute("data-filter");

            filterButtons.forEach((btn) => {
                btn.classList.remove("active", "btn-primary");
                btn.classList.add("btn-outline-primary");
            });
            this.classList.remove("btn-outline-primary");
            this.classList.add("active", "btn-primary");

            const galleryItems = document.querySelectorAll(".gallery-item");

            galleryItems.forEach((item) => {
                if (
                    filterValue === "all" ||
                    item.getAttribute("data-type") === filterValue
                ) {
                    item.style.display = "block";
                } else {
                    item.style.display = "none";
                }
            });
        });
    });
});
