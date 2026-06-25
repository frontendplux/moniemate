<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GFL Security Center - BVN Verification Identity Hub</title>
    
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
        .form-control:focus {
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
        .btn-gfl-outline {
            border: 2px solid #ddd;
            color: #666;
            transition: all 0.25s ease;
        }
        .btn-gfl-outline:hover {
            background-color: #fff;
            border-color: #333;
            color: #111;
        }
        .feature-card {
            background-color: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 16px;
            transition: transform 0.2s ease;
        }
        .feature-card.disabled-tier {
            background-color: rgba(248, 249, 250, 0.7);
            border-style: dashed;
        }
    </style>
</head>
<body class="bg-light">

    <div class="container py-5">
        <div class="row justify-content-center align-items-center panel-vh">
            <div class="col-12 col-md-10 col-lg-7" data-reveal="fade-up">
                
                <!-- Card Container Wrapper -->
                <div class="bg-white p-4 p-sm-5 rounded-5 shadow-sm border border-light-subtle">
                    
                    <!-- Progress Bar Header Indicator -->
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <div class="d-flex align-items-center">
                            <span class="bg-success rounded-3 d-flex align-items-center justify-content-center me-2 text-white" style="width: 32px; height: 32px;">
                                <i class="bi bi-shield-lock-fill fs-6"></i>
                            </span>
                            <span class="fw-bold text-dark fs-5">Security Setup</span>
                        </div>
                        <span class="badge bg-success-subtle text-success rounded-pill px-3 py-1.5 small fw-semibold">Step 2 of 2</span>
                    </div>

                    <!-- Informational Section Header -->
                    <div class="mb-4">
                        <h2 class="fw-bold text-dark mb-2">Verify Your Banking Identity</h2>
                        <p class="text-secondary small">Choose how you want your settlement parameters configured. Verifying your BVN opens full virtual commercial banking channels instantly.</p>
                    </div>

                    <!-- Comparison Framework Modules Options -->
                    <div class="row g-3 mb-4">
                        <!-- Path A: Fully Verified Dynamic Virtual Account Pathway -->
                        <div class="col-sm-6">
                            <div class="p-3 feature-card border-success border-2 h-100">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="badge bg-success text-white rounded-pill px-2 py-0.5" style="font-size: 0.65rem;">Recommended</span>
                                    <i class="bi bi-check-circle-fill text-success fs-5"></i>
                                </div>
                                <h6 class="fw-bold text-dark mb-1">Full Virtual Bank Account</h6>
                                <p class="text-muted m-0 p-0" style="font-size: 0.75rem;">Get a dedicated, dynamic commercial account number allocated to your name. Receive fast external direct bank transfers straight into your GFL wallets.</p>
                            </div>
                        </div>

                        <!-- Path B: Non-Verified Basic GFL Internal Ledger Channel -->
                        <div class="col-sm-6">
                            <div class="p-3 feature-card disabled-tier h-100">
                                <div class="d-flex align-items-center justify-content-between mb-2">
                                    <span class="badge bg-secondary-subtle text-secondary rounded-pill px-2 py-0.5" style="font-size: 0.65rem;">Skipped Tier</span>
                                    <i class="bi bi-exclamation-circle text-muted fs-5"></i>
                                </div>
                                <h6 class="fw-bold text-muted mb-1">GFL Internal Account Only</h6>
                                <p class="text-muted m-0 p-0" style="font-size: 0.75rem;">Skips dynamic commercial routing. You receive only a standard internal GFL profile identifier code. Wallet funding must be tracked manually.</p>
                            </div>
                        </div>
                    </div>

                    <!-- Dynamic Identity Form Module Wrapper -->
                    <form id="gflBvnVerificationForm" class="needs-validation" novalidate>
                        
                        <!-- Input String Parameter Block -->
                        <div class="mb-4">
                            <label for="bvnString" class="form-label fw-semibold text-dark small mb-1">Enter 11-Digit Bank Verification Number (BVN)</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light text-muted border-end-0"><i class="bi bi-hash"></i></span>
                                <input type="text" id="bvnString" class="form-control form-control-lg border-start-0 fs-6 bg-light font-monospace" placeholder="22345678901" maxlength="11" required>
                                <div class="invalid-feedback">An active, valid 11-digit BVN configuration string is needed to allocate a virtual account number.</div>
                            </div>
                            <!-- Security Privacy Guarantee Disclaimer -->
                            <div class="mt-2 p-2.5 bg-success-subtle bg-opacity-25 rounded-3 d-flex gap-2 align-items-start">
                                <i class="bi bi-patch-check-fill text-success fs-6 mt-0.5"></i>
                                <span class="text-muted" style="font-size: 0.7rem; line-height: 1.3;">GFL processes verification tokens through secure centralized channels. We do not have visual access to your primary banking assets or personal history markers.</span>
                            </div>
                        </div>

                        <!-- Stacked Action Control Blocks -->
                        <div class="vstack gap-2.5">
                            <!-- Primary Call to Action Option -->
                            <button type="submit" class="btn btn-success btn-lg w-100 rounded-pill py-3 fw-medium text-white shadow-sm d-flex align-items-center justify-content-center gap-2 btn-gfl-success">
                                <i class="bi bi-shield-check"></i> Verify Identity & Link Virtual Account
                            </button>

                            <!-- Bypassing Skip Control Path Trigger -->
                            <button type="button" id="skipBvnButton" class="btn btn-gfl-outline btn-lg w-100 rounded-pill py-3 fw-medium d-flex align-items-center justify-content-center gap-2">
                                Skip Verification, Give Me Internal GFL Account <i class="bi bi-arrow-right-short fs-4"></i>
                            </button>
                        </div>

                    </form>

                    <!-- Bottom Help Guidelines Desk Navigation -->
                    <p class="text-center text-secondary small mt-4 mb-0 pt-3 border-top border-light-subtle">
                        Unsure about our data parameters? <a href="#" class="text-success text-decoration-none fw-medium">Read Privacy Covenant</a> or <a href="#" class="text-success text-decoration-none fw-medium">Contact Support Desk</a>
                    </p>

                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap 5 JS Bundle Link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- ScrollReveal Hook Scripts -->
    <script src="https://unpkg.com/scrollreveal"></script>

    <!-- Custom Functional Interactions Management Script Logic -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            
            const bvnForm = document.getElementById("gflBvnVerificationForm");
            const bvnInput = document.getElementById("bvnString");
            const skipButton = document.getElementById("skipBvnButton");

            // 1. Force Pure Digit Formatting Configuration
            if (bvnInput) {
                bvnInput.addEventListener("input", function() {
                    this.value = this.value.replace(/[^0-9]/g, ''); // Instantly drop characters that aren't strings
                });
            }

            // 2. Form Verification Execution Handler
            if (bvnForm) {
                bvnForm.addEventListener("submit", function (e) {
                    if (!bvnForm.checkValidity() || bvnInput.value.length !== 11) {
                        e.preventDefault();
                        e.stopPropagation();
                        bvnInput.setCustomValidity("Invalid configuration length.");
                    } else {
                        bvnInput.setCustomValidity("");
                        // Hook your dynamic banking processor routing here
                        alert("Identity data matches cleanly! Creating secure multi-wallets and linking dynamic settlement virtual account codes.");
                    }
                    bvnForm.classList.add("was-validated");
                });
            }

            // 3. Skip Button Execution Handler (Bypasses verification variables completely)
            if (skipButton) {
                skipButton.addEventListener("click", function () {
                    const confirmSkip = confirm("Are you sure you want to skip? You will NOT get a dynamic virtual banking account number for direct funding. You will only receive a generic internal GFL Cooperative wallet track id.");
                    if (confirmSkip) {
                        // Route them directly to internal dashboard modules
                        alert("Routing setup sequence completed. Allocating basic internal GFL Account node string.");
                        window.location.href = "#"; // Replace with path endpoint
                    }
                });
            }

            // 4. Scroll Reveal Engine Setup 
            if (typeof ScrollReveal !== 'undefined') {
                ScrollReveal().reveal('[data-reveal="fade-up"]', {
                    origin: 'bottom',
                    distance: '40px',
                    duration: 900,
                    easing: 'ease-out'
                });
            }

        });
    </script>
</body>
</html>