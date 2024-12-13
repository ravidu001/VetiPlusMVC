// Assistant Section Toggle
function toggleAssistantSection() {
    const assistantSelect = document.getElementById('assistant-select');
    const assistantRadio = document.querySelector('input[name="assistant"]:checked');
    const canlendarImage = document.querySelector('.calendar-image img');
    
    assistantSelect.style.display = 
        assistantRadio.value === 'yes' ? 'block' : 'none';
        
    canlendarImage.style.display = 
        assistantRadio.value === 'yes' ? 'block' : 'none';
}

// Form Reset
function resetForm() {
    // Reset form fields
    document.getElementById('session-form').reset();
    
    // Clear selected date
    document.getElementById('selected-date').value = '';
    
    // Remove calendar selection
    document.querySelectorAll('.calendar-day').forEach(el => 
        el.classList.remove('selected')
    );
    
    // Hide assistant section
    document.getElementById('assistant-select').style.display = 'none';
}

// Initialize calendar and event listeners when DOM is fully loaded
document.addEventListener('DOMContentLoaded', () => {
    // Initialize calendar
    const vetCalendar = new VetCalendar();

    // Add event listeners to radio buttons
    document.querySelectorAll('input[name="assistant"]').forEach(radio => {
        radio.addEventListener('change', toggleAssistantSection);
    });
});