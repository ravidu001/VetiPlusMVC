//get the current data
let currentDate = new Date();
console.log(currentDate);
let selectedDate = null;

function highlightAndSelectDay(day) {
    const dayElements = document.querySelectorAll('.calendar-day');

    dayElements.forEach(element => {
        if (parseInt(element.textContent) === day && !element.classList.contains('closed')) {
            // Remove previous selection
            dayElements.forEach(el => el.classList.remove('selected'));
            
            // Add selection class
            element.classList.add('selected');
            
            // Simulate a click event to fetch slots
            element.click();
        }
    });
}


function sendSelectedDateToBackend(selectedDate) {
    if (!selectedDate) 
    {
        console.error('No date selected');
        return;
    }

    const formattedDate = selectedDate.toISOString().split('T')[0]; // Format as YYYY-MM-DD

    fetch(`${BASE_URL}/SalonCalendar/getSlots`, 
    {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ date: formattedDate }) // Sending as JSON
    })
    .then(response => response.json())
    .then(data => 
    {
        console.log('Response from backend:', data);
    })
    .catch(error => 
    {
        console.error('Error:', error);
    });
}

function displayTimeSlots(slots) {
    const slotContainer = document.getElementById('slotContainer');
    slotContainer.innerHTML = '';

    slots.forEach(slot => {
        const slotElement = document.createElement('div');
        slotElement.textContent = slot.time_slot;
        slotElement.classList.add('slot');

        if (slot.status === 'available') {
            slotElement.classList.add('available'); // Green
        } else if (slot.status === 'booked') {
            slotElement.classList.add('booked'); // Red
        } else if (slot.status === 'blocked') {
            slotElement.classList.add('blocked'); // Gray
        }

        slotContainer.appendChild(slotElement);
    });
}


function goToSelectedDate() 
{
    const datePicker = document.getElementById('datePicker');
    const selectedDate = new Date(datePicker.value);
    
    // Only update if a valid date is selected
    if (!isNaN(selectedDate.getTime())) {
        currentDate = new Date(selectedDate.getFullYear(), selectedDate.getMonth(), 1);
        initCalendar();
        
        // Select the specific day
        const day = selectedDate.getDate();
        selectDate(day);
        console.log(day);
        highlightAndSelectDay(day);
        
        // Find and highlight the selected day
        const dayElements = document.querySelectorAll('.calendar-day');
        dayElements.forEach(element => {
            if (parseInt(element.textContent) === day && !element.classList.contains('closed')) {
                element.click();
            }
        });

        sendSelectedDateToBackend(selectedDate);
    }
}

// Sample data for blocked time slots (you would typically get this from an API)
const blockedTimeSlots = {
    '2024-08-15': ['10:00', '10:20', '11:00'],
    '2024-08-16': ['09:00', '09:20', '09:40']
};

// Sample data for closed days (e.g., weekends or holidays)
const closedDays = {
    '2024-08': [4, 11, 18, 25] // Sundays are closed
};

function initCalendar() 
{
    const calendar = document.getElementById('calendar');
    calendar.innerHTML = '';
    
    const days = ['Sun', 'Mon', 'Tue', 'Wed', 'Thu', 'Fri', 'Sat'];
    days.forEach(day => {
        const dayHeader = document.createElement('div');
        dayHeader.className = 'day-header';
        dayHeader.textContent = day;
        calendar.appendChild(dayHeader);
    });

    const firstDay = new Date(currentDate.getFullYear(), currentDate.getMonth(), 1);
    const lastDay = new Date(currentDate.getFullYear(), currentDate.getMonth() + 1, 0);
    
    for (let i = 0; i < firstDay.getDay(); i++) {
        calendar.appendChild(document.createElement('div'));
    }
    
    for (let day = 1; day <= lastDay.getDate(); day++) {
        const dayElement = document.createElement('div');
        dayElement.className = 'calendar-day';

        // **Added: Wrapper for date and button**
        const dateWrapper = document.createElement('div');
        dateWrapper.className = 'date-wrapper';
        dateWrapper.textContent = day;

        // **Added: Button for each date**
        const dayButton = document.createElement('button');
        dayButton.className = 'date-button';
        dayButton.textContent = 'Select';
        dayButton.onclick = () => selectDate(day);

        // **Check if day is closed**
        const monthKey = `${currentDate.getFullYear()}-${String(currentDate.getMonth() + 1).padStart(2, '0')}`;
        if (closedDays[monthKey]?.includes(day)) {
            dayElement.classList.add('closed');
            dayButton.disabled = true; // Disable button if closed
        } else {
            dayElement.classList.add('open');
        }

        // **Append elements**
        dayElement.appendChild(dateWrapper);
        dayElement.appendChild(dayButton);
        calendar.appendChild(dayElement);
    }

    updateMonthDisplay();
}




function previousMonth() {
    currentDate.setMonth(currentDate.getMonth() - 1);
    initCalendar();
}

function nextMonth() {
    currentDate.setMonth(currentDate.getMonth() + 1);
    initCalendar();
}

function updateMonthDisplay() 
{
    const months = ['January', 'February', 'March', 'April', 'May', 'June', 
                  'July', 'August', 'September', 'October', 'November', 'December'];
    document.getElementById('current-month').textContent = 
        `${months[currentDate.getMonth()]} ${currentDate.getFullYear()}`;
}

// Initialize the calendar
initCalendar();
