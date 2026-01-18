@extends('layouts.app')

@section('title', 'Canteen Pay System')

@section('content')

<style>
    #floating-button {
        position: fixed;
        top: 20px;
        right: 20px;
        z-index: 1000;
        padding: 10px 16px;
        display: flex;
        flex-direction: column;
        align-items: flex-end;
        /*gap: 6px;  controls spacing */
    }

    #total-display {
        background: rgba(0,0,0,0.85);
        color: white;
        padding: 10px 16px;
        border-radius: 999px;
        font-weight: bold;
    }

    .pay-btn {
        padding: 8px 16px;
    }

</style>

<div class="background-image"></div>
<div class="row">
    <div class="col-md-12 mb-3"><br></div>
    <div class="col-md-12 form-container">
        <form id="order" name="order">
            @csrf
            
            <div class="row">
                <div class="col-md-12 text-center">
                    <img src="{{ asset('img/banner.png') }}" class="img-fluid mb-3" alt="Canteen Pay System">
                </div>
            </div>

            <div class="text-center">
                <h2 class="fw-bold" style="font-size:1.3rem;">Menu</h2>
            </div>
            
            <!-- Menu Items -->
            
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <img src="{{ asset('img/nasi_lemak.png') }}" class="card-img-top" alt="Nasi Lemak">
                        <div class="card-body text-center d-flex flex-column">
                            <h5 class="card-title">Nasi Lemak</h5>
                            <p class="card-text">RM 5.00</p>
                            <div class="d-flex justify-content-center align-items-center mb-2 mt-auto">
                                <button type="button" class="btn btn-sm btn-outline-secondary me-1" onclick="changeQty('nasi_lemak', -1)">-</button>
                                <span id="qty_nasi_lemak" class="mx-1">0</span>
                                <button type="button" class="btn btn-sm btn-outline-secondary ms-1" onclick="changeQty('nasi_lemak', 1)">+</button>
                            </div>
                            <input type="hidden" name="nasi_lemak" id="input_nasi_lemak" value="0">
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <img src="{{ asset('img/burger.png') }}" class="card-img-top" alt="Burger">
                        <div class="card-body text-center d-flex flex-column">
                            <h5 class="card-title">Burger</h5>
                            <p class="card-text">RM 8.00</p>
                            <div class="d-flex justify-content-center align-items-center mb-2 mt-auto">
                                <button type="button" class="btn btn-sm btn-outline-secondary me-1" onclick="changeQty('burger', -1)">-</button>
                                <span id="qty_burger" class="mx-1">0</span>
                                <button type="button" class="btn btn-sm btn-outline-secondary ms-1" onclick="changeQty('burger', 1)">+</button>
                            </div>
                            <input type="hidden" name="burger" id="input_burger" value="0">
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <img src="{{ asset('img/pizza.png') }}" class="card-img-top" alt="Pizza">
                        <div class="card-body text-center d-flex flex-column">
                            <h5 class="card-title">Pizza</h5>
                            <p class="card-text">RM 12.00</p>
                            <div class="d-flex justify-content-center align-items-center mb-2 mt-auto">
                                <button type="button" class="btn btn-sm btn-outline-secondary me-1" onclick="changeQty('pizza', -1)">-</button>
                                <span id="qty_pizza" class="mx-1">0</span>
                                <button type="button" class="btn btn-sm btn-outline-secondary ms-1" onclick="changeQty('pizza', 1)">+</button>
                            </div>
                            <input type="hidden" name="pizza" id="input_pizza" value="0">
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <img src="{{ asset('img/fried_chicken.png') }}" class="card-img-top" alt="Fried Chicken">
                        <div class="card-body text-center d-flex flex-column">
                            <h5 class="card-title">Fried Chicken</h5>
                            <p class="card-text">RM 6.00</p>
                            <div class="d-flex justify-content-center align-items-center mb-2 mt-auto">
                                <button type="button" class="btn btn-sm btn-outline-secondary me-1" onclick="changeQty('fried_chicken', -1)">-</button>
                                <span id="qty_fried_chicken" class="mx-1">0</span>
                                <button type="button" class="btn btn-sm btn-outline-secondary ms-1" onclick="changeQty('fried_chicken', 1)">+</button>
                            </div>
                            <input type="hidden" name="fried_chicken" id="input_fried_chicken" value="0">
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <img src="{{ asset('img/chicken_chop.png') }}" class="card-img-top" alt="Chicken Chop">
                        <div class="card-body text-center d-flex flex-column">
                            <h5 class="card-title">Chicken Chop</h5>
                            <p class="card-text">RM 10.00</p>
                            <div class="d-flex justify-content-center align-items-center mb-2 mt-auto">
                                <button type="button" class="btn btn-sm btn-outline-secondary me-1" onclick="changeQty('chicken_chop', -1)">-</button>
                                <span id="qty_chicken_chop" class="mx-1">0</span>
                                <button type="button" class="btn btn-sm btn-outline-secondary ms-1" onclick="changeQty('chicken_chop', 1)">+</button>
                            </div>
                            <input type="hidden" name="chicken_chop" id="input_chicken_chop" value="0">
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <img src="{{ asset('img/chicken_fries.png') }}" class="card-img-top" alt="Chicken Fries">
                        <div class="card-body text-center d-flex flex-column">
                            <h5 class="card-title">Chicken Fries</h5>
                            <p class="card-text">RM 8.00</p>
                            <div class="d-flex justify-content-center align-items-center mb-2 mt-auto">
                                <button type="button" class="btn btn-sm btn-outline-secondary me-1" onclick="changeQty('chicken_fries', -1)">-</button>
                                <span id="qty_chicken_fries" class="mx-1">0</span>
                                <button type="button" class="btn btn-sm btn-outline-secondary ms-1" onclick="changeQty('chicken_fries', 1)">+</button>
                            </div>
                            <input type="hidden" name="chicken_fries" id="input_chicken_fries" value="0">
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <h2 class="fw-bold" style="font-size:1.3rem;">Drinks</h2>
            </div>

            <div class="row">
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <img src="{{ asset('img/orange_drink.png') }}" class="card-img-top" alt="Orange Drink">
                        <div class="card-body text-center d-flex flex-column">
                            <h5 class="card-title">Orange Drink</h5>
                            <p class="card-text">RM 3.00</p>
                            <div class="d-flex justify-content-center align-items-center mb-2 mt-auto">
                                <button type="button" class="btn btn-sm btn-outline-secondary me-1" onclick="changeQty('orange_drink', -1)">-</button>
                                <span id="qty_orange_drink" class="mx-1">0</span>
                                <button type="button" class="btn btn-sm btn-outline-secondary ms-1" onclick="changeQty('orange_drink', 1)">+</button>
                            </div>
                            <input type="hidden" name="orange_drink" id="input_orange_drink" value="0">
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <img src="{{ asset('img/lime_drink.png') }}" class="card-img-top" alt="Lime Drink">
                        <div class="card-body text-center d-flex flex-column">
                            <h5 class="card-title">Lime Drink</h5>
                            <p class="card-text">RM 3.00</p>
                            <div class="d-flex justify-content-center align-items-center mb-2 mt-auto">
                                <button type="button" class="btn btn-sm btn-outline-secondary me-1" onclick="changeQty('lime_drink', -1)">-</button>
                                <span id="qty_lime_drink" class="mx-1">0</span>
                                <button type="button" class="btn btn-sm btn-outline-secondary ms-1" onclick="changeQty('lime_drink', 1)">+</button>
                            </div>
                            <input type="hidden" name="lime_drink" id="input_lime_drink" value="0">
                        </div>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <div class="card h-100">
                        <img src="{{ asset('img/soft_drink.png') }}" class="card-img-top" alt="Soft Drink">
                        <div class="card-body text-center d-flex flex-column">
                            <h5 class="card-title">Soft Drink</h5>
                            <p class="card-text">RM 4.00</p>
                            <div class="d-flex justify-content-center align-items-center mb-2 mt-auto">
                                <button type="button" class="btn btn-sm btn-outline-secondary me-1" onclick="changeQty('soft_drink', -1)">-</button>
                                <span id="qty_soft_drink" class="mx-1">0</span>
                                <button type="button" class="btn btn-sm btn-outline-secondary ms-1" onclick="changeQty('soft_drink', 1)">+</button>
                            </div>
                            <input type="hidden" name="soft_drink" id="input_soft_drink" value="0">
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-12 text-center">
                    
                </div>
            </div>
        </form>

        <!-- Floating Proceed to Payment Button -->
        
        <div id="floating-button">
            <div id="floating-container" style="background: white; padding: 15px; border-radius: 10px; box-shadow: 0 4px 8px rgba(0,0,0,0.1); border: 1px solid #ddd; min-width: 200px; display: none;">
                <div id="floating-items" style="margin-bottom: 10px; max-height: 150px; overflow-y: auto;">
                    <!-- Items will be displayed here -->
                </div>
                <div id="total-display" class="text-white" style="text-align: center; margin-bottom: 10px; font-weight: bold; color: #333;">
                    Total: RM <span id="floating-total">0.00</span>
                </div>

                <button
                    type="button"
                    class="btn btn-success w-100"
                    onclick="proceedToPayment()"
                >
                    Proceed to Payment
                </button>
            </div>
        </div>

        </form>

        <!-- Payment Section -->
        <div id="payment-section" style="display: none;">
            <div class="container mt-5">
                <div class="row justify-content-center">
                    <div class="col-md-10">
                        <div class="card shadow-lg border-0">
                            <div class="card-header bg-gradient-primary text-black text-center py-4">
                                <h2 class="mb-0">Confirm Payment</h2>
                                <p class="mb-0 mt-1">Complete your order with QR code payment</p>
                            </div>
                            <div class="card-body p-4">
                                <div class="row g-4">
                                    <div class="col-md-12">
                                        <div class="card border-0 bg-light mb-4">
                                            <div class="card-body">
                                                <div class="d-flex justify-content-between align-items-center mb-3">
                                                    <h5 class="card-title mb-0 text-primary">
                                                        <i class="fas fa-shopping-cart me-2"></i>Order Summary
                                                    </h5>
                                                    <button class="btn btn-sm btn-outline-primary" type="button" data-bs-toggle="collapse" data-bs-target="#orderDetails" aria-expanded="false" aria-controls="orderDetails">
                                                        <i class="fas fa-chevron-down" id="collapseIcon"></i>
                                                    </button>
                                                </div>
                                                <div class="collapse" id="orderDetails">
                                                    <div style="max-height: 200px; overflow-y: auto;">
                                                        <ul id="item-listing" class="list-group list-group-flush">
                                                            <!-- Items will be populated here -->
                                                        </ul>
                                                    </div>
                                                    <hr class="my-3">
                                                </div>
                                                <div class="text-center">
                                                    <div class="bg-success text-white rounded-pill py-2 px-4 d-inline-block">
                                                        <h4 class="mb-0 fw-bold">Total: RM <span id="payment-total">0.00</span></h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row g-4">
                                    <div class="col-md-12">
                                        <div class="card border-0 bg-light">
                                            <div class="card-body text-center">
                                                <h5 class="card-title mb-4 text-success">
                                                    <i class="fas fa-qrcode me-2"></i>Scan QR Code
                                                </h5>
                                                <p class="text-muted mb-3">Position your QR code within the scanner area below</p>
                                                <div id="payment-qr-reader" class="border border-primary rounded p-3 bg-white shadow-sm" style="min-height: 300px; display: flex; align-items: center; justify-content: center;">
                                                    <div class="text-muted">
                                                        <i class="fas fa-camera fa-2x mb-2"></i>
                                                        <br>Camera initializing...
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <small class="text-muted">
                                                        <i class="fas fa-info-circle me-1"></i>
                                                        Ensure good lighting for better scanning
                                                    </small>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12 text-center">
                                        <button type="button" class="btn btn-outline-primary btn-lg px-4" onclick="backToMenu()">
                                            <i class="fas fa-arrow-left me-2"></i>Back to Menu
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-12 text-center p-3">
            <div class="col-md-12 text-center p-0">
                <span class="footer_title">Canteen Pay System by ALZ Services</span>
            </div>
        </div>
    </div>
