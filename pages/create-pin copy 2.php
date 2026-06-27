<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GFL Gatekeeper - Initialize Transaction PIN</title>
    
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
            --pin-dimple-size: 20px;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--gfl-whitesmoke);
            user-select: none; /* Mitigate structural click-drag selections during fast typing */
        }
        .panel-vh {
            min-height: 100vh;
        }
        
        /* Cryptographic PIN Dot Matrix Visual Elements */
        .pin-display-container {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin: 30px 0;
        }
        .pin-dot {
            width: var(--pin-dimple-size);
            height: var(--pin-dimple-size);
            border: 2px solid #ced4da;
            border-radius: 50%;
            background-color: transparent;
            transition: all 0.15s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }
        .pin-dot.active {
            background-color: var(--gfl-green);
            border-color: var(--gfl-green);
            transform: scale(1.15);
            box-shadow: 0 0 10px rgba(25, 135, 84, 0.3);
        }
        .pin-dot.error {
            background-color: #dc3545 !important;
            border-color: #dc3545 !important;
            animation: shake 0.25s ease-in-out double;
        }

        /* Fintech Scaffolded Secure Scrambled Virtual Keyboard Matrix */
        .scaffold-keyboard {
            max-width: 360px;
            margin: 0 auto;
        }
        .key-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 14px;
            gap: 14px;
        }
        .virtual-key {
            flex: 1;
            height: 64px;
            border-radius: 16px;
            background-color: #ffffff;
            border: 1px solid #e9ecef;
            color: #212529;
            font-size: 1.5rem;
            font-weight: 600;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            transition: all 0.1s ease;
            box-shadow: 0 2px 4px rgba(0,0,0,0.02);
        }
        .virtual-key:active {
            background-color: #e9ecef;
            transform: scale(0.95);
            box-shadow: none;
        }
        .virtual-key.utility-key {
            background-color: transparent;
            border-color: transparent;
            font-size: 1.2rem;
            box-shadow: none;
        }
        .virtual-key.utility-key:active {
            background-color: rgba(0,0,0,0.05);
        }
        .virtual-key.action-key {
            color: var(--gfl-green);
        }

        /* Structural Interface Animation Definitions */
        @keyframes shake {
            0%, 100% { transform: translateX(0); }
            25% { transform: translateX(-6px); }
            75% { transform: translateX(6px); }
        }
        .animate-shake {
            animation: shake 0.3s ease-in-out;
        }
        .step-transition-wrapper {
            transition: opacity 0.25s ease-in-out;
        }
    </style>
