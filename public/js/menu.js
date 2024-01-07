var menuItems = document.querySelectorAll('li');
menuItems.forEach(function (item) {
    item.addEventListener('mouseover', function () {
        var subMenu = this.querySelector('ul');
        if (subMenu) {
            subMenu.style.display = 'block';
        }
    });

    item.addEventListener('mouseout', function () {
        var subMenu = this.querySelector('ul');
        if (subMenu) {
            subMenu.style.display = 'none';
        }
    });
});