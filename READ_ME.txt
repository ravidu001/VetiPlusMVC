VetDoctor
update doctorreview.view page 
    view-alter class content is hard coded and it should be remove after backend is done.
    relevant js file 1-54 line shuld be un comment and add relavent url here (fetch(''))
    @394 line in css file /* remove after new code added to the reviewNotification section */

    not full complete certificate.view.php file that is about medical certificate

    <script>
        const sessionDates = ['2024-11-15', '2024-12-16', '2025-01-20'];
        // this will pass the session dates to calendar for highlighting relevant dates
    </script>



Vet Assistant


Calendar
    remove funtions from existing js code
    1.Add a Global Variable in DoctorViewSession.php:
    <script>
    const isDoctorViewSession = true;
    </script>

    2.Modify the selectDate Function: Update calendar.js to check for this flag before running:
    selectDate(date, element) {
        if (typeof isDoctorViewSession !== 'undefined' && isDoctorViewSession) {
            // Do nothing in DoctorViewSession
            return;
        }

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





this is the page about vet doctor can review their vet assistants after assistants attend to the appointment session.

this is the html file
```

```

this is the css file 
```

```

this is js file
```

```

this is not a good UI experience for the vet doctors(users). So I need to make this more user friendly and attractive with the modern style with some animations too.

apart from this there is a sidebar which can be open and close. when it is open 250px and 88px used when close. home class includes

```
.home {
   position: relative;
   left: 250px;
   height: 100vh;
   width: calc(100% - 250px);
   background: var(--body-color);
   transition: var(--tran-05);
}

.home .text {
   font-size: 24px;
   font-weight: 500;
   color: var(--text-color);
   padding: 8px 40px;
}

.sidebar.close ~ .home {
   left: 88px;
   width: calc(100% - 88px);
}
```

this is my web page root color code
```
:root{
   --body-color: #E4E9F7;
   --sidebar-color: #FFF;
   --primary-color: #6a0dad;
   --primary-color-light: #f6f5ff;
   --toggle-color: #ddd;
   --text-color: #707070;
   --background-light: #c8a2c8;
   --background-primary: #6a0dad ;
   --background-white: #fff;
   --text-black: black;
   --text-primary: #6a0dad;
   --text-white: #fff;
   --shadow-color: slategray;
   --list-item: #ffecff;
 
   
   --tran-02: all 0.2s ease;
   --tran-03: all 0.3s ease;
   --tran-04: all 0.4s ease;
   --tran-05: all 0.5s ease;
}
```


Give me a single code without break down. I need single file. Give me best one. Don't forget I am still only UI interfaces that means I did not have still backend. So, I need hard coded output to see how UI is look likes






this is my old vet assistant page for 

this is the html file
```

```

this is the css file 
```

```

this is js file
```

```

this is not a good UI experience for the vet assistant(users). So I need to make this similar to below page. refer that page carefully and give me a best user friendly and modern UI for the vet doctor.
if you feel new features to add vet assitant apart from old page.please feel free to add them also. 

Give me a single code without break down. I need single file. Give me best one. Don't forget I am still only UI interfaces that means I did not have still backend. So, I need hard coded output to see how UI is look likes


apart from this there is a sidebar which can be open and close. when it is open 250px and 88px used when close. home class includes

```
.home {
   position: relative;
   left: 250px;
   height: 100vh;
   width: calc(100% - 250px);
   background: var(--body-color);
   transition: var(--tran-05);
}

.home .text {
   font-size: 24px;
   font-weight: 500;
   color: var(--text-color);
   padding: 8px 40px;
}

.sidebar.close ~ .home {
   left: 88px;
   width: calc(100% - 88px);
}
```

this is my web page root color code
```
:root{
   --body-color: #E4E9F7;
   --sidebar-color: #FFF;
   --primary-color: #6a0dad;
   --primary-color-light: #f6f5ff;
   --toggle-color: #ddd;
   --text-color: #707070;
   --background-light: #c8a2c8;
   --background-primary: #6a0dad ;
   --background-white: #fff;
   --text-black: black;
   --text-primary: #6a0dad;
   --text-white: #fff;
   --shadow-color: slategray;
   --list-item: #ffecff;
 
   
   --tran-02: all 0.2s ease;
   --tran-03: all 0.3s ease;
   --tran-04: all 0.4s ease;
   --tran-05: all 0.5s ease;
}
```


below page that you have to refer
this is the html file
```

```

this is the css file 
```

```

this is js file
```

```




// assitant request page
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Vet Assistant Appointment Requests</title>
    <style>
        :root {
            --body-color: #E4E9F7;
            --primary-color: #6a0dad;
            --secondary-color: #c8a2c8;
            --white: #ffffff;
            --text-color: #333;
            --transition: all 0.3s ease;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Arial', sans-serif;
        }

        body {
            background-color: var(--body-color);
            display: flex;
        }

        .home {
            width: calc(100% - 250px);
            margin-left: 250px;
            padding: 20px;
            transition: var(--transition);
        }

        .request-container {
            background-color: var(--white);
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            padding: 25px;
        }

        .request-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }

        .request-header h2 {
            color: var(--primary-color);
            font-size: 24px;
        }

        .request-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0 15px;
        }

        .request-table th {
            background-color: var(--primary-color);
            color: var(--white);
            padding: 15px;
            text-align: left;
        }

        .request-table tr {
            background-color: #f9f5ff;
            transition: var(--transition);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
        }

        .request-table tr:hover {
            transform: scale(1.02);
            box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
        }

        .request-table td {
            padding: 15px;
            vertical-align: middle;
        }

        .doctor-profile {
            width: 70px;
            height: 70px;
            border-radius: 50%;
            object-fit: cover;
            border: 3px solid var(--primary-color);
        }

        .action-buttons {
            display: flex;
            gap: 10px;
        }

        .btn {
            padding: 10px 15px;
            border: none;
            border-radius: 6px;
            cursor: pointer;
            transition: var(--transition);
            font-weight: 600;
        }

        .btn-accept {
            background-color: #4caf50;
            color: white;
        }

        .btn-reject {
            background-color: #f44336;
            color: white;
        }

        .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .request-table tr {
            animation: fadeIn 0.5s ease;
        }
    </style>
