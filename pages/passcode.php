<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>GFL Gatekeeper - Verify Secure Access Node</title>
    <link rel="icon" href="<?= $company_info['logo'] ?>" type="image/x-icon">
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
            min-height: 100%;
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

    <!-- SweetAlert2 -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Interactive Auto-Focus and Expiry Clock Script Loops Logic -->
<script>
    document.addEventListener("DOMContentLoaded", function () {

        // -------------------------------------------------------
        // CONFIGURATION
        // -------------------------------------------------------

        const SERVER = "<?= $company_info['server'] ?>";

        // Param is "u", value is URL-encoded base64 — decodeURIComponent first
        const rawParam   = new URLSearchParams(window.location.search).get("u") || "";
        const emailParam = decodeURIComponent(rawParam); // now clean base64
        const email      = emailParam;                   // passed as-is to server (already base64)

        // Sanity check — if no email param at all, bounce to signup
        if (!rawParam) {
            window.location.href = "/signup";
        }

        // -------------------------------------------------------
        // ELEMENTS
        // -------------------------------------------------------

        const fieldsContainer  = document.getElementById("otpFieldsContainer");
        const inputs           = document.querySelectorAll(".otp-input-field");
        const countdownDisplay = document.getElementById("countdownDisplay");
        const timerIcon        = document.getElementById("timerIcon");
        const statusMsg        = document.getElementById("validationSystemMessage");
        const verifyBtn        = document.getElementById("verifyCodeButton");
        const resendBtn        = document.getElementById("resendCodeButton");
        const resendCounter    = document.getElementById("resendTimeoutCount");
        const passForm         = document.getElementById("gflPasscodeForm");

        let countdownInterval = null;
        let resendInterval    = null;
        let remainingSeconds  = 0;

        // -------------------------------------------------------
        // HELPERS
        // -------------------------------------------------------

        function getPasscodeString() {
            let code = "";
            inputs.forEach(inp => { code += inp.value.trim(); });
            return code;
        }

        function enableInputs(state = true) {
            inputs.forEach(inp => { inp.disabled = !state; });
        }

        function evaluateFormState() {
            verifyBtn.disabled = getPasscodeString().length !== 6;
        }

        function formatTime(seconds) {
            const m = Math.floor(seconds / 60);
            const s = seconds % 60;
            return String(m).padStart(2, "0") + ":" + String(s).padStart(2, "0");
        }

        function resetVisuals() {
            countdownDisplay.classList.remove("text-danger");
            countdownDisplay.classList.add("text-dark");
            timerIcon.classList.remove("text-danger", "animate-pulse");
            timerIcon.classList.add("text-success");
            statusMsg.innerHTML = `<i class="bi bi-lock"></i> Secured 256-Bit Ledger Verification Channel`;
        }

        function setExpiredState(hardExpired = false) {
            clearInterval(countdownInterval);
            countdownDisplay.textContent = "00:00";
            countdownDisplay.classList.remove("text-dark");
            countdownDisplay.classList.add("text-danger");
            timerIcon.classList.remove("text-success");
            timerIcon.classList.add("text-danger", "animate-pulse");
            statusMsg.innerHTML = `
                <span class="text-danger">
                    <i class="bi bi-exclamation-octagon-fill"></i>
                    Operational Token Expired. Request a new sequence key below.
                </span>`;
            enableInputs(false);
            verifyBtn.disabled = true;

            if (hardExpired) {
                // 30-min window gone — must re-register
                resendBtn.disabled = true;
                resendBtn.innerHTML = `Session expired. Please register again.`;
                setTimeout(() => { window.location.href = "/signup"; }, 3000);
            } else if (!resendInterval) {
                resendBtn.disabled = false;
                resendBtn.innerHTML = `<i class="bi bi-arrow-clockwise"></i> Request Fresh 6-Digit Passcode Token`;
            }
        }

        // -------------------------------------------------------
        // OTP INPUT NAVIGATION
        // -------------------------------------------------------

        inputs.forEach((input, index) => {

            input.addEventListener("input", function () {
                this.value = this.value.replace(/[^0-9]/g, "").substring(0, 1);
                if (this.value && index < inputs.length - 1) {
                    inputs[index + 1].focus();
                }
                evaluateFormState();
            });

            input.addEventListener("keydown", function (e) {
                if (e.key === "Backspace" && !this.value && index > 0) {
                    inputs[index - 1].focus();
                }
                if (e.key === "ArrowLeft"  && index > 0)                inputs[index - 1].focus();
                if (e.key === "ArrowRight" && index < inputs.length - 1) inputs[index + 1].focus();
            });

            input.addEventListener("paste", function (e) {
                e.preventDefault();
                const pasted = (e.clipboardData.getData("text") || "")
                    .replace(/\D/g, "")
                    .substring(0, 6);
                pasted.split("").forEach((digit, i) => {
                    if (inputs[i]) inputs[i].value = digit;
                });
                if (pasted.length) {
                    inputs[Math.min(pasted.length - 1, inputs.length - 1)].focus();
                }
                evaluateFormState();
            });

        });

        // Container-level paste (covers gap clicks)
        fieldsContainer.addEventListener("paste", function (e) {
            e.preventDefault();
            const pasted = (e.clipboardData.getData("text") || "")
                .replace(/\D/g, "")
                .substring(0, 6);
            pasted.split("").forEach((digit, i) => {
                if (inputs[i]) inputs[i].value = digit;
            });
            if (pasted.length) {
                inputs[Math.min(pasted.length - 1, inputs.length - 1)].focus();
            }
            evaluateFormState();
        });

        inputs[0].focus();

        // -------------------------------------------------------
        // SERVER COUNTDOWN
        // -------------------------------------------------------

        async function loadCountdown() {
            try {

                const response = await fetch(SERVER, {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({
                        action: "/auth/update-passcode-timeframe-on-frontend",
                        email: email
                    })
                });

                const res = await response.json();

                if (!res.success) {
                    const hardExpired = res.data?.hard_expired === true;
                    const redirect    = res.data?.redirect;

                    if (redirect) {
                        await Swal.fire({
                            icon: "error",
                            title: hardExpired ? "Session Expired" : "Error",
                            text: res.message
                        });
                        window.location.href = redirect;
                        return;
                    }

                    // Code expired but resend still allowed
                    setExpiredState(false);
                    return;
                }

                remainingSeconds = Number(res.data.remaining);
                startCountdown();

            } catch (err) {
                console.error(err);
                Swal.fire({
                    icon: "error",
                    title: "Connection Error",
                    text: "Unable to contact the server. Please try again."
                });
            }
        }

        function startCountdown() {
            if (countdownInterval) clearInterval(countdownInterval);

            resetVisuals();
            enableInputs(true);
            evaluateFormState();

            countdownDisplay.textContent = formatTime(remainingSeconds);

            countdownInterval = setInterval(() => {
                remainingSeconds--;

                countdownDisplay.textContent = formatTime(Math.max(remainingSeconds, 0));

                if (remainingSeconds <= 180) {
                    countdownDisplay.classList.remove("text-dark");
                    countdownDisplay.classList.add("text-danger");
                    timerIcon.classList.remove("text-success");
                    timerIcon.classList.add("text-danger", "animate-pulse");
                }

                if (remainingSeconds <= 0) {
                    setExpiredState(false);
                }

            }, 1000);
        }

        loadCountdown();

        // -------------------------------------------------------
        // RESEND COOLDOWN
        // -------------------------------------------------------

        function startResendCooldown() {
            let cooldown = 30;
            resendBtn.disabled = true;
            resendBtn.innerHTML = `Resend Code (Wait <span id="resendTimeoutCount">${cooldown}</span>s)`;

            resendInterval = setInterval(() => {
                cooldown--;
                const counter = document.getElementById("resendTimeoutCount");
                if (counter) counter.textContent = cooldown;

                if (cooldown <= 0) {
                    clearInterval(resendInterval);
                    resendInterval = null;
                    resendBtn.disabled = false;
                    resendBtn.innerHTML = `<i class="bi bi-arrow-clockwise"></i> Request Fresh 6-Digit Passcode Token`;
                }
            }, 1000);
        }

        // -------------------------------------------------------
        // RESEND HANDLER
        // -------------------------------------------------------

        resendBtn.addEventListener("click", async function () {

            resendBtn.disabled = true;
            resendBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-1"></span> Sending...`;

            try {

                const response = await fetch(SERVER, {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({
                        action: "/auth/resendCode",
                        email: email
                    })
                });

                const res = await response.json();

                if (!res.success) {

                    if (res.data?.redirect) {
                        await Swal.fire({
                            icon: "error",
                            title: "Error",
                            text: res.message
                        });
                        window.location.href = res.data.redirect;
                        return;
                    }

                    Swal.fire({
                        icon: "warning",
                        title: "Notice",
                        text: res.message
                    });

                    resendBtn.disabled = false;
                    resendBtn.innerHTML = `<i class="bi bi-arrow-clockwise"></i> Request Fresh 6-Digit Passcode Token`;
                    return;
                }

                Swal.fire({
                    icon: "success",
                    title: "Code Sent",
                    text: res.message,
                    timer: 2500,
                    showConfirmButton: false
                });

                // Reset OTP boxes and restart with fresh 15 min
                inputs.forEach(inp => inp.value = "");
                inputs[0].focus();
                enableInputs(true);
                evaluateFormState();

                remainingSeconds = res.data?.expires_in ?? 900;
                startCountdown();
                startResendCooldown();

            } catch (err) {
                console.error(err);
                resendBtn.disabled = false;
                resendBtn.innerHTML = `<i class="bi bi-arrow-clockwise"></i> Request Fresh 6-Digit Passcode Token`;
                Swal.fire({
                    icon: "error",
                    title: "Connection Error",
                    text: "Unable to contact the server."
                });
            }

        });

        // -------------------------------------------------------
        // VERIFY PASSCODE
        // -------------------------------------------------------

        passForm.addEventListener("submit", async function (e) {

            e.preventDefault();

            const passcode = getPasscodeString();

            if (passcode.length !== 6) {
                Swal.fire({
                    icon: "warning",
                    title: "Incomplete Code",
                    text: "Please enter all 6 digits of your verification code."
                });
                return;
            }

            verifyBtn.disabled = true;
            verifyBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2"></span> Verifying Passkey Matrix...`;
            enableInputs(false);

            try {

                const response = await fetch(SERVER, {
                    method: "POST",
                    headers: { "Content-Type": "application/json" },
                    body: JSON.stringify({
                        action: "/auth/validate-passcode",
                        email: email,
                        passcode: passcode
                    })
                });

                const res = await response.json();

                if (res.success) {

                    clearInterval(countdownInterval);

                    await Swal.fire({
                        icon: "success",
                        title: "Verification Successful",
                        text: res.message,
                        allowOutsideClick: false,
                        confirmButtonText: "Continue"
                    });

                    if (res.data?.redirect) {
                        window.location.href = res.data.redirect;
                    }

                    return;
                }

                // Failed — restore form
                enableInputs(true);
                verifyBtn.disabled = false;
                verifyBtn.innerHTML = `<i class="bi bi-patch-check"></i> Authorize Secure Action`;
                inputs.forEach(inp => inp.value = "");
                inputs[0].focus();
                evaluateFormState();

                if (res.data?.redirect) {
                    await Swal.fire({
                        icon: "error",
                        title: "Verification Failed",
                        text: res.message
                    });
                    window.location.href = res.data.redirect;
                    return;
                }

                Swal.fire({
                    icon: "error",
                    title: "Verification Failed",
                    text: res.message
                });

            } catch (err) {
                console.error(err);
                enableInputs(true);
                verifyBtn.disabled = false;
                verifyBtn.innerHTML = `<i class="bi bi-patch-check"></i> Authorize Secure Action`;
                Swal.fire({
                    icon: "error",
                    title: "Connection Error",
                    text: "Unable to connect to the server."
                });
            }

        });

        // -------------------------------------------------------
        // SCROLL REVEAL
        // -------------------------------------------------------

        if (typeof ScrollReveal !== "undefined") {
            ScrollReveal().reveal('[data-reveal="fade-up"]', {
                origin: "bottom",
                distance: "30px",
                duration: 900,
                easing: "ease-out"
            });
        }

    });
</script>
</body>
</html>