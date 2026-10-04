 // =========================
 // CONTACT FORM
 // =========================

 const contactForm = document.querySelector(".contact-form");

 if (contactForm) {
     contactForm.addEventListener("submit", function(event) {
         event.preventDefault();

         const name = document.getElementById("contact-name").value;

         alert(
             "Thank you, " + name +
             "! Your message has been received. " +
             "We will get back to you soon."
         );

         contactForm.reset();
     });
 }

 // =========================
 // MOBILE MENU
 // =========================

 const menuToggle = document.getElementById("menu-toggle");
 const mainNav = document.getElementById("main-nav");

 if (menuToggle && mainNav) {
     menuToggle.addEventListener("click", function() {
         mainNav.classList.toggle("show");
     });
 } // =========================
 // BOOKING SEARCH & FILTER
 // =========================

 const searchBookings = document.getElementById("searchBookings");
 const statusFilter = document.getElementById("statusFilter");

 if (searchBookings && statusFilter) {

     function filterBookings() {

         const searchValue = searchBookings.value.toLowerCase();
         const selectedStatus = statusFilter.value;

         const rows = document.querySelectorAll(".booking-card tbody tr");

         rows.forEach(function(row) {

             const customer = row.cells[0].textContent.toLowerCase();
             const phone = row.cells[1].textContent.toLowerCase();
             const status = row.cells[6].textContent.trim();

             const matchesSearch =
                 customer.includes(searchValue) ||
                 phone.includes(searchValue);

             const matchesStatus =
                 selectedStatus === "all" ||
                 status.includes(selectedStatus);

             if (matchesSearch && matchesStatus) {
                 row.style.display = "";
             } else {
                 row.style.display = "none";
             }

         });
     }

     searchBookings.addEventListener("input", filterBookings);

     statusFilter.addEventListener("change", filterBookings);
 } // =========================
 // PREVENT PAST BOOKING DATES
 // =========================

 document.addEventListener("DOMContentLoaded", function() {

     const bookingDate = document.getElementById("date");

     if (bookingDate) {

         const today = new Date();

         const year = today.getFullYear();
         const month = String(today.getMonth() + 1).padStart(2, "0");
         const day = String(today.getDate()).padStart(2, "0");

         const todayDate = `${year}-${month}-${day}`;

         bookingDate.min = todayDate;
     }

 });