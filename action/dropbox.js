function toggleDropdown() {
    var dropdown = document.querySelector("#dropdown-smem .dropdown-content");
    dropdown.classList.toggle("show");
}

// Đóng dropdown nếu click ra ngoài dropdown
window.onclick = function(event) {
    if (!event.target.closest('.header__navbar__item__wrapper')) {
        var dropdowns = document.querySelectorAll(".dropdown-content");
        dropdowns.forEach(function(dropdown) {
            if (dropdown.classList.contains('show')) {
                dropdown.classList.remove('show');
            }
        });
    }
}