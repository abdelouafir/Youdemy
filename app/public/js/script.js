const sidebar = document.getElementById('sidebar');
const mainContent = document.getElementById('mainContent');
const toggleButton = document.getElementById('toggleSidebar');
const sidebarTexts = document.querySelectorAll('.sidebar-text');
let isSidebarOpen = true;

toggleButton.addEventListener('click', () => {
    isSidebarOpen = !isSidebarOpen;
    
    if (isSidebarOpen) {
        sidebar.classList.remove('w-20');
        sidebar.classList.add('w-64');
        mainContent.classList.remove('ml-20');
        mainContent.classList.add('ml-64');
        sidebarTexts.forEach(text => text.classList.remove('hidden'));
    } else {
        sidebar.classList.remove('w-64');
        sidebar.classList.add('w-20');
        mainContent.classList.remove('ml-64');
        mainContent.classList.add('ml-20');
        sidebarTexts.forEach(text => text.classList.add('hidden'));
    }
});