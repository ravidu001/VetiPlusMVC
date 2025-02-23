function selectDate(day) 
{
    const year = currentDate.getFullYear();
    const month = String(currentDate.getMonth() + 1).padStart(2, '0');
    const date = `${year}-${month}-${String(day).padStart(2, '0')}`;

    // Get backend URL from the calendar div
    const calendarDiv = document.querySelector('.calendar');
    const backendUrl = calendarDiv.getAttribute('data-backend-url'); // Dynamic URL

    if (!backendUrl) {
        alert('Backend URL is not defined!');
        return;
    }

    // Prepare and send data
    const formData = new FormData();//create the form
    formData.append('selectedDate', date);//selectDate-value, date- key

    //________________________________________________________________________________________________________________
    //fetch and get the upcoming page data using the backendUR
    fetch(backendUrl, 
    {
        method: 'POST',
        body: new URLSearchParams({ selectedDate: date }), // Send the date as POST data
    })
        .then(response => response.json())
        .then(data => 
        {
            const tableBody = document.getElementById('appointmentTableBody'); // Reference to tbody
            
            if(data.success && data.gotdata.length > 0) 
            {
                tableBody.innerHTML = ''; // Clear existing rows if any
    
                data.gotdata.forEach(item => {
                    // Format booked date (optional, if needed)
                    const bookedDate = item.bookedDate.split(' ')[0]; // Extract date part
    
                    const row = `
                        <tr>
                            <td>
                                <div class="user">${item.fullName}</div>
                            </td>
                            <td>${bookedDate}</td>
                            <td>${item.slotDate}</td>
                            <td>${item.timeSlot}</td>
                            <td>${item.service}</td>
                            <td>${item.contactNumber || 'N/A'}</td>
                        </tr>
                    `;
                    tableBody.insertAdjacentHTML('beforeend', row);
                });
            }
             else 
             {
                // Show "No appointments found" if no data
                tableBody.innerHTML = `
                    <tr>
                        <td colspan="7">No appointments found.</td>
                    </tr>`;
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });    
}
