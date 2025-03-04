
// Initial seat count for each bus
let availableSeats = {
    bus1: 60,
    bus2: 60,
    bus3: 60
};

function bookSeats(busId, event) {
    event.preventDefault(); // Prevent page reload

    let seatElement = document.getElementById(`seats${busId}`);
    let selectElement = document.getElementById(`selectSeats${busId}`);
    let selectedSeats = parseInt(selectElement.value);

    if (selectedSeats > availableSeats[`bus${busId}`]) {
        alert("Not enough seats available!");
        return false;
    }

    // Deduct selected seats
    availableSeats[`bus${busId}`] -= selectedSeats;
    seatElement.innerText = availableSeats[`bus${busId}`];

    // Show success message
    let successMessage = document.getElementById("successMessage");
    successMessage.innerText = `You have successfully booked ${selectedSeats} seat(s) for Bus ${busId}!`;
    successMessage.classList.remove("d-none");

    // Reset only the selected field
    selectElement.value = "1";

    // Save seat availability changes in local storage so they persist even if the page is refreshed
    localStorage.setItem(`availableSeats`, JSON.stringify(availableSeats));

    return false;
}

// Search function for filtering buses based on source, destination, and onward date
function searchBuses() {
    const source = document.getElementById("sourceSelect").value;
    const destination = document.getElementById("destinationSelect").value;
    const onwardDate = document.getElementById("onwardDate").value;

    // Filter bus cards based on selected source, destination, and date
    let busCards = document.querySelectorAll(".busCard");
    let foundBus = false;

    // If onwardDate is not selected, ignore date comparison
    busCards.forEach(card => {
        let cardSource = card.getAttribute("data-source");
        let cardDestination = card.getAttribute("data-destination");
        let cardDate = card.getAttribute("data-date");

        if (
            (source === "Source" || cardSource === source) && 
            (destination === "Destination" || cardDestination === destination) && 
            (onwardDate === "" || cardDate === onwardDate)
        ) {
            card.style.display = "block";
            foundBus = true;
        } else {
            card.style.display = "none";
        }
    });

    if (!foundBus) {
        alert("No buses available for the selected route and date.");
    }
}

// Initialize available seats from local storage (if any)
window.onload = function() {
    let storedSeats = localStorage.getItem("availableSeats");
    if (storedSeats) {
        availableSeats = JSON.parse(storedSeats);
        document.getElementById("seats1").innerText = availableSeats.bus1;
        document.getElementById("seats2").innerText = availableSeats.bus2;
        document.getElementById("seats3").innerText = availableSeats.bus3;
    }
};
