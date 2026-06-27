<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GFL Cooperative Portal - Secure Member Terminal</title>
    
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
            --gfl-body-bg: #f4f7f5;
            --sidebar-width: 260px;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--gfl-body-bg);
            color: #333333;
            overflow-x: hidden;
        }

        /* OPay Desktop Layout Mirror Rules */
        .gfl-header {
            height: 70px;
            background-color: #ffffff;
            border-bottom: 1px solid #e5e9e6;
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            z-index: 1030;
        }

        .dashboard-container {
            margin-top: 70px;
            min-height: calc(100vh - 70px);
            display: flex;
        }

        /* Fixed Sidebar Component Layout */
        .gfl-sidebar {
            width: var(--sidebar-width);
            background-color: #ffffff;
            border-right: 1px solid #e5e9e6;
            position: fixed;
            top: 70px;
            bottom: 0;
            left: 0;
            z-index: 1020;
            padding: 1.5rem 1rem;
            overflow-y: auto;
            transition: transform 0.3s ease;
        }

        /* Scrollable Main Content Frame */
        .gfl-main-content {
            margin-left: var(--sidebar-width);
            width: calc(100% - var(--sidebar-width));
            padding: 2rem;
            min-height: 100%;
        }

        /* Navigation Links Layout styling */
        .nav-menu-item {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: #5c6760;
            font-weight: 500;
            font-size: 0.95rem;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.2s ease;
            margin-bottom: 4px;
        }

        .nav-menu-item:hover {
            color: var(--gfl-green);
            background-color: var(--gfl-green-light);
        }

        .nav-menu-item.active {
            color: #ffffff;
            background-color: var(--gfl-green);
            box-shadow: 0 4px 12px rgba(25, 135, 84, 0.2);
        }

        /* OPay-Style Balance Dashboard Cards styling */
        .wallet-card {
            background-color: #ffffff;
            border: 1px solid #e5e9e6;
            border-radius: 20px;
            padding: 1.5rem;
            box-shadow: 0 2px 6px rgba(0,0,0,0.02);
            position: relative;
            overflow: hidden;
        }

        .wallet-card-primary {
            background: linear-gradient(135deg, var(--gfl-green-dark), var(--gfl-green));
            color: #ffffff;
            border: none;
        }

        .action-circle-btn {
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background-color: var(--gfl-green-light);
            color: var(--gfl-green);
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.2rem;
            border: none;
            transition: all 0.2s ease;
        }

        .wallet-card-primary .action-circle-btn {
            background-color: rgba(255,255,255,0.15);
            color: #ffffff;
        }

        .action-circle-btn:hover {
            transform: scale(1.05);
        }

        /* Responsive Breakpoints Handling Grid */
        @media (max-width: 991.98px) {
            .gfl-sidebar {
                transform: translateX(-100%);
            }
            .gfl-sidebar.show {
                transform: translateX(0);
            }
            .gfl-main-content {
                margin-left: 0;
                width: 100%;
                padding: 1.25rem;
            }
        }
    </style>
