
function convertTimeToAMPM(timeString) {
    const [hour, minute] = timeString.split(':');
    const parsedHour = parseInt(hour, 10);

    let period = 'AM';
    let formattedHour = parsedHour;

    if (parsedHour === 0) {
        formattedHour = 12;
    } else if (parsedHour === 12) {
        period = 'PM';
    } else if (parsedHour > 12) {
        formattedHour = parsedHour - 12;
        period = 'PM';
    }

    return `${formattedHour}:${minute} ${period}`;
}

function convertTimeTo24HourFormat(timeString) {
    // Split the time string into hours, minutes, and period (AM/PM)
    const [time, period] = timeString.split(' ');
    // Split the hours and minutes
    const [hours, minutes] = time.split(':');

    // Convert to 24-hour format
    let hours24 = parseInt(hours, 10);

    if (period === 'PM' && hours24 !== 12) {
        hours24 += 12;
    } else if (period === 'AM' && hours24 === 12) {
        hours24 = 0;
    }

    // Add seconds (00) to the result
    const result = `${hours24.toString().padStart(2, '0')}:${minutes}:00`;
    return result;
}