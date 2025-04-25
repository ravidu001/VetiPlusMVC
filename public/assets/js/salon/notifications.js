function fetchNotifications() 
{
    let container = document.querySelector('.notifications');
    if (!container) 
    {
        console.warn("No .notifications-container element found in DOM.");
        return;
    }

    fetch(`${BASE_URL}/SalonNotifications/findUpComing`)
        .then(response => response.json())
        .then(data => {
            container.innerHTML = ""; // Clear old notifications
            // console.log(data);
            if (data.length === 0) {
                const today = new Date().toISOString().split('T')[0];
                container.innerHTML = `
                    <div class="upcoming">
                        <p class="Date"><i class="fas fa-calendar-alt"></i> ${today}</p>
                        <div class="upcomingdetails">
                            <p class="Name"><i class="fas fa-user"></i> Name: - </p>
                            <p class="Service"><i class="fas fa-concierge-bell"></i> Service: - </p>
                            <p class="Slot"><i class="fas fa-clock"></i> Slot Period: - </p>
                            <p class="SlotDate"><i class="fas fa-calendar-check"></i> Slot Date: - </p>
                        </div>
                        <p class="expireDate">Available slot</p>
                    </div> 
                `;
                return;
            }

            data.forEach(notify => {
                const bookingDateTime = new Date(notify.BookingDateTime);
                const now = new Date();
                const minutesLeft = Math.floor((bookingDateTime - now) / (1000 * 60));
                console.log(notify.today);
                const html = `
                    <div class="upcoming filled-notification">
                        <p class="Date"><i class="fas fa-calendar-alt"></i> ${bookingDateTime.toLocaleString()}</p>
                        <div class="upcomingdetails">
                            <p class="Name"><i class="fas fa-user"></i> Name: ${notify.ownername}</p>
                            <p class="Service"><i class="fas fa-cut"></i> Service: ${notify.service}</p>
                            <p class="Slot"><i class="fas fa-clock"></i> Slot Period: ${notify.slot || 'N/A'}</p>
                            <p class="SlotDate"><i class="fas fa-calendar-check"></i> Slot Date: ${notify.period || 'Today'}</p>
                        </div>
                        <p class="expireDate">Appointment in ${minutesLeft} minute${minutesLeft !== 1 ? 's' : ''}</p>
                    </div>
                `;
                container.innerHTML += html;
            });
        })
        .catch(error => {
            console.error("Error fetching notifications:", error);
        });
}

setInterval(fetchNotifications, 20000);//overload every 10s
window.onload = fetchNotifications;
