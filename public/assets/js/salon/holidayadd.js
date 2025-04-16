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