</head>
<body>

    <!-- 1. Sticky OPay Top Navbar Header Frame -->
    <header class="gfl-header d-flex align-items-center px-3 px-lg-4 justify-content-between">
        <div class="d-flex align-items-center gap-3">
            <!-- Mobile Toggle Menu Button Hamburger -->
            <button class="btn btn-light d-lg-none rounded-3 p-2 border" type="button" id="sidebarToggleButton">
                <i class="bi bi-list fs-5"></i>
            </button>
            
            <!-- Corporate Brand Identity Core Badge -->
            <div class="d-flex align-items-center">
                <span class="bg-success rounded-3 d-flex align-items-center justify-content-center me-2 text-white shadow-sm" style="width: 38px; height: 38px;">
                    <i class="bi bi-wallet2 fs-5"></i>
                </span>
                <span class="fs-4 fw-bold text-dark tracking-tight">GFL<span class="text-success">.</span></span>
                <span class="badge bg-light text-muted border ms-2 rounded-pill font-monospace fw-normal" style="font-size: 0.72rem;">COOP NODE</span>
            </div>
        </div>

        <!-- Identity User Info Profile Right-side controls alignment -->
        <div class="d-flex align-items-center gap-3">
            <!-- Quick System Deadline Notice System alert badge -->
            <div class="d-none d-md-flex align-items-center gap-2 px-3 py-1.5 bg-warning-subtle rounded-pill text-warning border border-warning-subtle">
                <i class="bi bi-exclamation-triangle-fill fs-6"></i>
                <span class="fw-semibold small" style="font-size: 0.75rem;">Saturday Ledger Window Open</span>
            </div>

            <!-- Profile Info Menu Dropdown mapping -->
            <div class="d-flex align-items-center gap-2">
                <div class="text-end d-none d-sm-block">
                    <h6 class="m-0 fw-bold text-dark small">Alhaji Samuel Kunle</h6>
                    <span class="text-muted font-monospace" style="font-size: 0.7rem;">ID: GFL-8829-NG</span>
                </div>
                <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center fw-bold fs-6" style="width: 42px; height: 42px; border: 2px solid #fff; box-shadow: 0 0 8px rgba(0,0,0,0.1);">
                    SK
                </div>
            </div>
        </div>
    </header>

    <!-- 2. Responsive Dashboard Split Workspace Frame Container -->
    <div class="dashboard-container">
        
        <!-- Aside Panel Sidebar Menu Map (Hidden cleanly on mobile viewports dynamically) -->
        <aside class="gfl-sidebar" id="gflSidebarPanel">
            <div class="vstack gap-1">
                <a href="#" class="nav-menu-item active">
                    <i class="bi bi-grid-1x2-fill"></i> <span>Overview Hub</span>
                </a>
                <a href="#" class="nav-menu-item">
                    <i class="bi bi-arrow-left-right"></i> <span>Send Money</span>
                </a>
                <a href="#" class="nav-menu-item">
                    <i class="bi bi-safe2"></i> <span>Cooperative Slots</span>
                </a>
                <a href="#" class="nav-menu-item">
                    <i class="bi bi-cart-check"></i> <span>Food Basket Tracker</span>
                </a>
                <a href="#" class="nav-menu-item">
                    <i class="bi bi-bank"></i> <span>Micro Loans Approved</span>
                </a>
                <a href="#" class="nav-menu-item">
                    <i class="bi bi-people"></i> <span>Referrals Base</span>
                </a>
                
                <hr class="text-muted opacity-20 my-3">
                <span class="text-muted px-3 text-uppercase font-monospace tracking-wider d-block mb-2" style="font-size: 0.68rem;">Management Desk</span>
                
                <a href="#" class="nav-menu-item">
                    <i class="bi bi-shield-check"></i> <span>Security Center</span>
                </a>
                <a href="#" class="nav-menu-item text-danger hover-bg-danger-subtle">
                    <i class="bi bi-box-arrow-left"></i> <span>Secure Exit</span>
                </a>
            </div>
        </aside>

        <!-- Main Dashboard Viewport Layout -->
        <main class="gfl-main-content">
            
            <!-- Alert Banner System: Framework Rule Notification callout box -->
            <div class="alert bg-white border rounded-4 p-3 d-flex align-items-center justify-content-between mb-4 shadow-sm" data-reveal="fade-down">
                <div class="d-flex align-items-center gap-3">
                    <div class="bg-success-subtle text-success p-2.5 rounded-3 fs-4 line-height-1">
                        <i class="bi bi-patch-check-fill"></i>
                    </div>
                    <div>
                        <h6 class="fw-bold text-dark mb-0.5">Account Status: Dynamic Virtual Bank Active</h6>
                        <p class="text-secondary small mb-0">Your initialization balance of <strong>₦6,000 Setup Capital</strong> settled completely. Direct funding endpoints are enabled.</p>
                    </div>
                </div>
                <span class="badge bg-success-subtle text-success rounded-pill px-3 py-1.5 font-monospace fw-semibold d-none d-sm-inline-block">VERIFIED NODE</span>
            </div>

            <!-- Row Block A: Dynamic Multi-Wallets Component Section Grid Layout -->
            <h5 class="fw-bold text-dark mb-3"><i class="bi bi-layers-half text-success me-1"></i> Multi-Wallet Balances Overview</h5>
            <div class="row g-3 mb-4">
                
                <!-- Card 1: Core Vault Principal Ledger Account (Primary Large Display) -->
                <div class="col-12 col-md-6 col-xl-4">
                    <div class="wallet-card wallet-card-primary h-100 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="small fw-medium opacity-75">Primary Transactional Wallet</span>
                                <i class="bi bi-eye text-white opacity-75 cursor-pointer"></i>
                            </div>
                            <h2 class="fw-bold mb-1 font-monospace">₦142,500.00</h2>
                            <p class="small opacity-50 m-0" style="font-size: 0.75rem;">Dynamic Providus Virtual Account Code: 1029485761</p>
                        </div>
                        <div class="d-flex gap-2 mt-4">
                            <button class="btn btn-white text-success fw-bold px-3 rounded-pill btn-sm bg-white border-0 shadow-sm w-50">Add Cash</button>
                            <button class="btn btn-outline-white text-white fw-bold px-3 rounded-pill btn-sm border-white border-opacity-50 w-50">Transfer</button>
                        </div>
                    </div>
                </div>

                <!-- Card 2: Fixed Cooperative 50-Week Savings Module Account -->
                <div class="col-12 col-sm-6 col-md-6 col-xl-4">
                    <div class="wallet-card h-100 d-flex flex-column justify-content-between">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <span class="text-secondary small d-block fw-medium mb-1">50-Week Cooperative Savings</span>
                                <h3 class="fw-bold text-dark font-monospace mb-0">₦45,000.00</h3>
                            </div>
                            <span class="action-circle-btn"><i class="bi bi-safe"></i></span>
                        </div>
                        <div class="mt-3 pt-2 border-top border-light-subtle d-flex justify-content-between align-items-center">
                            <span class="text-muted" style="font-size: 0.72rem;"><i class="bi bi-clock-history"></i> Next deposit due: Sat Midnight</span>
                            <span class="badge bg-success-subtle text-success rounded-pill" style="font-size: 0.65rem;">Active ROI</span>
                        </div>
                    </div>
                </div>

                <!-- Card 3: Food Inflation Protection Savings Balance Box -->
                <div class="col-12 col-sm-6 col-md-6 col-xl-4">
                    <div class="wallet-card h-100 d-flex flex-column justify-content-between">
                        <div class="d-flex justify-content-between align-items-start">
                            <div>
                                <span class="text-secondary small d-block fw-medium mb-1">Food Inflation Contribution Wallet</span>
                                <h3 class="fw-bold text-dark font-monospace mb-0">₦12,200.00</h3>
                            </div>
                            <span class="action-circle-btn"><i class="bi bi-basket3"></i></span>
                        </div>
                        <div class="mt-3 pt-2 border-top border-light-subtle d-flex justify-content-between align-items-center">
                            <span class="text-muted" style="font-size: 0.72rem;"><i class="bi bi-truck"></i> Cycle dispatch window</span>
                            <span class="badge bg-primary-subtle text-primary rounded-pill" style="font-size: 0.65rem;">₦300 Matrix Tier</span>
                        </div>
                    </div>
                </div>

            </div>

            <!-- Row Block B: Micro Loans and Referrals Split Tracking Component Grid System -->
            <div class="row g-4">
                
                <!-- Left Column Block Grid Frame: Micro Loan approvals status widget panels -->
                <div class="col-12 col-lg-7">
                    <div class="bg-white border p-4 rounded-5 shadow-sm h-100">
                        <div class="d-flex justify-content-between align-items-center mb-3">
                            <h6 class="fw-bold text-dark m-0"><i class="bi bi-bank2 text-success me-1"></i> Loan Metrics Status Desk</h6>
                            <a href="#" class="text-success text-decoration-none small fw-semibold">Apply For Grant</a>
                        </div>
                        
                        <!-- Visual Micro Credit Processing Cards component -->
                        <div class="p-3 bg-light rounded-4 border border-light-subtle mb-3">
                            <div class="row align-items-center text-center text-sm-start g-3">
                                <div class="col-sm-8">
                                    <span class="badge bg-dark-subtle text-dark-emphasis rounded-pill mb-1.5" style="font-size: 0.68rem;">0.1% Daily Interest Tier</span>
                                    <h5 class="fw-bold text-dark mb-1">Approved Credit Pool Allocation</h5>
                                    <p class="text-secondary m-0" style="font-size: 0.78rem;">Your wallet qualifies for an instant micro-advance loan sequence capped up to <strong>₦50,000.00</strong>.</p>
                                </div>
                                <div class="col-sm-4 text-sm-end">
                                    <button class="btn btn-success rounded-pill px-3 py-2 btn-sm fw-medium w-100">Draw Funds</button>
                                </div>
                            </div>
                        </div>

                        <!-- System Parameters reminders checklist guidelines module -->
                        <div class="vstack gap-2 small text-muted">
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-check2-circle text-success fs-5"></i>
                                <span>No collateral strings required; backed completely by unified ledger history coordinates.</span>
                            </div>
                            <div class="d-flex align-items-center gap-2">
                                <i class="bi bi-check2-circle text-success fs-5"></i>
                                <span>Repayment periods trace fluid intervals across active savings profiles seamlessly.</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Column Block Grid Frame: Referral Onboarding Track progress modules -->
                <div class="col-12 col-lg-5">
                    <div class="bg-white border p-4 rounded-5 shadow-sm h-100 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-3">
                                <h6 class="fw-bold text-dark m-0"><i class="bi bi-diagram-3-fill text-success me-1"></i> Referral Node Framework</h6>
                                <span class="badge bg-warning text-dark fw-bold rounded-pill" style="font-size: 0.65rem;">30-Day Mandate</span>
                            </div>
                            <p class="text-secondary small mb-3">Your continuous 30% investment return metrics rely heavily on keeping a newly registered onboarding link node active inside each monthly loop cycle cycle.</p>
                            
                            <!-- Static Progress Level Bar Graphic UI Element -->
                            <div class="mb-2 d-flex justify-content-between align-items-center font-monospace small text-dark fw-bold">
                                <span>Current Loop Links Saturated</span>
                                <span class="text-success">2 / 1 Nodes Active</span>
                            </div>
                            <div class="progress rounded-pill mb-1" style="height: 8px;">
                                <div class="progress-bar bg-success rounded-pill" role="progressbar" style="width: 100%" aria-valuenow="100" aria-minnow="0" aria-maxnow="100"></div>
                            </div>
                        </div>
                        <div class="pt-3 mt-3 border-top border-light-subtle">
                            <button class="btn btn-light border rounded-pill w-100 py-2 fs-7 text-secondary fw-semibold text-truncate"><i class="bi bi-copy me-1"></i> Copy Node Link: gfl.platform/ref?u=8829</button>
                        </div>
                    </div>
                </div>

            </div>

        </main>
    </div>

    <!-- Bootstrap 5 JS Bundle Link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Custom Layout Interactions Script Logic -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            
            const menuToggleBtn = document.getElementById("sidebarToggleButton");
            const sidePanelElement = document.getElementById("gflSidebarPanel");

            // Mobile Navigation Toggle Actions Module Handler 
            if (menuToggleBtn && sidePanelElement) {
                menuToggleBtn.addEventListener("click", function (e) {
                    e.stopPropagation();
                    sidePanelElement.classList.toggle("show");
                });

                // Dismiss open panel views automatically when users click outside active frames bounds
                document.addEventListener("click", function (e) {
                    if (!sidePanelElement.contains(e.target) && !menuToggleBtn.contains(e.target)) {
                        sidePanelElement.classList.remove("show");
                    }
                });
            }
        });
    </script>
</body>
</html>