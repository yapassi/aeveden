import './bootstrap';
import '@fortawesome/fontawesome-free/js/all.js';

// Toggle sidebar mobile
document.getElementById('sidebarToggler').addEventListener('click', () => {
    document.getElementById('sidebar').classList.toggle('show');
});

// Gestion responsive
function handleResize() {
    const sidebar = document.getElementById('sidebar');
    if (window.innerWidth < 768) {
        sidebar.classList.remove('show');
    } else {
        sidebar.classList.add('show');
    }
}

window.addEventListener('resize', handleResize);
handleResize();