</head>
<body>
    <div class="home">
        <div class="request-container">
            <div class="request-header">
                <h2>Appointment Requests</h2>
                <div class="filter-options">
                    <!-- Optional: Add filter/sort functionality -->
                </div>
            </div>
            <table class="request-table">
                <thead>
                    <tr>
                        <th colspan="2" class="table-heading">Doctor</th>
                        <th>Date & Time</th>
                        <th>Location</th>
                        <th>Contact</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <img src="<?= ROOT ?>/assets/images/vetAssistant/assistantprofile.avif" alt="Dr. Kasun" class="doctor-profile">
                            
                        </td>
                        <td>Dr. Kasun Perera</td>
                        <td>Nov 30, 2024<br>3:00 PM - 6:00 PM</td>
                        <td>147, Galthude, Panadura</td>
                        <td>077 050 7520</td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn btn-accept">Accept</button>
                                <button class="btn btn-reject">Reject</button>
                            </div>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <img src="<?= ROOT ?>/assets/images/vetAssistant/assistantprofile.avif" alt="Dr. Saman" class="doctor-profile">
                            
                        </td>
                        <td>Dr. Saman Silva</td>
                        <td>Dec 02, 2024<br>3:00 PM - 6:00 PM</td>
                        <td>147, Hirana, Panadura</td>
                        <td>077 050 1136</td>
                        <td>
                            <div class="action-buttons">
                                <button class="btn btn-accept">Accept</button>
                                <button class="btn btn-reject">Reject</button>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        // Future JavaScript for dynamic interactions
        document.querySelectorAll('.btn-accept, .btn-reject').forEach(button => {
            button.addEventListener('click', function() {
                const row = this.closest('tr');
                row.remove(); // Simple removal for now
                // In future: Add logic to move to appropriate sections
            });
        });
    </script>
</body>
</html>



