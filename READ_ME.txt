VetDoctor
update doctorreview.view page 
    view-alter class content is hard coded and it should be remove after backend is done.
    relevant js file 1-54 line shuld be un comment and add relavent url here (fetch(''))
    @394 line in css file /* remove after new code added to the reviewNotification section */




Vet Assistant


this is the page about vet doctor can review their vet assistants after assistants attend to the appointment session.

this is the html and js file
```
<div class="maincontainer" id="blur" >
    <div class="heading">To Review</div>

    <table class="toReview">
        <thead class="toReviewHead">
            <th>No.</th>
            <th>Profile</th>
            <th>Name</th>
            <th>Starting time</th>
            <th>Closing time</th>
            <th>Location</th>
            <th></th>
        </thead>
        <tr>
            <td>1</td>
            <td><img src="../../../client/assets/images/doctorprofile.jpg" alt="profile" /></td>
            <td>Pabodya</td>
            <td>2024/08/17 15:00</td>
            <td>2024/08/17 17:00</td>
            <td>147, Galthude, Panadura</td>
            <td>
                <a href="#" onclick="togglePopup()">
                    <i class='bx bx-right-arrow-circle button' ></i>
                </a>
            </td>
        </tr>

        <tr>
            <td>2</td>
            <td><img src="../../../client/assets/images/doctorprofile.jpg" alt="profile" /></td>
            <td>Kasun Mendis</td>
            <td>2024/08/19 15:00</td>
            <td>2024/08/19 17:00</td>
            <td>147, Galthude, Colombo</td>
            <td>
                <a href="#" onclick="togglePopup('Kasun Mendis')">
                    <i class='bx bx-right-arrow-circle button' ></i>
                </a>
            </td>
        </tr>

        <tr>
            <td>3</td>
            <td><img src="../../../client/assets/images/doctorprofile.jpg" alt="profile" /></td>
            <td>Sunil Mendis</td>
            <td>2024/08/20 15:00</td>
            <td>2024/08/20 17:00</td>
            <td>150, Galthude, Colombo</td>
            <td>
                <a href="#" onclick="togglePopup()">
                    <i class='bx bx-right-arrow-circle button' ></i>
                </a>
            </td>
        </tr>
    </table>
</div>

<div id="popup">
    <div class="popupframe">
        <div class="container1">
            <div class="profile">
                <img src="../../../client/assets/images/logo.png" alt="profile" class="profilepic" />
                <h1>Dr. Kasun Mendis</h1>
            </div>
        </div>

        <form action="feedback.php" method="post" class="form-style">
            <div class="formtext">
                Message <br />
            </div>
            <textarea name="message" id="message" cols="75" rows="10"></textarea>
            <br />
            <div class="formtext">
                Rating <br /> 
            </div>
            
            <div class="rating">
                <div class="star-widget"> 
                    <input type="radio" name="rate" id="rate-5">
                    <label for="rate-5" class="fas fa-star"></label>
                    <input type="radio" name="rate" id="rate-4">
                    <label for="rate-4" class="fas fa-star"></label>
                    <input type="radio" name="rate" id="rate-3">
                    <label for="rate-3" class="fas fa-star"></label>
                    <input type="radio" name="rate" id="rate-2">
                    <label for="rate-2" class="fas fa-star"></label>
                    <input type="radio" name="rate" id="rate-1">
                    <label for="rate-1" class="fas fa-star"></label>
                    
                    <header> </header>

                </div>
            </div>
            <div >
                <input type="button" class="buttoncontainer" value="Cancel" onclick="togglePopup()">

                <input type="submit" class="buttoncontainer">
            </div>
        </form>
    

    </div>
</div>

<script>
    function togglePopup(name) {
    const popup = document.getElementById('popup');
    const doctorName = popup.querySelector('.container1 h1');
    doctorName.textContent = `Dr. ${name}`;
    popup.classList.toggle('active');

    const blur = document.getElementById('blur');
    blur.classList.toggle('active');
}
</script>
```

