//get the current data
let currentDate = new Date();
let selectedDate = null;

//default highlight the today
const today = new Date();
const isCurrentMonth = today.getMonth() === currentDate.getMonth() && today.getFullYear() === currentDate.getFullYear();

// if (!currentSelectedDate && isCurrentMonth) {
//     const todayDay = today.getDate();
//     highlightAndSelectDay(todayDay);
// }


//______________________________________________________________________________________


function highlightAndSelectDay(day) 
{
    const dayElements = document.querySelectorAll('.calendar-day');

    dayElements.forEach(element => {
        if (parseInt(element.textContent) === day && !element.classList.contains('closed')) 
        {
            // Remove previous selection
            dayElements.forEach(el => el.classList.remove('selected'));
            
            // Add selection class
            element.classList.add('selected');
            
            // Simulate a click event to fetch slots
            element.click();
        }
    });
}


function sendSelectedDateToBackend(selectedDate) 
{
    if (!selectedDate) 
    {
        console.error('No date selected');
        return;
    }

    // const formattedDate = selectedDate.toISOString().split('T')[0]; // Format as YYYY-MM-DD
    const correctformattedDate = selectedDate.getFullYear() + '-' +
                      String(selectedDate.getMonth() + 1).padStart(2, '0') + '-' +
                      String(selectedDate.getDate()).padStart(2, '0');

    const SalonEmailAddress = salonEmail;

    fetch(`${BASE_URL}/SalonCalendar/getSlots`, 
    {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ date: correctformattedDate, salonID: SalonEmailAddress }) // Sending as JSON
    })
    .then(response => response.json())
    .then(data => 
    {
        console.log('uuuuuuuu');
        //__________________________________________________
        if(data.success)
        {
            console.log('kkkkkkkkk', data);
            appointmentData = {
                upcoming: data.upcoming || [],
                complete: data.complete || [],
                incomplete: data.incomplete || []
            };
            console.log(appointmentData);
            filterAppointments(currentFilter);
        }
        else
        {
            document.getElementById('appointment-list').innerHTML = `<p>${data.message}</p>`;
        }
        //___________________________________________________________________________
    })
    .catch(error => 
    {
        console.error('Errotttttttttttr:',error);
        document.getElementById('appointment-list').innerHTML = `<p>Error loading appointments.</p>`;
    });
}

//___________________________________________________________________________________________________________________________________
//create the functions for get the time slots 


//____________________________________________________________________________________________________________________________________

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
    
    for (let i = 0; i < firstDay.getDay(); i++) 
    {
        calendar.appendChild(document.createElement('div'));
    }
    
    for (let day = 1; day <= lastDay.getDate(); day++) 
    {
        const dayElement = document.createElement('div');
        dayElement.className = 'calendar-day';

        // **Added: Wrapper for date and button**
        const dateWrapper = document.createElement('div');
        dateWrapper.className = 'date-wrapper';
        // dateWrapper.textContent = day;

        // **Added: Button for each date**
        const dayButton = document.createElement('button');
        dayButton.className = 'date-button';
        dayButton.textContent = day;
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




function previousMonth() 
{
    currentDate.setMonth(currentDate.getMonth() - 1);
    initCalendar();
}

function nextMonth() 
{
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
