const body = document.querySelector("body"),
      sidebar = body.querySelector(".sidebar"),
      toggle = body.querySelector(".toggle"),
      searchBtn = body.querySelector(".search-box"),
      modeSwitch = body.querySelector(".toggle-switch"),
      modeText = body.querySelector(".mode-text");

toggle.addEventListener("click", () => {
    sidebar.classList.toggle("close");
});

modeSwitch.addEventListener("click", () => {
    body.classList.toggle("dark");

    if (body.classList.contains("dark")) {
        modeText.innerText = "Light Mode";
    } else {
        modeText.innerText = "Dark Mode";
    }
});

// Initialize the map
function initMap() {
    // Set the initial center and zoom level
    var mapOptions = {
        center: { lat: 23.332, lng:  86.361 },
        zoom: 14
    };
    // Create a new map object
    var map = new google.maps.Map(document.getElementById('map'), mapOptions);

    // You can add additional customization here, such as markers, overlays, etc.
    // For example:
    var marker = new google.maps.Marker({
        position: { lat: -23.332, lng: 86.361 },
        map: map,
        title: 'Hello World!'
    });
}

