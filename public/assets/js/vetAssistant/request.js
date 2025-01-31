class AppointmentManager {
    constructor() {
        // Ensure data persists across page reloads using localStorage
        this.requests = JSON.parse(localStorage.getItem('requests')) || [
            {
                id: 1,
                doctor: 'Dr. Kasun Perera',
                date: 'Jan 15, 2024',
                startTime: '3:00 PM',
                endTime: '6:00 PM',
                location: '147, Galthude, Panadura',
                contact: '077 050 7520',
                profileImage: 'https://via.placeholder.com/70'
            },
            {
                id: 2,
                doctor: 'Dr. Saman Perera',
                date: 'Jan 20, 2024',
                startTime: '2:00 PM',
                endTime: '5:00 PM',
                location: '147, Hirana, Panadura',
                contact: '077 050 1136',
                profileImage: 'https://via.placeholder.com/70'
            }
        ];

        this.acceptedRequests = JSON.parse(localStorage.getItem('acceptedRequests')) || [];
        this.historyRequests = JSON.parse(localStorage.getItem('historyRequests')) || [];
    }

    // Method to save current state to localStorage
    saveState() {
        localStorage.setItem('requests', JSON.stringify(this.requests));
        localStorage.setItem('acceptedRequests', JSON.stringify(this.acceptedRequests));
        localStorage.setItem('historyRequests', JSON.stringify(this.historyRequests));
    }

    acceptRequest(requestId) {
        const request = this.requests.find(r => r.id === requestId);
        if (request) {
            // Remove from requests
            this.requests = this.requests.filter(r => r.id !== requestId);
            
            // Add to accepted requests
            this.acceptedRequests.push({
                ...request,
                acceptedAt: new Date().toISOString()
            });

            // Save updated state
            this.saveState();
        }
    }

    rejectRequest(requestId) {
        const request = this.requests.find(r => r.id === requestId);
        if (request) {
            // Remove from requests
            this.requests = this.requests.filter(r => r.id !== requestId);
            
            // Add to history as rejected
            this.historyRequests.push({
                ...request,
                status: 'Rejected',
                rejectedAt: new Date().toISOString()
            });

            // Save updated state
            this.saveState();
        }
    }

    moveExpiredRequests() {
        const now = new Date();

        // Move expired accepted requests to history
        const expiredRequests = this.acceptedRequests.filter(request => {
            const requestEndTime = new Date(`${request.date} ${request.endTime}`);
            return requestEndTime < now;
        });

        // Remove expired requests from accepted requests
        this.acceptedRequests = this.acceptedRequests.filter(request => {
            const requestEndTime = new Date(`${request.date} ${request.endTime}`);
            return requestEndTime >= now;
        });

        // Add expired requests to history
        expiredRequests.forEach(request => {
            this.historyRequests.push({
                ...request,
                status: 'Completed'
            });
        });

        // Save updated state
        this.saveState();
    }
}

// Create a global instance
window.appointmentManager = new AppointmentManager();

// Utility function to render tables across pages
function renderTable(tableBodyId, dataSource, isHistory = false) {
    const tableBody = document.getElementById(tableBodyId);
    
    // Ensure table body exists before trying to populate
    if (!tableBody) return;

    // Clear existing rows
    tableBody.innerHTML = '';

    // Populate table rows
    dataSource.forEach(request => {
        const row = document.createElement('tr');
        
        let statusCell = '';
        if (isHistory) {
            statusCell = `<td class="${request.status === 'Rejected' ? 'status-rejected' : 'status-completed'}">${request.status}</td>`;
        } else {
            statusCell = `
                <td>
                    <div class="action-buttons">
                        <button class="btn btn-view" onclick="viewRequest(${request.id})">View</button>
                    </div>
                </td>
            `;
        }

        row.innerHTML = `
            <td>
                <img src="${request.profileImage}" alt="${request.doctor}" class="doctor-profile">
                ${request.doctor}
            </td>
            <td>${request.date}<br>${request.startTime} - ${request.endTime}</td>
            <td>${request.location}</td>
            <td>${request.contact}</td>
            ${statusCell}
        `;
        
        tableBody.appendChild(row);
    });
}

// Function to view request details (can be expanded)
function viewRequest(requestId) {
    alert(`Viewing details for request ID: ${requestId}`);
}

// Run on page load to ensure data is up to date
document.addEventListener('DOMContentLoaded', () => {
    // Check and move expired requests
    window.appointmentManager.moveExpiredRequests();

    // Render tables based on current page
    if (document.getElementById('requestsTableBody')) {
        renderTable('requestsTableBody', window.appointmentManager.requests);
    }

    if (document.getElementById('acceptedRequestsTableBody')) {
        renderTable('acceptedRequestsTableBody', window.appointmentManager.acceptedRequests);
    }

    if (document.getElementById('historyTableBody')) {
        renderTable('historyTableBody', window.appointmentManager.historyRequests, true);
    }
});