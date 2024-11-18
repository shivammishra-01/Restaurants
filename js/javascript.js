var checkboxes = document.querySelectorAll('input[type="checkbox"]');
var quantityInputs = document.querySelectorAll('.quantity');
var priceInputs = document.querySelectorAll('.price');
var totalPriceElement = document.getElementById('totalPrice');

// Add event listeners to the checkboxes
checkboxes.forEach(function (checkbox, index) {
    checkbox.addEventListener('change', function () {
        // Check if the checkbox is checked
        if (checkbox.checked) {
            // Enable the quantity input field
            quantityInputs[index].readOnly = false;
        } else {
            // Disable the quantity input field and reset the price
            quantityInputs[index].readOnly = true;
            quantityInputs[index].value = '';
            priceInputs[index].value = '';
        }

        // Calculate the price for this item and update the price input
        var quantity = quantityInputs[index].value;
        var price = checkbox.dataset.price * quantity;
        priceInputs[index].value = price || '';

        // Calculate the overall total and update the total price element
        var overallTotal = 0;
        priceInputs.forEach(function (priceInput) {
            overallTotal += Number(priceInput.value);
        });
        document.getElementById('totalPrice').value = overallTotal;
    });
});

// Add event listeners to the quantity inputs
quantityInputs.forEach(function (quantityInput, index) {
    quantityInput.addEventListener('input', function () {
        var checkbox = checkboxes[index];

        // Calculate the price for this item and update the price input
        var quantity = quantityInput.value;
        var price = checkbox.dataset.price * quantity;
        priceInputs[index].value = price || '';

        // Calculate the overall total and update the total price element
        var overallTotal = 0;
        priceInputs.forEach(function (priceInput) {
            overallTotal += Number(priceInput.value);
        });
        document.getElementById('totalPrice').value = overallTotal;
    });
});


let input = document.getElementById("searchInput");
let resultsContainer = document.getElementById("results");
let menu=document.querySelectorAll('.menu');
input.addEventListener("input", function () {
    let searchTerm = input.value.toLowerCase();

    let headings = resultsContainer.getElementsByTagName("h5");
    for (let i = 0; i < headings.length; i++) {
        let headingText = headings[i].textContent.toLowerCase();
        if (headingText.indexOf(searchTerm) > -1) {
            headings[i].style.display = "block";
            menu[i].style.display = "block";
        } else {
            headings[i].style.display = "none";
            menu[i].style.display = "none";
        }
    }
});