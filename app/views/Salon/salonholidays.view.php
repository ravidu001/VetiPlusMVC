<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
</head>
<body>
    <div class="holidays">
        <a href="<?=ROOT?>/SalonSlot"><i class="fa-solid fa-circle-xmark pageclose"></i></a>

        <form action="<?=ROOT?>/SalonHolidays" method="post">
            <div class="holidays">
            <p>Add holidays:</p>
            <input type="date" id="holidayDate" />
            <button type="button" onclick="addHoliday()">Add</button>

            <ul id="holidayList"></ul>

            <!-- Hidden input to store holidays array -->
            <div id="hiddenInputs"></div>

            <button type="submit" name="saveholidays">Save</button>
        </form>
    </div>
</body>

<script>
    const holidayList = document.getElementById("holidayList");
    const hiddenInputs = document.getElementById("hiddenInputs");
    const holidays = [];

    //  Function to add holidays
    function addHoliday() 
    {
        const dateInput = document.getElementById("holidayDate");
        const dateValue = dateInput.value;

        if (dateValue && !holidays.includes(dateValue)) 
        {
            holidays.push(dateValue);
            updateHolidayList();
            updateHiddenInputs();
            dateInput.value = "";
        }
    }

    //  Function to remove specific holiday
    function removeSpecificHoliday(date) 
    {
        const index = holidays.indexOf(date);
        if (index !== -1) 
        {
            holidays.splice(index, 1);
            updateHolidayList();
            updateHiddenInputs();
        }
    }

    //  Update list in UI
    function updateHolidayList() 
    {
        holidayList.innerHTML = holidays
            .map(date => `<li>${date} <button type="button" onclick="removeSpecificHoliday('${date}')">X</button></li>`)
            .join('');
    }

    //  Update hidden inputs to send holidays via PHP
    function updateHiddenInputs() 
    {
        hiddenInputs.innerHTML = holidays
            .map(date => `<input type="hidden" name="holidays[]" value="${date}" />`)
            .join('');
    }
</script>

</html>