<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GFL Gatekeeper - Verify Secure PIN</title>
    
    <!-- Google Fonts (Poppins) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <style>
        :root {
            --gfl-green: #198754;
            --gfl-green-dark: #146c43;
            --gfl-whitesmoke: #f8f9fa;
            --pin-dot-size: 18px;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--gfl-whitesmoke);
            user-select: none; /* Prevents text selection highlights during rapid tapping */
        }
        .panel-vh {
            min-height: 100vh;
        }
        
        /* OPay Style Cryptographic Masked Dots */
        .pin-dot-stream {
            display: flex;
            justify-content: center;
            gap: 24px;
            margin: 35px 0;
        }
        .dot-node {
            width: var(--pin-dot-size);
            height: var(--pin-dot-size);
            border: 2px solid #ced4da;
            border-radius: 50%;
            background-color: transparent;
            transition: all 0.1s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .dot-node.filled {
            background-color: var(--gfl-green);
            border-color: var(--gfl-green);
            transform: scale(1.2);
            box-shadow: 0 0 8px rgba(25, 135, 84, 0.25);
        }
        .dot-node.failed {
            background-color: #dc3545 !important;
            border-color: #dc3545 !important;
        }

        /* Virtual Keypad Structural Grid */
        .keypad-matrix-container {
            max-width: 340px;
            margin: 0 auto;
        }
        .keypad-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 12px;
            gap: 12px;
        }
        .keypad-btn {
            flex: 1;
            height: 60px;
            border-radius: 16px;
            background-color: #ffffff;
            border: 1px solid #e9ecef;
            color: #212529;
            font-size: 1.4rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.1s ease;
        }
        .keypad-btn:active {
            background-color: #e9ecef;
            transform: scale(0.96);
        }
        .keypad-btn.system-action-key {
            background-color: transparent;
            border-color: transparent;
            font-size: 1.1rem;
            font-weight: 500;
        }
        .keypad-btn.system-action-key:active {
            background-color: rgba(0,0,0,0.04);
        }

        /* Layout Shaking Animation on Auth Failure */
        @keyframes structuralShake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-6px); }
            75% { transform: translateX(6px); }
        }
        .animate-shake {
            animation: structuralShake 0.25s ease-in-out;
        }
    </style>
