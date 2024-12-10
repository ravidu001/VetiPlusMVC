 // Calendar Functionality
 class VetCalendar {
    constructor() {
        this.currentDate = new Date();
        this.calendarGrid = document.getElementById('calendar-grid');
        this.monthDisplay = document.getElementById('current-month');
        this.selectedDateInput = document.getElementById('selected-date');
        this.assistantSelect = document.getElementById('assistant-select');

        // Bind event listeners
        this.initEventListeners();

        // Initial render
        this.renderCalendar();
    }

    initEventListeners() {
        document.getElementById('prev-month').addEventListener('click', () => this.changeMonth(-1));
        document.getElementById('next-month').addEventListener('click', () => this.changeMonth(1));
    }

    renderCalendar() {
        const firstDay = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth(), 1);
        const lastDay = new Date(this.currentDate.getFullYear(), this.currentDate.getMonth() + 1, 0);
        
        this.calendarGrid.innerHTML = '';
        this.updateMonthDisplay();

        // Add day headers
        const dayHeaders = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
        dayHeaders.forEach(day => {
            const headerElement = document.createElement('div');
            headerElement.textContent = day;
            headerElement.classList.add('day-header');
            this.calendarGrid.appendChild(headerElement);
        });

        // Add empty cells for days before the first day of the month
        for (let i = 0; i < firstDay.getDay(); i++) {
            this.calendarGrid.appendChild(document.createElement('div'));
        }

        // Render days
        for (let day = 1; day <= lastDay.getDate(); day++) {
            const dayElement = document.createElement('div');
            dayElement.textContent = day;
            dayElement.classList.add('calendar-day');

            const comparisonDate = new Date(
                this.currentDate.getFullYear(), 
                this.currentDate.getMonth(), 
                day
            );

            // Classify days
            if (comparisonDate.toDateString() === new Date().toDateString()) {
                dayElement.classList.add('current-date');
            } else if (comparisonDate < new Date()) {
                dayElement.classList.add('past-date');
            } else {
                dayElement.classList.add('future-date');
            }

            // Add click event for date selection
            dayElement.addEventListener('click', () => this.selectDate(comparisonDate, dayElement));
            
            this.calendarGrid.appendChild(dayElement);
        }
    }

    updateMonthDisplay() {
        const months = [
            'January', 'February', 'March', 'April', 'May', 'June', 
            'July', 'August', 'September', 'October', 'November', 'December'
        ];
        this.monthDisplay.textContent = `${months[this.currentDate.getMonth()]} ${this.currentDate.getFullYear()}`;
    }

    changeMonth(direction) {
        this.currentDate.setMonth(this.currentDate.getMonth() + direction);
        this.renderCalendar();
    }

    selectDate(date, element) {
        // Prevent selection of past dates
        if (date < new Date()) return;

        // Remove previous selection
        this.calendarGrid.querySelectorAll('.calendar-day').forEach(el => 
            el.classList.remove('selected')
        );

        // Add selection to clicked date
        element.classList.add('selected');

        // Update selected date input
        this.selectedDateInput.value = date.toDateString();
    }
}

// Initialize calendar and event listeners when DOM is fully loaded
document.addEventListener('DOMContentLoaded', () => {
    // Initialize calendar
    const vetCalendar = new VetCalendar();

});