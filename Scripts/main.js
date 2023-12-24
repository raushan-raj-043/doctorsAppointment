'use strict';

var final_mode = "Clinic";
var cnt = 0;
var final_date = new Date();
var choosen_time;
var selectedDoctorId = 1;
var selectedUserId = 1;


const items = document.querySelectorAll(".accordion button");
function toggleAccordion() {
  const itemToggle = this.getAttribute('aria-expanded');
  
  for (var i = 0; i < items.length; i++) {
    items[i].setAttribute('aria-expanded', 'false');
  }
  
  if (itemToggle == 'false') {
    this.setAttribute('aria-expanded', 'true');
  }
};

items.forEach(item => item.addEventListener('click', toggleAccordion));


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

// for choice of appoitment
const clinic = document.querySelector('.Clinic');
const video = document.querySelector('.Video');
const audio = document.querySelector('.Audio');

clinic.addEventListener('click', selectMode);
video.addEventListener('click', selectMode);
audio.addEventListener('click', selectMode);

function selectMode(event) {
    var modeContent = event.currentTarget.querySelector('.mode').textContent;
    console.log(modeContent);
    if (modeContent === "Clinic") {
        clinic.classList.add('selected_type');
        video.classList.remove('selected_type');
        audio.classList.remove('selected_type');
    } else if (modeContent === "Video") {
        video.classList.add('selected_type');
        clinic.classList.remove('selected_type');
        audio.classList.remove('selected_type');
    } else {
        audio.classList.add('selected_type');
        clinic.classList.remove('selected_type');
        video.classList.remove('selected_type');
    }
    final_mode = modeContent;
}

window.onload = function () {
    // const todaysDate = document.getElementById("todays-date");
    const dayAftertomorrowsDate = document.getElementById("day-tomorrows-date");
    const availableSlots = document.getElementById("available-slots");

    function getFormattedDate(date) {
        const options = { year: 'numeric', month: 'long', day: 'numeric' };
        return date.toLocaleDateString(undefined, options);
    }

    function updateDisplay() {
        const currentDate = new Date();
        const todaysFormattedDate = getFormattedDate(currentDate);
        const dayAfterTomorrow = getFormattedDate(new Date(currentDate.getTime() + 2*24 * 60 * 60 * 1000));
        dayAftertomorrowsDate.textContent = dayAfterTomorrow;
    }
    updateDisplay();
    setInterval(updateDisplay, 1000 * 60); // Update every minute
};

// selecting date
const today = document.querySelector('.today');
const tomorrow = document.querySelector('.tomorrow');
const dayAfterTomorrow = document.querySelector('.dayAfterTomorrow');

today.addEventListener('click', selectDate);
tomorrow.addEventListener('click', selectDate);
dayAfterTomorrow.addEventListener('click', selectDate);

function selectDate(event) {
    var choosenDate = event.currentTarget.querySelector('.content').textContent;
    console.log(choosenDate);

    if (choosenDate === "Today") {
        final_date = new Date();
        today.classList.add('date_choosen');
        tomorrow.classList.remove('date_choosen');
        dayAfterTomorrow.classList.remove('date_choosen');
    } else if (choosenDate === "Tomorrow") {
        const currentDate = new Date();
        final_date = new Date(currentDate.getTime() + 24 * 60 * 60 * 1000);
        tomorrow.classList.add('date_choosen');
        today.classList.remove('date_choosen');
        dayAfterTomorrow.classList.remove('date_choosen');
    } else {
        const currentDate = new Date();
        final_date = new Date(currentDate.getTime() + 2*24 * 60 * 60 * 1000);
        dayAfterTomorrow.classList.add('date_choosen');
        today.classList.remove('date_choosen');
        tomorrow.classList.remove('date_choosen');
    }

    const selectedDate = final_date;
    const formattedDate = selectedDate.toISOString().split('T')[0];
    getAvailableSlots(formattedDate, selectedDoctorId)
    .then(slots => {
        console.log('Available slots:', slots);
        console.log(formattedDate);
        displayAvailableSlots(slots);
    });
}

const prev = document.querySelector('.prev');
const next = document.querySelector('.next');