</div>

<script src="{{ asset('js/camera.js') }}"></script>
<script src="{{ asset('js/fontawesome.js') }}"></script>
<script>
let totalSpan;
let html5QrcodeScanner;
const prices = {
    nasi_lemak: 5,
    burger: 8,
    pizza: 12,
    fried_chicken: 6,
    chicken_chop: 10,
    chicken_fries: 8,
    orange_drink: 3,
    lime_drink: 3,
    soft_drink: 4
};

const itemNames = {
    nasi_lemak: 'Nasi Lemak',
    burger: 'Burger',
    pizza: 'Pizza',
    fried_chicken: 'Fried Chicken',
    chicken_chop: 'Chicken Chop',
    chicken_fries: 'Chicken Fries',
    orange_drink: 'Orange Drink',
    lime_drink: 'Lime Drink',
    soft_drink: 'Soft Drink'
};

function proceedToPayment() {
    // Hide the menu form
    document.getElementById('order').style.display = 'none';
    // Hide the floating button
    document.getElementById('floating-button').style.display = 'none';
    // Show the payment section
    document.getElementById('payment-section').style.display = 'block';
    // Populate item listing
    populateItemListing();
    // Start QR scanner
    startQrScanner();
}

function backToMenu() {
    // Stop QR scanner
    if (html5QrcodeScanner) {
        html5QrcodeScanner.clear().then(() => {
            console.log("QR Scanner stopped");
        }).catch((err) => {
            console.log("Failed to stop QR Scanner", err);
        });
    }
    // Hide payment section
    document.getElementById('payment-section').style.display = 'none';
    // Show menu
    document.getElementById('order').style.display = 'block';
    // Show floating button
    document.getElementById('floating-button').style.display = 'block';
}

