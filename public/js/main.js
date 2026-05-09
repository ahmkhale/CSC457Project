function changeTheme() {
    document.body.classList.toggle("dark-mode");
}

const searchInput = document.getElementById("searchInput");
const categoryFilter = document.getElementById("categoryFilter");
const cards = document.querySelectorAll(".card");
const resultsCount = document.getElementById("resultsCount");

function updateGallery() {
    const searchValue = searchInput.value.trim().toLowerCase();
    const selectedCategory = categoryFilter.value;

    let visibleCount = 0;

    cards.forEach(function (card) {
        const cardText = card.innerText.toLowerCase();
        const cardCategory = card.getAttribute("data-category");

        const matchesSearch = cardText.includes(searchValue);
        const matchesCategory = selectedCategory === "all" || cardCategory === selectedCategory;

        if (matchesSearch && matchesCategory) {
            card.style.display = "block";
            visibleCount++;
        } else {
            card.style.display = "none";
        }
    });

    resultsCount.textContent = visibleCount;
}

if (searchInput && categoryFilter) {
    searchInput.addEventListener("input", updateGallery);
    categoryFilter.addEventListener("change", updateGallery);
}