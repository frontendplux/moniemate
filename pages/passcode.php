<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GFL Gatekeeper - Verify Secure Access Node</title>
    
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
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--gfl-whitesmoke);
        }
        .panel-vh {
            min-height: 100vh;
        }
        .btn-gfl-success {
            background-color: var(--gfl-green);
            border: none;
            transition: all 0.25s ease;
        }
        .btn-gfl-success:hover:not(:disabled) {
            background-color: var(--gfl-green-dark);
            transform: translateY(-1px);
        }
        /* Specialized 6-Digit Passcode Box Matrix Styles */
        .otp-input-field {
            width: 50px;
            height: 60px;
            font-size: 1.5rem;
            font-weight: 700;
            text-align: center;
            border: 2px solid #dee2e6;
            background-color: #f8f9fa;
            border-radius: 12px;
            transition: all 0.2s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .otp-input-field:focus {
            color: var(--gfl-green);
            background-color: #fff;
            border-color: var(--gfl-green);
            outline: none;
            box-shadow: 0 4px 12px rgba(25, 135, 84, 0.15);
        }
        @media (max-width: 380px) {
            .otp-input-field {
                width: 40px;
                height: 50px;
                font-size: 1.25rem;
                border-radius: 8px;
            }
        }
    </style>
</head>
<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center align-items-center panel-vh">
            <div class="col-12 col-md-8 col-lg-5" data-reveal="fade-up">
                
                <!-- Main Passcode Vault Container Card -->
                <div class="bg-white p-4 p-sm-5 rounded-5 shadow-sm border border-light-subtle text-center">
                    
                    <!-- Top Security Verification Badge Header -->
                    <div class="mb-4">
                        <span class="bg-success-subtle text-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow-sm" style="width: 56px; height: 56px;">
                            <i class="bi bi-shield-fill-check fs-3"></i>
                        </span>
                        <h2 class="fw-bold text-dark mb-1">Enter Passcode</h2>
                        <p class="text-secondary small max-width-xs mx-auto mb-0" style="max-width: 340px;">
                            A unique 6-digit cryptographic verification profile code was sent to your registered access node route.
                        </p>
                    </div>

                    <!-- Dynamic Countdown Clock Element Wrapper -->
                    <div class="p-2.5 bg-light rounded-4 d-inline-flex align-items-center gap-2 mb-4">
                        <i id="timerIcon" class="bi bi-clock-history text-success"></i>
                        <span id="countdownDisplay" class="fw-bold font-monospace text-dark" style="font-size: 0.9rem;">15:00</span>
                        <span class="text-muted small" style="font-size: 0.75rem;">until expiry</span>
                    </div>

                    <!-- 6-Digit Matrix Form Box Module -->
                    <form id="gflPasscodeForm" autocomplete="off">
                        
                        <!-- Flex Row Box Input Containers -->
                        <div class="d-flex justify-content-center gap-2 mb-4" id="otpFieldsContainer">
                            <input type="text" class="otp-input-field font-monospace" maxlength="1" inputmode="numeric" required>
                            <input type="text" class="otp-input-field font-monospace" maxlength="1" inputmode="numeric" required>
                            <input type="text" class="otp-input-field font-monospace" maxlength="1" inputmode="numeric" required>
                            <input type="text" class="otp-input-field font-monospace" maxlength="1" inputmode="numeric" required>
                            <input type="text" class="otp-input-field font-monospace" maxlength="1" inputmode="numeric" required>
                            <input type="text" class="otp-input-field font-monospace" maxlength="1" inputmode="numeric" required>
                        </div>

                        <!-- System Warning / Notice Messaging Blocks -->
                        <div id="validationSystemMessage" class="small text-muted mb-4 font-monospace">
                            <i class="bi bi-lock"></i> Secured 256-Bit Ledger Verification Channel
                        </div>

                        <!-- Main Submit Transaction Call Action -->
                        <button type="submit" id="verifyCodeButton" class="btn btn-success btn-lg w-100 rounded-pill py-3 fw-medium text-white shadow-sm d-flex align-items-center justify-content-center gap-2 btn-gfl-success">
                            <i class="bi bi-patch-check"></i> Authorize Secure Action
                        </button>
                    </form>

                    <!-- Reset / Fallback Pathways Interface Grid Links -->
                    <div class="text-center mt-4 pt-3 border-top border-light-subtle">
                        <p class="text-secondary small mb-0">
                            Didn't receive your access authorization token?
                        </p>
                        <button type="button" id="resendCodeButton" class="btn btn-link text-success text-decoration-none fw-semibold small mt-1 p-0" disabled>
                            Resend Code (Wait <span id="resendTimeoutCount">30</span>s)
                        </button>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle Link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- ScrollReveal Animation Module Engine -->
    <script src="https://unpkg.com/scrollreveal"></script>

    <!-- Interactive Auto-Focus and Expiry Clock Script Loops Logic -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            
            const fieldsContainer = document.getElementById("otpFieldsContainer");
            const inputs = document.querySelectorAll(".otp-input-field");
            const countdownDisplay = document.getElementById("countdownDisplay");
            const timerIcon = document.getElementById("timerIcon");
            const statusMsg = document.getElementById("validationSystemMessage");
            const verifyBtn = document.getElementById("verifyCodeButton");
            const resendBtn = document.getElementById("resendCodeButton");
            const resendCounter = document.getElementById("resendTimeoutCount");
            const passForm = document.getElementById("gflPasscodeForm");

            // --- 1. Auto-Focus Matrix Navigation Inputs Handling Loops ---
            inputs.forEach((input, index) => {
                // Ensure only pure positive digits are typed inside the slots
                input.addEventListener("input", function(e) {
                    this.value = this.value.replace(/[^0-9]/g, '');
                    
                    if (this.value.length === 1 && index < inputs.length - 1) {
                        inputs[index + 1].focus(); // Advance cursor index path forward
                    }
                    evaluateFormState();
                });

                // Capture key codes loops to handle backspaces properly
                input.addEventListener("keydown", function(e) {
                    if (e.key === "Backspace" && this.value.length === 0 && index > 0) {
                        inputs[index - 1].focus(); // Move cursor back
                    }
                });

                // Support direct multi-digit paste mechanics
                input.addEventListener("paste", function(e) {
                    e.preventDefault();
                    const pasteData = e.clipboardData.getData("text").replace(/[^0-9]/g, '').substring(0, 6);
                    
                    if (pasteData.length > 0) {
                        const splitData = pasteData.split('');
                        inputs.forEach((inp, idx) => {
                            if (splitData[idx]) inp.value = splitData[idx];
                        });
                        // Focus position placement resolution on the last elements 
                        const targetFocusIndex = Math.min(splitData.length - 1, inputs.length - 1);
                        inputs[targetFocusIndex].focus();
                    }
                    evaluateFormState();
                });
            });

            function evaluateFormState() {
                const completedString = getPasscodeString();
                // Enable button visually only when matrix fields are fully saturated
                verifyBtn.disabled = (completedString.length !== 6);
            }

            function getPasscodeString() {
                let code = "";
                inputs.forEach(inp => code += inp.value);
                return code;
            }

            // --- 2. Strict 15-Minute Expiry Countdown Engine ---
            let totalTimeInSeconds = 15 * 60; // 900 Seconds total tracking array parameters
            
            const expiryIntervalClock = setInterval(() => {
                totalTimeInSeconds--;
                
                let minutes = Math.floor(totalTimeInSeconds / 60);
                let seconds = totalTimeInSeconds % 60;

                // Format values with matching prepended zero string loops
                minutes = minutes < 10 ? "0" + minutes : minutes;
                seconds = seconds < 10 ? "0" + seconds : seconds;

                countdownDisplay.textContent = `${minutes}:${seconds}`;

                // Warning threshold styling adjustments trigger (Less than 3 minutes remaining)
                if (totalTimeInSeconds <= 180) {
                    countdownDisplay.classList.replace("text-dark", "text-danger");
                    timerIcon.classList.replace("text-success", "text-danger");
                    timerIcon.classList.add("animate-pulse");
                }

                // Expiry execution threshold logic target triggers
                if (totalTimeInSeconds <= 0) {
                    clearInterval(expiryIntervalClock);
                    handleCodeExpiryState();
                }
            }, 1000);

            function handleCodeExpiryState() {
                countdownDisplay.textContent = "00:00";
                statusMsg.innerHTML = `<span class="text-danger"><i class="bi bi-exclamation-octagon-fill"></i> Operational Token Expired. Request a new sequence key below.</span>`;
                inputs.forEach(inp => inp.disabled = true);
                verifyBtn.disabled = true;
                resendBtn.disabled = false;
                resendBtn.innerHTML = `<i class="bi bi-arrow-clockwise"></i> Request Fresh 6-Digit Passcode Token`;
            }

            // --- 3. Anti-Spam Resend Lock Mechanism Loops ---
            let resendHoldTimer = 30;
            const resendLockClock = setInterval(() => {
                resendHoldTimer--;
                if (resendCounter) resendCounter.textContent = resendHoldTimer;
                
                if (resendHoldTimer <= 0) {
                    clearInterval(resendLockClock);
                    if(totalTimeInSeconds > 0) { // Only enable if overall form hasn't fully expired yet
                        resendBtn.disabled = false;
                        resendBtn.textContent = "Resend Code Over SMS/Email Channels";
                    }
                }
            }, 1000);

            // --- 4. Form Action Interception Processing Pipeline ---
            passForm.addEventListener("submit", function(e) {
                e.preventDefault();
                const absolutePasscode = getPasscodeString();
                
                if(absolutePasscode.length === 6) {
                    verifyBtn.disabled = true;
                    verifyBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2"></span> Verifying Passkey Matrix...`;
                    
                    setTimeout(() => {
                        alert(`Authorization Ledger Validated Successfully! Accessing dashboard profile parameters.`);
                        window.location.href = "#"; // Target dashboard endpoint channel route
                    }, 1400);
                }
            });

            // Resend Click Actions Mock Trigger Integration
            resendBtn.addEventListener("click", function() {
                alert("Cryptographic token re-dispatched. Expiry clock window allocation refreshed cleanly.");
                window.location.reload(); // Quick refresh loops simulation state matching
            });

            // Initialize form on first load state parameters
            evaluateFormState();

            // --- 5. Scroll Reveal Engine Loading Systems ---
            if (typeof ScrollReveal !== 'undefined') {
                ScrollReveal().reveal('[data-reveal="fade-up"]', {
                    origin: 'bottom',
                    distance: '30px',
                    duration: 900,
                    easing: 'ease-out'
                });
            }

        });
    </script>
</body>
</html>