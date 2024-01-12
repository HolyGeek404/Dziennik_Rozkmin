function showTab(tabId) {
    const tabs = document.querySelectorAll('.about_user_content');
    tabs.forEach(tab => {
        tab.style.display = 'none';
    });

    const allTabs = document.querySelectorAll('.user_profile_info');
    allTabs.forEach(tab => {
        tab.classList.remove('current_user_profile_info');
    });

    const selectedTab = document.getElementById(tabId);
    selectedTab.style.display = 'block';

    const clickedElement = event.currentTarget;
    clickedElement.classList.add('current_user_profile_info');
}

document.getElementById('editAboutMeBtn').addEventListener('click', function () {
    var aboutMeForm = document.getElementById('aboutMeForm');
    aboutMeForm.style.display = 'block';
});