</head>
<body class="bg-light">

    <div class="container py-4">
        <div class="row justify-content-center align-items-center panel-vh">
            <div class="col-12 col-md-7 col-lg-5" data-reveal="fade-up">
                
                <!-- Main Passcode Container Shell -->
                <div class="bg-white p-4 p-sm-5 rounded-5 shadow-sm border border-light-subtle">
                    
                    <!-- Top Heading Configuration -->
                    <div class="text-center mb-2">
                        <span class="bg-success-subtle text-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow-sm" style="width: 52px; height: 52px;">
                            <i class="bi bi-shield-lock-fill fs-4"></i>
                        </span>
                        <h4 class="fw-bold text-dark mb-1">Payment PIN</h4>
                        <p class="text-secondary small mx-auto mb-0" style="max-width: 290px;">
                            Please verify your 4-digit security PIN to complete this ecosystem transaction.
                        </p>
                    </div>

                    <!-- Cryptographic Pin Mask Frame -->
                    <div id="dotMatrixWrapper">
                        <div class="pin-dot-stream">
                            <div class="dot-node"></div>
                            <div class="dot-node"></div>
                            <div class="dot-node"></div>
                            <div class="dot-node"></div>
                        </div>
                    </div>

                    <!-- Feedback Alert Message Field -->
                    <div id="systemFeedbackChannel" class="text-center small font-monospace text-muted mb-4 py-1">
                        <i class="bi bi-lock-fill text-success"></i> Secure Transaction Channel Active
                    </div>

                    <!-- ON-SCREEN HARDWARE DIGITAL KEYPAD -->
                    <div class="keypad-matrix-container" id="digitalPinKeypad">
                        <!-- Row 1 -->
                        <div class="keypad-row">
                            <button type="button" class="keypad-btn" data-input="1">1</button>
                            <button type="button" class="keypad-btn" data-input="2">2</button>
                            <button type="button" class="keypad-btn" data-input="3">3</button>
                        </div>
                        <!-- Row 2 -->
                        <div class="keypad-row">
                            <button type="button" class="keypad-btn" data-input="4">4</button>
                            <button type="button" class="keypad-btn" data-input="5">5</button>
                            <button type="button" class="keypad-btn" data-input="6">6</button>
                        </div>
                        <!-- Row 3 -->
                        <div class="keypad-row">
                            <button type="button" class="keypad-btn" data-input="7">7</button>
                            <button type="button" class="keypad-btn" data-input="8">8</button>
                            <button type="button" class="keypad-btn" data-input="9">9</button>
                        </div>
                        <!-- Row 4 -->
                        <div class="keypad-row">
                            <!-- Left Action: Reset/Forget Routine Routing -->
                            <a href="#forgot-pin" class="keypad-btn system-action-key text-success text-decoration-none small">Forgot?</a>
                            <!-- Center Key -->
                            <button type="button" class="keypad-btn" data-input="0">0</button>
                            <!-- Right Action: Pop single character -->
                            <button type="button" class="keypad-btn system-action-key text-dark" id="triggerBackspace" title="Delete Last Entry">
                                <i class="bi bi-backspace-fill"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Bottom Return Shortcut -->
                    <div class="text-center mt-4 pt-2 border-top border-light-subtle">
                        <a href="#back" class="text-decoration-none text-secondary small fw-medium">
                            <i class="bi bi-arrow-left-short fs-5 align-middle"></i> Back to Transaction Summary
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle Link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- ScrollReveal CDN Library -->
    <script src="https://unpkg.com/scrollreveal"></script>

    <!-- App Identity State Management Machine -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            
            const pinDots = document.querySelectorAll(".dot-node");
            const keypadModule = document.getElementById("digitalPinKeypad");
            const wrapperUI = document.getElementById("dotMatrixWrapper");
            const feedbackText = document.getElementById("systemFeedbackChannel");
            const backspaceControl = document.getElementById("triggerBackspace");

            let currentPinInputBuffer = "";
            const mandatoryPinLength = 4;

            // --- 1. Capture Virtual Key Matrix Events ---
            keypadModule.addEventListener("click", function (event) {
                const capturedButton = event.target.closest(".keypad-btn");
                if (!capturedButton) return;

                if (capturedButton.hasAttribute("data-input")) {
                    const digitValue = capturedButton.getAttribute("data-input");
                    appendDigitToBuffer(digitValue);
                } else if (capturedButton.id === "triggerBackspace") {
                    removeLastDigitFromBuffer();
                }
            });

            // --- 2. Buffer Management Array Pipelines ---
            function appendDigitToBuffer(number) {
                if (currentPinInputBuffer.length >= mandatoryPinLength) return;

                currentPinInputBuffer += number;
                synchronizeUiDots(currentPinInputBuffer.length);

                // Instantly compile and send for evaluation once length criteria is saturated
                if (currentPinInputBuffer.length === mandatoryPinLength) {
                    lockKeypadInteraction(true);
                    setTimeout(submitPinToVerificationEngine, 300);
                }
            }

            function removeLastDigitFromBuffer() {
                if (currentPinInputBuffer.length > 0) {
                    currentPinInputBuffer = currentPinInputBuffer.slice(0, -1);
                    synchronizeUiDots(currentPinInputBuffer.length);
                }
                clearErrorUIPatterns();
            }

            // --- 3. UI Sync Routines ---
            function synchronizeUiDots(activeLength) {
                pinDots.forEach((dot, positionIndex) => {
                    if (positionIndex < activeLength) {
                        dot.classList.add("filled");
                    } else {
                        dot.classList.remove("filled");
                    }
                });
            }

            function clearErrorUIPatterns() {
                pinDots.forEach(dot => dot.classList.remove("failed"));
                feedbackText.innerHTML = `<i class="bi bi-lock-fill text-success"></i> Secure Transaction Channel Active`;
            }

            // --- 4. Micro Authentication Process Evaluation ---
            function submitPinToVerificationEngine() {
                feedbackText.innerHTML = `<span class="text-primary"><i class="spinner-border spinner-border-sm me-1"></i> Running consensus matching...</span>`;
                
                // MOCK MATCH TEST: Set default success parameters to "1234" for validation simulation loops
                if (currentPinInputBuffer === "1234") {
                    feedbackText.innerHTML = `<span class="text-success fw-semibold"><i class="bi bi-check2-circle me-1"></i> PIN Authorization Settled Successfully!</span>`;
                    setTimeout(() => {
                        alert("Authentication Approved. Ledger balances adjusting smoothly.");
                        window.location.href = "#"; // Redirect directly to final receipt/dashboard layout
                    }, 1000);
                } else {
                    executeFailureUIFeedback();
                }
            }

            function executeFailureUIFeedback() {
                feedbackText.innerHTML = `<span class="text-danger fw-bold"><i class="bi bi-exclamation-triangle-fill me-1"></i> Authentication Failure. Incorrect PIN code.</span>`;
                wrapperUI.classList.add("animate-shake");
                pinDots.forEach(dot => dot.classList.add("failed"));

                setTimeout(() => {
                    wrapperUI.classList.remove("animate-shake");
                    // Wipe buffer elements cleanly to enable automatic recalculation entries
                    currentPinInputBuffer = "";
                    synchronizeUiDots(0);
                    lockKeypadInteraction(false);
                }, 800);
            }

            function lockKeypadInteraction(booleanFlag) {
                const operationalKeys = keypadModule.querySelectorAll(".keypad-btn");
                operationalKeys.forEach(btn => btn.disabled = booleanFlag);
            }

            // --- 5. ScrollReveal System Animations Initialization ---
            if (typeof ScrollReveal !== 'undefined') {
                ScrollReveal().reveal('[data-reveal="fade-up"]', {
                    origin: 'bottom',
                    distance: '20px',
                    duration: 800,
                    easing: 'cubic-bezier(0.16, 1, 0.3, 1)'
                });
            }
        });
    </script>
</body>
</html>