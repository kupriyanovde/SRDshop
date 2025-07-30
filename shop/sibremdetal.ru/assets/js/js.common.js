document.addEventListener('DOMContentLoaded', function () {
    const toggleButtons = document.querySelectorAll('.mobile-menu-toggle');

    toggleButtons.forEach(button => {
        const targetMenuId = button.dataset.toggleMenu;
        const targetMenu = document.getElementById(targetMenuId);
        const icon = button.querySelector('img');

        const iconOpen = button.dataset.iconOpen;
        const iconClose = button.dataset.iconClose;

        if (!targetMenu) return;

        button.addEventListener('click', () => {
            const isActive = targetMenu.classList.contains('active');

            // Если текущее меню уже открыто — закрываем его
            if (isActive) {
                targetMenu.classList.remove('active');
                document.body.style.overflow = '';
                if (icon) {
                    icon.src = iconOpen;
                    icon.alt = 'Открыть меню';
                }
            } else {
                // Закрываем все остальные меню
                toggleButtons.forEach(btn => {
                    const menuId = btn.dataset.toggleMenu;
                    const menu = document.getElementById(menuId);
                    const btnIcon = btn.querySelector('img');
                    const btnIconOpen = btn.dataset.iconOpen;

                    if (menu && menu.classList.contains('active')) {
                        menu.classList.remove('active');
                        if (btnIcon) {
                            btnIcon.src = btnIconOpen;
                            btnIcon.alt = 'Открыть меню';
                        }
                    }
                });

                // Открываем текущее меню
                targetMenu.classList.add('active');
                document.body.style.overflow = 'hidden';
                if (icon) {
                    icon.src = iconClose;
                    icon.alt = 'Закрыть меню';
                }
            }
        });
    });
});



document.addEventListener('DOMContentLoaded', () => {
    // Кнопка "Наверх"
    const upBtn = document.querySelector('.up-btn');
    if (upBtn) {
        upBtn.style.display = 'none'; // изначально скрыта
        upBtn.addEventListener('click', () => {
            window.scrollTo({top: 0, behavior: 'smooth'});
        });
        window.addEventListener('scroll', () => {
            if (window.scrollY > 100) {
                upBtn.style.display = 'flex';
            } else {
                upBtn.style.display = 'none';
            }
        });
    }

    // Заглушка для кнопки Чат
    const chatBtn = document.querySelector('.chat-btn');
    if (chatBtn) {
        chatBtn.addEventListener('click', () => {
            alert('Открыть чат');
        });
    }
});
