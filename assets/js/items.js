document.addEventListener('DOMContentLoaded', function () {
    const urlParams = new URLSearchParams(window.location.search);
    const categories = urlParams.get('category');

    if (categories) {
        const selectedCategories = categories.split(',');
        selectedCategories.forEach(cat => {
            const checkbox = document.querySelector(`.category-checkbox[value="${cat}"]`);
            if (checkbox) {
                checkbox.checked = true;
            }
        });
    }

    document.getElementById('filterBtn').addEventListener('click', function () {
        const selected = [];
        const checkboxes = document.querySelectorAll('.category-checkbox:checked');

        checkboxes.forEach(cb => selected.push(cb.value));

        if (selected.length > 0) {
            const query = selected.join(',');
            window.location.href = 'items.php?category=' + encodeURIComponent(query);
        } else {
            window.location.href = 'items.php';
        }
    });
});