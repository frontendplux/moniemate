<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=no">
    <title>GFL Member Portal - Unified Finance Hub</title>
    
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
            --gfl-green-dark: #11623c;
            --gfl-green-light: #e8f5e9;
            --gfl-whitesmoke: #f3f7f4;
            --opay-gray: #f8f9fa;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--gfl-whitesmoke);
            padding-bottom: 80px; /* Safe clearing space for OPay-style sticky bottom navigation menu */
        }
        /* OPay Style Floating Combined Main Wallet Balance Card Banner */
        .opay-wallet-card {
            background: linear-gradient(135deg, var(--gfl-green) 0%, var(--gfl-green-dark) 100%);
            border-radius: 24px;
            color: #ffffff;
            box-shadow: 0 8px 24px rgba(25, 135, 84, 0.15);
            position: relative;
            overflow: hidden;
        }
        .opay-wallet-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 250px;
            height: 250px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            pointer-events: none;
        }
        /* Quick Services Grid Grid Squares */
        .service-btn-box {
            background-color: #ffffff;
            border-radius: 16px;
            transition: transform 0.15s ease, box-shadow 0.15s ease;
            cursor: pointer;
            border: 1px solid rgba(0,0,0,0.02);
        }
        .service-btn-box:active {
            transform: scale(0.96);
            background-color: var(--opay-gray);
        }
        .icon-circle-wrapper {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            margin: 0 auto 8px;
        }
        /* Sticky Mobile OPay Base Menu Bars Elements */
        .opay-bottom-nav {
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #ffffff;
            box-shadow: 0 -4px 16px rgba(0, 0, 0, 0.06);
            z-index: 1030;
            border-top: 1px solid #eaeaea;
        }
        .nav-item-link {
            color: #8e949a;
            font-size: 0.72rem;
            font-weight: 500;
            text-decoration: none;
            display: flex;
            flex-column: uppercase;
            flex-direction: column;
            align-items: center;
            padding: 8px 0;
            transition: color 0.2s ease;
        }
        .nav-item-link.active-node {
            color: var(--gfl-green) !important;
        }
        .nav-item-link i {
            font-size: 1.35rem;
            margin-bottom: 2px;
        }
    </style>
