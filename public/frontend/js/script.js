function handleShowSearch() {
    var btnShowSearch = document.querySelectorAll('.show-form-search');
    var showSearch = document.querySelector('.box-search-group');
    var formSearch = document.querySelector('.form-search-group');

    btnShowSearch.forEach(function (btn) {
        btn.addEventListener('click', function (event) {
            event.preventDefault();
            formSearch.classList.add('zoom-in');
            formSearch.classList.remove('zoom-out');
            showSearch.classList.toggle('show');
        });
    });
}

function handleCloseSearchBox() {
    document.getElementById('close-box-search').addEventListener('click', function () {
        var searchBox = document.querySelector('.box-search-group');
        var formSearchGroup = document.querySelector('.form-search-group');
        formSearchGroup.classList.add('zoom-out');
        formSearchGroup.classList.remove('zoom-in');
        setTimeout(function () {
            searchBox.classList.remove('show');
        }, 300);
    });
}

document.addEventListener('DOMContentLoaded', function () {
    handleShowSearch();
    handleCloseSearchBox();
});
