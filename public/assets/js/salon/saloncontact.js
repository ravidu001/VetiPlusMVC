document.addEventListener('DOMContentLoaded', function() 
{
    const messageType = document.getElementById('messageType');
    const messageContainer = document.getElementById('messageContainer');
    const ratingContainer = document.getElementById('ratingContainer');
    const uploadContainer = document.getElementById('uploadContainer');

    function updateFormFields() {
        // Hide all optional containers first
        messageContainer.style.display = 'none';
        ratingContainer.style.display = 'none';
        uploadContainer.style.display = 'none';

        // Show message container for both types
        messageContainer.style.display = 'block';

        // Show additional fields based on selected type
        const selectedType = messageType.value;
        if (selectedType === 'Feedback') {
            ratingContainer.style.display = 'block';
        } else if (selectedType === 'Inquiry') {
            uploadContainer.style.display = 'block';
        }
    }

    // Initial call to set the correct fields on page load
    updateFormFields();

    // Add event listener to update fields when the type changes
    messageType.addEventListener('change', updateFormFields);
});