<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Salon Time Slots</title>
    <link rel="stylesheet" href="styles.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">

  </head>
  <body>
    <div class="container">
      <h1>Salon Time Slot Configuration</h1>
      <a href="<?=ROOT?>/SalonSlot"><i class="fa-solid fa-circle-xmark pageclose"></i></a>
      <form action="submit_slots.php" method="post">
        <div class="slots">
          <label>Time Duration per Slot (minutes):
            <select name="duration">
              <option value="10">10</option>
              <option value="20">20</option>
              <option value="30">30</option>
            </select>
          </label>
          <label>Appointments per Slot:
            <input type="number" name="appointments" min="1" required />
          </label>
        </div>

        <table>
          <thead>
            <tr>
              <th>Day</th>
              <th>Start Time</th>
              <th>Close Time</th>
              <th>Closed</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Sunday</td>
              <td><input type="time" name="start_sunday"></td>
              <td><input type="time" name="close_sunday"></td>
              <td><input type="checkbox" name="closed_sunday"></td>
            </tr>
            <tr>
              <td>Monday</td>
              <td><input type="time" name="start_monday"></td>
              <td><input type="time" name="close_monday"></td>
              <td><input type="checkbox" name="closed_monday"></td>
            </tr>
            <tr>
              <td>Tuesday</td>
              <td><input type="time" name="start_tuesday"></td>
              <td><input type="time" name="close_tuesday"></td>
              <td><input type="checkbox" name="closed_tuesday"></td>
            </tr>
            <tr>
              <td>Wednesday</td>
              <td><input type="time" name="start_wednesday"></td>
              <td><input type="time" name="close_wednesday"></td>
              <td><input type="checkbox" name="closed_wednesday"></td>
            </tr>
            <tr>
              <td>Thursday</td>
              <td><input type="time" name="start_thursday"></td>
              <td><input type="time" name="close_thursday"></td>
              <td><input type="checkbox" name="closed_thursday"></td>
            </tr>
            <tr>
              <td>Friday</td>
              <td><input type="time" name="start_friday"></td>
              <td><input type="time" name="close_friday"></td>
              <td><input type="checkbox" name="closed_friday"></td>
            </tr>
            <tr>
              <td>Saturday</td>
              <td><input type="time" name="start_saturday"></td>
              <td><input type="time" name="close_saturday"></td>
              <td><input type="checkbox" name="closed_saturday"></td>
            </tr>
          </tbody>
        </table>

        <div class="options">
          <p>Create time slots for:</p>
          <label><input type="radio" name="period" value="week" required /> Per Week</label>
          <label><input type="radio" name="period" value="month" /> Per Month</label>
        </div>

        <div class="holidays">
            <p>Add holidays:</p>
            <input type="date" id="holidayDate" />
            <button onclick="addHoliday()">Add</button>
            <ul id="holidayList"></ul>
        </div>

        <div class="submit-btn">
          <button type="submit">Generate Time Slots</button>
        </div>
      </form>
    </div>

    <script>
        const holidayList = document.getElementById("holidayList");
        const holidays = [];

        function addHoliday() {
            const dateInput = document.getElementById("holidayDate");
            const dateValue = dateInput.value;
            if (dateValue && !holidays.includes(dateValue)) {
                holidays.push(dateValue);
                updateHolidayList();
                dateInput.value = "";
            }
        }

        function removeSpecificHoliday(date) {
            const index = holidays.indexOf(date);
            if (index !== -1) {
                holidays.splice(index, 1);
                updateHolidayList();
            }
        }

        function updateHolidayList() {
            holidayList.innerHTML = holidays
                .map(date => `<li>${date} <button onclick="removeSpecificHoliday('${date}')">X</button></li>`)
                .join('');
        }

    </script>

    <style>
      body {
            font-family: Arial, sans-serif;
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            background: #f0f4f8;
            margin: 0;
        }
        
        .container {
            width: 80%;
            max-width: 800px;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        /* Close button styling */
        .pageclose {
            position: absolute;
            top: 1.5rem;
            right: 1.5rem;
            font-size: 1.6rem;
            color: #6a0dad;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .pageclose:hover {
            color: #ff4d4d;
            transform: rotate(90deg);
        }

        h1 {
            text-align: center;
            color: #333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        th, td {
            padding: 10px;
            text-align: center;
            border: 1px solid #ddd;
        }
        select, input[type="date"] {
            padding: 8px;
            border-radius: 5px;
            border: 1px solid #ccc;
        }
        button {
            padding: 8px 12px;
            background: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin: 5px;
        }
        button:hover {
            background: #0056b3;
        }
        .options, .holidays {
            margin: 15px 0;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        ul li {
            background: #e9ecef;
            padding: 5px 10px;
            margin: 5px 0;
            border-radius: 5px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
    </style>
  </body>
</html>
