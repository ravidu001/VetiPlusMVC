function selectDate(day) 
{
    
    const year = currentDate.getFullYear();
    const month = String(currentDate.getMonth() + 1).padStart(2, '0');
    const date = `${year}-${month}-${String(day).padStart(2, '0')}`;

    // Get backend URL from the calendar div
    const calendarDiv = document.querySelector('.calendar');
    const backendUrl = calendarDiv.getAttribute('data-backend-url');

    if (!backendUrl) {
        alert('Backend URL is not defined!');
        return;
    }

    // Prepare and send data
    const formData = new FormData();//create the form
    formData.append('selectedDate', date);//selectDate-value, date- key


    // Send the selected date to the backend
    fetch(backendUrl, {
        method: 'POST',
        body: new URLSearchParams({ selectedDate: date }),
    })
        .then(response => response.json())
        .then(data => {
            const timeSlotsContainer = document.getElementById('timeSlotsContainer'); // Reference to time slots container

            if (data.success && data.sessiondata.length > 0) {
                timeSlotsContainer.innerHTML = ''; // Clear existing slots

                data.sessiondata.forEach(item => {
                    const timeSlot = document.createElement('div');
                    timeSlot.classList.add('time-slot');

                    // Set the text (time range)
                    timeSlot.textContent = item.time_slot;

                    // Apply color based on status
                    if (item.status === 'available') {
                        timeSlot.classList.add('available');
                    } else if (item.status === 'blocked') {
                        timeSlot.classList.add('blocked');
                    } else if (item.status === 'booked') {
                        timeSlot.classList.add('booked');
                    }

                    // Append to container
                    timeSlotsContainer.appendChild(timeSlot);
                });
            } else {
                timeSlotsContainer.innerHTML = `<p>No available time slots.</p>`;
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
}

