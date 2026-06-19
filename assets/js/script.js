/**
 * Flytify Brochure Generator — JavaScript
 *
 * This file handles the interactive parts of the
 * brochure builder. Right now only ONE feature
 * works — the primary colour preview.
 *
 * YOUR TASK:
 *   - Make the secondary colour preview work too
 *   - Add form validation (check fields are filled)
 *   - Show a preview of the selected logo image
 *   - Add a live character counter for the tagline
 */

document.addEventListener('DOMContentLoaded', function () {

    // ─── PRIMARY COLOUR (works!) ────────────────
    // When the user picks a colour, the swatch
    // next to it updates to match.

    var primaryInput = document.getElementById('primary-color');
    var primarySwatch = document.getElementById('primary-swatch');

    if (primaryInput && primarySwatch) {
        primaryInput.addEventListener('input', function () {
            primarySwatch.style.backgroundColor = this.value;
        });
    }

    // ─── SECONDARY COLOUR (broken — fix me!) ────
    // TODO: Add an event listener on the secondary
    // colour input that updates secondary-swatch.
    //
    // Hint: It works the same way as primary above.
    // You need:
    //   1. Get the element with id="secondary-color"
    //   2. Get the element with id="secondary-swatch"
    //   3. Add an 'input' event listener that sets
    //      swatch.style.backgroundColor = input.value

    var secondaryInput = document.getElementById('secondary-color');
    var secondarySwatch = document.getElementById('secondary-swatch');

    if (secondaryInput && secondarySwatch) {
        secondaryInput.addEventListener('input', function () {
            secondarySwatch.style.backgroundColor = this.value;
        });
    }

    // TODO: Your code goes here

    // ─── LOGO PREVIEW ───────────────────────────
    // TODO: When the user selects a logo file,
    // show a small preview of it on the page.
    //
    // Hint: Use the FileReader API:
    var logoInput = document.getElementById('logo');
    logoInput.addEventListener('change', function() {
        var file = this.files[0];
        if (file) {
       var reader = new FileReader();
         reader.onload = function(e) { 
            var preview = document.getElementById('logo-preview');
            preview.src = e.target.result;
            preview.style.display = 'block'; 
         };
        reader.readAsDataURL(file);
        }
    });

    // ─── FORM VALIDATION ────────────────────────
    // TODO: Before the form submits, check that
    // required fields (like Full Name) are filled.
    // Show an alert if something is missing.
    var form = document.querySelector('form');
    var nameInput = document.getElementById('name');

    if (form) {
        form.addEventListener('submit', function(e){
            if (nameInput.value.trim() === '') {
                e.preventDefault();
                alert('Please enter your full name!');
                nameInput.focus();
            }
        });
    }

    // ─── TAGLINE COUNTER ────────────────────────
    // TODO: Show a live "X / 100 characters" count
    // below the tagline input field.
    var taglineInput = document.getElementById('tagline');

    if (taglineInput) {
        var counter = document.createElement('p');
        counter.style.fontSize = '12px';
        counter.style.color = '#999';
        counter.textContent = '0 / 100 characters';
        taglineInput.parentNode.appendChild(counter);

        taglineInput.addEventListener('input', function() {
            var count = this.value.length;
            counter.textContent = count + ' / 100 characters';
            if (count > 100) {
                counter.style.color = 'red';
            }   else{
                counter.style.color = '#999';
            }
        });
    }
});