this is the css file 
```
.heading {
    font-size: 30px;
    color: var(--text-primary);
    font-family: 'arial';
    font-weight: bold;
    margin-left: 30px;
    margin-top: 30px;
    margin-bottom: 40px;
}

.maincontainer{
    color: black;
}

.maincontainer#blur.active {
    filter: blur(10px);
    pointer-events: none; 
    user-select: none;
}

.toReview {
    border-collapse: collapse;
    width: 97%;
    font-family: Arial, Helvetica, sans-serif;
    text-align: left;
    border-radius: 10px;
    overflow: hidden;
    margin-left: 30px;
    margin-top: 30px;
    margin-bottom: 30px;
}

.toReviewHead {
    background-color: var(--background-primary);
    color: var(--text-white);
    font-size: 20px;
    height: 60px;
}

.toReview th, td {
    padding-left: 15px;
    border-bottom: 6px solid var(--background-white);
    font-weight: bold;
}

.toReview tr td {
    background-color: var(--list-item);
    height: 120px;
    padding-bottom: 0px;
}

.toReview tr td img {
    width: 60px;
    height: 60px;
    margin-top: 0px;    
    border-radius: 50px;
}

.toReview tr:last-child td:first-child {
    border-bottom-left-radius: 20px;
}

.toReview tr:last-child td:last-child {
    border-bottom-right-radius: 20px;
}

.button {
    color: black;
    font-size: 40px;
}

.button:hover {
    text-shadow: var(--shadow-color) 1px 1px 1px;
}

#popup{
    position: fixed;
    top: 50%;
    left: 50%;
    transform: translate(-50%, -50%);
    width: 600px;
    height: auto;
    padding:50px;
    border: 2px solid var(--text-primary);
    border-radius: 10px;
    box-shadow: 0 5px 30px rgba(0, 0, 0, .30);
    visibility: hidden;
    opacity: 0;
    transition: 0.5s;
    background: var(--background-white);
}

#popup.active{
    top: 50%;  
    visibility: visible;
    opacity: 1;
    transition: 0.5s;
}

.container1 {
    display: block;
    margin-left: 0px;
    margin-top: -20px;
    margin-bottom: 20px;
    background: var(--background-light);
    height: 90px;
    width: 90%;
    padding-left: 20px;
    padding-top: 0px;
    border-radius: 15px;
    box-shadow: var(--shadow-color) 5px 5px 5px;
    
}

.container1 h1 {
    color: var(--text-black);
    font-size: 25px;
    font-weight: bold;
    padding-top: 30px;
    font-family: 'arial';
    
}

.container1 img{
    float: left;
    width: 60px;
    height: 60px;
    margin-top: 15px;
    margin-right: 30px;
}

.formtext {
    font-size: 20px;
    color: var(--text-black);
    font-family: 'arial';
    margin-top: 20px;
    margin-bottom: 10px;
}

.buttoncontainer {
    background: var(--text-primary);
    color: var(--text-white);
    font-size: 20px;
    border-radius: 10px;
    padding: 10px;
    margin-top: 20px;
    margin-left: 20px;
    margin-bottom: 10px;
    width: 200px;
    font-family: 'arial';
    cursor: pointer;
}

/*input type is number*/
.rating {
    width: 400px;
    background: none;
    padding: 10px 10px;
    display: flex;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}

.rating .star-widget input {
    display: none;
}

.star-widget label {
    font-size: 40px;
    color: #444; 
    padding: 10px;
    float: right;
    transition: all 0.2s ease;
}

.star-widget input:not(:checked) ~ label:hover,
.star-widget input:not(:checked) ~ label:hover ~ label {
    color: var(--text-primary);
}

.star-widget input:checked ~ label {
    color: var(--text-primary);
}

input#rate-5:checked ~ label {
    color: var(--text-primary);
    text-shadow: 0 0 20px var(--background-light);
}

/* Display rating text based on selection */
#rate-1:checked ~ header:before {
    content: 'Very Bad 😖';
} 
#rate-2:checked ~ header:before {
    content: 'Bad 🙁';
}
#rate-3:checked ~ header:before {
    content: 'Good 😃';
}
#rate-4:checked ~ header:before {
    content: 'Very Good 😎';
}
#rate-5:checked ~ header:before {
    content: "Excellent 😍";
}

star-widget header {
    display: none;
}

input:checked ~ header {
    display: block;
}

.star-widget header {
    width: 100%;
    font-size: 25px;
    color: var(--text-primary);
    font-weight: 500;
    margin: 5px 0 20px 0;
    text-align: center;
    transition: all 0.2s ease;
} 
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

There should be two buttons named, pending reviewes and the completed reviews.
in the pending section should display all the reviews that vet should still not replied yet.
in the completed section should display all the reviews that vet doctor already replied. Apart from details, it should include reply message and the rating as well.

in a row, there should only be one card
I am,
row 1 : card 1
row 2 : card 2
... like wise.

Give me a single code without break down. I need single file. Give me best one. Don't forget I am still only UI interfaces that means I did not have still backend. So, I need hard coded output to see how UI is look like 