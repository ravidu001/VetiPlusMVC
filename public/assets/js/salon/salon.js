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
    fetch(backendUrl, {
        method: 'POST',
        body: new URLSearchParams({ selectedDate: date }), // Send the date as POST data
    })
        .then(response => response.json())
        .then(data => {
            const appointmentContainer = document.getElementById('appointmentContainer'); // Reference to the main container
    
            if (data.success && data.gotdata.length > 0) {
                appointmentContainer.innerHTML = ''; // Clear existing appointments if any
    
                data.gotdata.forEach(item => {
                    const timeSlot = item.timeSlot || 'N/A';
                    const fullName = item.fullName || 'Anonymous';
                    const service = item.service || 'N/A';
                    const contactNumber = item.contactNumber || 'N/A';
    
                    const appointmentHTML = `
                        <div class="appointmentbox">
                            <p class="realtime">${timeSlot}</p>
                            <div class="image">
                                <!-- Optional image section (add src if needed) -->
                                <!-- <img class="image" src="../../assets/images/salon/boy.jpg" alt="boy"> -->
                                <!-- <img class="petimage" src="../../assets/images/White Playful Pet Shop Logo.png"> -->
                            </div>
                            <div class="userdetails">
                                <p class="username">${fullName}</p><br>
                                <i class="fa-solid fa-paw icon"><p class="servicename">${service}</p></i><br>
                                <p class="number">${contactNumber}</p><br>
                                <p class="time"><b>${item.slotDate}</b></p>
                            </div>
                        </div>
                    `;
                    appointmentContainer.insertAdjacentHTML('beforeend', appointmentHTML);
                });
            } else {
                // Show "No appointments found" if no data
                appointmentContainer.innerHTML = `
                    <div class="no-appointments">No appointments found.</div>`;
            }
        })
        .catch(error => {
            console.error('Error:', error);
        });
    
}
