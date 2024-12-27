

// Select the Medical link and the parent menu item
const profileLink = document.querySelector(".Profile-link");
const profileMenu = profileLink.closest(".nav-link");

// Add event listener to the Medical link
profileLink.addEventListener("click", (e) => {
  e.preventDefault();
  profileMenu.classList.toggle("open");
  console.log("Profile clicked");
  
  const hiddenListItems_Profile = document.getElementById("hiddenListItems-Profile");
  
  if (hiddenListItems_Profile) {
    hiddenListItems_Profile.style.display === "block"
      ? (hiddenListItems_Profile.style.display = "none")
      : (hiddenListItems_Profile.style.display = "block");
  }
});