<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>GFL Security Center - Reset Account Password</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="icon" href="<?= $company_info['logo'] ?>" type="image/x-icon">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
        .panel-vh { min-height: 100%; }
        .form-control:focus {
            border-color: var(--gfl-green);
            box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.15);
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

        /* OTP boxes */
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
        .otp-input-field.is-invalid {
            border-color: #dc3545;
            background-color: #fff5f5;
        }

        /* Password strength bar */
        .strength-bar-track {
            height: 5px;
            background: #e9ecef;
            border-radius: 99px;
            overflow: hidden;
            margin-top: 8px;
        }
        .strength-bar-fill {
            height: 100%;
            width: 0%;
            border-radius: 99px;
            transition: width 0.3s ease, background-color 0.3s ease;
        }

        /* Step transition */
        .step-panel {
            display: none;
        }
        .step-panel.active {
            display: block;
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

            <div class="bg-white p-4 p-sm-5 rounded-5 shadow-sm border border-light-subtle text-center">

                <!-- ── STEP 1: OTP Verification ── -->
                <div id="stepOtp" class="step-panel active">

                    <div class="mb-4">
                        <span class="bg-success-subtle text-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow-sm" style="width: 56px; height: 56px;">
                            <i class="bi bi-key-fill fs-3"></i>
                        </span>
                        <h2 class="fw-bold text-dark mb-1">Enter Reset Code</h2>
                        <p class="text-secondary small mx-auto mb-0" style="max-width: 340px;">
                            A 6-digit password reset code was sent to the email address linked to your account.
                        </p>
                    </div>

                    <!-- Countdown -->
                    <div class="bg-light rounded-4 d-inline-flex align-items-center gap-2 px-3 py-2 mb-4">
                        <i id="timerIcon" class="bi bi-clock-history text-success"></i>
                        <span id="countdownDisplay" class="fw-bold font-monospace text-dark" style="font-size: 0.9rem;">15:00</span>
                        <span class="text-muted small" style="font-size: 0.75rem;">until expiry</span>
                    </div>

                    <!-- OTP Boxes -->
                    <div class="d-flex justify-content-center gap-2 mb-3" id="otpFieldsContainer">
                        <input type="text" class="otp-input-field font-monospace" maxlength="1" inputmode="numeric">
                        <input type="text" class="otp-input-field font-monospace" maxlength="1" inputmode="numeric">
                        <input type="text" class="otp-input-field font-monospace" maxlength="1" inputmode="numeric">
                        <input type="text" class="otp-input-field font-monospace" maxlength="1" inputmode="numeric">
                        <input type="text" class="otp-input-field font-monospace" maxlength="1" inputmode="numeric">
                        <input type="text" class="otp-input-field font-monospace" maxlength="1" inputmode="numeric">
                    </div>

                    <div id="otpStatusMsg" class="small text-muted mb-4 font-monospace">
                        <i class="bi bi-lock"></i> Secured 256-Bit Reset Authorization Channel
                    </div>

                    <button type="button" id="verifyOtpBtn"
                        class="btn btn-success btn-lg w-100 rounded-pill py-3 fw-medium text-white shadow-sm d-flex align-items-center justify-content-center gap-2 btn-gfl-success"
                        disabled>
                        <i class="bi bi-patch-check"></i> Verify Reset Code
                    </button>

                    <!-- Resend -->
                    <div class="text-center mt-4 pt-3 border-top border-light-subtle">
                        <p class="text-secondary small mb-0">Didn't receive the reset code?</p>
                        <button type="button" id="resendOtpBtn"
                            class="btn btn-link text-success text-decoration-none fw-semibold small mt-1 p-0"
                            disabled>
                            Resend Code (Wait <span id="resendCounter">30</span>s)
                        </button>
                    </div>

                </div>

                <!-- ── STEP 2: New Password ── -->
                <div id="stepPassword" class="step-panel">

                    <div class="mb-4">
                        <span class="bg-success-subtle text-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow-sm" style="width: 56px; height: 56px;">
                            <i class="bi bi-shield-lock-fill fs-3"></i>
                        </span>
                        <h2 class="fw-bold text-dark mb-1">Set New Password</h2>
                        <p class="text-secondary small mx-auto mb-0" style="max-width: 340px;">
                            Create a strong new password for your account. You will be redirected to login once saved.
                        </p>
                    </div>

                    <form id="resetPasswordForm" novalidate class="text-start">

                        <!-- New Password -->
                        <div class="mb-3">
                            <label for="newPassword" class="form-label fw-semibold text-dark small mb-1">New Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0">
                                    <i class="bi bi-lock"></i>
                                </span>
                                <input type="password" id="newPassword"
                                    class="form-control form-control-lg border-start-0 fs-6 bg-light"
                                    placeholder="••••••••">
                                <button class="input-group-text bg-light text-muted border-start-0"
                                    type="button" id="toggleNewPassword">
                                    <i class="bi bi-eye" id="toggleNewIcon"></i>
                                </button>
                            </div>
                            <!-- Strength bar -->
                            <div class="strength-bar-track">
                                <div class="strength-bar-fill" id="strengthBarFill"></div>
                            </div>
                            <div id="strengthLabel" class="form-text mt-1" style="font-size: 0.72rem;"></div>
                            <div id="newPasswordError" class="text-danger small mt-1 d-none"></div>
                        </div>

                        <!-- Confirm Password -->
                        <div class="mb-4">
                            <label for="confirmPassword" class="form-label fw-semibold text-dark small mb-1">Confirm Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0">
                                    <i class="bi bi-lock-fill"></i>
                                </span>
                                <input type="password" id="confirmPassword"
                                    class="form-control form-control-lg border-start-0 fs-6 bg-light"
                                    placeholder="••••••••">
                                <button class="input-group-text bg-light text-muted border-start-0"
                                    type="button" id="toggleConfirmPassword">
                                    <i class="bi bi-eye" id="toggleConfirmIcon"></i>
                                </button>
                            </div>
                            <div id="confirmPasswordError" class="text-danger small mt-1 d-none"></div>
                        </div>

                        <!-- Password Rules Checklist -->
                        <div class="bg-light rounded-3 p-3 mb-4 text-start">
                            <p class="small fw-semibold text-dark mb-2" style="font-size: 0.78rem;">Password Requirements:</p>
                            <ul class="list-unstyled mb-0 vstack gap-1" style="font-size: 0.75rem;">
                                <li id="rule-length"   class="text-muted"><i class="bi bi-circle me-2"></i>At least 6 characters</li>
                                <li id="rule-upper"    class="text-muted"><i class="bi bi-circle me-2"></i>At least one uppercase letter</li>
                                <li id="rule-digit"    class="text-muted"><i class="bi bi-circle me-2"></i>At least one number</li>
                            </ul>
                        </div>

                        <button type="submit" id="savePasswordBtn"
                            class="btn btn-success btn-lg w-100 rounded-pill py-3 fw-medium text-white shadow-sm d-flex align-items-center justify-content-center gap-2 btn-gfl-success">
                            <i class="bi bi-floppy-fill"></i> Save New Password
                        </button>

                    </form>

                </div>

            </div>

            <!-- Back to login -->
            <div class="text-center mt-3">
                <a href="/login" class="text-success text-decoration-none small fw-medium">
                    <i class="bi bi-arrow-left"></i> Return to Secure Log In
                </a>
            </div>

        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://unpkg.com/scrollreveal"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", function () {

    // -------------------------------------------------------
    // CONFIGURATION
    // -------------------------------------------------------

    const SERVER = "<?= $company_info['server'] ?>";

    // Read email from ?email= param (base64-encoded)
    const rawParam = new URLSearchParams(window.location.search).get("email") || "";
    let email = "";

    try {
        email = atob(rawParam);
    } catch (e) {
        email = "";
    }

    if (!email || !email.includes("@")) {
        Swal.fire({
            icon:              "error",
            title:             "Invalid Session",
            text:              "No valid account session found. Please start the recovery process again.",
            allowOutsideClick: false,
            confirmButtonText: "Go to Recovery",
            confirmButtonColor:"#198754"
        }).then(() => {
            window.location.href = "/forgot-password";
        });
    }

    // Verified OTP is stored here before step 2 is shown
    let verifiedOtp = "";

    // -------------------------------------------------------
    // ELEMENTS — STEP 1
    // -------------------------------------------------------

    const stepOtp          = document.getElementById("stepOtp");
    const stepPassword     = document.getElementById("stepPassword");

    const otpInputs        = document.querySelectorAll(".otp-input-field");
    const countdownDisplay = document.getElementById("countdownDisplay");
    const timerIcon        = document.getElementById("timerIcon");
    const otpStatusMsg     = document.getElementById("otpStatusMsg");
    const verifyOtpBtn     = document.getElementById("verifyOtpBtn");
    const resendOtpBtn     = document.getElementById("resendOtpBtn");
    const resendCounter    = document.getElementById("resendCounter");

    // -------------------------------------------------------
    // ELEMENTS — STEP 2
    // -------------------------------------------------------

    const resetPasswordForm    = document.getElementById("resetPasswordForm");
    const newPasswordInput     = document.getElementById("newPassword");
    const confirmPasswordInput = document.getElementById("confirmPassword");
    const savePasswordBtn      = document.getElementById("savePasswordBtn");
    const strengthBarFill      = document.getElementById("strengthBarFill");
    const strengthLabel        = document.getElementById("strengthLabel");
    const newPasswordError     = document.getElementById("newPasswordError");
    const confirmPasswordError = document.getElementById("confirmPasswordError");

    // -------------------------------------------------------
    // HELPERS
    // -------------------------------------------------------

    let countdownInterval = null;
    let resendInterval    = null;
    let remainingSeconds  = 0;

    function getOtp() {
        let code = "";
        otpInputs.forEach(i => { code += i.value.trim(); });
        return code;
    }

    function enableOtpInputs(state = true) {
        otpInputs.forEach(i => { i.disabled = !state; });
    }

    function updateVerifyBtn() {
        verifyOtpBtn.disabled = getOtp().length !== 6;
    }

    function formatTime(s) {
        return String(Math.floor(s / 60)).padStart(2, "0") + ":" + String(s % 60).padStart(2, "0");
    }

    function setExpiredState() {
        clearInterval(countdownInterval);
        countdownInterval = null;

        countdownDisplay.textContent = "00:00";
        countdownDisplay.classList.replace("text-dark", "text-danger");
        timerIcon.classList.replace("text-success", "text-danger");

        otpStatusMsg.innerHTML = `
            <span class="text-danger">
                <i class="bi bi-exclamation-octagon-fill"></i>
                Reset code expired. Request a new one below.
            </span>`;

        enableOtpInputs(false);
        verifyOtpBtn.disabled = true;

        if (!resendInterval) {
            resendOtpBtn.disabled = false;
            resendOtpBtn.innerHTML = `<i class="bi bi-arrow-clockwise"></i> Resend Reset Code`;
        }
    }

    function resetCountdownVisuals() {
        countdownDisplay.classList.remove("text-danger");
        countdownDisplay.classList.add("text-dark");
        timerIcon.classList.remove("text-danger");
        timerIcon.classList.add("text-success");
        otpStatusMsg.innerHTML = `<i class="bi bi-lock"></i> Secured 256-Bit Reset Authorization Channel`;
    }

    // -------------------------------------------------------
    // COUNTDOWN
    // -------------------------------------------------------

    function startCountdown() {
        if (countdownInterval) clearInterval(countdownInterval);
        resetCountdownVisuals();
        countdownDisplay.textContent = formatTime(remainingSeconds);

        countdownInterval = setInterval(() => {
            remainingSeconds--;
            countdownDisplay.textContent = formatTime(Math.max(remainingSeconds, 0));

            if (remainingSeconds <= 180) {
                countdownDisplay.classList.remove("text-dark");
                countdownDisplay.classList.add("text-danger");
                timerIcon.classList.remove("text-success");
                timerIcon.classList.add("text-danger");
            }

            if (remainingSeconds <= 0) setExpiredState();
        }, 1000);
    }

    async function loadCountdown() {
        try {
            const res = await fetch(SERVER, {
                method:  "POST",
                headers: { "Content-Type": "application/json" },
                body:    JSON.stringify({
                    action: "/auth/update-passcode-timeframe-on-frontend",
                    email:  btoa(email)
                })
            }).then(r => r.json());

            if (!res.success) {
                if (res.data?.hard_expired || res.data?.redirect === "/signup") {
                    await Swal.fire({
                        icon:              "warning",
                        title:             "Session Expired",
                        text:              res.message,
                        confirmButtonText: "Start Again",
                        confirmButtonColor:"#198754",
                        allowOutsideClick: false
                    });
                    window.location.href = "/forgot-password";
                    return;
                }
                setExpiredState();
                return;
            }

            remainingSeconds = Number(res.data.remaining);
            startCountdown();

        } catch (err) {
            console.error(err);
            Swal.fire({
                icon:  "error",
                title: "Connection Error",
                text:  "Unable to contact the server. Please refresh.",
                confirmButtonColor: "#198754"
            });
        }
    }

    loadCountdown();

    // -------------------------------------------------------
    // OTP INPUT NAVIGATION
    // -------------------------------------------------------

    otpInputs.forEach((input, index) => {

        input.addEventListener("input", function () {
            this.value = this.value.replace(/[^0-9]/g, "").substring(0, 1);
            if (this.value && index < otpInputs.length - 1) {
                otpInputs[index + 1].focus();
            }
            updateVerifyBtn();
        });

        input.addEventListener("keydown", function (e) {
            if (e.key === "Backspace" && !this.value && index > 0) {
                otpInputs[index - 1].focus();
            }
            if (e.key === "ArrowLeft"  && index > 0)                   otpInputs[index - 1].focus();
            if (e.key === "ArrowRight" && index < otpInputs.length - 1) otpInputs[index + 1].focus();
        });

    });

    document.getElementById("otpFieldsContainer").addEventListener("paste", e => {
        e.preventDefault();
        const pasted = (e.clipboardData.getData("text") || "")
            .replace(/[^0-9]/g, "")
            .substring(0, 6);
        pasted.split("").forEach((d, i) => {
            if (otpInputs[i]) otpInputs[i].value = d;
        });
        if (pasted.length) {
            otpInputs[Math.min(pasted.length - 1, otpInputs.length - 1)].focus();
        }
        updateVerifyBtn();
    });

    otpInputs[0].focus();

    // -------------------------------------------------------
    // RESEND OTP
    // -------------------------------------------------------

    function startResendCooldown() {
        let cooldown = 30;
        resendOtpBtn.disabled = true;
        resendOtpBtn.innerHTML = `Resend Code (Wait <span id="resendCounter">${cooldown}</span>s)`;

        resendInterval = setInterval(() => {
            cooldown--;
            const el = document.getElementById("resendCounter");
            if (el) el.textContent = cooldown;

            if (cooldown <= 0) {
                clearInterval(resendInterval);
                resendInterval = null;
                resendOtpBtn.disabled = false;
                resendOtpBtn.innerHTML = `<i class="bi bi-arrow-clockwise"></i> Resend Reset Code`;
            }
        }, 1000);
    }

    resendOtpBtn.addEventListener("click", async function () {

        resendOtpBtn.disabled = true;
        resendOtpBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-1"></span> Sending...`;

        try {
            const res = await fetch(SERVER, {
                method:  "POST",
                headers: { "Content-Type": "application/json" },
                body:    JSON.stringify({
                    action: "/auth/forgot-password-resend",
                    email:  btoa(email)
                })
            }).then(r => r.json());

            if (!res.success) {
                if (res.data?.redirect) {
                    await Swal.fire({
                        icon:  "error",
                        title: "Error",
                        text:  res.message,
                        confirmButtonColor: "#198754"
                    });
                    window.location.href = res.data.redirect;
                    return;
                }

                Swal.fire({
                    icon:  "warning",
                    title: "Notice",
                    text:  res.message,
                    confirmButtonColor: "#198754"
                });

                resendOtpBtn.disabled = false;
                resendOtpBtn.innerHTML = `<i class="bi bi-arrow-clockwise"></i> Resend Reset Code`;
                return;
            }

            Swal.fire({
                icon:              "success",
                title:             "Code Sent",
                text:              res.message,
                timer:             2500,
                showConfirmButton: false
            });

            // Re-enable and reset OTP boxes
            enableOtpInputs(true);
            otpInputs.forEach(i => { i.value = ""; });
            otpInputs[0].focus();
            updateVerifyBtn();

            remainingSeconds = Number(res.data?.expires_in ?? 900);
            startCountdown();
            startResendCooldown();

        } catch (err) {
            console.error(err);
            resendOtpBtn.disabled = false;
            resendOtpBtn.innerHTML = `<i class="bi bi-arrow-clockwise"></i> Resend Reset Code`;
            Swal.fire({
                icon:  "error",
                title: "Connection Error",
                text:  "Unable to contact the server.",
                confirmButtonColor: "#198754"
            });
        }

    });

    // -------------------------------------------------------
    // VERIFY OTP  →  advance to step 2
    // -------------------------------------------------------

    verifyOtpBtn.addEventListener("click", async function () {

        const otp = getOtp();
        if (otp.length !== 6) return;

        verifyOtpBtn.disabled = true;
        verifyOtpBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2"></span> Verifying...`;
        enableOtpInputs(false);

        try {
            const res = await fetch(SERVER, {
                method:  "POST",
                headers: { "Content-Type": "application/json" },
                body:    JSON.stringify({
                    action:   "/auth/verify-reset-otp",
                    email:    btoa(email),
                    passcode: otp
                })
            }).then(r => r.json());

            if (res.success) {
                clearInterval(countdownInterval);
                verifiedOtp = otp;

                // Slide to step 2
                stepOtp.classList.remove("active");
                stepPassword.classList.add("active");
                newPasswordInput.focus();
                return;
            }

            // Failed — restore
            enableOtpInputs(true);
            verifyOtpBtn.disabled = false;
            verifyOtpBtn.innerHTML = `<i class="bi bi-patch-check"></i> Verify Reset Code`;
            otpInputs.forEach(i => { i.value = ""; });
            otpInputs[0].focus();
            updateVerifyBtn();

            if (res.data?.redirect) {
                await Swal.fire({
                    icon:  "error",
                    title: "Verification Failed",
                    text:  res.message,
                    confirmButtonColor: "#198754"
                });
                window.location.href = res.data.redirect;
                return;
            }

            Swal.fire({
                icon:  "error",
                title: "Verification Failed",
                text:  res.message,
                confirmButtonColor: "#198754"
            });

        } catch (err) {
            console.error(err);
            enableOtpInputs(true);
            verifyOtpBtn.disabled = false;
            verifyOtpBtn.innerHTML = `<i class="bi bi-patch-check"></i> Verify Reset Code`;
            Swal.fire({
                icon:  "error",
                title: "Connection Error",
                text:  "Unable to connect to the server.",
                confirmButtonColor: "#198754"
            });
        }

    });

    // -------------------------------------------------------
    // PASSWORD TOGGLE BUTTONS
    // -------------------------------------------------------

    function bindToggle(btnId, inputId, iconId) {
        document.getElementById(btnId).addEventListener("click", () => {
            const inp  = document.getElementById(inputId);
            const icon = document.getElementById(iconId);
            const hide = inp.type === "password";
            inp.type = hide ? "text" : "password";
            icon.classList.toggle("bi-eye",       !hide);
            icon.classList.toggle("bi-eye-slash",  hide);
        });
    }

    bindToggle("toggleNewPassword",     "newPassword",     "toggleNewIcon");
    bindToggle("toggleConfirmPassword", "confirmPassword", "toggleConfirmIcon");

    // -------------------------------------------------------
    // PASSWORD STRENGTH + RULES CHECKER
    // -------------------------------------------------------

    const rules = {
        length: { el: document.getElementById("rule-length"), test: v => v.length >= 6      },
        upper:  { el: document.getElementById("rule-upper"),  test: v => /[A-Z]/.test(v)    },
        digit:  { el: document.getElementById("rule-digit"),  test: v => /[0-9]/.test(v)    }
    };

    const strengthLevels = [
        { label: "",          color: "",        width: "0%"   },
        { label: "Weak",      color: "#dc3545", width: "33%"  },
        { label: "Fair",      color: "#f59e0b", width: "66%"  },
        { label: "Strong",    color: "#198754", width: "100%" }
    ];

    newPasswordInput.addEventListener("input", function () {
        const val = this.value;
        let passed = 0;

        Object.values(rules).forEach(r => {
            const ok = r.test(val);
            if (ok) passed++;
            r.el.className = ok ? "text-success" : "text-muted";
            r.el.querySelector("i").className = ok
                ? "bi bi-check-circle-fill me-2"
                : "bi bi-circle me-2";
        });

        const level = val.length === 0 ? 0 : Math.min(passed, 3);
        const s = strengthLevels[level];
        strengthBarFill.style.width           = s.width;
        strengthBarFill.style.backgroundColor = s.color;
        strengthLabel.textContent             = s.label;
        strengthLabel.style.color             = s.color;

        // Clear error on type
        newPasswordError.classList.add("d-none");
    });

    confirmPasswordInput.addEventListener("input", function () {
        confirmPasswordError.classList.add("d-none");
    });

    // -------------------------------------------------------
    // SAVE NEW PASSWORD
    // -------------------------------------------------------

    resetPasswordForm.addEventListener("submit", async function (e) {
        e.preventDefault();

        const newPass     = newPasswordInput.value;
        const confirmPass = confirmPasswordInput.value;
        let   valid       = true;

        // Validate new password
        if (!/^(?=.*[A-Z])(?=.*\d).{6,}$/.test(newPass)) {
            newPasswordError.textContent = "Password must be at least 6 characters with one uppercase letter and one number.";
            newPasswordError.classList.remove("d-none");
            valid = false;
        }

        // Validate match
        if (newPass !== confirmPass) {
            confirmPasswordError.textContent = "Passwords do not match.";
            confirmPasswordError.classList.remove("d-none");
            valid = false;
        }

        if (!valid) return;

        savePasswordBtn.disabled = true;
        savePasswordBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2"></span> Saving...`;

        try {
            const res = await fetch(SERVER, {
                method:  "POST",
                headers: { "Content-Type": "application/json" },
                body:    JSON.stringify({
                    action:   "/auth/reset-password",
                    email:    btoa(email),
                    passcode: verifiedOtp,
                    password: newPass
                })
            }).then(r => r.json());

            if (res.success) {
                await Swal.fire({
                    icon:              "success",
                    title:             "Password Reset Successful",
                    text:              res.message,
                    confirmButtonText: "Go to Login",
                    confirmButtonColor:"#198754",
                    allowOutsideClick: false
                });
                window.location.href = res.data?.redirect || "/login";
                return;
            }

            // Token expired between step 1 and step 2 — restart
            if (res.data?.redirect) {
                await Swal.fire({
                    icon:  "error",
                    title: "Session Expired",
                    text:  res.message,
                    confirmButtonColor: "#198754"
                });
                window.location.href = res.data.redirect;
                return;
            }

            Swal.fire({
                icon:  "error",
                title: "Reset Failed",
                text:  res.message,
                confirmButtonColor: "#198754"
            });

        } catch (err) {
            console.error(err);
            Swal.fire({
                icon:  "error",
                title: "Connection Error",
                text:  "Unable to connect to the server.",
                confirmButtonColor: "#198754"
            });
        } finally {
            savePasswordBtn.disabled = false;
            savePasswordBtn.innerHTML = `<i class="bi bi-floppy-fill"></i> Save New Password`;
        }

    });

    // -------------------------------------------------------
    // SCROLL REVEAL
    // -------------------------------------------------------

    if (typeof ScrollReveal !== "undefined") {
        ScrollReveal().reveal('[data-reveal="fade-up"]', {
            origin:   "bottom",
            distance: "30px",
            duration: 900,
            easing:   "ease-out"
        });
    }

});
</script>
</body>
</html>