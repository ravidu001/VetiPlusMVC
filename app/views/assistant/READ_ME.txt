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