</head>
<body>

    <!-- 1. Platform Top Profile Sticky Header -->
    <header class="bg-white sticky-top py-2.5 px-3 border-bottom shadow-sm">
        <div class="container max-width-lg d-flex align-items-center justify-content-between">
            <div class="d-flex align-items-center gap-2.5">
                <!-- User Avatars Identity Circle -->
                <div class="position-relative">
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=120&q=80" alt="Profile" class="rounded-circle border border-2 border-success shadow-sm" style="width: 42px; height: 42px; object-fit: cover;">
                    <span class="position-absolute bottom-0 end-0 bg-success border border-white border-2 rounded-circle" style="width: 12px; height: 12px;"></span>
                </div>
                <div>
                    <div class="d-flex align-items-center gap-1">
                        <span class="fw-bold text-dark small">Hi, Chioma</span>
                        <span class="badge bg-success bg-opacity-10 text-success rounded-pill fw-bold font-monospace" style="font-size: 0.65rem;">KYC TIER 2</span>
                    </div>
                    <span class="text-muted d-block font-monospace" style="font-size: 0.72rem;">GFL ID: 1045920381</span>
                </div>
            </div>
            
            <!-- Quick Tools: Customer Desk Support Hook & Dynamic Alerts Icons -->
            <div class="d-flex align-items-center gap-2">
                <a href="#" class="btn btn-light rounded-circle p-2 line-height-1 position-relative" style="width: 38px; height: 38px;"><i class="bi bi-bell text-dark"></i><span class="position-absolute top-1 start-75 translate-middle p-1 bg-danger border border-white rounded-circle"></span></a>
                <a href="#" class="btn btn-light rounded-circle p-2 line-height-1" style="width: 38px; height: 38px;"><i class="bi bi-headset text-dark"></i></a>
            </div>
        </div>
    </header>

    <main class="container max-width-lg mt-3 px-3">
        
        <!-- 2. Main Balance Matrix Panel Module Box (OPay Canvas Blueprint) -->
        <div class="opay-wallet-card p-4 mb-4">
            <div class="d-flex align-items-center justify-content-between mb-1.5 text-white text-opacity-80 small">
                <span class="d-flex align-items-center gap-1.5">
                    <i class="bi bi-shield-lock-fill text-warning"></i> Available Ledger Multi-Wallet Balance
                    <button class="btn btn-link p-0 text-white line-height-1 opacity-75" type="button" id="toggleBalanceVisibility">
                        <i class="bi bi-eye-fill" id="eyeIcon"></i>
                    </button>
                </span>
                <span class="small font-monospace text-warning"><i class="bi bi-arrow-repeat"></i> Auto-Sync Active</span>
            </div>
            
            <!-- Absolute Balance Text -->
            <div class="mb-3">
                <h1 class="display-6 fw-bold m-0 tracking-tight font-monospace" id="walletBalanceString">₦142,550<span class="fs-4 fw-normal">.75</span></h1>
            </div>

            <!-- Fast Action Access Gate Buttons Row Mapping -->
            <div class="row g-2 pt-2 border-top border-white border-opacity-10">
                <div class="col-6">
                    <button class="btn btn-white w-100 rounded-pill py-2.5 fw-semibold text-success bg-white d-flex align-items-center justify-content-center gap-2 border-0 shadow-sm" style="font-size: 0.85rem;">
                        <i class="bi bi-plus-circle-fill text-success"></i> Add Money
                    </button>
                </div>
                <div class="col-6">
                    <button class="btn btn-success border border-white border-opacity-20 w-100 rounded-pill py-2.5 fw-semibold text-white d-flex align-items-center justify-content-center gap-2 shadow-sm" style="font-size: 0.85rem; background: rgba(255,255,255,0.12);">
                        <i class="bi bi-send-fill text-white"></i> Transfer Fund
                    </button>
                </div>
            </div>
        </div>

        <!-- 3. Critical Compliance Push Warning Banner (Rule Reminder Tracker Element) -->
        <div class="p-3 bg-danger bg-opacity-10 border border-danger-subtle rounded-4 d-flex align-items-start gap-2.5 mb-4 shadow-sm">
            <i class="bi bi-exclamation-octagon-fill text-danger fs-5 mt-0.5 animate-pulse"></i>
            <div>
                <h6 class="fw-bold text-danger small mb-0.5">Saturday Multi-Slot Deadline Warning</h6>
                <p class="text-secondary p-0 m-0" style="font-size: 0.75rem; line-height: 1.4;">
                    Your <strong>₦300 Premium Food Matrix Slot</strong> must receive a deposit before Saturday midnight. Unfunded slots automatically prompt dynamic system penalty tracking.
                </p>
            </div>
        </div>

        <!-- 4. Quick Financial Utilities Services Grid Matrix (4-Column Layout exactly like OPay) -->
        <div class="mb-4">
            <h6 class="fw-bold text-dark mb-3 px-1 text-uppercase tracking-wider small">Ecosystem Utilities</h6>
            <div class="row g-2 text-center">
                
                <!-- Box 1 -->
                <div class="col-3">
                    <div class="p-3 service-btn-box shadow-xs">
                        <div class="icon-circle-wrapper bg-success bg-opacity-10 text-success"><i class="bi bi-bank"></i></div>
                        <span class="d-block text-dark fw-medium tracking-tight" style="font-size: 0.72rem;">To Bank</span>
                    </div>
                </div>

                <!-- Box 2 -->
                <div class="col-3">
                    <div class="p-3 service-btn-box shadow-xs">
                        <div class="icon-circle-wrapper bg-success bg-opacity-10 text-success"><i class="bi bi-phone-vibrate"></i></div>
                        <span class="d-block text-dark fw-medium tracking-tight" style="font-size: 0.72rem;">Airtime</span>
                    </div>
                </div>

                <!-- Box 3 -->
                <div class="col-3">
                    <div class="p-3 service-btn-box shadow-xs">
                        <div class="icon-circle-wrapper bg-success bg-opacity-10 text-success"><i class="bi bi-lightning-charge"></i></div>
                        <span class="d-block text-dark fw-medium tracking-tight" style="font-size: 0.72rem;">Electricity</span>
                    </div>
                </div>

                <!-- Box 4 -->
                <div class="col-3">
                    <div class="p-3 service-btn-box shadow-xs">
                        <div class="icon-circle-wrapper bg-success bg-opacity-10 text-success"><i class="bi bi-egg-fried"></i></div>
                        <span class="d-block text-dark fw-medium tracking-tight" style="font-size: 0.72rem;">Food Slot</span>
                    </div>
                </div>

                <!-- Box 5 -->
                <div class="col-3">
                    <div class="p-3 service-btn-box shadow-xs">
                        <div class="icon-circle-wrapper bg-success bg-opacity-10 text-success"><i class="bi bi-cash-coin"></i></div>
                        <span class="d-block text-dark fw-medium tracking-tight" style="font-size: 0.72rem;">Micro Loan</span>
                    </div>
                </div>

                <!-- Box 6 -->
                <div class="col-3">
                    <div class="p-3 service-btn-box shadow-xs">
                        <div class="icon-circle-wrapper bg-success bg-opacity-10 text-success"><i class="bi bi-trophy"></i></div>
                        <span class="d-block text-dark fw-medium tracking-tight" style="font-size: 0.72rem;">Referrals</span>
                    </div>
                </div>

                <!-- Box 7 -->
                <div class="col-3">
                    <div class="p-3 service-btn-box shadow-xs">
                        <div class="icon-circle-wrapper bg-success bg-opacity-10 text-success"><i class="bi bi-safe"></i></div>
                        <span class="d-block text-dark fw-medium tracking-tight" style="font-size: 0.72rem;">50-Wks Save</span>
                    </div>
                </div>

                <!-- Box 8 -->
                <div class="col-3">
                    <div class="p-3 service-btn-box shadow-xs">
                        <div class="icon-circle-wrapper bg-success bg-opacity-10 text-success"><i class="bi bi-grid-fill"></i></div>
                        <span class="d-block text-dark fw-medium tracking-tight" style="font-size: 0.72rem;">More</span>
                    </div>
                </div>

            </div>
        </div>

        <!-- 5. Real-Time Transaction Activity Feed Ledger Ledger -->
        <div class="bg-white rounded-4 p-3.5 shadow-sm border border-light-subtle mb-4">
            <div class="d-flex align-items-center justify-content-between mb-3 border-bottom pb-2">
                <h6 class="fw-bold text-dark m-0 small"><i class="bi bi-clock-history me-1 text-success"></i> Recent Activity Ticker</h6>
                <a href="#" class="text-success text-decoration-none small fw-semibold" style="font-size: 0.75rem;">View History</a>
            </div>

            <!-- List Nodes Vertical Elements Stack -->
            <div class="vstack gap-3" id="transactionListWrapper">
                
                <!-- Entry Row item 1 -->
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2.5">
                        <div class="bg-light rounded-circle p-2 text-center text-success" style="width: 38px; height: 38px;"><i class="bi bi-arrow-down-left-circle-fill"></i></div>
                        <div>
                            <span class="d-block fw-bold text-dark small">Wallet Inflow Settlement</span>
                            <span class="text-muted d-block" style="font-size: 0.68rem;">Today, 02:45 PM • Via Wema Virtual</span>
                        </div>
                    </div>
                    <span class="fw-bold font-monospace text-success small">+₦25,000.00</span>
                </div>

                <!-- Entry Row item 2 -->
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2.5">
                        <div class="bg-light rounded-circle p-2 text-center text-danger" style="width: 38px; height: 38px;"><i class="bi bi-arrow-up-right-circle-fill"></i></div>
                        <div>
                            <span class="d-block fw-bold text-dark small">₦300 Premium Food Slot Contribution</span>
                            <span class="text-muted d-block" style="font-size: 0.68rem;">Yesterday, 09:12 PM • Auto-Debit</span>
                        </div>
                    </div>
                    <span class="fw-bold font-monospace text-dark small">-₦2,100.00</span>
                </div>

                <!-- Entry Row item 3 -->
                <div class="d-flex align-items-center justify-content-between">
                    <div class="d-flex align-items-center gap-2.5">
                        <div class="bg-light rounded-circle p-2 text-center text-success" style="width: 38px; height: 38px;"><i class="bi bi-gift-fill text-warning"></i></div>
                        <div>
                            <span class="d-block fw-bold text-dark small">Referral Bonus Credit</span>
                            <span class="text-muted d-block" style="font-size: 0.68rem;">18 Jun 2026 • Node ID 9201</span>
                        </div>
                    </div>
                    <span class="fw-bold font-monospace text-success small">+₦1,500.00</span>
                </div>

            </div>
        </div>

    </main>

    <!-- 6. OPay Sticky Fixed Base Navigation Footer Anchors Grid -->
    <nav class="opay-bottom-nav">
        <div class="container max-width-lg">
            <div class="row text-center g-0">
                
                <div class="col-3">
                    <a href="#" class="nav-item-link active-node">
                        <i class="bi bi-house-door-fill"></i>
                        <span>Home</span>
                    </a>
                </div>

                <div class="col-3">
                    <a href="#" class="nav-item-link">
                        <i class="bi bi-safe2"></i>
                        <span>Savings</span>
                    </a>
                </div>

                <div class="col-3">
                    <a href="#" class="nav-item-link">
                        <i class="bi bi-cash-stack"></i>
                        <span>Loans</span>
                    </a>
                </div>

                <div class="col-3">
                    <a href="#" class="nav-item-link">
                        <i class="bi bi-person-circle"></i>
                        <span>Me</span>
                    </a>
                </div>

            </div>
        </div>
    </nav>

    <!-- Bootstrap 5 JS Bundle Link Wrapper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Client-Side Balance Masking Toggle Automation Logic Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            
            const toggleBalanceBtn = document.getElementById("toggleBalanceVisibility");
            const balanceDisplay = document.getElementById("walletBalanceString");
            const eyeIcon = document.getElementById("eyeIcon");

            let isBalanceMasked = false;
            const originalBalanceHTML = `₦142,550<span class="fs-4 fw-normal">.75</span>`;
            const maskedBalanceHTML = `••••••`;

            if (toggleBalanceBtn && balanceDisplay) {
                toggleBalanceBtn.addEventListener("click", function () {
                    isBalanceMasked = !isBalanceMasked;
                    
                    if (isBalanceMasked) {
                        balanceDisplay.innerHTML = maskedBalanceHTML;
                        eyeIcon.classList.replace("bi-eye-fill", "bi-eye-slash-fill");
                    } else {
                        balanceDisplay.innerHTML = originalBalanceHTML;
                        eyeIcon.classList.replace("bi-eye-slash-fill", "bi-eye-fill");
                    }
                });
            }

            // Quick interaction logging mock simulation for utility buttons 
            const boxes = document.querySelectorAll('.service-btn-box');
            boxes.forEach(box => {
                box.addEventListener('click', function() {
                    const featureName = this.querySelector('span').textContent;
                    console.log(`Navigating to target utility model endpoint: ${featureName}`);
                });
            });

        });
    </script>
</body>
</html>