function populateItemListing() {
    const itemListing = document.getElementById('item-listing');
    itemListing.innerHTML = '';
    let total = 0;
    const inputs = document.querySelectorAll('#order input[type="hidden"]');
    inputs.forEach(input => {
        const qty = parseInt(input.value) || 0;
        if (qty > 0) {
            const item = input.id.replace('input_', '');
            const price = prices[item];
            const itemTotal = qty * price;
            total += itemTotal;
            const li = document.createElement('li');
            li.className = 'list-group-item d-flex justify-content-between align-items-center';
            li.innerHTML = `
                <div>
                    <strong>${itemNames[item]}</strong> <span class="badge bg-primary rounded-pill ms-2">${qty}</span>
                </div>
                <span class="text-success fw-bold">RM ${itemTotal.toFixed(2)}</span>
            `;
            itemListing.appendChild(li);
        }
    });
    document.getElementById('payment-total').textContent = total.toFixed(2);
}

function startQrScanner() {
    const qrReader = document.getElementById('payment-qr-reader');
    qrReader.innerHTML = ''; // Clear any previous content

    html5QrcodeScanner = new Html5QrcodeScanner(
        "payment-qr-reader", {
            fps: 10,
            qrbox: 250
        });

    html5QrcodeScanner.render((decodedText, decodedResult) => {
        // Handle successful scan
        console.log("QR Code scanned: ", decodedText);
        // Here you can add logic to process the payment
        alert("Payment confirmed! QR Code: " + decodedText);
        // Optionally, stop the scanner or proceed
        backToMenu();
    }, (errorMessage) => {
        // Handle scan error
        console.log("QR Scan error: ", errorMessage);
    });
}

