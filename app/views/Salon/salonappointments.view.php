<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
  <link rel="stylesheet" href="<?=ROOT?>/assets/css/salon/salonappointments.css">
  <title>Appointments</title>
  
        <?php
            include __DIR__ . '/../navbar/salonnav.php';
        ?>
</head>

<body>

  <h3 class="appointments">
    Appointments Details
  </h3>
  <div class="appointment-content">
        
    <div class="calander-content">
        <?php
            require __DIR__ .'/saloncalander.view.php'; 
        ?> 
    </div>
    <div class="details-content">
        
      <div class="filter-buttons">
        <button class="filter-btn" onclick="filterAppointments('upcoming', this)">Upcoming</button>
        <button class="filter-btn" onclick="filterAppointments('complete', this)">Complete</button>
        <button class="filter-btn" onclick="filterAppointments('incomplete', this)">Incomplete</button>
      </div>
      <div id="appointment-list" class="appointments-container">
      </div>
    </div>
  </div>

  <script>
    let currentSelectedDate = null;
    let currentFilter = 'upcoming';
    let appointmentData = { upcoming: [], complete: [], incomplete: [] };

    function filterAppointments(status, btn = null) 
    {
      // Update active button style
      const allBtns = document.querySelectorAll('.filter-btn');
      allBtns.forEach(b => b.classList.remove('active'));
      if (btn)
      {
        btn.classList.add('active');
      }
      else
      {
        // highlight default "Upcoming" button
        //special use :nth-child(1) this use for get the child from count the parent if use 2 color the complete
        document.querySelector(".filter-btn:nth-child(1)").classList.add("active");
      }
      
      const container = document.getElementById('appointment-list');
      // container.innerHTML = '';

      const appointments = appointmentData[status] || [];

      console.log(appointments);

      if (appointments.length === 0) {
        container.innerHTML = `
        <h3 class="title">${status.charAt(0).toUpperCase() + status.slice(1)} Appointments</h3>
        <div class="details">
          <table class="apdetail">
            <thead>
              <tr>
                  <th class="topic">Customer Name</th>
                  <th class="topic">Slot Date</th>
                  <th class="topic">Time Slot</th>
                  <th class="topic">Service</th>
                  <th class="topic">Contact Number</th>
                  ${status === 'upcoming' ? '<th class="topic">Status</th>' : ''}
              </tr>
            </thead>
            <tbody>
              <tr>
                <td>
                  <td colspan= '6' class="no-data">
                  No ${status} appointments on ${currentSelectedDate}
                </td>
              </tr>
            </tbody>`
      }
      else {
      let  html = `
        <h3 class="title">${status.charAt(0).toUpperCase() + status.slice(1)} Appointments</h3>
        <div class="details">
          <table class="apdetail">
            <thead>
              <tr>
                  <th class="topic">Customer Name</th>
                  <th class="topic">Slot Date</th>
                  <th class="topic">Time Slot</th>
                  <th class="topic">Service</th>
                  <th class="topic">Contact Number</th>
                  ${status === 'upcoming' ? '<th class="topic">Status</th>' : ''}
              </tr>
            </thead>
            <tbody>
              ${appointments.map(app => `
                <tr>
                  <td class="sendingdate">${app.bookedDate}</td>
                  <td class="sendingtime">${app.bookedTime}</td>
                </tr>
                <tr>
                  <td class="subdetail">${app.petOwner}</td>
                  <td class="subdetail">${app.slotDate}</td>
                  <td class="subdetail">${app.timeSlot}</td>
                  <td class="subdetail">${app.service}</td>
                  <td class="subdetail">${app.contactNumber}</td>
                  ${status === 'upcoming' ? `
                    <td class="subdetail">
                      <button class="complete" onclick="UpdateStatus(${app.groomingID}, 2)">Complete</button>
                    </td>
                  ` : ''}
                </tr>
              `).join('')}
            </tbody>
          </table>
        </div>
        `;
        container.innerHTML = html;
    }
      
  }
  
    //________________________________________________________________________________________________
    //updateStatus function 

    //_____________________________________________________________
    //if not select show today
    window.onload = () => 
    {
        const today = new Date();
        // const formattedToday = today.toISOString().split('T')[0];
        // currentSelectedDate = formattedToday;

        // Highlight today's date in the calendar
        highlightAndSelectDay(today.getDate());
        
        // Fetch slots from backend
        sendSelectedDateToBackend(today);

        // let currentFilter = 'upcoming'; // Default filter

        // Load today's appointment data with default status (upcoming)
        console.log(currentFilter);

        // filterAppointments(currentFilter);
        // console.log($result);
    };

    //add the select date function
    function selectDate(day) 
    {
        //create a date object for selected day
        const selected = new Date(currentDate.getFullYear(), currentDate.getMonth(), day);

        // console.log(selected);
        // console.log(day);

        // Format the date as YYYY-MM-DD
        // currentSelectedDate = selected;

        // Send to backend to fetch slot details
        // currentSelectedDate = formatted;

        // Highlight selected day
        highlightAndSelectDay(selected.getDate());

        // Fetch slots from backend
        sendSelectedDateToBackend(selected);

        // let currentFilter = 'upcoming'; // Default filter

        // Refresh appointments
        // filterAppointments(currentFilter);
    }


    function UpdateStatus(appintmentId, newStatus)
    {
      fetch(`${BASE_URL}/SalonAppointments/updateGroomingStatus`,
      {
        method:'POST',
        headers: {
          'Content-Type' : 'application/json'
        },
        body:JSON.stringify({ id: appintmentId, status: newStatus })
      })
      .then(res => res.json())
      .then(data => {
        if(data.success) {
          alert('Status updated successfully!');
          location.reload();
          //again refresh the data 
          // sendSelectedDateToBackend(currentSelectedDate);
        }
        else
        {
          alert('Failed to update status.');
        }
      })
      .catch(err => console.error('Error updating status:', err));
    }


  </script>
  <script>
    const salonEmail = "<?php echo $_SESSION['SALON_USER']; ?>";
  </script>
</body>
<script src="<?=ROOT?>/assets/js/salon/saloncalendar.js"></script>
</html>
