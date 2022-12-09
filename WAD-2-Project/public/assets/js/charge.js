const app = Vue.createApp({
  data() {
      return {
          toggleNavState: false,
          toggleNavStateMobile: false,
          mobileSearchIcon: "search", 
          notifications: []
      };
  }, 
  methods: {
      toggleNav() {
          /**
           * Toggles the side navbar when the viewport is >small breakpoint size
           */
          let bodyElem = document.querySelector("#main-content");
          if (!this.toggleNavState) {
              let prevElem = document.querySelector("#side-nav-short");
              setTimeout(() => {
                  prevElem.style.transform = "translate(-100px)";

                  setTimeout(() => {
                      prevElem.style.display = "none";
  
                      let currElem = document.querySelector("#side-nav");
                      currElem.style.display = "block";
                      setTimeout(() => {
                          currElem.style.transform = "translate(195px)";
                          bodyElem.style.transform = "translate(60px)";
                      }, 250);
                  }, 500);
              }, 0);
              this.toggleNavState = !this.toggleNavState;
          } else {
              let prevElem = document.querySelector("#side-nav");
              setTimeout(() => {
                  prevElem.style.removeProperty("transform");
                  bodyElem.style.removeProperty("transform");

                  setTimeout(() => {
                      prevElem.style.display = "none";
  
                      let currElem = document.querySelector("#side-nav-short");
                      currElem.style.display = "block";
                      setTimeout(() => {
                          currElem.style.removeProperty("transform");
                      }, 250);
                  }, 500);
              }, 0); 
              this.toggleNavState = !this.toggleNavState;
          }
      }, 
      toggleNavMobile() {
          /**
           * Toggle the side navbar when the viewport is <=small breakpoint
           */
          let elem = document.querySelector("#side-nav-mobile");
          let bgElem = document.querySelector("#mobile-modal-bg");
          if (this.toggleNavStateMobile) {
              elem.style.display = "block";

              setTimeout(() => {
                  elem.style.transform = "translate(300px)";
                  bgElem.style.display = "block";
              }, 0);
              this.toggleNavStateMobile = !this.toggleNavStateMobile;
          } else {
              setTimeout(() => {
                  elem.style.removeProperty("transform");
                  setTimeout(() => {
                      elem.style.display = "none";
                      bgElem.style.display = "none";
                  }, 250);
              }, 0);
              this.toggleNavStateMobile = !this.toggleNavStateMobile;
          }
      }, 
      mobileSearch() {
          /**
           * Toggles the search bar when the viewport is at <=medium breakpoint
           */
          let elem = document.querySelector("#mobile-search-bar");
          if (this.mobileSearchIcon === "search") {
              elem.style.display = "block";
              this.mobileSearchIcon = "close";
          } else {
              elem.style.display = "none";
              this.mobileSearchIcon = "search";
          }
      }
  }, 
  computed() {
  }, 
  mounted() {
      let tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
      let tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
          return new bootstrap.Tooltip(tooltipTriggerEl)
      });

      // Create a Stripe client

      var stripe = Stripe('pk_test_51Jht19Ly7IJEzP0aFbk9pw3HgNLdioJyepRLG5RLrkFsYQEt6YnVvduslnMtdXBrOWxaUoLJ5R9jSilD19zvXge700ylTLbrWF');

      // Create an instance of Elements
      var elements = stripe.elements();

      // Custom styling can be passed to options when creating an Element.
      // (Note that this demo uses a wider set of styles than the guide below.)
      var style = {
        base: {
          color: '#32325d',
          fontFamily: '"Helvetica Neue", Helvetica, sans-serif',
          fontSmoothing: 'antialiased',
          fontSize: '16px',
          '::placeholder': {
            color: '#aab7c4'
          }
        },
        invalid: {
          color: '#fa755a',
          iconColor: '#fa755a'
        }
      };

      // Style button with BS
      document.querySelector('#payment-form button').classList =
        'btn btn-primary btn-block mt-4';

      // Create an instance of the card Element
      var card = elements.create('card', { style: style });

      // Add an instance of the card Element into the `card-element` <div>
      card.mount('#card-element');

      // Handle real-time validation errors from the card Element.
      card.addEventListener('change', function(event) {
        var displayError = document.getElementById('card-errors');
        if (event.error) {
          displayError.textContent = event.error.message;
        } else {
          displayError.textContent = '';
        }
      });

      function stripeTokenHandler(token) {
        // Insert the token ID into the form so it gets submitted to the server
        var form = document.getElementById('payment-form');
        var hiddenInput = document.createElement('input');
        hiddenInput.setAttribute('type', 'hidden');
        hiddenInput.setAttribute('name', 'stripeToken');
        hiddenInput.setAttribute('value', token.id);
        form.appendChild(hiddenInput);
      
        // Submit the form
        form.submit();
      }

      // Handle form submission
      var form = document.getElementById('payment-form');
      form.addEventListener('submit', function(event) {
        event.preventDefault();

        stripe.createToken(card).then(function(result) {
          if (result.error) {
            // Inform the user if there was an error
            var errorElement = document.getElementById('card-errors');
            errorElement.textContent = result.error.message;
          } else {
            // Send the token to your server
            stripeTokenHandler(result.token);
          }
        });
      });

      var url="../api/user.php";
      para= {
          id:"2"
      };

      axios.get(url, {params:para})
      .then(response => {
          console.log(response.data.data.email);
          let d=response.data.data;
          var name= d.username;
          var mail=d.email
          document.getElementById("first_name").value = d.username;
          document.getElementById("email").value = d.email;
      })
      .catch(error => {
          console.log(error.message)
          //document.getElementById("txtHint").innerText = error.message;
      });

      console.log(document.getElementById("first_name").value);
  }
});

app.mount("#app");