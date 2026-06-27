<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1">
    <title>GFL Member Node Portal - Unified Multi-Wallet Ledger</title>
        
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
            --gfl-green-light: rgba(25, 135, 84, 0.08);
            --gfl-whitesmoke: #f4f6f8;
            --opay-card-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
            --header-height: 70px;
            --sidebar-width: 260px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--gfl-whitesmoke);
            color: #333333;
            overflow-x: hidden;
        }

        /* --- OPay Inspired Sticky Header Layout --- */
        .gfl-dashboard-header {
            height: var(--header-height);
            background-color: #ffffff;
            border-bottom: 1px solid #e9ecef;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
        }

        /* --- Main Dual Layout Container Structure --- */
        .gfl-dashboard-wrapper {
            margin-top: var(--header-height);
            min-height: calc(100vh - var(--header-height));
            display: flex;
        }

        /* --- Desktop Sidebar Fixed Left Pane (Aside) --- */
        .gfl-sidebar-pane {
            width: var(--sidebar-width);
            background-color: #ffffff;
            border-right: 1px solid #e9ecef;
            position: fixed;
            top: var(--header-height);
            bottom: 0;
            left: 0;
            z-index: 1020;
            padding: 1.5rem 1rem;
            overflow-y: auto;
            transition: all 0.3s ease;
        }

        /* --- Sidebar Navigation Link System --- */
        .nav-link-node {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: #5c677d;
            font-weight: 500;
            font-size: 0.9rem;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.2s ease;
            margin-bottom: 4px;
        }
        .nav-link-node:hover {
            background-color: #f8f9fa;
            color: var(--gfl-green);
        }
        .nav-link-node.active-node {
            background-color: var(--gfl-green-light);
            color: var(--gfl-green);
            font-weight: 600;
        }

        /* --- Primary Scrollable Main Canvas Content --- */
        .gfl-main-canvas {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 2rem;
            background-color: var(--gfl-whitesmoke);
            transition: all 0.3s ease;
        }

        /* --- Custom OPay Accent Dashboard Components --- */
        .opay-wallet-mastercard {
            background: linear-gradient(135deg, #146c43, #198754);
            border-radius: 24px;
            color: #ffffff;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 30px rgba(25, 135, 84, 0.2);
        }
        .opay-mini-wallet {
            background-color: #ffffff;
            border-radius: 18px;
            border: 1px solid #e9ecef;
            box-shadow: var(--opay-card-shadow);
            transition: transform 0.2s ease;
        }
        .opay-mini-wallet:hover {
            transform: translateY(-2px);
        }
        .action-circle-btn {
            width: 48px;
            height: 48px;
            background-color: var(--gfl-green-light);
            color: var(--gfl-green);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.25rem;
            margin: 0 auto 8px;
            transition: all 0.2s ease;
            border: none;
        }
        .action-circle-btn:hover {
            background-color: var(--gfl-green);
            color: #ffffff;
        }

        /* --- RESPONSIVE MEDIA QUERIES (OPay Style Mobile Adaption) --- */
        @media (max-width: 991.98px) {
            .gfl-sidebar-pane {
                width: 100%;
                height: auto;
                position: fixed;
                top: var(--header-height);
                left: 0;
                right: 0;
                bottom: auto;
                border-right: none;
                border-bottom: 1px solid #e9ecef;
                padding: 0.5rem 1rem;
                display: flex;
                flex-direction: row;
                gap: 8px;
                overflow-x: auto;
                white-space: nowrap;
                scroll-behavior: smooth;
            }
            .gfl-sidebar-pane::-webkit-scrollbar {
                display: none; /* Hide scroll track visual clutter */
            }
            .nav-link-node {
                margin-bottom: 0;
                padding: 8px 16px;
                display: inline-flex;
            }
            .gfl-main-canvas {
                margin-left: 0;
                margin-top: 50px; /* Offset the horizontal mobile sub-navigation row */
                padding: 1.25rem;
            }
        }
    </style>
</head>
<body>

    <!-- 1. STICKY TOP HEADER NAV -->
    <header class="gfl-dashboard-header d-flex align-items-center px-3 px-lg-4 shadow-sm">
        <div class="container-fluid d-flex align-items-center justify-content-between p-0">
            
            <!-- Brand Mark -->
            <a class="navbar-brand d-flex align-items-center text-decoration-none" href="#">
                <span class="bg-success rounded-3 d-flex align-items-center justify-content-center me-2 text-white" style="width: 36px; height: 36px;">
                    <i class="bi bi-wallet2 fs-6"></i>
                </span>
                <span class="fs-4 fw-bold text-dark">GFL<span class="text-success">.</span></span>
            </a>

            <!-- Right Profile Context Area -->
            <div class="d-flex align-items-center gap-3">
                
                <!-- Mandatory System Notification Bell -->
                <button class="btn btn-light position-relative rounded-circle p-2 line-height-1">
                    <i class="bi bi-bell text-secondary fs-5"></i>
                    <span class="position-absolute top-2 start-75 translate-middle p-1 bg-danger border border-light rounded-circle"></span>
                </button>
                
                <!-- Separator Line Split -->
                <div class="vr h-100 bg-secondary opacity-20 d-none d-sm-block" style="height: 24px !important;"></div>

                <!-- Verified Account Badge Data Container -->
                <div class="d-flex align-items-center gap-2">
                    <div class="text-end d-none d-sm-block">
                        <span class="fw-bold text-dark d-block small">Samuel Adebayo</span>
                        <span class="text-muted d-block font-monospace" style="font-size: 0.72rem;">GFL-10492850</span>
                    </div>
                    <!-- Mock Avatar Icon Sphere -->
                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center fw-bold text-uppercase shadow-sm" style="width: 40px; height: 40px; font-size: 0.9rem;">
                        SA
                    </div>
                </div>

            </div>
        </div>
    </header>

    <!-- 2. SPLIT INTERACTIVE FLEX PANES CONTAINER WRAPPER -->
    <div class="gfl-dashboard-wrapper">
        
        <!-- SIDEBAR CONTAINER (ASIDE) -->
        <aside class="gfl-sidebar-pane">
            <a href="#" class="nav-link-node active-node"><i class="bi bi-grid-1x2-fill"></i> <span>Dashboard</span></a>
            <a href="#" class="nav-link-node"><i class="bi bi-arrow-left-right"></i> <span>Transfers</span></a>
            <a href="#" class="nav-link-node"><i class="bi bi-piggy-bank"></i> <span>Cooperative Slots</span></a>
            <a href="#" class="nav-link-node"><i class="bi bi-basket3"></i> <span>Food Basket</span></a>
            <a href="#" class="nav-link-node"><i class="bi bi-shield-check"></i> <span>Micro Loans</span></a>
            <a href="#" class="nav-link-node"><i class="bi bi-people"></i> <span>Referrals</span></a>
            <a href="#" class="nav-link-node"><i class="bi bi-gear"></i> <span>Settings</span></a>
            <hr class="my-3 text-secondary opacity-10 d-none d-lg-block">
            <a href="#" class="nav-link-node text-danger d-none d-lg-flex mt-auto"><i class="bi bi-box-arrow-left"></i> <span>Log Out</span></a>
        </aside>

        <!-- MAIN DYNAMIC DATA CANVAS (MAIN) -->
        <main class="gfl-main-canvas">
            <div class="container-fluid p-0">
                
                <!-- Quick System Warning Operational Mandate Bar (Saturday Rule enforcement) -->
                <div class="alert bg-warning bg-opacity-10 border-warning border-start border-4 rounded-4 py-3 px-4 mb-4 d-flex align-items-center justify-content-between gap-3 shadow-sm">
                    <div class="d-flex align-items-center gap-3">
                        <i class="bi bi-exclamation-triangle-fill text-warning fs-4"></i>
                        <div>
                            <h6 class="fw-bold text-dark mb-0 small">Saturday Ledger Deadline Pending</h6>
                            <p class="text-secondary p-0 m-0 small" style="font-size: 0.78rem;">Fund active multi-wallets before midnight to prevent system automated double penalties.</p>
                        </div>
                    </div>
                    <span class="badge bg-warning text-dark px-3 py-1.5 rounded-pill font-monospace small fw-bold d-none d-md-inline-block">Active Lock</span>
                </div>

                <!-- Primary Financial Block Grid Row -->
                <div class="row g-4 mb-4">
                    
                    <!-- Left: OPay Style Primary Core Balance Card -->
                    <div class="col-12 col-xl-5">
                        <div class="opay-wallet-mastercard p-4 h-100 d-flex flex-column justify-content-between">
                            <div>
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="text-white text-opacity-75 small font-monospace uppercase"><i class="bi bi-shield-lock-fill"></i> Primary Ledger Vault</span>
                                    <button class="btn p-0 text-white border-0" id="toggleBalanceVisibility"><i class="bi bi-eye-fill" id="eyeIcon"></i></button>
                                </div>
                                <h1 class="display-6 fw-bold font-monospace m-0 text-white" id="mainWalletBalance">₦145,250<span class="fs-4">.00</span></h1>
                            </div>
                            
                            <!-- Static virtual banking metadata allocations -->
                            <div class="mt-4 pt-3 border-top border-white border-opacity-10 d-flex justify-content-between align-items-center">
                                <div>
                                    <span class="text-white text-opacity-50 d-block small" style="font-size: 0.68rem;">Assigned Settlement Virtual Bank</span>
                                    <span class="fw-semibold text-white small">Wema Bank / GFL-Samuel Adebayo</span>
                                </div>
                                <button class="btn btn-white bg-white text-success rounded-pill px-3 py-1.5 font-monospace fw-bold btn-sm shadow-sm" onclick="navigator.clipboard.writeText('10492850'); alert('Virtual Account copied!')">
                                    10492850 <i class="bi bi-copy ms-1"></i>
                                </button>
                            </div>
                        </div>
                    </div>

                    <!-- Right: Fast Call-to-Action Utility Hub Grid Layout -->
                    <div class="col-12 col-xl-7">
                        <div class="bg-white p-4 rounded-5 border h-100 shadow-sm">
                            <h6 class="fw-bold text-dark mb-4 small text-uppercase tracking-wider">Fast Utilities Operations</h6>
                            <div class="row g-3 text-center">
                                <div class="col-3">
                                    <button class="action-circle-btn"><i class="bi bi-plus-circle-fill"></i></button>
                                    <span class="text-secondary fw-medium small d-block" style="font-size: 0.78rem;">Fund Wallet</span>
                                </div>
                                <div class="col-3">
                                    <button class="action-circle-btn"><i class="bi bi-send-fill"></i></button>
                                    <span class="text-secondary fw-medium small d-block" style="font-size: 0.78rem;">Bank Transfer</span>
                                </div>
                                <div class="col-3">
                                    <button class="action-circle-btn"><i class="bi bi-lightning-charge-fill"></i></button>
                                    <span class="text-secondary fw-medium small d-block" style="font-size: 0.78rem;">Pay Bills</span>
                                </div>
                                <div class="col-3">
                                    <button class="action-circle-btn"><i class="bi bi-qr-code-scan"></i></button>
                                    <span class="text-secondary fw-medium small d-block" style="font-size: 0.78rem;">GFL Scanner</span>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

                <!-- Secondary Sub-wallets Matrix Subgrid Section -->
                <h5 class="fw-bold text-dark mb-3">Multi-Wallet Partition Matrix</h5>
                <div class="row g-3 mb-4">
                    
                    <!-- Partition Wallet 1: Cooperative 50-Wks Savings -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="opay-mini-wallet p-3.5 card p-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge bg-success-subtle text-success rounded-pill px-2.5 py-1 small fw-medium">50-Wks Savings</span>
                                <i class="bi bi-calendar-check text-success fs-5"></i>
                            </div>
                            <span class="text-muted d-block small mb-1" style="font-size: 0.75rem;">Active Allocated Balance</span>
                            <h4 class="fw-bold font-monospace text-dark m-0 masked-balance">₦85,000<span class="fs-6 text-muted">.00</span></h4>
                        </div>
                    </div>

                    <!-- Partition Wallet 2: Food Basket Scheme Contributions -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="opay-mini-wallet p-3.5 card p-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge bg-info-subtle text-info rounded-pill px-2.5 py-1 small fw-medium">Food Basket Wallet</span>
                                <i class="bi bi-basket text-info fs-5"></i>
                            </div>
                            <span class="text-muted d-block small mb-1" style="font-size: 0.75rem;">Active Premium Slot Pool</span>
                            <h4 class="fw-bold font-monospace text-dark m-0 masked-balance">₦12,500<span class="fs-6 text-muted">.00</span></h4>
                        </div>
                    </div>

                    <!-- Partition Wallet 3: Referral ROI Accumulation -->
                    <div class="col-12 col-sm-6 col-md-4">
                        <div class="opay-mini-wallet p-3.5 card p-3">
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <span class="badge bg-warning-subtle text-warning rounded-pill px-2.5 py-1 small fw-medium">Referral Commissions</span>
                                <i class="bi bi-gift text-warning fs-5"></i>
                            </div>
                            <span class="text-muted d-block small mb-1" style="font-size: 0.75rem;">Eligible 30-Day Node Payouts</span>
                            <h4 class="fw-bold font-monospace text-dark m-0 masked-balance">₦41,750<span class="fs-6 text-muted">.00</span></h4>
                        </div>
                    </div>

                </div>

                <!-- Desktop Tables Ledger Transaction History Log Layout -->
                <div class="bg-white p-4 rounded-5 border shadow-sm">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <h5 class="fw-bold text-dark m-0">Recent Ecosystem Operations Log</h5>
                        <button class="btn btn-light rounded-pill btn-sm text-success fw-medium px-3">View All Logs</button>
                    </div>
                    
                    <div class="table-responsive">
                        <table class="table table-hover align-middle mb-0">
                            <thead class="table-light text-secondary small">
                                <tr>
                                    <th class="border-0 py-3 rounded-start-3">Reference String</th>
                                    <th class="border-0 py-3">Partition Desk</th>
                                    <th class="border-0 py-3">Timestamp Date</th>
                                    <th class="border-0 py-3">Status Vector</th>
                                    <th class="border-0 py-3 text-end rounded-end-3">Amount Delta</th>
                                </tr>
                            </thead>
                            <tbody class="small font-monospace">
                                <tr>
                                    <td class="fw-medium text-dark py-3">TXN-9023849182</td>
                                    <td><span class="text-secondary fw-medium">Cooperative Slot ₦700</span></td>
                                    <td class="text-muted">2026-06-22 14:32</td>
                                    <td><span class="badge bg-success-subtle text-success rounded-pill px-2 py-1">Success</span></td>
                                    <td class="text-end fw-bold text-danger">-₦4,900.00</td>
                                    <!-- Negative value as contribution debit cycle outward tracking -->
                                </tr>
                                <tr>
                                    <td class="fw-medium text-dark py-3">TXN-8947201948</td>
                                    <td><span class="text-secondary fw-medium">External Transfer In</span></td>
                                    <td class="text-muted">2026-06-21 09:15</td>
                                    <td><span class="badge bg-success-subtle text-success rounded-pill px-2 py-1">Success</span></td>
                                    <td class="text-end fw-bold text-success">+₦50,000.00</td>
                                </tr>
                                <tr>
                                    <td class="fw-medium text-dark py-3">TXN-8749201940</td>
                                    <td><span class="text-secondary fw-medium">Registration Activation</span></td>
                                    <td class="text-muted">2026-05-22 11:04</td>
                                    <td><span class="badge bg-light text-muted rounded-pill px-2 py-1">Settled</span></td>
                                    <td class="text-end fw-bold text-muted">-₦6,000.00</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>

            </div>
        </main>
    </div>

    <!-- Bootstrap 5 JS Bundle Link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Custom Viewport Utilities Interaction Logic Script -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            
            // Balance Encryption-mask Toggling Interaction Logic (OPay Inspired Privacy Feature)
            const toggleBtn = document.getElementById("toggleBalanceVisibility");
            const eyeIcon = document.getElementById("eyeIcon");
            const mainWallet = document.getElementById("mainWalletBalance");
            const maskedWallets = document.querySelectorAll(".masked-balance");

            // Cache natural strings values inside arrays data references strings
            const originalMainBalance = mainWallet.innerHTML;
            const originalSubBalances = [];
            
            maskedWallets.forEach(wallet => {
                originalSubBalances.push(wallet.innerHTML);
            });

            let isBalancesVisible = true;

            if (toggleBtn) {
                toggleBtn.addEventListener("click", function() {
                    isBalancesVisible = !isBalancesVisible;
                    
                    if (!isBalancesVisible) {
                        // Mask balances with standard star configuration arrays strings
                        mainWallet.textContent = "••••••";
                        maskedWallets.forEach(wallet => wallet.textContent = "••••");
                        eyeIcon.classList.replace("bi-eye-fill", "bi-eye-slash-fill");
                    } else {
                        // Restore balances
                        mainWallet.innerHTML = originalMainBalance;
                        maskedWallets.forEach((wallet, index) => {
                            wallet.innerHTML = originalSubBalances[index];
                        });
                        eyeIcon.classList.replace("bi-eye-slash-fill", "bi-eye-fill");
                    }
                });
            }
        });
    </script>
</body>
</html>