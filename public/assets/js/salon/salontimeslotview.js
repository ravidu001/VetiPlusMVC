console.log('hhhhhhhhhhhhhhhhhhhhhhhhhhh');
//_____________________________________________________________
//if not select show today
window.onload = () => 
{
    const today = new Date();
    
    // Highlight today's date in the calendar
    highlightAndSelectDay(today.getDate());
    
    //fetch data for get time slots details
    getTimeSlotsFromBackend(today);

};

//add the select date function
function selectDate(day) 
{
    //create a date object for selected day
    const selected = new Date(currentDate.getFullYear(), currentDate.getMonth(), day);

    // Highlight selected day
    highlightAndSelectDay(selected.getDate());

    //fetch data for get time slots details
    getTimeSlotsFromBackend(selected);

};

//_________________________________________________________________________________________________________________________________
function getTimeSlotsFromBackend(selectedDate) 
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

    fetch(`${BASE_URL}/SalonTimeSlot/RetriveTimeSlotsDataByDate`, 
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
        console.log(data.success);

        const tableBody = document.getElementById('slotTableBody');
        tableBody.innerHTML = '';

        // console.log('uuuuuuuu');
        //__________________________________________________
        if (data.success && data.result.length > 0) 
        {
            data.result.forEach(slot => {
                const row = document.createElement('tr');

                row.innerHTML = `
                    <td>${slot.time_slot}</td>
                    <td>${slot.status}</td>
                    <td>${slot.openday}</td>
                `;

                tableBody.appendChild(row);
            });
        } 
        else
        {
            tableBody.innerHTML = `<tr><td colspan="3">${data.message || 'No slots available for this date.'}</td></tr>`;
        }    
        //___________________________________________________________________________
    })
    .catch(error => 
    {
        console.error('Error fetching slots:', error);
        document.getElementById('slotTableBody').innerHTML = `<tr><td colspan="3">Error loading appointment slots.</td></tr>`;
    });
}