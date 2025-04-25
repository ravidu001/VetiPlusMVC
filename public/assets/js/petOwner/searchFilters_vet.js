const docNameFilterContainer = document.getElementById('docNameFilter');
const docNameInput = docNameFilterContainer.querySelector('input');

const docNameFilter = new SearchableDropdown({
    inputElement: docNameInput,
    listElement: docNameFilterContainer.querySelector('ul'),
    items: docNameList
});

const districtList = [
    "Ampara", "Anuradhapura", "Badulla", "Batticaloa", "Colombo", 
    "Galle", "Gampaha", "Hambantota", "Jaffna", "Kalutara", 
    "Kandy", "Kegalle", "Kilinochchi", "Kurunegala", "Mannar", 
    "Matale", "Matara", "Monaragala", "Mullaitivu", "Nuwara Eliya", 
    "Polonnaruwa", "Puttalam", "Ratnapura", "Trincomalee", "Vavuniya"
];
const districtFilterContainer = document.getElementById('districtFilter');
const districtInput = districtFilterContainer.querySelector('input');
const districtFilter = new SearchableDropdown({
    inputElement: districtInput,
    listElement: districtFilterContainer.querySelector('ul'),
    items: districtList
});

const dateFilterContainer = document.getElementById('dateFilter');
const dateInput = dateFilterContainer.querySelector('input');

const timeFilterContainer = document.getElementById('timeFilter');
const timeInput = timeFilterContainer.querySelector('input');

let debounceTimeout;
function handleSearchInputs () {
    clearTimeout(debounceTimeout);

    debounceTimeout = setTimeout(() => {
        const docName = docNameInput.value.trim();
        const district = districtInput.value.trim();
        const selectedDate = dateInput.value;
        const startTime = timeInput.value;

        const params = new URLSearchParams();

        if (docName) params.append('docName', docName);
        if (district) params.append('district', district);
        if (selectedDate) params.append('selectedDate', selectedDate);
        if (startTime) params.append('startTime', startTime);

        const url = `PO_apptDashboard_Vet/getAvailableSessions?${params.toString()}`;

        fetchAndAppendCards(
            url,
            '.availSessCard-template',
            '.availSessCard-container'
        )
    }, 300);
}
document.querySelector('.searchFilter-container').addEventListener('input', handleSearchInputs)
document.querySelector('.searchFilter-container').addEventListener('change', handleSearchInputs)