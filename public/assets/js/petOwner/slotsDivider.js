
function pad(num) {
    return num.toString().padStart(2, '0');
}

function formatDate(date) {
    // Format as 'YYYY-MM-DD HH:mm:00'
    return `${date.getFullYear()}-${pad(date.getMonth()+1)}-${pad(date.getDate())} ${pad(date.getHours())}:${pad(date.getMinutes())}:00`;
}

function divideTimeRangeBySlotDuration(start, end, slotDurationMin, apptCount) {
    const startDateTime = new Date(start.replace(' ', 'T'));
    const endDateTime = new Date(end.replace(' ', 'T'));
    const slots = [];

    let current = new Date(startDateTime);
    let slotsCreated = 0;

    while (current < endDateTime) {
        if (slotsCreated >= apptCount) break;

        const slotStart = new Date(current);
        const slotEnd = new Date(current.getTime() + slotDurationMin * 60000);

        if (slotEnd > endDateTime) break;

        slots.push({
            start: formatDate(slotStart),
            end: formatDate(slotEnd)
        });
        slotsCreated++;
        current = slotEnd;
    }

    return slots;
}
