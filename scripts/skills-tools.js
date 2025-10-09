/**
 * Skills & Tools Interactive Functionality
 * 
 * Handles tab switching and interactive behavior for the Skills & Tools component
 */

document.addEventListener('DOMContentLoaded', function () {
    const skillsBox = document.querySelector('[data-skills-box]');

    if (!skillsBox) return;

    const toggleButtons = skillsBox.querySelectorAll('.toggle-btn');
    const skillsList = skillsBox.querySelector('[data-content="skills"]');
    const toolsList = skillsBox.querySelector('[data-content="tools"]');
    const toggleBox = skillsBox.querySelector('[data-toggle-box]');

    // Handle tab switching
    toggleButtons.forEach(button => {
        button.addEventListener('click', function () {
            const targetTab = this.getAttribute('data-tab');

            // Remove active class from all buttons
            toggleButtons.forEach(btn => {
                btn.classList.remove('active');
                btn.setAttribute('aria-expanded', 'false');
            });

            // Add active class to clicked button
            this.classList.add('active');
            this.setAttribute('aria-expanded', 'true');

            // Show/hide content based on selected tab
            if (targetTab === 'skills') {
                skillsList.style.display = 'flex';
                toolsList.style.display = 'none';
                skillsList.classList.add('active');
                toolsList.classList.remove('active');
                skillsBox.classList.remove('active');
                toggleBox.classList.remove('active');
            } else if (targetTab === 'tools') {
                skillsList.style.display = 'none';
                toolsList.style.display = 'flex';
                skillsList.classList.remove('active');
                toolsList.classList.add('active');
                skillsBox.classList.add('active');
                toggleBox.classList.add('active');
            }
        });
    });

    // Handle keyboard navigation
    toggleButtons.forEach((button, index) => {
        button.addEventListener('keydown', function (e) {
            let targetIndex;

            switch (e.key) {
                case 'ArrowLeft':
                    e.preventDefault();
                    targetIndex = index === 0 ? toggleButtons.length - 1 : index - 1;
                    toggleButtons[targetIndex].focus();
                    break;
                case 'ArrowRight':
                    e.preventDefault();
                    targetIndex = index === toggleButtons.length - 1 ? 0 : index + 1;
                    toggleButtons[targetIndex].focus();
                    break;
                case 'Enter':
                case ' ':
                    e.preventDefault();
                    button.click();
                    break;
            }
        });
    });
});