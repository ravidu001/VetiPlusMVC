// Select the Appointment link and the parent menu item
const requestLink = document.querySelector(".request-link");
const requestMenu = requestLink.closest(".nav-link");

// Add event listener to the Appointment link
requestLink.addEventListener("click", (e) => {
  e.preventDefault();
  requestMenu.classList.toggle("open");
  console.log("Request clicked");
  
  const hiddenListItems_Request = document.getElementById("hiddenListItems-Request");
  
  if (hiddenListItems_Request) {
    hiddenListItems_Request.style.display === "block"
      ? (hiddenListItems_Request.style.display = "none")
      : (hiddenListItems_Request.style.display = "block");
  }
});