<template>
  <div class="page-container">
    <!-- Header section with logo and navigation -->
    <header class="header">
      <img src="../assets/logo.png" alt="Progi Logo" class="logo">
      <nav class="navbar">
        <ul>
          <li><a href="https://www.linkedin.com/in/mlarivain/" target="_blank">Contact Me</a></li>
        </ul>
      </nav>
    </header>
    <!-- Main content area -->
    <main class="main-content">
      <section class="content">
        <h1>The Bid Calculation Tool</h1>
        <p>Calculate vehicle costs, including fees, based on the base price.</p>
         <!-- Button to start the calculator -->
        <button class="explore-button" v-if="!hideButton" @click="showCalculator = true; hideButton = true">Let's go</button>
         <!-- Button to start the calculator -->
        <button class="back-button" v-if="showCalculator" @click="showCalculator = false; hideButton = false">
          <i class="mdi mdi-arrow-left"></i> Back
        </button>
        <!-- Calculator section -->
          <div v-if="showCalculator">
            <div class="calculator">
              <main class="main">
                <section>
                  <form @submit.prevent="calculatePrice">
                    <div class="form-group">
                      <label>Base Price</label>
                      <div style="display: flex; align-items: center;">
                        <input type="number" v-model="vehiclePrice" class="number-input" step="any" placeholder="Choose a base price" />
                        <span style="margin-left: 10px; color: #2E4053;">CAD</span> 
                      </div>
                    </div>
                    <div class="form-group">
                      <label>Vehicle Type</label>
                      <div class="vehicle-type-buttons">
                         <!-- Button for selecting common vehicle type -->
                        <button type="button" @click="vehicleType = 'common'" :class="{ active: vehicleType === 'common' }">
                          <span class="mdi mdi-car-side size-icon"></span> Common
                        </button>
                        <!-- Button for selecting luxury vehicle type -->
                        <button type="button" @click="vehicleType = 'luxury'" :class="{ active: vehicleType === 'luxury' }">
                          <span class="mdi mdi-car-sports size-icon"></span> Luxury
                        </button>
                      </div>
                    </div>
                    <button type="submit" class="explore-button">Calculate</button>
                    <button type="button" class="explore-button" @click="resetForm">Reset</button>
                  </form>

                  <!-- Result section displayed when totalPrice exists -->
                  <div class="result-container" v-if="totalPrice">
                    <h2>Result:</h2>
                    <p>Your total price is {{ totalPrice.total }} CAD</p>
                    <div class="details-toggle">
                      <div style="flex: 1; text-align: center;">
                        <button class="explore-button" @click="toggleDetails">{{ showDetails ? 'Hide' : 'Show' }} Details</button>
                      </div>
                      <!-- Detailed breakdown displayed if showDetails is true -->
                      <div v-if="showDetails" class="details-card">
                        <ul>
                          <li><span class="mdi mdi-cash-multiple"></span> Base Price: {{ totalPrice.base_price }} CAD</li>
                          <li><span class="mdi mdi-cash"></span> Basic Buyer Fee: {{ totalPrice.basic_buyer_fee }} CAD</li>
                          <li><span class="mdi mdi-star"></span> Special Fee: {{ totalPrice.special_fee }} CAD</li>
                          <li><span class="mdi mdi-account-group"></span> Association Fee: {{ totalPrice.association_fee }} CAD</li>
                          <li><span class="mdi mdi-store"></span> Storage Fee: {{ totalPrice.storage_fee }} CAD</li>
                        </ul>
                      </div>
                    </div>
                  </div>
                </section>
              </main>
            </div>
          </div>
      </section>
    </main>
    <!-- Footer section -->
    <footer class="footer">
      <p>&copy; LARIVAIN Morgan</p>
    </footer>
  </div>
</template>


<script>
import { ref } from 'vue';
import axios from 'axios';
import '@mdi/font/css/materialdesignicons.css';

export default {
  setup() {
    // Reactive variables to manage application state
    const showCalculator = ref(false);
    const hideButton = ref(false);
    const vehiclePrice = ref(null);
    const vehicleType = ref('common');
    const totalPrice = ref(null);
    const showDetails = ref(false);

    // Function to reset the form and state variables
    const resetForm = () => {
      vehiclePrice.value = null; 
      vehicleType.value = 'common'; 
      totalPrice.value = null; 
      showDetails.value = false; 
    };

    // Function to calculate the price based on user input
    const calculatePrice = async () => {
      // Validate user input for vehicle price
      if (vehiclePrice.value === null || vehiclePrice.value <= 0) {
        alert('Please enter a valid base price.');
        return;
      }
      try {
        // Send a POST request to the server with vehicle price and type
        const response = await axios.post('/src/api.php', {
          base_price: vehiclePrice.value,
          vehicle_type: vehicleType.value
        });
        totalPrice.value = response.data; 
        showDetails.value = false; 
      } catch (error) {
        console.error('Error during request:', error);
      }
    };

    // Function to toggle the visibility of price details
    const toggleDetails = () => {
      showDetails.value = !showDetails.value; 
    };

    // Return all reactive variables and functions for template access
    return {
      showCalculator,
      hideButton,
      vehiclePrice,
      vehicleType,
      totalPrice,
      calculatePrice,
      resetForm,
      showDetails,
      toggleDetails
    };
  }
};
</script>