</head>
<body class="bg-light">

    <div class="container py-4">
        <div class="row justify-content-center align-items-center panel-vh">
            <div class="col-12 col-md-8 col-lg-5" data-reveal="fade-up">
                
                <!-- Main Authentication Shell Card -->
                <div class="bg-white p-4 p-sm-5 rounded-5 shadow-sm border border-light-subtle">
                    
                    <!-- Top Security Branding Module -->
                    <div class="text-center mb-4">
                        <span class="bg-success-subtle text-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow-sm" style="width: 56px; height: 56px;">
                            <i id="lockShieldIcon" class="bi bi-shield-lock-fill fs-3"></i>
                        </span>
                        <h4 id="workflowTitle" class="fw-bold text-dark mb-1">Create Transaction PIN</h4>
                        <p id="workflowSubtitle" class="text-secondary small mx-auto mb-0" style="max-width: 320px;">
                            Establish a 4-digit security code to authorize token movements, withdrawals, and ledger settlements.
                        </p>
                    </div>

                    <!-- Flow Phase Tracker Progress Line -->
                    <div class="d-flex justify-content-center align-items-center gap-1 mb-2">
                        <span id="progressBarStep1" class="badge rounded-pill bg-success px-3" style="height: 6px; font-size: 0;">Step 1</span>
                        <span id="progressBarStep2" class="badge rounded-pill bg-light border px-3" style="height: 6px; font-size: 0;">Step 2</span>
                    </div>
                    <div id="stepStateText" class="text-center font-monospace text-muted fw-bold mb-4" style="font-size: 0.68rem; tracking-wider: 1px;">PHASE: INITIAL ENTRY</div>

                    <!-- Cryptographic Pin Input Dot Matrix -->
                    <div class="step-transition-wrapper" id="displayWrapper">
                        <div class="pin-display-container" id="pinDotGrid">
                            <div class="pin-dot"></div>
                            <div class="pin-dot"></div>
                            <div class="pin-dot"></div>
                            <div class="pin-dot"></div>
                        </div>
                    </div>

                    <!-- Global System Status Context Response Message Field -->
                    <div id="keyboardSystemFeedback" class="text-center small font-monospace text-muted mb-4 py-1">
                        <i class="bi bi-patch-check-fill text-success"></i> Keypad channel isolated securely.
                    </div>

                    <!-- VIRTUAL ON-SCREEN KEYPAD MATRIX MODULE -->
                    <div class="scaffold-keyboard" id="virtualKeypadMatrix">
                        <!-- Row 1 -->
                        <div class="key-row">
                            <button type="button" class="virtual-key" data-value="1">1</button>
                            <button type="button" class="virtual-key" data-value="2">2</button>
                            <button type="button" class="virtual-key" data-value="3">3</button>
                        </div>
                        <!-- Row 2 -->
                        <div class="key-row">
                            <button type="button" class="virtual-key" data-value="4">4</button>
                            <button type="button" class="virtual-key" data-value="5">5</button>
                            <button type="button" class="virtual-key" data-value="6">6</button>
                        </div>
                        <!-- Row 3 -->
                        <div class="key-row">
                            <button type="button" class="virtual-key" data-value="7">7</button>
                            <button type="button" class="virtual-key" data-value="8">8</button>
                            <button type="button" class="virtual-key" data-value="9">9</button>
                        </div>
                        <!-- Row 4 -->
                        <div class="key-row">
                            <!-- Left Utility: Clear/Reset Entire Memory Buffer -->
                            <button type="button" class="virtual-key utility-key text-secondary" id="keyClearAll" title="Clear Buffer">Clear</button>
                            <!-- Center Matrix Target Digit -->
                            <button type="button" class="virtual-key" data-value="0">0</button>
                            <!-- Right Utility: Backspace Pop Single Element -->
                            <button type="button" class="virtual-key utility-key text-dark" id="keyBackspace" title="Delete Last Digit">
                                <i class="bi bi-backspace-fill"></i>
                            </button>
                        </div>
                    </div>

                    <!-- Contextual Cancellation Link Paths -->
                    <div class="text-center mt-4 pt-2 border-top border-light-subtle">
                        <a href="#dashboard" class="text-decoration-none text-muted small fw-medium">
                            <i class="bi bi-x-circle me-1"></i> Cancel Setup Process
                        </a>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle Link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- ScrollReveal CDN Library Module -->
    <script src="https://unpkg.com/scrollreveal"></script>

    <!-- State machine handling token validation mechanics -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            
            // UI Element Document Mapping Hooks
            const dots = document.querySelectorAll(".pin-dot");
            const keypad = document.getElementById("virtualKeypadMatrix");
            const displayWrapper = document.getElementById("displayWrapper");
            const feedbackMsg = document.getElementById("keyboardSystemFeedback");
            
            const workflowTitle = document.getElementById("workflowTitle");
            const workflowSubtitle = document.getElementById("workflowSubtitle");
            const stepText = document.getElementById("stepStateText");
            const lockShieldIcon = document.getElementById("lockShieldIcon");
            
            const progressStep1 = document.getElementById("progressBarStep1");
            const progressStep2 = document.getElementById("progressBarStep2");

            // Internal Data Buffer Matrix Memory Blocks
            let primaryPinBuffer = "";
            let confirmationPinBuffer = "";
            let isConfirmationPhase = false;
            const targetPinLength = 4;

            // --- 1. Dynamic Matrix Keypad Click Registration Dispatcher ---
            keypad.addEventListener("click", function (e) {
                const targetKey = e.target.closest(".virtual-key");
                if (!targetKey) return; // Exit if boundary interaction falls inside margins

                // Route operational parameters based on standard utility properties
                if (targetKey.id === "keyBackspace") {
                    popDigitFromBuffer();
                } else if (targetKey.id === "keyClearAll") {
                    clearActiveBuffer();
                } else if (targetKey.hasAttribute("data-value")) {
                    const extractedValue = targetKey.getAttribute("data-value");
                    appendDigitToBuffer(extractedValue);
                }
            });

            // --- 2. State Controller Logic Core Matrix ---
            function appendDigitToBuffer(digit) {
                let currentActiveLength = isConfirmationPhase ? confirmationPinBuffer.length : primaryPinBuffer.length;
                
                if (currentActiveLength >= targetPinLength) return; // Buffer protection wall

                if (!isConfirmationPhase) {
                    primaryPinBuffer += digit;
                    updateVisualDots(primaryPinBuffer.length);
                    if (primaryPinBuffer.length === targetPinLength) {
                        setTimeout(transitionToConfirmationPhase, 200);
                    }
                } else {
                    confirmationPinBuffer += digit;
                    updateVisualDots(confirmationPinBuffer.length);
                    if (confirmationPinBuffer.length === targetPinLength) {
                        setTimeout(evaluatePinMatchingLogic, 250);
                    }
                }
            }

            function popDigitFromBuffer() {
                if (!isConfirmationPhase) {
                    if (primaryPinBuffer.length > 0) {
                        primaryPinBuffer = primaryPinBuffer.slice(0, -1);
                        updateVisualDots(primaryPinBuffer.length);
                    }
                } else {
                    if (confirmationPinBuffer.length > 0) {
                        confirmationPinBuffer = confirmationPinBuffer.slice(0, -1);
                        updateVisualDots(confirmationPinBuffer.length);
                    }
                }
                resetFeedbackToNormal();
            }

            function clearActiveBuffer() {
                if (!isConfirmationPhase) {
                    primaryPinBuffer = "";
                    updateVisualDots(0);
                } else {
                    confirmationPinBuffer = "";
                    updateVisualDots(0);
                }
                resetFeedbackToNormal();
            }

            // --- 3. UI Synchronization Loops ---
            function updateVisualDots(activeCount) {
                dots.forEach((dot, index) => {
                    if (index < activeCount) {
                        dot.classList.add("active");
                    } else {
                        dot.classList.remove("active");
                    }
                });
            }

            function resetFeedbackToNormal() {
                dots.forEach(dot => dot.classList.remove("error"));
                if (!isConfirmationPhase) {
                    feedbackMsg.innerHTML = `<i class="bi bi-patch-check-fill text-success"></i> Keypad channel isolated securely.`;
                } else {
                    feedbackMsg.innerHTML = `<span class="text-warning"><i class="bi bi-info-circle-fill"></i> Retype security passcode to verify sequence map consistency.</span>`;
                }
            }

            // --- 4. Workflow Transition Routing Elements ---
            function transitionToConfirmationPhase() {
                // Apply swift visualization dimming matrix sequence
                displayWrapper.style.opacity = "0.1";
                
                setTimeout(() => {
                    isConfirmationPhase = true;
                    updateVisualDots(0); // Clear layout dots indicator safely
                    
                    // Reconfigure descriptive headers dynamically to guide user operations
                    workflowTitle.textContent = "Confirm Transaction PIN";
                    workflowSubtitle.textContent = "Re-enter your newly defined 4-digit credential token array to prevent verification mismatch exceptions.";
                    stepText.textContent = "PHASE: SEQUENCE VERIFICATION";
                    
                    lockShieldIcon.classList.replace("bi-shield-lock-fill", "bi-shield-check");
                    progressStep2.classList.replace("bg-light", "bg-success");
                    progressStep2.classList.remove("border");
                    
                    feedbackMsg.innerHTML = `<span class="text-warning"><i class="bi bi-info-circle-fill"></i> Retype security passcode to verify sequence map consistency.</span>`;
                    displayWrapper.style.opacity = "1";
                }, 200);
            }

            // --- 5. Algorithmic Matching Verification Architecture ---
            function evaluatePinMatchingLogic() {
                if (primaryPinBuffer === confirmationPinBuffer) {
                    handleVerificationSuccessState();
                } else {
                    handleVerificationFailureState();
                }
            }

            function handleVerificationSuccessState() {
                feedbackMsg.innerHTML = `<span class="text-success"><i class="spinner-border spinner-border-sm me-2"></i> Syncing security nodes across multi-wallets...</span>`;
                disableVirtualKeypadMatrix(true);

                setTimeout(() => {
                    alert("Cryptographic Transaction PIN established successfully! Secure balance signing capabilities enabled.");
                    window.location.href = "#"; // Destination Route dashboard anchor map location
                }, 1500);
            }

            function handleVerificationFailureState() {
                // Apply systemic validation visual alerts to error nodes
                feedbackMsg.innerHTML = `<span class="text-danger fw-bold"><i class="bi bi-exclamation-octagon-fill"></i> Code Mismatch! Pin parameters must match exactly.</span>`;
                
                displayWrapper.classList.add("animate-shake");
                dots.forEach(dot => dot.classList.add("error"));

                setTimeout(() => {
                    displayWrapper.classList.remove("animate-shake");
                    // Hard reset confirmation data vectors to allow effortless layout retry operations
                    confirmationPinBuffer = "";
                    updateVisualDots(0);
                    resetFeedbackToNormal();
                }, 800);
            }

            function disableVirtualKeypadMatrix(statusFlag) {
                const operationalButtons = keypad.querySelectorAll("button");
                operationalButtons.forEach(btn => btn.disabled = statusFlag);
            }

            // --- 6. ScrollReveal Presentation Engine Loading Layouts ---
            if (typeof ScrollReveal !== 'undefined') {
                ScrollReveal().reveal('[data-reveal="fade-up"]', {
                    origin: 'bottom',
                    distance: '25px',
                    duration: 850,
                    easing: 'cubic-bezier(0.25, 1, 0.5, 1)'
                });
            }
        });
    </script>
</body>
</html>