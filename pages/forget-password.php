<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GFL Security Center - Recover Account Node</title>
    
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
        .form-control:focus, .form-select:focus {
            border-color: var(--gfl-green);
            box-shadow: 0 0 0 0.25rem rgba(25, 135, 84, 0.15);
        }
        .btn-gfl-success {
            background-color: var(--gfl-green);
            border: none;
            transition: all 0.25s ease;
        }
        .btn-gfl-success:hover {
            background-color: var(--gfl-green-dark);
            transform: translateY(-1px);
        }
        /* Custom UI Selector Chips */
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
    </style>
</head>
<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center align-items-center panel-vh">
            <div class="col-12 col-md-9 col-lg-6" data-reveal="fade-up">
                
                <!-- Main Recovery Container Card -->
                <div class="bg-white p-4 p-sm-5 rounded-5 shadow-sm border border-light-subtle">
                    
                    <!-- Top Icon Header -->
                    <div class="text-center mb-4">
                        <span class="bg-success-subtle text-success rounded-circle d-inline-flex align-items-center justify-content-center mb-3 shadow-sm" style="width: 64px; height: 64px;">
                            <i class="bi bi-shield-lock fs-2"></i>
                        </span>
                        <h2 class="fw-bold text-dark mb-1">Account Recovery</h2>
                        <p class="text-secondary small max-width-xs mx-auto" style="max-width: 380px;">
                            Lost access to your multi-wallet ledger? Choose your preferred identity vector below to locate your secure account profile.
                        </p>
                    </div>

                    <!-- Dynamic Recovery Search Form -->
                    <form id="gflRecoveryForm" class="needs-validation" novalidate>
                        
                        <!-- Step 1: Identifier Selection Grid System -->
                        <div class="mb-4">
                            <label class="form-label fw-semibold text-dark small mb-2">Select Account Finder Method:</label>
                            <div class="row g-2">
                                
                                <!-- Mode A: Account Number Vector -->
                                <div class="col-4">
                                    <input type="radio" name="recoveryMethod" id="methodAccount" value="account" class="d-none recovery-radio" checked>
                                    <label for="methodAccount" class="recovery-chip text-center d-block h-100">
                                        <i class="bi bi-hash d-block fs-4 text-muted mb-1"></i>
                                        <span class="fw-medium text-dark d-block" style="font-size: 0.75rem;">Account No.</span>
                                    </label>
                                </div>

                                <!-- Mode B: Phone Number Vector -->
                                <div class="col-4">
                                    <input type="radio" name="recoveryMethod" id="methodPhone" value="phone" class="d-none recovery-radio">
                                    <label for="methodPhone" class="recovery-chip text-center d-block h-100">
                                        <i class="bi bi-phone d-block fs-4 text-muted mb-1"></i>
                                        <span class="fw-medium text-dark d-block" style="font-size: 0.75rem;">Phone Line</span>
                                    </label>
                                </div>

                                <!-- Mode C: Email Vector -->
                                <div class="col-4">
                                    <input type="radio" name="recoveryMethod" id="methodEmail" value="email" class="d-none recovery-radio">
                                    <label for="methodEmail" class="recovery-chip text-center d-block h-100">
                                        <i class="bi bi-envelope d-block fs-4 text-muted mb-1"></i>
                                        <span class="fw-medium text-dark d-block" style="font-size: 0.75rem;">Email Address</span>
                                    </label>
                                </div>

                            </div>
                        </div>

                        <!-- Step 2: Adaptive Dynamic Target Input Area -->
                        <div class="mb-4">
                            <label id="inputFieldLabel" for="recoveryInput" class="form-label fw-semibold text-dark small mb-1">Enter Your Account Number</label>
                            <div class="input-group">
                                <span id="inputFieldIcon" class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-hash"></i></span>
                                <input type="text" id="recoveryInput" class="form-control form-control-lg border-start-0 fs-6 bg-light font-monospace" placeholder="e.g., 1023456789" required>
                                <div id="inputFieldFeedback" class="invalid-feedback">Please provide your matching 10-digit GFL or virtual account number identifier.</div>
                            </div>
                            <div id="fieldHelpHint" class="form-text text-muted" style="font-size: 0.72rem;">Accepts either your standard internal GFL identifier string or assigned virtual banking number.</div>
                        </div>

                        <!-- Action Controls Button Execution Grid -->
                        <div class="vstack gap-2">
                            <button type="submit" id="submitRecoveryButton" class="btn btn-success btn-lg w-100 rounded-pill py-3 fw-medium text-white shadow-sm d-flex align-items-center justify-content-center gap-2 btn-gfl-success">
                                <i class="bi bi-search"></i> Search Secure Ledger
                            </button>
                            
                            <a href="#" class="btn btn-link text-success text-decoration-none small fw-medium mt-2 py-1">
                                <i class="bi bi-arrow-left"></i> Return to Secure Log In
                            </a>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle Link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- ScrollReveal CDN Library -->
    <script src="https://unpkg.com/scrollreveal"></script>

    <!-- Custom State Modification Script Logic Engine -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            
            const radioMethods = document.querySelectorAll('input[name="recoveryMethod"]');
            const inputLabel = document.getElementById("inputFieldLabel");
            const inputIcon = document.getElementById("inputFieldIcon");
            const inputElement = document.getElementById("recoveryInput");
            const inputFeedback = document.getElementById("inputFieldFeedback");
            const helpHint = document.getElementById("fieldHelpHint");
            const form = document.getElementById("gflRecoveryForm");

            // Define configurations dictionary for each selector chip state dynamically
            const structuralStates = {
                account: {
                    label: "Enter Your Account Number",
                    iconClass: "bi-hash",
                    placeholder: "e.g., 1023456789",
                    feedback: "Please provide your matching 10-digit GFL or virtual account number identifier.",
                    hint: "Accepts either your standard internal GFL identifier string or assigned virtual banking number.",
                    filterRegex: /[^0-9]/g,
                    maxLength: "10"
                },
                phone: {
                    label: "Enter Your Registered Phone Number",
                    iconClass: "bi-phone",
                    placeholder: "e.g., 08012345678",
                    feedback: "Please provide the active 11-digit mobile lane linked to your profiles.",
                    hint: "An OTP profile authorization index key code will slide directly into this phone line terminal.",
                    filterRegex: /[^0-9]/g,
                    maxLength: "11"
                },
                email: {
                    label: "Enter Your Registered Email Address",
                    iconClass: "bi-envelope",
                    placeholder: "name@example.com",
                    feedback: "Please check your format string structure. A valid email coordinates mapping string is required.",
                    hint: "We'll dispatch a cryptographically randomized configuration pass link directly into this secure inbox.",
                    filterRegex: null,
                    maxLength: "100"
                }
            };

            // 1. Reactive State Observer Mutator Mapping Logic
            function applyIdentifierState(methodKey) {
                const config = structuralStates[methodKey];
                
                // Mutate texts and layout visually
                inputLabel.textContent = config.label;
                inputElement.setAttribute("placeholder", config.placeholder);
                inputElement.setAttribute("maxlength", config.maxLength);
                inputFeedback.textContent = config.feedback;
                helpHint.innerHTML = config.hint;
                
                // Set native HTML input types dynamically to trigger proper smartphone keyboards
                inputElement.setAttribute("type", methodKey === "email" ? "email" : "text");
                
                // Manage bootstrap icons classes transitions safely
                inputIcon.innerHTML = `<i class="bi ${config.iconClass}"></i>`;
                
                // Clear input string trace to eliminate cross-format values validation collisions
                inputElement.value = "";
                form.classList.remove("was-validated");
            }

            // Bind listeners inside the radio array items structure
            radioMethods.forEach(radio => {
                radio.addEventListener("change", function() {
                    if (this.checked) applyIdentifierState(this.value);
                });
            });

            // 2. Continuous Field Sanitization Stream Handling
            inputElement.addEventListener("input", function() {
                const selectedMethod = document.querySelector('input[name="recoveryMethod"]:checked').value;
                const activeConfig = structuralStates[selectedMethod];
                
                if (activeConfig.filterRegex) {
                    this.value = this.value.replace(activeConfig.filterRegex, '');
                }
            });

            // 3. Form Submission Validation and Parsing Pipeline Action 
            if (form) {
                form.addEventListener("submit", function (e) {
                    const currentMethod = document.querySelector('input[name="recoveryMethod"]:checked').value;
                    const val = inputElement.value.trim();
                    let isValid = true;

                    // Apply strict structural string evaluation criteria constraints
                    if (currentMethod === 'account' && val.length < 10) isValid = false;
                    if (currentMethod === 'phone' && val.length < 11) isValid = false;
                    if (!form.checkValidity()) isValid = false;

                    if (!isValid) {
                        e.preventDefault();
                        e.stopPropagation();
                        inputElement.setCustomValidity("Invalid matrix pattern execution parameters.");
                    } else {
                        inputElement.setCustomValidity("");
                        e.preventDefault(); // Stop reload for presentation tracking
                        
                        // Simulating Database Node Verification Loops
                        const submitBtn = document.getElementById("submitRecoveryButton");
                        submitBtn.disabled = true;
                        submitBtn.innerHTML = `<span class="spinner-border spinner-border-sm me-2"></span> Parsing Database Nodes...`;
                        
                        setTimeout(() => {
                            alert(`Account identity vector located smoothly! Verification dispatch keys have been pushed via secure pathways mapping to this verified profile lookup index.`);
                            submitBtn.disabled = false;
                            submitBtn.innerHTML = `<i class="bi bi-search"></i> Search Secure Ledger`;
                            form.reset();
                            applyIdentifierState('account'); // Reset back cleanly
                        }, 1500);
                    }
                    form.classList.add("was-validated");
                }, false);
            }

            // 4. Scroll Reveal Initialization Engine Layouts
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