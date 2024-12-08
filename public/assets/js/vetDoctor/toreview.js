let currentTab = 'pending'; // Default tab

function switchTab(tab) {
    const pendingTab = document.getElementById('pendingReviews');
    const completedTab = document.getElementById('completedReviews');
    const pendingButton = document.querySelector('.tab-button:nth-child(1)');
    const completedButton = document.querySelector('.tab-button:nth-child(2)');

    if (tab === 'pending') {
        pendingTab.style.display = 'grid';
        completedTab.style.display = 'none';
        pendingButton.classList.add('active');
        completedButton.classList.remove('active');
        currentTab = 'pending';
        // window.alert(currentTab);
    } else {
        pendingTab.style.display = 'none';
        completedTab.style.display = 'grid';
        pendingButton.classList.remove('active');
        completedButton.classList.add('active');
        currentTab = 'completed';
        // window.alert(currentTab);
    }
}

function openReviewModal() {
    const modal = document.getElementById('reviewModal');
    modal.style.display = 'flex';
}

function closeModal() {
    const modal = document.getElementById('reviewModal');
    modal.style.display = 'none';
    switchTab(currentTab); // Switch back to the relevant tab
}

function deleteReview(button) {
    const card = button.closest('.review-card');
    // Add your delete logic here
}

// Add event listener to the cancel button
document.getElementById('cancel').addEventListener('click', closeModal);
