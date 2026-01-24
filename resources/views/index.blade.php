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

    .card-title {
        font-size: 0.55rem !important;
        font-weight: bold !important;
        word-wrap: break-word;
        hyphens: auto;
    }

    .card-text {
        font-size: 1.0rem !important;
    }

    @media (min-width: 576px) {
        .card-title {
            font-size: 1.0rem !important;
        }

        .card-text {
            font-size: 1.0rem !important;
        }
    }

    @media (min-width: 768px) {
        .card-title {
            font-size: 1.0rem !important;
        }

        .card-text {
            font-size: 1.0rem !important;
        }
    }

    /* QR Scanner improvements for mobile */
    @media (max-width: 576px) {
        .qr-reader-container {
            min-height: 250px !important;
        }

        .scanning-hints ul {
            font-size: 0.75rem;
        }
    }

    .qr-reader-container {
        position: relative;
        overflow: hidden;
    }

    .qr-reader-container canvas {
        max-width: 100%;
        height: auto;
    }

    .card-img-top {
        height: 120px !important;
        object-fit: cover !important;
    }

    @media (min-width: 576px) {
        .card-img-top {
            height: 150px !important;
        }
    }

    @media (min-width: 768px) {
        .card-img-top {
            height: 180px !important;
        }
    }

    .food-img {
        width: 100%;
        max-width: 220px;      /* control max size */
        aspect-ratio: 1 / 1;  /* square */
        object-fit: contain;  /* no crop, no stretch */
        display: block;
        margin: auto;
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
                <div class="col-4 mb-3">
                    <div class="card h-50 border-0">
                        <img src="{{ asset('img/nasi_lemak.png') }}" class="card-img-top food-img" alt="Nasi Lemak">
                        <div class="card-body text-center">
                            <h5 class="card-title">Nasi Lemak</h5>
                            <p class="card-text">RM 5.00</p>
                            <input type="hidden" name="nasi_lemak" id="input_nasi_lemak" value="0">
                        </div>
                        <div class="card-footer text-center">
                            <div class="d-flex justify-content-center align-items-center">
                                <button type="button" class="btn btn-sm btn-outline-secondary me-1" onclick="changeQty('nasi_lemak', -1)">-</button>
                                <span id="qty_nasi_lemak" class="mx-1">0</span>
                                <button type="button" class="btn btn-sm btn-outline-secondary ms-1" onclick="changeQty('nasi_lemak', 1)">+</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 mb-3">
                    <div class="card h-50 border-0">
                        <img src="{{ asset('img/burger.png') }}" class="card-img-top food-img" alt="Burger" width="150" height="150">
                        <div class="card-body text-center">
                            <h5 class="card-title">Burger</h5>
                            <p class="card-text">RM 8.00</p>
                            <input type="hidden" name="burger" id="input_burger" value="0">
                        </div>
                        <div class="card-footer text-center">
                            <div class="d-flex justify-content-center align-items-center">
                                <button type="button" class="btn btn-sm btn-outline-secondary me-1" onclick="changeQty('burger', -1)">-</button>
                                <span id="qty_burger" class="mx-1">0</span>
                                <button type="button" class="btn btn-sm btn-outline-secondary ms-1" onclick="changeQty('burger', 1)">+</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 mb-3">
                    <div class="card h-50 border-0">
                        <img src="{{ asset('img/pizza.png') }}" class="card-img-top food-img" alt="Pizza" width="150" height="150">
                        <div class="card-body text-center">
                            <h5 class="card-title">Pizza</h5>
                            <p class="card-text">RM 12.00</p>
                            <input type="hidden" name="pizza" id="input_pizza" value="0">
                        </div>
                        <div class="card-footer text-center">
                            <div class="d-flex justify-content-center align-items-center">
                                <button type="button" class="btn btn-sm btn-outline-secondary me-1" onclick="changeQty('pizza', -1)">-</button>
                                <span id="qty_pizza" class="mx-1">0</span>
                                <button type="button" class="btn btn-sm btn-outline-secondary ms-1" onclick="changeQty('pizza', 1)">+</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-4 mb-3">
                    <div class="card h-50 border-0">
                        <img src="{{ asset('img/fried_chicken.png') }}" class="card-img-top food-img" alt="Fried Chicken" width="150" height="150">
                        <div class="card-body text-center">
                            <h5 class="card-title" style="font-size: 1.2rem; font-weight: bold;">Fried Chicken</h5>
                            <p class="card-text" style="font-size: 1.1rem;">RM 6.00</p>
                            <input type="hidden" name="fried_chicken" id="input_fried_chicken" value="0">
                        </div>
                        <div class="card-footer text-center">
                            <div class="d-flex justify-content-center align-items-center">
                                <button type="button" class="btn btn-sm btn-outline-secondary me-1" onclick="changeQty('fried_chicken', -1)">-</button>
                                <span id="qty_fried_chicken" class="mx-1">0</span>
                                <button type="button" class="btn btn-sm btn-outline-secondary ms-1" onclick="changeQty('fried_chicken', 1)">+</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 mb-3">
                    <div class="card h-50 border-0">
                        <img src="{{ asset('img/chicken_chop.png') }}" class="card-img-top food-img" alt="Chicken Chop" width="150" height="150">
                        <div class="card-body text-center">
                            <h5 class="card-title">Chicken Chop</h5>
                            <p class="card-text">RM 10.00</p>
                            <input type="hidden" name="chicken_chop" id="input_chicken_chop" value="0">
                        </div>
                        <div class="card-footer text-center">
                            <div class="d-flex justify-content-center align-items-center">
                                <button type="button" class="btn btn-sm btn-outline-secondary me-1" onclick="changeQty('chicken_chop', -1)">-</button>
                                <span id="qty_chicken_chop" class="mx-1">0</span>
                                <button type="button" class="btn btn-sm btn-outline-secondary ms-1" onclick="changeQty('chicken_chop', 1)">+</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 mb-3">
                    <div class="card h-50 border-0">
                        <img src="{{ asset('img/chicken_fries.png') }}" class="card-img-top food-img" alt="Chicken Fries" width="150" height="150">
                        <div class="card-body text-center">
                            <h5 class="card-title">Chicken Fries</h5>
                            <p class="card-text">RM 8.00</p>
                            <input type="hidden" name="chicken_fries" id="input_chicken_fries" value="0">
                        </div>
                        <div class="card-footer text-center">
                            <div class="d-flex justify-content-center align-items-center">
                                <button type="button" class="btn btn-sm btn-outline-secondary me-1" onclick="changeQty('chicken_fries', -1)">-</button>
                                <span id="qty_chicken_fries" class="mx-1">0</span>
                                <button type="button" class="btn btn-sm btn-outline-secondary ms-1" onclick="changeQty('chicken_fries', 1)">+</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="text-center">
                <h2 class="fw-bold" style="font-size:1.3rem;">Drinks</h2>
            </div>

            <div class="row">
                <div class="col-4 mb-3">
                    <div class="card h-50 border-0">
                        <img src="{{ asset('img/orange_drink.png') }}" class="card-img-top food-img" alt="Orange Drink" width="150" height="150">
                        <div class="card-body text-center">
                            <h5 class="card-title">Orange</h5>
                            <p class="card-text">RM 3.00</p>
                            <input type="hidden" name="orange_drink" id="input_orange_drink" value="0">
                        </div>
                        <div class="card-footer text-center">
                            <div class="d-flex justify-content-center align-items-center">
                                <button type="button" class="btn btn-sm btn-outline-secondary me-1" onclick="changeQty('orange_drink', -1)">-</button>
                                <span id="qty_orange_drink" class="mx-1">0</span>
                                <button type="button" class="btn btn-sm btn-outline-secondary ms-1" onclick="changeQty('orange_drink', 1)">+</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 mb-3">
                    <div class="card h-50 border-0">
                        <img src="{{ asset('img/lime_drink.png') }}" class="card-img-top food-img" alt="Lime Drink" width="150" height="150">
                        <div class="card-body text-center">
                            <h5 class="card-title">Lime</h5>
                            <p class="card-text">RM 3.00</p>
                            <input type="hidden" name="lime_drink" id="input_lime_drink" value="0">
                        </div>
                        <div class="card-footer text-center">
                            <div class="d-flex justify-content-center align-items-center">
                                <button type="button" class="btn btn-sm btn-outline-secondary me-1" onclick="changeQty('lime_drink', -1)">-</button>
                                <span id="qty_lime_drink" class="mx-1">0</span>
                                <button type="button" class="btn btn-sm btn-outline-secondary ms-1" onclick="changeQty('lime_drink', 1)">+</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-4 mb-3">
                    <div class="card h-50 border-0">
                        <img src="{{ asset('img/soft_drink.png') }}" class="card-img-top food-img" alt="Soft Drink" width="150" height="150">
                        <div class="card-body text-center">
                            <h5 class="card-title">Carbonate</h5>
                            <p class="card-text">RM 4.00</p>
                            <input type="hidden" name="soft_drink" id="input_soft_drink" value="0">
                        </div>
                        <div class="card-footer text-center">
                            <div class="d-flex justify-content-center align-items-center">
                                <button type="button" class="btn btn-sm btn-outline-secondary me-1" onclick="changeQty('soft_drink', -1)">-</button>
                                <span id="qty_soft_drink" class="mx-1">0</span>
                                <button type="button" class="btn btn-sm btn-outline-secondary ms-1" onclick="changeQty('soft_drink', 1)">+</button>
                            </div>
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
                                                <div id="payment-qr-reader" class="qr-reader-container border border-primary rounded p-3 bg-white shadow-sm min-h-[300px] flex items-center justify-center" role="region" aria-label="QR Code Scanner" aria-live="polite">
                                                    <div class="qr-reader-placeholder text-muted flex flex-col items-center justify-center text-center">
                                                        <i class="fas fa-camera fa-2x mb-2" aria-hidden="true"></i>
                                                        <span class="loading-text">Camera initializing...</span>
                                                    </div>
                                                </div>
                                                <div class="mt-3">
                                                    <div class="scanning-hints text-muted small">
                                                        <div class="mb-2">
                                                            <i class="fas fa-lightbulb me-1"></i>
                                                            <strong>Tips for better scanning:</strong>
                                                        </div>
                                                        <ul class="list-unstyled mb-0 small">
                                                            <li>• Ensure good lighting</li>
                                                            <li>• Hold camera steady</li>
                                                            <li>• Keep QR code within the scanning area</li>
                                                            <li>• Try different distances if scanning fails</li>
                                                        </ul>
                                                    </div>
                                                    <div id="camera-switch-hint" class="mt-2" style="display: none;">
                                                        <button class="btn btn-sm btn-outline-info" onclick="switchCamera()">
                                                            <i class="fas fa-exchange-alt me-1"></i>
                                                            Switch Camera
                                                        </button>
                                                        <small class="text-muted d-block mt-1">
                                                            If scanning doesn't work, try switching cameras
                                                        </small>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row mt-4">
                                    <div class="col-md-12 text-center">
                                        <button type="button" class="btn btn-outline-primary btn-lg px-4" onclick="window.location.href='/'">
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
            html5QrcodeScanner = null; // Clear the reference
        }).catch((err) => {
            console.log("Failed to stop QR Scanner", err);
            html5QrcodeScanner = null; // Clear the reference even on error
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
        const item = input.id.replace('input_', '');
        const price = prices[item];
        if (price !== undefined && qty > 0) {
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

let currentCameraConfig = 0;
const cameraConfigs = [
    {
        name: "Rear Camera",
        constraints: {
            facingMode: "environment",
            width: { ideal: 640 },
            height: { ideal: 480 }
        }
    },
    {
        name: "Front Camera",
        constraints: {
            facingMode: "user",
            width: { ideal: 640 },
            height: { ideal: 480 }
        }
    },
    {
        name: "Any Camera (Fallback)",
        constraints: {
            width: { ideal: 640 },
            height: { ideal: 480 }
        }
    }
];

function startQrScanner(cameraConfigIndex = 0) {
    const qrReader = document.getElementById('payment-qr-reader');

    // Check if running on HTTPS or localhost
    if (location.protocol !== 'https:' && location.hostname !== 'localhost' && location.hostname !== '127.0.0.1') {
        qrReader.innerHTML = `
            <div class="text-center text-warning">
                <i class="fas fa-exclamation-triangle fa-3x mb-2"></i>
                <h5>Camera Access Requires HTTPS</h5>
                <p>Camera access is only available on secure connections (HTTPS) or localhost.</p>
                <p>Please use a secure connection to scan QR codes.</p>
            </div>
        `;
        return;
    }

    // Check if camera is supported
    if (!navigator.mediaDevices || !navigator.mediaDevices.getUserMedia) {
        qrReader.innerHTML = `
            <div class="text-center text-danger">
                <i class="fas fa-times-circle fa-3x mb-2"></i>
                <h5>Camera Not Supported</h5>
                <p>Your device or browser does not support camera access.</p>
                <p>Please use a modern browser with camera support.</p>
            </div>
        `;
        return;
    }

    const config = cameraConfigs[cameraConfigIndex];
    currentCameraConfig = cameraConfigIndex;

    qrReader.innerHTML = `
        <div class="qr-reader-placeholder text-muted flex flex-col items-center justify-center text-center">
            <i class="fas fa-camera fa-2x mb-2" aria-hidden="true"></i>
            <span class="loading-text">Initializing ${config.name}...</span>
        </div>
    `; // Reset to initial content

    const scannerConfig = {
        fps: 10, // Stable FPS
        qrbox: 250, // Fixed size for reliability
        videoConstraints: config.constraints
    };

    // Clear any existing scanner
    if (html5QrcodeScanner) {
        html5QrcodeScanner.clear().catch(() => {});
    }

    html5QrcodeScanner = new Html5QrcodeScanner(
        "payment-qr-reader",
        scannerConfig
    );

    let scanStartTime = Date.now();
    let scanTimeout;

    html5QrcodeScanner.render(
        (decodedText, decodedResult) => {
            // Clear any timeout
            if (scanTimeout) {
                clearTimeout(scanTimeout);
            }
            // Handle successful scan
            console.log("QR Code scanned successfully: ", decodedText);
            console.log("Decoded result: ", decodedResult);
            // Get the total amount
            const totalAmount = parseFloat(document.getElementById('payment-total').textContent);
            // Make AJAX request to check balance
            checkStudentBalance(decodedText, totalAmount);
        },
        (errorMessage) => {
            // Handle scan error
            console.log("QR Scan error: ", errorMessage);
            // Only show error messages for actual failures, not normal scanning errors
            if (errorMessage.includes('NotAllowedError') || errorMessage.includes('Permission denied')) {
                qrReader.innerHTML = `
                    <div class="text-center text-warning">
                        <i class="fas fa-exclamation-triangle fa-3x mb-2"></i>
                        <h5>Camera Permission Denied</h5>
                        <p>Please allow camera access to scan QR codes.</p>
                        <button class="btn btn-primary mt-2" onclick="restartScanner()">Try Again</button>
                    </div>
                `;
            } else if (errorMessage.includes('NotFoundError') || errorMessage.includes('No camera')) {
                qrReader.innerHTML = `
                    <div class="text-center text-danger">
                        <i class="fas fa-times-circle fa-3x mb-2"></i>
                        <h5>No Camera Found</h5>
                        <p>No camera device was found on this device.</p>
                        <p>Please ensure your device has a camera and try again.</p>
                        <button class="btn btn-primary mt-2" onclick="restartScanner()">Try Again</button>
                    </div>
                `;
            } else if (errorMessage.includes('OverconstrainedError') || errorMessage.includes('Constraints')) {
                // Try next camera configuration
                const nextConfig = (currentCameraConfig + 1) % cameraConfigs.length;
                if (nextConfig !== cameraConfigIndex) {
                    console.log(`Trying alternative camera config: ${cameraConfigs[nextConfig].name}`);
                    startQrScanner(nextConfig);
                    return;
                }
                // All configs failed
                qrReader.innerHTML = `
                    <div class="text-center text-danger">
                        <i class="fas fa-times-circle fa-3x mb-2"></i>
                        <h5>Camera Configuration Failed</h5>
                        <p>Unable to find a suitable camera configuration.</p>
                        <p>Try a different device or browser.</p>
                        <button class="btn btn-primary mt-2" onclick="restartScanner()">Try Again</button>
                    </div>
                `;
            }
            // For other errors (like scanning errors), don't show UI - just log
        }
    );

    // Scanner started successfully - show controls
    console.log("QR Scanner started successfully with config:", config.name);
    document.getElementById('camera-switch-hint').style.display = 'block';

    // Set a timeout to show additional hints if scanning takes too long
    scanTimeout = setTimeout(() => {
        const hintDiv = document.getElementById('camera-switch-hint');
        if (hintDiv && hintDiv.style.display !== 'none') {
            hintDiv.innerHTML = `
                <button class="btn btn-sm btn-outline-info" onclick="switchCamera()">
                    <i class="fas fa-exchange-alt me-1"></i>
                    Switch Camera
                </button>
                <small class="text-warning d-block mt-1">
                    <i class="fas fa-exclamation-triangle me-1"></i>
                    Taking longer than expected? Try switching cameras or ensure good lighting.
                </small>
            `;
        }
    }, 10000); // 10 seconds
}

function checkStudentBalance(studentId, amount) {
    // Stop the scanner temporarily
    if (html5QrcodeScanner) {
        html5QrcodeScanner.clear().then(() => {
            html5QrcodeScanner = null; // Clear the reference
        }).catch((err) => {
            console.log("Failed to clear scanner", err);
            html5QrcodeScanner = null; // Clear the reference even on error
        });
    }

    // Show loading message
    const qrReader = document.getElementById('payment-qr-reader');
    qrReader.innerHTML = `
        <div class="text-center">
            <i class="fas fa-spinner fa-spin fa-2x mb-2"></i>
            <p>Processing payment...</p>
        </div>
    `;

    // Collect items
    const items = [];
    const inputs = document.querySelectorAll('#order input[type="hidden"]');
    inputs.forEach(input => {
        const qty = parseInt(input.value) || 0;
        const item = input.id.replace('input_', '');
        if (qty > 0) {
            items.push({
                item: item,
                name: itemNames[item],
                quantity: qty,
                price: prices[item],
                subtotal: qty * prices[item]
            });
        }
    });

    // Make AJAX request
    fetch('/check-balance', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value
        },
        body: JSON.stringify({
            student_id: studentId,
            amount: amount,
            items: items
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Payment success
            qrReader.innerHTML = `
                <div class="text-center text-success">
                    <i class="fas fa-check-circle fa-3x mb-2"></i>
                    <h5>Payment Successful!</h5>
                    <p>Thank you for your purchase.</p>
                    <p><strong>Student:</strong> ${data.name}</p>
                    <p><strong>Wallet Balance:</strong> RM ${parseFloat(data.balance).toFixed(2)}</p>
                </div>
            `;
            // Reload after 8 seconds
            // setTimeout(() => {
            //     window.location.reload();
            // }, 8000);
        } else {
            // Payment failed
            qrReader.innerHTML = `
                <div class="text-center text-danger">
                    <i class="fas fa-times-circle fa-3x mb-2"></i>
                    <h5>Payment Failed</h5>
                    <p>${data.message || 'Insufficient balance.'}</p>
                    <p><strong>Student:</strong> ${data.name}</p>
                    <p><strong>Wallet Balance:</strong> RM ${parseFloat(data.balance).toFixed(2)}</p>
                    <button class="btn btn-primary mt-2" onclick="restartScanner()">Try Again</button>
                </div>
            `;
        }
    })
    .catch(error => {
        console.error('Error:', error);
        qrReader.innerHTML = `
            <div class="text-center text-danger">
                <i class="fas fa-exclamation-triangle fa-3x mb-2"></i>
                <h5>Error</h5>
                <p>An error occurred. Please try again.</p>
                <button class="btn btn-primary mt-2" onclick="restartScanner()">Try Again</button>
            </div>
        `;
    });
}

function restartScanner() {
    startQrScanner(0); // Start with first config
}

function switchCamera() {
    const nextConfig = (currentCameraConfig + 1) % cameraConfigs.length;
    startQrScanner(nextConfig);
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
