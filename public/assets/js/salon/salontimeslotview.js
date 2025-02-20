document.addEventListener('DOMContentLoaded', function() {
    // Get the buttons and content sections
    const openDaysBtn = document.getElementById('opendays');
    const holidaysBtn = document.getElementById('holidaywithbooked');
    const selsectContentDiv = document.querySelector('.selsectcontent');
    const openDaysSection = document.querySelector('.opendays');
    const holidaysSection = document.querySelector('.holidays');

    // Initially show open days section and hide holidays section
    openDaysSection.style.display = 'block';
    holidaysSection.style.display = 'none';

    // Set initial button styles
    openDaysBtn.style.backgroundColor = '#28a745';
    holidaysBtn.style.backgroundColor = '#dc3545';

    // Add click event for open days button
    openDaysBtn.addEventListener('click', function() {
        // Show open days section
        openDaysSection.style.display = 'block';
        holidaysSection.style.display = 'none';
        
        // Update button styles
        openDaysBtn.style.backgroundColor = '#28a745';
        holidaysBtn.style.backgroundColor = '#dc3545';
    });

    // Add click event for holidays button
    holidaysBtn.addEventListener('click', function() {
        // Show holidays section
        holidaysSection.style.display = 'block';
        openDaysSection.style.display = 'none';
        
        // Update button styles
        holidaysBtn.style.backgroundColor = '#28a745';
        openDaysBtn.style.backgroundColor = '#dc3545';
    });

    // Populate year dropdown
    const yearSelect = document.getElementById('year');
    const currentYear = new Date().getFullYear();
    
    // Add years from current year to next 5 years
    for (let year = currentYear; year <= currentYear + 5; year++) {
        const option = document.createElement('option');
        option.value = year;
        option.textContent = year;
        yearSelect.appendChild(option);
    }
});