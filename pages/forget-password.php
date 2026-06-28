<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>GFL Security Center - Recover Account Node</title>
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
        .form-control:focus, .form-select:focus {
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
        .recovery-chip {
            cursor: pointer;
            border: 2px solid #e9ecef;
            border-radius: 14px;
            padding: 12px;
            transition: all 0.2s ease;
            background-color: #fff;
        }
        .recovery-chip:hover {
            border-color: #dee2e6;
            background-color: #fafafa;
        }
        .recovery-radio:checked + .recovery-chip {
            border-color: var(--gfl-green);
            background-color: rgba(25, 135, 84, 0.04);
        }
        /* Country code select inside input-group */
        .phone-code-select {
            width: auto;
            max-width: 120px;
            border-radius: 0;
            border-right: 1px solid #dee2e6;
            background-color: #f8f9fa;
            font-size: 0.875rem;
            cursor: pointer;
        }
        .phone-code-select:focus {
            border-color: var(--gfl-green);
            box-shadow: none;
            z-index: 3;
        }
        #phoneWrapper { display: none; }
        #standardWrapper { display: block; }
    </style>
</head>
<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center align-items-center panel-vh">
            <div class="col-12 col-md-9 col-lg-6" data-reveal="fade-up">

                <div class="bg-white p-4 p-sm-5 rounded-5 shadow-sm border border-light-subtle">

                    <!-- Header -->
                    <div class="text-center mb-4">
                        <span class="bg-success-subtle text-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow-sm" style="width: 64px; height: 64px;">
                            <i class="bi bi-shield-lock fs-2"></i>
                        </span>
                        <h2 class="fw-bold text-dark mb-1">Account Recovery</h2>
                        <p class="text-secondary small mx-auto" style="max-width: 380px;">
                            Lost access to your account? Choose your preferred method below to locate and recover your secure profile.
                        </p>
                    </div>

                    <form id="gflRecoveryForm" novalidate>

                        <!-- Method Selector Chips -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark small mb-2">Select Recovery Method:</label>
                            <div class="row g-2">

                                <div class="col-4">
                                    <input type="radio" name="recoveryMethod" id="methodAccount" value="account" class="d-none recovery-radio" checked>
                                    <label for="methodAccount" class="recovery-chip text-center d-block h-100">
                                        <i class="bi bi-hash d-block fs-4 text-muted mb-1"></i>
                                        <span class="fw-medium text-dark d-block" style="font-size: 0.75rem;">Account No.</span>
                                    </label>
                                </div>

                                <div class="col-4">
                                    <input type="radio" name="recoveryMethod" id="methodPhone" value="phone" class="d-none recovery-radio">
                                    <label for="methodPhone" class="recovery-chip text-center d-block h-100">
                                        <i class="bi bi-phone d-block fs-4 text-muted mb-1"></i>
                                        <span class="fw-medium text-dark d-block" style="font-size: 0.75rem;">Phone Line</span>
                                    </label>
                                </div>

                                <div class="col-4">
                                    <input type="radio" name="recoveryMethod" id="methodEmail" value="email" class="d-none recovery-radio">
                                    <label for="methodEmail" class="recovery-chip text-center d-block h-100">
                                        <i class="bi bi-envelope d-block fs-4 text-muted mb-1"></i>
                                        <span class="fw-medium text-dark d-block" style="font-size: 0.75rem;">Email Address</span>
                                    </label>
                                </div>

                            </div>
                        </div>

                        <!-- ── Standard input (account / email) ── -->
                        <div class="mb-4" id="standardWrapper">
                            <label id="inputFieldLabel" for="recoveryInput" class="form-label fw-semibold text-dark small mb-1">
                                Enter Your Account Number
                            </label>
                            <div class="input-group">
                                <span id="inputFieldIcon" class="input-group-text bg-light text-muted border-end-0">
                                    <i class="bi bi-hash"></i>
                                </span>
                                <input type="text" id="recoveryInput"
                                    class="form-control form-control-lg border-start-0 fs-6 bg-light font-monospace"
                                    placeholder="e.g., 1023456789"
                                    maxlength="10">
                            </div>
                            <div id="fieldHelpHint" class="form-text text-muted mt-1" style="font-size: 0.72rem;">
                                Accepts your internal GFL account number or assigned virtual banking number.
                            </div>
                            <div id="standardError" class="text-danger small mt-1 d-none"></div>
                        </div>

                        <!-- ── Phone input with country code ── -->
                        <div class="mb-4" id="phoneWrapper">
                            <label class="form-label fw-semibold text-dark small mb-1">
                                Enter Your Registered Phone Number
                            </label>
                            <div class="input-group">

                                <!-- Country code dropdown -->
                                <span class="input-group-text bg-light text-muted border-end-0 pe-0">
                                    <i class="bi bi-phone"></i>
                                </span>
                                <select id="phoneCodeSelect" class="form-select form-select-lg phone-code-select border-start-0">
                                    <option value="+234" data-flag="🇳🇬" selected>🇳🇬 +234</option>
                                    <option value="+1"   data-flag="🇺🇸">🇺🇸 +1</option>
                                    <option value="+44"  data-flag="🇬🇧">🇬🇧 +44</option>
                                    <option value="+233" data-flag="🇬🇭">🇬🇭 +233</option>
                                    <option value="+254" data-flag="🇰🇪">🇰🇪 +254</option>
                                    <option value="+27"  data-flag="🇿🇦">🇿🇦 +27</option>
                                    <option value="+251" data-flag="🇪🇹">🇪🇹 +251</option>
                                    <option value="+255" data-flag="🇹🇿">🇹🇿 +255</option>
                                    <option value="+256" data-flag="🇺🇬">🇺🇬 +256</option>
                                    <option value="+225" data-flag="🇨🇮">🇨🇮 +225</option>
                                    <option value="+221" data-flag="🇸🇳">🇸🇳 +221</option>
                                    <option value="+237" data-flag="🇨🇲">🇨🇲 +237</option>
                                    <option value="+91"  data-flag="🇮🇳">🇮🇳 +91</option>
                                    <option value="+86"  data-flag="🇨🇳">🇨🇳 +86</option>
                                    <option value="+49"  data-flag="🇩🇪">🇩🇪 +49</option>
                                    <option value="+33"  data-flag="🇫🇷">🇫🇷 +33</option>
                                    <option value="+971" data-flag="🇦🇪">🇦🇪 +971</option>
                                    <option value="+966" data-flag="🇸🇦">🇸🇦 +966</option>
                                </select>

                                <!-- Phone number field -->
                                <input type="tel" id="phoneNumberInput"
                                    class="form-control form-control-lg fs-6 bg-light font-monospace"
                                    placeholder="08012345678"
                                    maxlength="15"
                                    inputmode="numeric">
                            </div>
                            <div class="form-text text-muted mt-1" style="font-size: 0.72rem;">
                                Select your country code, then enter your number without the leading zero if required.
                            </div>
                            <div id="phoneError" class="text-danger small mt-1 d-none"></div>
                        </div>

                        <!-- Action Buttons -->
                        <div class="vstack gap-2">
                            <button type="submit" id="submitRecoveryButton"
                                class="btn btn-success btn-lg w-100 rounded-pill py-3 fw-medium text-white shadow-sm d-flex align-items-center justify-content-center gap-2 btn-gfl-success">
                                <i class="bi bi-search"></i> Search Secure Ledger
                            </button>
                            <a href="/login" class="btn btn-link text-success text-decoration-none small fw-medium mt-2 py-1">
                                <i class="bi bi-arrow-left"></i> Return to Secure Log In
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function () {

        const SERVER = "<?= $company_info['server'] ?>";

        // ── Elements ──────────────────────────────────────────────────────
        const radioMethods      = document.querySelectorAll('input[name="recoveryMethod"]');
        const standardWrapper   = document.getElementById("standardWrapper");
        const phoneWrapper      = document.getElementById("phoneWrapper");
        const inputLabel        = document.getElementById("inputFieldLabel");
        const inputIcon         = document.getElementById("inputFieldIcon");
        const recoveryInput     = document.getElementById("recoveryInput");
        const fieldHelpHint     = document.getElementById("fieldHelpHint");
        const standardError     = document.getElementById("standardError");
        const phoneCodeSelect   = document.getElementById("phoneCodeSelect");
        const phoneNumberInput  = document.getElementById("phoneNumberInput");
        const phoneError        = document.getElementById("phoneError");
        const form              = document.getElementById("gflRecoveryForm");
        const submitBtn         = document.getElementById("submitRecoveryButton");

        // ── Method config (account + email only — phone handled separately) ──
        const methodConfig = {
            account: {
                label:       "Enter Your Account Number",
                icon:        "bi-hash",
                placeholder: "e.g., 1023456789",
                hint:        "Accepts your internal GFL account number or assigned virtual banking number.",
                type:        "text",
                maxLength:   "10",
                filterRegex: /[^0-9]/g
            },
            email: {
                label:       "Enter Your Registered Email Address",
                icon:        "bi-envelope",
                placeholder: "name@example.com",
                hint:        "A password reset link will be sent to this inbox.",
                type:        "email",
                maxLength:   "100",
                filterRegex: null
            }
        };

        // ── Switch visible panel ──────────────────────────────────────────
        function applyMethod(method) {
            standardError.classList.add("d-none");
            phoneError.classList.add("d-none");
            recoveryInput.value     = "";
            phoneNumberInput.value  = "";

            if (method === "phone") {
                standardWrapper.style.display = "none";
                phoneWrapper.style.display    = "block";
                return;
            }

            phoneWrapper.style.display    = "none";
            standardWrapper.style.display = "block";

            const cfg = methodConfig[method];
            inputLabel.textContent = cfg.label;
            inputIcon.innerHTML    = `<i class="bi ${cfg.icon}"></i>`;
            recoveryInput.setAttribute("type",        cfg.type);
            recoveryInput.setAttribute("placeholder", cfg.placeholder);
            recoveryInput.setAttribute("maxlength",   cfg.maxLength);
            fieldHelpHint.textContent = cfg.hint;
        }

        radioMethods.forEach(r => {
            r.addEventListener("change", function () {
                if (this.checked) applyMethod(this.value);
            });
        });

        // ── Digit-only filter for account / phone inputs ──────────────────
        recoveryInput.addEventListener("input", function () {
            const method = document.querySelector('input[name="recoveryMethod"]:checked').value;
            if (methodConfig[method]?.filterRegex) {
                this.value = this.value.replace(methodConfig[method].filterRegex, "");
            }
        });

        phoneNumberInput.addEventListener("input", function () {
            this.value = this.value.replace(/[^0-9]/g, "");
        });

        // ── Inline error helpers ──────────────────────────────────────────
        function showError(el, msg) {
            el.textContent = msg;
            el.classList.remove("d-none");
        }
        function clearErrors() {
            standardError.classList.add("d-none");
            phoneError.classList.add("d-none");
        }

        // ── Validate before submit ────────────────────────────────────────
        function validate(method) {
            clearErrors();

            if (method === "account") {
                if (recoveryInput.value.trim().length !== 10) {
                    showError(standardError, "Account number must be exactly 10 digits.");
                    return false;
                }
            }

            if (method === "email") {
                const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
                if (!emailRegex.test(recoveryInput.value.trim())) {
                    showError(standardError, "Please enter a valid email address.");
                    return false;
                }
            }

            if (method === "phone") {
                const num = phoneNumberInput.value.trim();
                if (num.length < 7 || num.length > 15) {
                    showError(phoneError, "Please enter a valid phone number (7–15 digits).");
                    return false;
                }
            }

            return true;
        }

        // ── Submit ────────────────────────────────────────────────────────
        form.addEventListener("submit", async function (e) {
            e.preventDefault();

            const method = document.querySelector('input[name="recoveryMethod"]:checked').value;
            if (!validate(method)) return;

            // Build payload
            const payload = { action: "/auth/forgot-password", method };

            if (method === "account") {
                payload.account_number = recoveryInput.value.trim();
            } else if (method === "email") {
                payload.email = recoveryInput.value.trim();
            } else if (method === "phone") {
                payload.phone_code = phoneCodeSelect.value;
                payload.phone      = phoneNumberInput.value.trim();
            }

            // Loading state
            submitBtn.disabled  = true;
            submitBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2"></span> Searching...`;

            Swal.fire({
                title:             "Searching...",
                text:              "Locating your account profile.",
                allowOutsideClick: false,
                allowEscapeKey:    false,
                showConfirmButton: false,
                didOpen:           () => Swal.showLoading()
            });

            try {

                const res = await fetch(SERVER, {
                    method:  "POST",
                    headers: { "Content-Type": "application/json" },
                    body:    JSON.stringify(payload)
                }).then(r => r.json());

                Swal.close();

                if (res.success) {

                    await Swal.fire({
                        icon:              "success",
                        title:             "Account Located",
                        text:              res.message,
                        confirmButtonText: "Continue",
                        confirmButtonColor:"#198754",
                        allowOutsideClick: false
                    });

                    if (res.data?.redirect) {
                        window.location.href = res.data.redirect+"?u="+res.data.email;
                    }

                    return;
                }

                // Hard redirect (e.g. account blocked / closed)
                if (res.data?.redirect) {
                    await Swal.fire({
                        icon:  "error",
                        title: "Recovery Failed",
                        text:  res.message,
                        confirmButtonColor: "#198754"
                    });
                    window.location.href = res.data.redirect;
                    return;
                }

                // Soft error — stay on page
                Swal.fire({
                    icon:              "error",
                    title:             "Not Found",
                    text:              res.message,
                    confirmButtonColor:"#198754"
                });

            } catch (err) {
                console.error(err);
                Swal.close();
                Swal.fire({
                    icon:  "error",
                    title: "Connection Error",
                    text:  "Unable to reach the server. Please try again.",
                    confirmButtonColor: "#198754"
                });
            } finally {
                submitBtn.disabled  = false;
                submitBtn.innerHTML = `<i class="bi bi-search"></i> Search Secure Ledger`;
            }

        });

        // ── ScrollReveal ──────────────────────────────────────────────────
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