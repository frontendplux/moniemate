<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <link rel="icon" href="<?= $company_info['logo'] ?>" type="image/x-icon">
    <title>GFL Gateway - Setup Secure Cooperative Node</title>
    
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
        html, body{
            height: 100%; width: 100%;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--gfl-whitesmoke);
        }
        .signup-vh {
            min-height: 100%;
        }
        .brand-panel {
            background: linear-gradient(135deg, rgba(20, 108, 67, 0.96), rgba(25, 135, 84, 0.92)), 
                        url('https://images.unsplash.com/photo-1563013544-824ae1d704d3?auto=format&fit=crop&w=1000&q=80') center/cover no-repeat;
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
        .bg-wallet-node {
            background: rgba(255, 255, 255, 0.08);
            border: 1px solid rgba(255, 255, 255, 0.15);
        }
    </style>
</head>
<body class="bg-light">

    <div class="container-fluid p-0">
        <div class="row g-0 signup-vh">
            
            <!-- Left Panel: Ecosystem Structural Breakdown (Visible on lg screens) -->
            <div class="col-lg-6 d-none d-lg-flex flex-column justify-content-between p-5 text-white brand-panel position-relative">
                
                <!-- Logo -->
                <div class="d-flex align-items-center">
                    <span class="bg-white rounded-3 d-flex align-items-center justify-content-center me-2 shadow" style="width: 40px; height: 40px;">
                        <i class="bi bi-wallet2 text-success fs-5"></i>
                    </span>
                    <span class="fs-3 fw-bold tracking-tight">GFL<span class="text-white opacity-50">.</span></span>
                </div>

                <!-- Core Information Content Blueprint -->
                <div class="my-auto" style="max-width: 520px;" data-reveal="fade-right">
                    <span class="badge bg-white bg-opacity-20 text-dark rounded-pill px-3 py-2 fw-medium mb-3">Onboarding Parameters</span>
                    <h1 class="display-6 fw-bold lh-sm mb-3">Create Your Unified Account Nodes</h1>
                    <p class="text-white-50 small mb-4">Provide accurate credentials. Upon verification, your profile partitions into 5 functional multi-wallets automatically.</p>
                    
                    <!-- Structural System Visualizer Cards inside Panel -->
                    <div class="vstack gap-2.5 mb-4">
                        <div class="d-flex align-items-center gap-3 p-3 rounded-4 bg-wallet-node mb-2">
                            <i class="bi bi-shield-fill-check text-warning fs-4"></i>
                            <div>
                                <h6 class="fw-bold mb-0 small">BVN Verification Match</h6>
                                <p class="m-0 text-white-50" style="font-size: 0.75rem;">Protects your ledger identity and secures automated payouts directly.</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3 p-3 rounded-4 bg-wallet-node mb-2">
                            <i class="bi bi-cash-stack text-white fs-4"></i>
                            <div>
                                <h6 class="fw-bold mb-0 small">₦6,000 Wallet Initialization Setup</h6>
                                <p class="m-0 text-white-50" style="font-size: 0.75rem;">Your wallet is instantly debited upon initial funding to activate account modules.</p>
                            </div>
                        </div>

                        <div class="d-flex align-items-center gap-3 p-3 rounded-4 bg-wallet-node">
                            <i class="bi bi-exclamation-triangle-fill text-warning fs-4"></i>
                            <div>
                                <h6 class="fw-bold mb-0 small">Mandatory System Parameters</h6>
                                <p class="m-0 text-white-50" style="font-size: 0.75rem;">Onboard at least 1 referral within 30 days to protect your continuous 30% savings ROI.</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Footer Text Inside Panel -->
                <div class="small opacity-50">
                    &copy; 2026 GFL Financial Platforms Inc. Certified Core Node Infrastructure.
                </div>
            </div>

            <!-- Right Panel: Secured Registration Form -->
            <div class="col-12 col-lg-6 d-flex align-items-center justify-content-center p-4 p-md-5 bg-white overflow-y-auto">
                <div class="w-100 mx-auto py-4" style="max-width: 480px;" data-reveal="fade-left">
                    
                    <!-- Mobile View Brand Header -->
                    <div class="d-flex align-items-center mb-4 d-lg-none">
                        <span class="bg-success rounded-3 d-flex align-items-center justify-content-center me-2 text-white" style="width: 36px; height: 36px;">
                            <i class="bi bi-wallet2 fs-6"></i>
                        </span>
                        <span class="fs-4 fw-bold text-dark">GFL<span class="text-success">.</span></span>
                    </div>

                    <!-- Welcome Header Texts -->
                    <div class="mb-4">
                        <h2 class="fw-bold text-dark mb-1">Open Your Cooperative Account</h2>
                        <p class="text-secondary small">Register your data parameters to get your 5 distinct system wallets assigned instantly.</p>
                    </div>

                    <!-- Main Secure SignUp Form -->
                    <form id="gflSignUpForm" class="needs-validation">
                        
                        <!-- Row 1: Full Names -->
                         <div class="d-flex gap-2">
                            <div class="mb-3 w-100">
                                <label for="firstName" class="form-label fw-medium text-dark small">First Name</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-person"></i></span>
                                    <input type="text" id="firstName" class="form-control form-control-lg border-start-0 fs-6 bg-light" placeholder="firstname" required>
                                    <div class="invalid-feedback">Please input your matching compliance fullname.</div>
                                </div>
                            </div>
                            <div class="mb-3 w-100">
                                <label for="lastName" class="form-label fw-medium text-dark small">Last Name</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-person"></i></span>
                                    <input type="text" id="lastName" class="form-control form-control-lg border-start-0 fs-6 bg-light" placeholder="lastname" required>
                                    <div class="invalid-feedback">Please input your matching compliance fullname.</div>
                                </div>
                            </div>
                         </div>

                        <!-- Row 2: Email Configuration -->
                        <div class="mb-3">
                            <label for="regEmail" class="form-label fw-medium text-dark small">Email Address</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-envelope"></i></span>
                                <input type="email" id="regEmail" class="form-control form-control-lg border-start-0 fs-6 bg-light" placeholder="name@example.com" required>
                                <div class="invalid-feedback">A valid communication email coordinate is mandatory.</div>
                            </div>
                        </div>


                        <!-- Row 5: Create Account Passkey Password -->
                        <div class="mb-4">
                            <label for="regPassword" class="form-label fw-medium text-dark small">Create Password</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-key"></i></span>
                                <input type="password" id="regPassword" class="form-control form-control-lg border-start-0 fs-6 bg-light" placeholder="Minimum 8 characters" minlength="8" required>
                                <button class="input-group-text bg-light text-muted border-start-0" type="button" id="toggleRegPassword">
                                    <i class="bi bi-eye" id="toggleRegIcon"></i>
                                </button>
                                <div class="invalid-feedback">Your secure entry code must map to at least 8 character strings.</div>
                            </div>
                        </div>

                        <!-- Operational Parameters Agreements Checkboxes -->
                        <div class="form-check mb-4 d-flex align-items-start">
                            <input class="form-check-input mt-1 border-secondary-subtle" type="checkbox" id="termsCheck" required>
                            <label class="form-check-label text-secondary small ms-2" for="termsCheck">
                                I verify my inputs and authorize the standard <strong>₦6,000 instant wallet setup deduction</strong> upon first ledger funding, along with Saturday tracking parameters.
                            </label>
                        </div>

                        <!-- Submit Registration Button -->
                        <button id="btnsubmit" type="submit" class="btn btn-success btn-lg w-100 rounded-pill py-3 fw-medium text-white shadow-sm d-flex align-items-center justify-content-center gap-2 btn-gfl-success">
                            <i class="bi bi-person-plus-fill"></i> Initialize My Account
                        </button>
                    </form>

                    <!-- Bottom Navigations Pathways Redirection -->
                    <div class="text-center mt-4 pt-2 border-top border-light-subtle">
                        <p class="text-secondary small mb-0">
                            Already registered inside the ledger network? <a href="/login" class="text-success text-decoration-none fw-semibold">Sign In Securely</a>
                        </p>
                    </div>

                </div>
            </div>

        </div>
    </div>

<!-- Bootstrap 5 JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- ScrollReveal CDN -->
<script src="https://unpkg.com/scrollreveal"></script>

<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<script>
document.addEventListener("DOMContentLoaded", () => {

    // Get referral code from URL
    const urlParams = new URLSearchParams(window.location.search);
    const referral = (urlParams.get("ref") || "").trim();

    // Password Toggle
    const toggleBtn = document.getElementById("toggleRegPassword");
    const passField = document.getElementById("regPassword");
    const toggleIcon = document.getElementById("toggleRegIcon");

    if (toggleBtn && passField && toggleIcon) {
        toggleBtn.addEventListener("click", () => {
            if (passField.type === "password") {
                passField.type = "text";
                toggleIcon.classList.replace("bi-eye", "bi-eye-slash");
            } else {
                passField.type = "password";
                toggleIcon.classList.replace("bi-eye-slash", "bi-eye");
            }
        });
    }

    // ScrollReveal
    if (typeof ScrollReveal !== "undefined") {
        ScrollReveal().reveal("[data-reveal]", {
            distance: "40px",
            duration: 800,
            interval: 150,
            origin: "bottom"
        });
    }

    const form = document.getElementById("gflSignUpForm");
    if (!form) return;

    const btnSubmit = document.getElementById("btnsubmit");
    const defaultButton =
        "<i class='bi bi-person-plus-fill'></i> Initialize My Account";

    function resetButton() {
        btnSubmit.disabled = false;
        btnSubmit.innerHTML = defaultButton;
    }

    form.addEventListener("submit", async (e) => {

        e.preventDefault();

        form.classList.add("was-validated");

        if (!form.checkValidity()) {
            return;
        }

        const firstName = document.getElementById("firstName").value.trim();
        const lastName = document.getElementById("lastName").value.trim();
        const email = document.getElementById("regEmail").value.trim();
        const password = document.getElementById("regPassword").value;
        const terms = document.getElementById("termsCheck").checked;

        btnSubmit.disabled = true;
        btnSubmit.innerHTML =
            "<span class='spinner-border spinner-border-sm me-2'></span>Processing...";

        const nameRegex = /^[A-Za-z\s]{2,50}$/;
        const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;

        if (!nameRegex.test(firstName)) {
            resetButton();
            return Swal.fire("Invalid First Name", "Enter a valid first name.", "error");
        }

        if (!nameRegex.test(lastName)) {
            resetButton();
            return Swal.fire("Invalid Last Name", "Enter a valid last name.", "error");
        }

        if (!emailRegex.test(email)) {
            resetButton();
            return Swal.fire("Invalid Email", "Enter a valid email address.", "error");
        }

        if (password.length < 8) {
            resetButton();
            return Swal.fire("Weak Password", "Password must be at least 8 characters.", "error");
        }

        if (!/[A-Z]/.test(password)) {
            resetButton();
            return Swal.fire("Weak Password", "Password must contain at least one uppercase letter.", "error");
        }

        if (!/[a-z]/.test(password)) {
            resetButton();
            return Swal.fire("Weak Password", "Password must contain at least one lowercase letter.", "error");
        }

        if (!/[0-9]/.test(password)) {
            resetButton();
            return Swal.fire("Weak Password", "Password must contain at least one number.", "error");
        }

        if (!terms) {
            resetButton();
            return Swal.fire("Agreement Required", "You must accept the terms.", "error");
        }

        try {

            Swal.fire({
                title: "Creating Account...",
                text: "Please wait...",
                allowOutsideClick: false,
                allowEscapeKey: false,
                showConfirmButton: false,
                didOpen: () => Swal.showLoading()
            });

            const response = await fetch("<?= $company_info['server'] ?>", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json"
                },
                body: JSON.stringify({
                    action: "/auth/register",
                    firstName,
                    lastName,
                    email,
                    password,
                    ref: referral
                })
            });

            if (!response.ok) {
                throw new Error("Server returned " + response.status);
            }

            const res = await response.json();

            Swal.close();

            if (res.success) {

                await Swal.fire({
                    icon: "success",
                    title: "Registration Successful",
                    text: res.message,
                    timer: 1800,
                    showConfirmButton: false
                });

                if (res.data?.redirect) {
                    const emailParam = res.data.email
                        ? "?u=" + encodeURIComponent(res.data.email)
                        : "";

                    window.location.href = res.data.redirect + emailParam;
                }

            } else {

                resetButton();

                Swal.fire({
                    icon: "error",
                    title: "Registration Failed",
                    text: res.message || "Unable to register."
                });

            }

        } catch (err) {

            Swal.close();
            resetButton();

            console.error(err);

            Swal.fire({
                icon: "error",
                title: "Connection Error",
                text: err.message || "Unable to connect to the server."
            });

        }

    });

});
</script>


</body>
</html>