prev.addEventListener('click', moveDateBackward);
next.addEventListener('click', moveDateForward);

function moveDateBackward(event) {
    if(cnt != 0){
        // toodo
    }
    else{
        prev.disabled = true;
        prev.classList.add('fade');
        console.log('faded')
    }
}

function moveDateForward(event){
    cnt++;
    const currentDate = new Date();
    // remaining
}

// date choice
const availableSlots = document.querySelector('.available-slots');
availableSlots.addEventListener('click', selectTime);

function selectTime(event){
    if (event.target.tagName === 'LI') {

        // Remove the existing selected class from all list items
        var listItems = availableSlots.querySelectorAll('li');
        listItems.forEach(item => item.classList.remove('selected_time'));

        // Add the 'selected' class to the clicked list item
        event.target.classList.add('selected_time');
        var chosenTime = event.target.textContent;
        console.log(chosenTime);
        choosen_time = chosenTime;
    }
}

// continue button
const cnt_btn = document.querySelector('.cnt_btn');
cnt_btn.addEventListener('click', bookAppointment);

async function bookAppointment(event) {
    var formattedDate = final_date.toISOString().split('T')[0];
    console.log(formattedDate + " " + choosen_time);

    if (choosen_time != null) {
        const data = {
            userid: selectedUserId,
            date: formattedDate,
            time: convertTimeTo24HourFormat(choosen_time),
            doctorid: selectedDoctorId
        };
        console.log(data);

        try {
            const response = await fetch(`DB_api/book_slot.php?date=${data.date}&doctorid=${data.doctorid}&time=${data.time}&userid=${data.userid}`);

            if (!response.ok) {
                throw new Error(`HTTP error: ${response.status}`);
            }

            const result = await response.json();
            console.log(result);
            // Process the result as needed
        } catch (error) {
            console.error('An error occurred:', error);
        }
        alert('Booking sucessful !');
        getAvailableSlots(formattedDate, selectedDoctorId)
        .then(slots => {
            console.log('Available slots:', slots);
            console.log(formattedDate);
            displayAvailableSlots(slots);
        });
    } else {
        alert('Please select a correct date and time');
    }
}


async function getAvailableSlots(date, doctorId) {
    try {
        const response = await fetch(`DB_api/available_slots.php?date=${date}&doctor_id=${doctorId}`);

        if (!response.ok) {
            throw new Error(`HTTP error: ${response.status}`);
        }

        const slots = await response.json();
        return slots.map(slot => slot.time);
    } catch (error) {
        console.error('An error occurred:', error);
        return [];
    }
}


function displayAvailableSlots(apiSlots) {
    const predefinedSlots = ["9:00 AM", "10:00 AM", "11:00 AM", "1:00 PM", "2:00 PM", "3:00 PM", "4:00 PM"];
    apiSlots = apiSlots.map(time => convertTimeToAMPM(time));

    // Remove booked slots from predefined slots
    const uniqueSlots = predefinedSlots.filter(slot => !apiSlots.includes(slot));
    console.log(uniqueSlots);
    const selectedElement = document.querySelector('.date_choosen:has(#count_availablity)');
    if (selectedElement) {
        const countAvailablity = selectedElement.querySelector('#count_availablity');
        if (uniqueSlots.length == 0) {
            countAvailablity.innerHTML = "Not Available";
        }else countAvailablity.innerHTML = uniqueSlots.length.toString() + " Available";
        // console.log(selectedElement);
    } else {
        console.log('No element with class "selected" containing #count_availablity found');
    }

    const availableSlots = document.getElementById("available-slots");
    availableSlots.innerHTML = ''; // Clear previous slots

    if (uniqueSlots.length === 0) {
        console.log('No unique available slots for the specified date and doctor.');
        return;
    }
    uniqueSlots.forEach(slot => {
        const listItem = document.createElement('li');
        listItem.textContent = `${slot}`;
        availableSlots.appendChild(listItem);
    });
}

const formattedDate = final_date.toISOString().split('T')[0];
getAvailableSlots(formattedDate, selectedDoctorId)
    .then(slots => {
        displayAvailableSlots(slots);
});
    


