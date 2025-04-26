function fetchNotifications() 
{
    let countSpan = document.querySelector('.notification-count');
    if (!countSpan) 
    {
        console.warn("No .notification-count element found in DOM.");
        return;
    }

    fetch(`${BASE_URL}/SalonNotifications/findUpComing`)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.length !== undefined) {
                countSpan.textContent = data.length;
            } else {
                countSpan.textContent = "0";
            }
        })
        .catch(error => {
            console.error("Error fetching notifications:", error);
            countSpan.textContent = "0"; // fallback on error
        });
}

setInterval(fetchNotifications, 20000); // 20 seconds
window.onload = fetchNotifications;