function changeQty(item, delta) {
    const qtySpan = document.getElementById('qty_' + item);
    const input = document.getElementById('input_' + item);
    let qty = parseInt(qtySpan.textContent) + delta;
    if (qty < 0) qty = 0;
    qtySpan.textContent = qty;
    input.value = qty;
    calculateTotal();
}

function calculateTotal() {
    let total = 0;
    let hasItems = false;
    const inputs = document.querySelectorAll('#order input[type="hidden"]');
    const floatingItems = document.getElementById('floating-items');
    if (floatingItems) {
        floatingItems.innerHTML = '';
    }

    inputs.forEach(input => {
        const qty = parseInt(input.value) || 0;
        const item = input.id.replace('input_', '');
        const price = prices[item];
        if (price !== undefined && qty > 0) {
            total += qty * price;
            hasItems = true;
            if (floatingItems) {
                const itemDiv = document.createElement('div');
                itemDiv.style.display = 'flex';
                itemDiv.style.justifyContent = 'space-between';
                itemDiv.style.alignItems = 'center';
                itemDiv.style.padding = '2px 0';
                itemDiv.style.fontSize = '14px';
                itemDiv.innerHTML = `
                    <span>${itemNames[item]} x ${qty}</span>
                    <span>RM ${(qty * price).toFixed(2)}</span>
                `;
                floatingItems.appendChild(itemDiv);
            }
        }
    });

    const formattedTotal = total.toFixed(2);
    if (totalSpan) {
        totalSpan.textContent = formattedTotal;
    }
    const floatingTotal = document.getElementById('floating-total');
    if (floatingTotal) {
        floatingTotal.textContent = formattedTotal;
    }

    // Show/hide floating container based on items
    const floatingContainer = document.getElementById('floating-container');
    if (floatingContainer) {
        if (hasItems) {
            floatingContainer.style.display = 'block';
        } else {
            floatingContainer.style.display = 'none';
        }
    }
}

document.addEventListener('DOMContentLoaded', function() {
    totalSpan = document.getElementById('total');
    calculateTotal(); // Initial calculation

    // Handle collapse icon change
    const orderDetailsCollapse = document.getElementById('orderDetails');
    const collapseIcon = document.getElementById('collapseIcon');
    if (orderDetailsCollapse && collapseIcon) {
        orderDetailsCollapse.addEventListener('shown.bs.collapse', function () {
            collapseIcon.className = 'fas fa-chevron-up';
        });
        orderDetailsCollapse.addEventListener('hidden.bs.collapse', function () {
            collapseIcon.className = 'fas fa-chevron-down';
        });
    }
});
</script>

@endsection
