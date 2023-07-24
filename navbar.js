// JavaScript para el menú desplegable
const dropdownArrow = document.querySelector('.arrow');
const dropdownContent = document.querySelector('.dropdown-content');

dropdownArrow.addEventListener('click', () => {
    dropdownContent.classList.toggle('show');
});

window.addEventListener('click', (event) => {
    if (!event.target.matches('.arrow')) {
        if (dropdownContent.classList.contains('show')) {
            dropdownContent.classList.remove('show');
        }
    }
});