<style>
/* CSS Styles */

/* Container for the entire page */
.page-container {
  display: flex;
  flex-direction: column;
  height: 100vh;
  background-image: url('../assets/bg-img.jpg'); 
  background-size: cover;
  background-position: center;
}

/* Header section styles */
.header {
  background-color: white; 
  display: flex;
  align-items: center;
  padding: 10px 20px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
}

/* Logo styles */
.logo {
  height: 50px;
  margin-right: auto;
}

/* Navbar styles */
.navbar ul {
  display: flex;
  list-style: none;
  margin: 0;
  padding: 0;
}

.navbar li {
  margin-left: 20px;
}

.navbar a {
  color: #2E4053; 
  text-decoration: none;
  font-size: 16px;
}


/* Main content section */
.main-content {
  flex: 1;
  display: flex;
  justify-content: center;
  align-items: center; 
  color: white; 
  text-align: center; 
}

/* Content box styles */
.content {
  background-color: rgba(46, 64, 83, 0.8); 
  padding: 20px;
  border-radius: 8px;
  margin-top: 14px;
  width: 35%;
  margin-bottom: 20px; 
}

/* Styles for buttons */
.explore-button {
  background-color: #00629c; 
  color: white; 
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  margin-top: 20px;
}

/* Button hover effect */
.explore-button:hover {
  background-color: #66CCCC; 
}

/* Footer styles */
.footer {
  background-color: #2E4053; 
  color: white;
  text-align: left;
  padding: 19px;
}

/* Styles for the calculator */
.calculator {
  max-width: 600px;
  padding: 20px;
  background-color: rgba(255, 255, 255, 0.9); 
  border: none; 
}

/* Main layout of the calculator */
.main {
  display: flex;
  flex-direction: column;
  align-items: center;
}

h2 {
  margin-top: 0;
  color: #2E4053; 
}

/* Form group styles */
.form-group {
  margin-bottom: 20px;
  color : #2E4053; 
}

label {
  display: block;
  margin-bottom: 10px;
}

input[type="number"], select {
  width: 100%;
  height: 40px;
  padding: 10px;
  border: 1px solid #CCCCCC;
}

button {
  background-color: #2E4053; 
  color: #FFFFFF;
  padding: 10px 20px;
  border: none;
  cursor: pointer;
  margin-left: 2%;
}

button:hover {
  background-color: #66CCCC;
}

/* Result container styles */
.result-container {
  padding: 20px;
  background-color: rgba(240, 240, 240, 0.9); 
  color: #2E4053;
}

/* Vehicle type button styles */
.vehicle-type-buttons {
  display: flex;
  justify-content: center;
  gap: 3px;
  background-color: #EAECEF;
}

.vehicle-type-buttons button {
  background-color: white; 
  color: #2E4053; 
  padding: 10px 20px;
  border: none;
  border-radius: 10px; 
  cursor: pointer;
  transition: background-color 0.3s ease; 
}

.vehicle-type-buttons button.active {
  background-color: #2E4053; 
  color: white; 
}

.size-icon {
  font-size: 35px; 
  margin-right: 8px; 
}

.number-input::-webkit-outer-spin-button,
.number-input::-webkit-inner-spin-button {
  -webkit-appearance: none;
  margin: 0;
}

/* Apparence for FireFox, Chrome and Standard */
.number-input[type="number"] {
  -moz-appearance: textfield; 
  -webkit-appearance: none; 
  appearance: none; 
}

body {
  height: 100%;
  margin: 0;
  background-color: #003466; 
}

/* Details card styles */
.details-card {
  margin-left: 20px; /* Espace entre le bouton et les détails */
  background-color: rgba(255, 255, 255, 0.9);
  border-radius: 8px;
  padding: 10px;
  box-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
}

/* Styles for toggle details button */
.details-toggle {
  display: flex;
  justify-content: space-between; 
  align-items: center; 
  margin-top: 10px; 
  width: 100%; 
}

/* List styles inside the details card */
.details-card ul {
  list-style-type: none; /* Remove list bullets */
  padding: 0;
  margin: 0; /* Remove default margin */
}

.details-card li {
  display: flex; /* Utilisation de flexbox pour aligner les icônes et le texte */
  justify-content: space-between; /* Aligne le texte à gauche et à droite */
  align-items: center; /* Aligne verticalement les éléments */
  margin-bottom: 10px; /* Ajoute un espacement entre les lignes */
}

.details-card span {
  margin-right: 10px; /* Espace entre l'icône et le texte */
  color: #2E4053; /* Couleur des icônes */
}

/* Back button styles */
.back-button {
  color: white;
  padding: 10px 20px;
  border: none;
  border-radius: 5px;
  cursor: pointer;
  margin-bottom: 20px;
}

.back-button:hover {
  background-color: transparent; 
  box-shadow: none; 
  border: none;
  cursor: pointer;
}

</style>
