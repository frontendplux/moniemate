<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GFL Member Portal - Unified Wealth Matrix</title>
    
    <!-- Google Fonts (Poppins) -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
       
    <style>
     
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
    <style>
        :root {
            --gfl-green: #198754;
            --gfl-green-light: rgba(25, 135, 84, 0.08);
            --gfl-green-dark: #146c43;
            --gfl-whitesmoke: #f4f6f8;
            --opay-dark: #1a1a1a;
            --sidebar-width: 260px;
            --header-height: 70px;
        }
        
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--gfl-whitesmoke);
            overflow-x: hidden;
        }

        /* OPay Desktop Structure Grid Framework */
        .opay-header {
            height: var(--header-height);
            background: #ffffff;
            border-bottom: 1px solid #e9ecef;
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1030;
        }

        .opay-wrapper {
            display: flex;
            margin-top: var(--header-height);
            min-height: calc(100vh - var(--header-height));
        }

        /* Fixed Navigation Aside Menu Column */
        .opay-aside {
            width: var(--sidebar-width);
            background: #ffffff;
            border-right: 1px solid #e9ecef;
            position: fixed;
            top: var(--header-height);
            bottom: 0;
            left: 0;
            z-index: 1020;
            overflow-y: auto;
            transition: transform 0.3s ease;
        }

        /* Main Context Stage Box */
        .opay-main {
            flex: 1;
            margin-left: var(--sidebar-width);
            padding: 2rem;
            max-width: calc(100% - var(--sidebar-width));
            transition: all 0.3s ease;
        }

        /* Navigation Interactive Item Links styling */
        .nav-menu-link {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 24px;
            color: #555555;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.2s ease;
            border-left: 4px solid transparent;
        }
        .nav-menu-link:hover {
            color: var(--gfl-green);
            background-color: var(--gfl-green-light);
        }
        .nav-menu-link.active {
            color: var(--gfl-green);
            background-color: var(--gfl-green-light);
            border-left-color: var(--gfl-green);
            font-weight: 600;
        }

        /* OPay-style Specialized Glass Financial Balance Cards */
        .balance-master-card {
            background: linear-gradient(135deg, var(--gfl-green-dark), var(--gfl-green));
            border: none;
            border-radius: 20px;
            color: #ffffff;
            position: relative;
            overflow: hidden;
            box-shadow: 0 10px 20px rgba(25, 135, 84, 0.15);
        }
        .balance-master-card::after {
            content: '';
            position: absolute;
            width: 150px;
            height: 150px;
            background: rgba(255, 255, 255, 0.05);
            border-radius: 50%;
            top: -50px;
            right: -50px;
        }

        /* Responsive Breakpoint Adaptations */
        @media (max-width: 991.98px) {
            .opay-aside {
                transform: translateX(-100%);
            }
            .opay-aside.show-mobile {
                transform: translateX(0);
            }
            .opay-main {
                margin-left: 0;
                max-width: 100%;
                padding: 1.25rem;
            }
        }
    </style>
</head>
<body>

    <!-- 1. TOP HEADER NAVIGATION BAR -->
    <header class="opay-header d-flex align-items-center px-4 justify-content-between">
        <!-- Header Left Brand Module -->
        <div class="d-flex align-items-center gap-3">
            <button class="btn d-lg-none p-0 border-0 fs-3 text-dark" id="mobileMenuToggle" type="button">
                <i class="bi bi-list"></i>
            </button>
            <a class="navbar-brand d-flex align-items-center text-decoration-none" href="#">
                <span class="bg-success rounded-3 d-flex align-items-center justify-content-center me-2 text-white" style="width: 35px; height: 35px;">
                    <i class="bi bi-wallet2 fs-6"></i>
                </span>
                <span class="fs-4 fw-bold text-dark">GFL<span class="text-success">.</span></span>
            </a>
            <span class="badge bg-light text-success border border-success-subtle rounded-pill px-3 py-1.5 fw-medium d-none d-sm-inline-block">
                <i class="bi bi-shield-fill-check me-1"></i> Account Mode: Verified Node
            </span>
        </div>

        <!-- Header Right Profile Utilities Control Desk -->
        <div class="d-flex align-items-center gap-3">
            <!-- System Status Indicator Clock -->
            <div class="text-end d-none d-md-block small text-muted font-monospace me-2">
                <span class="text-warning"><i class="bi bi-exclamation-circle-fill me-1"></i> Saturday Cutoff:</span> 4d 02h left
            </div>
            
            <!-- Quick Notification Alerts Vector Dropdown -->
            <div class="position-relative cursor-pointer text-secondary px-2">
                <i class="bi bi-bell-fill fs-5"></i>
                <span class="position-absolute top-1 start-75 translate-middle p-1.5 bg-danger border border-light rounded-circle"></span>
            </div>

            <!-- Profile User String Avatar Identity Block -->
            <div class="d-flex align-items-center gap-2 border-start ps-3">
                <div class="bg-success-subtle text-success rounded-circle d-flex align-items-center justify-content-center fw-bold text-uppercase shadow-sm" style="width: 40px; height: 40px; font-size: 0.9rem;">
                    SA
                </div>
                <div class="d-none d-sm-block">
                    <h6 class="mb-0 fw-semibold text-dark small">Samuel Adebayo</h6>
                    <span class="text-muted d-block font-monospace" style="font-size: 0.68rem;">ID: GFL-109232</span>
                </div>
            </div>
        </div>
    </header>

    <!-- SYSTEM SPLIT LAYOUT WRAPPER CONTAINER -->
    <div class="opay-wrapper">

        <!-- 2. FIXED SPLIT ASIDE: MAIN SIDEBAR NAVIGATION -->
        <aside class="opay-aside py-3" id="sidebarMenuLayout">
            <div class="d-flex flex-column justify-content-between h-100">
                <!-- Navigation Option Links Matrix -->
                <div class="vstack">
                    <span class="px-4 text-uppercase text-muted fw-bold tracking-wider mb-2 d-block" style="font-size: 0.68rem;">Main Accounts</span>
                    <a href="#" class="nav-menu-link active"><i class="bi bi-grid-1x2-fill"></i> Summary Console</a>
                    <a href="#" class="nav-menu-link"><i class="bi bi-cash-coin"></i> Savings Ledger Tiers</a>
                    <a href="#" class="nav-menu-link"><i class="bi bi-basket-fill"></i> Food Basket Slots</a>
                    <a href="#" class="nav-menu-link"><i class="bi bi-bank"></i> Bank Transfers</a>
                    
                    <span class="px-4 text-uppercase text-muted fw-bold tracking-wider mt-4 mb-2 d-block" style="font-size: 0.68rem;">Benefits & Grants</span>
                    <a href="#" class="nav-menu-link"><i class="bi bi-piggy-bank-fill"></i> Micro Loans / Grants</a>
                    <a href="#" class="nav-menu-link"><i class="bi bi-people-fill"></i> Referral Rewards Tree</a>
                    
                    <span class="px-4 text-uppercase text-muted fw-bold tracking-wider mt-4 mb-2 d-block" style="font-size: 0.68rem;">Profile Configurations</span>
                    <a href="#" class="nav-menu-link"><i class="bi bi-person-fill-lock"></i> Identity & BVN</a>
                    <a href="#" class="nav-menu-link"><i class="bi bi-gear-wide-connected"></i> Account Parameters</a>
                </div>

                <!-- Footer Quick Logout Trigger -->
                <div class="px-3 pt-3 border-top mt-auto">
                    <button class="btn btn-light text-danger w-100 rounded-pill py-2.5 small fw-medium d-flex align-items-center justify-content-center gap-2">
                        <i class="bi bi-power"></i> Log Out Securely
                    </button>
                </div>
            </div>
        </aside>

        <!-- 3. PRIMARY MAIN WORKSPACE: CONTENT PRESENTATION STAGE -->
        <main class="opay-main">
            <div class="container-fluid p-0">
                
                <!-- Dashboard Workspace Context Greetings Banner Row -->
                <div class="row align-items-center justify-content-between mb-4 g-3">
                    <div class="col-12 col-md-auto">
                        <h3 class="fw-bold text-dark mb-1">Overview Dashboard</h3>
                        <p class="text-secondary small mb-0">Welcome back, Samuel. Manage your active banking metrics and cooperative allocations.</p>
                    </div>
                    <!-- Virtual Account Number Callout Box (Like OPay top parameters view) -->
                    <div class="col-12 col-md-auto">
                        <div class="bg-white px-4 py-3 border rounded-4 d-flex align-items-center justify-content-between gap-4 shadow-sm">
                            <div>
                                <span class="text-muted d-block text-uppercase font-monospace fw-bold" style="font-size: 0.65rem; tracking-wider">Dynamic Settlement Bank</span>
                                <h6 class="fw-bold text-dark mb-0 font-monospace">Wema Bank • 9034291832</h6>
                            </div>
                            <button class="btn btn-success-subtle text-success btn-sm rounded-pill px-2.5" title="Copy Number Link"><i class="bi bi-copy"></i></button>
                        </div>
                    </div>
                </div>

                <!-- Row 1: OPay Balanced Metrics Card Matrix Grid -->
                 
                <div class="row g-4 mb-4">
                    <!-- Column Card A: Central Main Available Wallet Account -->
                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="card p-4 balance-master-card h-100">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <span class="fw-medium text-white text-opacity-75 small">Total Multi-Wallet Balance</span>
                                <i class="bi bi-eye-fill cursor-pointer text-white opacity-75"></i>
                            </div>
                            <h2 class="display-6 fw-bold mb-3 font-monospace">₦142,500<span class="fs-5 fw-normal">.00</span></h2>
                            <div class="d-flex gap-2">
                                <button class="btn btn-white btn-sm bg-white text-success rounded-pill px-3 py-1.5 fw-semibold small shadow-sm"><i class="bi bi-plus-circle-fill me-1"></i> Add Money</button>
                                <button class="btn btn-light bg-transparent border border-white text-white btn-sm rounded-pill px-3 py-1.5 fw-medium small"><i class="bi bi-arrow-up-right-circle-fill me-1"></i> Send Transfer</button>
                            </div>
                        </div>
                    </div>

                    <!-- Column Card B: Cooperative Slots Savings Ledger Status Tracker -->
                    <div class="col-12 col-md-6 col-xl-4">
                        <div class="card p-4 bg-white border border-light-subtle h-100 rounded-4 shadow-sm">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <span class="text-secondary fw-semibold small">Active 50-Wks Savings Balance</span>
                                <span class="badge bg-success-subtle text-success rounded-pill font-monospace" style="font-size: 0.7rem;">+30% ROI Active</span>
                            </div>
                            <h2 class="display-6 fw-bold text-dark mb-3 font-monospace">₦85,000<span class="fs-5 fw-normal text-muted">.00</span></h2>
                            <div class="d-flex justify-content-between align-items-center text-muted small pt-1">
                                <span>Portfolio Cycle Week: <strong>14 / 50</strong></span>
                                <span class="text-success"><i class="bi bi-calendar-check me-1"></i> Next Due: Sat</span>
                            </div>
                        </div>
                    </div>

                    <!-- Column Card C: Food Basket Inbound Incentives Balance -->
                    <div class="col-12 col-xl-4">
                        <div class="card p-4 bg-white border border-light-subtle h-100 rounded-4 shadow-sm">
                            <div class="d-flex align-items-center justify-content-between mb-3">
                                <span class="text-secondary fw-semibold small">Food Basket Contributions</span>
                                <span class="badge bg-warning-subtle text-warning rounded-pill px-2" style="font-size: 0.7rem;">₦300 Daily Slot</span>
                            </div>
                            <h2 class="display-6 fw-bold text-dark mb-3 font-monospace">₦57,500<span class="fs-5 fw-normal text-muted">.00</span></h2>
                            <div class="d-flex justify-content-between align-items-center text-muted small pt-1">
                                <span>Commodity Matrix Payout Cycle</span>
                                <a href="#" class="text-success text-decoration-none fw-medium">View Basket Status <i class="bi bi-arrow-right-short"></i></a>
                            </div>
                        </div>
                    </div>
                </div>


<!-- INLINE MODAL POPUP: DYNAMIC "MORE OPTIONS" UTILITY MENU PANEL OVERLAY -->
<div class="modal fade" id="moreServicesModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content rounded-5 p-3 border-0 shadow-lg">
            <div class="modal-header border-0 pb-0">
                <h5 class="fw-bold text-dark mb-0"><i class="bi bi-grid-3x3-gap-fill text-success me-1"></i> All Extended Operations</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body py-4">
                <div class="row row-cols-3 g-3 text-center">
                    <div class="col"><a href="#bvn" class="text-decoration-none text-dark d-block p-2"><i class="bi bi-person-vcard fs-3 text-success mb-1 d-block"></i><span class="small fw-medium">BVN Link</span></a></div>
                    <div class="col"><a href="#statement" class="text-decoration-none text-dark d-block p-2"><i class="bi bi-file-earmark-pdf fs-3 text-success mb-1 d-block"></i><span class="small fw-medium">Statement</span></a></div>
                    <div class="col"><a href="#cards" class="text-decoration-none text-dark d-block p-2"><i class="bi bi-credit-card-2-back fs-3 text-success mb-1 d-block"></i><span class="small fw-medium">Virtual Card</span></a></div>
                    <div class="col"><a href="#referral" class="text-decoration-none text-dark d-block p-2"><i class="bi bi-qr-code-scan fs-3 text-success mb-1 d-block"></i><span class="small fw-medium">My QR Node</span></a></div>
                    <div class="col"><a href="#support" class="text-decoration-none text-dark d-block p-2"><i class="bi bi-chat-square-dots fs-3 text-success mb-1 d-block"></i><span class="small fw-medium">Help Desk</span></a></div>
                    <div class="col"><a href="#settings" class="text-decoration-none text-dark d-block p-2"><i class="bi bi-sliders fs-3 text-secondary mb-1 d-block"></i><span class="small fw-medium">Preferences</span></a></div>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="mb-4 bg-white rounded-3">
    <!-- <h6 class="fw-bold text-dark mb-3 px-1 text-uppercase tracking-wider small">Ecosystem Utilities</h6> -->
    <div class="row g-2 text-center">
        
        <!-- Box 1: To Bank -->
        <div class="col-3 col-sm-3 col-md-3 col-lg-1">
            <a href="#transfer" class="p-3 service-btn-box shadow-xs text-decoration-none d-block">
                <div class="icon-circle-wrapper bg-success bg-opacity-10 text-success mx-auto mb-2"><i class="bi bi-bank"></i></div>
                <span class="d-block text-dark fw-medium tracking-tight text-truncate" style="font-size: 0.72rem;">To Bank</span>
            </a>
        </div>

        <!-- Box 2: Airtime -->
        <div class="col-3 col-sm-3 col-md-3 col-lg-1">
            <a href="#airtime" class="p-3 service-btn-box shadow-xs text-decoration-none d-block">
                <div class="icon-circle-wrapper bg-success bg-opacity-10 text-success mx-auto mb-2"><i class="bi bi-phone-vibrate"></i></div>
                <span class="d-block text-dark fw-medium tracking-tight text-truncate" style="font-size: 0.72rem;">Airtime</span>
            </a>
        </div>

        <!-- Box 3: Electricity -->
        <div class="col-3 col-sm-3 col-md-3 col-lg-1">
            <a href="#electricity" class="p-3 service-btn-box shadow-xs text-decoration-none d-block">
                <div class="icon-circle-wrapper bg-success bg-opacity-10 text-success mx-auto mb-2"><i class="bi bi-lightning-charge"></i></div>
                <span class="d-block text-dark fw-medium tracking-tight text-truncate" style="font-size: 0.72rem;">Electricity</span>
            </a>
        </div>

        <!-- Box 4: Food Slot -->
        <div class="col-3 col-sm-3 col-md-3 col-lg-1">
            <a href="#food-slot" class="p-3 service-btn-box shadow-xs text-decoration-none d-block">
                <div class="icon-circle-wrapper bg-success bg-opacity-10 text-success mx-auto mb-2"><i class="bi bi-egg-fried"></i></div>
                <span class="d-block text-dark fw-medium tracking-tight text-truncate" style="font-size: 0.72rem;">Food Slot</span>
            </a>
        </div>

        <!-- Box 5: Micro Loan -->
        <div class="col-3 col-sm-3 col-md-3 col-lg-1">
            <a href="#loans" class="p-3 service-btn-box shadow-xs text-decoration-none d-block">
                <div class="icon-circle-wrapper bg-success bg-opacity-10 text-success mx-auto mb-2"><i class="bi bi-cash-coin"></i></div>
                <span class="d-block text-dark fw-medium tracking-tight text-truncate" style="font-size: 0.72rem;">Micro Loan</span>
            </a>
        </div>

        <!-- Box 6: Referrals -->
        <div class="col-3 col-sm-3 col-md-3 col-lg-1">
            <a href="#referrals" class="p-3 service-btn-box shadow-xs text-decoration-none d-block">
                <div class="icon-circle-wrapper bg-success bg-opacity-10 text-success mx-auto mb-2"><i class="bi bi-trophy"></i></div>
                <span class="d-block text-dark fw-medium tracking-tight text-truncate" style="font-size: 0.72rem;">Referrals</span>
            </a>
        </div>

        <!-- Box 7: 50-Wks Save -->
        <div class="col-3 col-sm-3 col-md-3 col-lg-1">
            <a href="#savings" class="p-3 service-btn-box shadow-xs text-decoration-none d-block">
                <div class="icon-circle-wrapper bg-success bg-opacity-10 text-success mx-auto mb-2"><i class="bi bi-safe"></i></div>
                <span class="d-block text-dark fw-medium tracking-tight text-truncate" style="font-size: 0.72rem;">50-Wks Save</span>
            </a>
        </div>

        <!-- Box 8: More -->
        <div class="col-3 col-sm-3 col-md-3 col-lg-1">
            <a href="#utilities-hub" class="p-3 service-btn-box shadow-xs text-decoration-none d-block">
                <div class="icon-circle-wrapper bg-success bg-opacity-10 text-success mx-auto mb-2"><i class="bi bi-grid-fill"></i></div>
                <span class="d-block text-dark fw-medium tracking-tight text-truncate" style="font-size: 0.72rem;">More</span>
            </a>
        </div>

    </div>
</div>



                <!-- Row 2: Ledger Core System Tracking Activity Logs -->
                <div class="row g-4">
                    <!-- Column Left: Interactive Real-time Transactions Table Ledger -->
                    <div class="col-12 col-xl-8">
                        <div class="bg-white border rounded-4 p-4 shadow-sm h-100">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="fw-bold text-dark mb-0">Recent Platform Operations</h5>
                                <a href="#" class="text-success text-decoration-none small fw-medium">See Full Statements <i class="bi bi-chevron-right small"></i></a>
                            </div>

                            <div class="table-responsive">
                                <table class="table table-hover align-middle mb-0">
                                    <thead class="table-light border-0">
                                        <tr class="small text-muted text-uppercase tracking-wider font-monospace">
                                            <th class="py-3 ps-3 border-0">Operation Type</th>
                                            <th class="py-3 border-0">Reference / ID</th>
                                            <th class="py-3 border-0">Timestamp</th>
                                            <th class="py-3 border-0">Amount</th>
                                            <th class="py-3 pe-3 border-0 text-end">Execution</th>
                                        </tr>
                                    </thead>
                                    <tbody class="small">
                                        <!-- Log 1: Inbound Bank Funding Transfer -->
                                        <tr>
                                            <td class="py-3 ps-3">
                                                <div class="d-flex align-items-center gap-2.5">
                                                    <div class="bg-success-subtle text-success rounded-3 p-1.5 fs-5 line-height-1"><i class="bi bi-arrow-down-left-square-fill"></i></div>
                                                    <div><h6 class="mb-0 fw-semibold small text-dark">Bank Wallet Funding</h6><span class="text-muted text-xxs" style="font-size: 0.7rem;">Via Wema Inbound Transfer</span></div>
                                                </div>
                                            </td>
                                            <td class="font-monospace text-muted">GFL-TX-892301</td>
                                            <td class="text-muted">Today, 02:14 PM</td>
                                            <td class="fw-bold text-success font-monospace">+₦25,000.00</td>
                                            <td class="text-end pe-3"><span class="badge bg-success-subtle text-success rounded-pill px-2.5 py-1">Settled</span></td>
                                        </tr>
                                        <!-- Log 2: Daily Automated Slot Contribution Deductions -->
                                        <tr>
                                            <td class="py-3 ps-3">
                                                <div class="d-flex align-items-center gap-2.5">
                                                    <div class="bg-primary-subtle text-primary rounded-3 p-1.5 fs-5 line-height-1"><i class="bi bi-basket3-fill"></i></div>
                                                    <div><h6 class="mb-0 fw-semibold small text-dark">Food Slot Allocation</h6><span class="text-muted text-xxs" style="font-size: 0.7rem;">Automated System Ledger</span></div>
                                                </div>
                                            </td>
                                            <td class="font-monospace text-muted">GFL-FD-391204</td>
                                            <td class="text-muted">Yesterday, 12:00 AM</td>
                                            <td class="fw-bold text-dark font-monospace">-₦300.00</td>
                                            <td class="text-end pe-3"><span class="badge bg-primary-subtle text-primary rounded-pill px-2.5 py-1">Auto-Deduct</span></td>
                                        </tr>
                                        <!-- Log 3: Delayed Saturday Ledger Fine / Penalty -->
                                        <tr>
                                            <td class="py-3 ps-3">
                                                <div class="d-flex align-items-center gap-2.5">
                                                    <div class="bg-danger-subtle text-danger rounded-3 p-1.5 fs-5 line-height-1"><i class="bi bi-exclamation-triangle-fill"></i></div>
                                                    <div><h6 class="mb-0 fw-semibold small text-dark">Delayed Slot Penalty</h6><span class="text-muted text-xxs" style="font-size: 0.7rem;">Saturday Midnight System Rule</span></div>
                                                </div>
                                            </td>
                                            <td class="font-monospace text-muted">GFL-FN-110492</td>
                                            <td class="text-muted">20 Jun 2026</td>
                                            <td class="fw-bold text-danger font-monospace">-₦1,000.00</td>
                                            <td class="text-end pe-3"><span class="badge bg-danger-subtle text-danger rounded-pill px-2.5 py-1">Enforced</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                    <!-- Column Right: Quick Account Mandates Action Rules Module -->
                    <div class="col-12 col-xl-4">
                        <div class="bg-white border rounded-4 p-4 shadow-sm h-100 d-flex flex-column justify-content-between">
                            <div>
                                <h5 class="fw-bold text-dark mb-3">Cooperative Mandates</h5>
                                
                                <!-- Rule 1 Card: Referral Setup Requirement Indicator -->
                                <div class="p-3 bg-light rounded-4 mb-3 border-start border-success border-3">
                                    <h6 class="fw-bold text-dark small mb-1"><i class="bi bi-person-plus-fill text-success me-1"></i> Active Referral Mandate</h6>
                                    <p class="text-muted small mb-2" style="font-size: 0.75rem;">Accounts must maintain at least 1 onboarded active referral per month to maintain eligibility parameters for continuous high-yield bonus streams.</p>
                                    <div class="progress rounded-pill bg-secondary-subtle" style="height: 6px;">
                                        <div class="progress-bar bg-success rounded-pill" style="width: 100%;"></div>
                                    </div>
                                    <span class="text-success fw-semibold font-monospace mt-1.5 d-block text-end" style="font-size: 0.7rem;">1/1 Met (Resets in 9 Days)</span>
                                </div>

                                <!-- Rule 2 Card: Automated Setup Capital Debit Info -->
                                <div class="p-3 bg-light rounded-4 border-start border-warning border-3">
                                    <h6 class="fw-bold text-dark small mb-1"><i class="bi bi-patch-check-fill text-warning me-1"></i> Wallet Setup Token</h6>
                                    <p class="text-muted small mb-0" style="font-size: 0.75rem;">Your initialization ledger parameters have been correctly reconciled against the registration code criteria parameters.</p>
                                </div>
                            </div>

                            <!-- Fast Utility Shortcuts Panel -->
                            <div class="mt-4 pt-3 border-top">
                                <button class="btn btn-success btn-lg w-100 rounded-pill py-2.5 fs-6 fw-medium text-white btn-gfl-success d-flex align-items-center justify-content-center gap-2 shadow-sm">
                                    <i class="bi bi-lightning-charge-fill"></i> Fast Funding Hub
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </main>

    </div>
    


    <!-- BOTTOM STICKY NAVIGATION BAR FOR MOBILE (OPAY STYLE) -->
<div class="d-lg-none fixed-bottom bg-white border-top shadow-lg pb-safe-bottom" style="z-index: 1040;">
    <div class="d-flex align-items-center justify-content-around position-relative py-2">
        
        <!-- Tab 1: Home/Console (Active State) -->
        <a href="#summary-console" class="mobile-nav-item active text-decoration-none text-center">
            <i class="bi bi-grid-1x2-fill d-block fs-5"></i>
            <span class="d-block text-xxs">Home</span>
        </a>

        <!-- Tab 2: Savings Ledger -->
        <a href="#savings" class="mobile-nav-item text-decoration-none text-center">
            <i class="bi bi-piggy-bank d-block fs-5"></i>
            <span class="d-block text-xxs">Savings</span>
        </a>

        <!-- Tab 3: HIGH-PRIORITY FLOATING HUB ACTION (OPay Pay Center Component) -->
        <div class="mobile-nav-center-wrapper">
            <a href="#utilities-hub" class="mobile-nav-center-btn shadow text-decoration-none">
                <i class="bi bi-lightning-charge-fill text-white"></i>
            </a>
            <span class="d-block text-xxs text-dark fw-semibold mt-1 text-center">Quick Pay</span>
        </div>

        <!-- Tab 4: Food Basket Slots -->
        <a href="#food-slot" class="mobile-nav-item text-decoration-none text-center">
            <i class="bi bi-basket3 d-block fs-5"></i>
            <span class="d-block text-xxs">Food Slot</span>
        </a>

        <!-- Tab 5: Account Parameters / Profile -->
        <a href="#profile" class="mobile-nav-item text-decoration-none text-center">
            <i class="bi bi-person d-block fs-5"></i>
            <span class="d-block text-xxs">Me</span>
        </a>

    </div>
</div>
<style>
    /* --- Mobile Sticky Footer Navigation Rules --- */
.text-xxs {
    font-size: 0.65rem;
    font-weight: 500;
}

/* Base Interactive Layout Anchors */
.mobile-nav-item {
    color: #8a8d91;
    flex: 1;
    transition: all 0.15s ease-in-out;
}

/* Active Highlight Palette Matching GFL Green */
.mobile-nav-item.active {
    color: #198754 !important;
    font-weight: 600;
}

/* Elevated Core Floating Hub Element Structure (OPay Blueprint) */
.mobile-nav-center-wrapper {
    position: relative;
    top: -20px; /* Pulls the button upwards out of the bar boundary */
    width: 68px;
    display: flex;
    flex-direction: column;
    align-items: center;
    z-index: 1050;
}

.mobile-nav-center-btn {
    width: 52px;
    height: 52px;
    background: linear-gradient(135deg, #146c43, #198754);
    border: 4px solid #ffffff; /* Creates clear background spacing separation */
    border-radius: 50%;
    display: flex;
    align-items: center;
    justify-content: center;
    font-size: 1.4rem;
    transition: all 0.2s ease;
}

.mobile-nav-center-btn:active {
    transform: scale(0.92);
    background: #146c43;
}

/* Modern iOS Notch/Safe-Area Layout Offset Configuration */
.pb-safe-bottom {
    padding-bottom: env(safe-area-inset-bottom, 0px);
}

/* Make sure main layout structure content doesn't get hidden behind the sticky footer bar */
@media (max-width: 991.98px) {
    body {
        padding-bottom: 85px !important; 
    }
}
</style>

    <!-- Bootstrap 5 JS Bundle Link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Custom Viewport Layout Adaptive Interaction Script Engine -->
    <script>
        const SERVER = "<?= $company_info['server'] ?>";
        document.addEventListener("DOMContentLoaded", async () => {

    try {

        const response = await fetch(SERVER, {
            method: "POST",
            credentials: "include",
            headers: {
                "Content-Type": "application/json"
            },
            body: JSON.stringify({action:"/auth/check-dedicated-account"})
        });

        const result = await response.json();

        if (!result.success) {

            Swal.fire({
                icon: "info",
                title: "Dedicated Account",
                html: `
                    <p>You don't have a Dedicated Virtual Account yet.</p>
                    <small>
                        Create one now to receive bank transfers directly into your wallet.
                    </small>
                `,
                showCancelButton: true,
                confirmButtonColor: "#198754",
                confirmButtonText: "Create Account",
                cancelButtonText: "Skip",
                allowOutsideClick: false
            }).then((response) => {

                if (response.isConfirmed) {

                    createDedicatedAccount();

                }

            });

        }

    } catch (e) {

        console.log(e);

        Swal.fire({
            icon: "error",
            title: "Network Error",
            text: "Unable to connect to the server."
        });

    }

});
        document.addEventListener("DOMContentLoaded", function () {
            
            const menuToggleBtn = document.getElementById("mobileMenuToggle");
            const sidebarContainer = document.getElementById("sidebarMenuLayout");

            // 1. Mobile Menu Open / Close Trigger Interceptor
            if (menuToggleBtn && sidebarContainer) {
                menuToggleBtn.addEventListener("click", function (e) {
                    e.stopPropagation();
                    sidebarContainer.classList.toggle("show-mobile");
                });

                // Auto collapse left panel if user clicks anywhere inside the main body framework 
                document.addEventListener("click", function (e) {
                    if (!sidebarContainer.contains(e.target) && !menuToggleBtn.contains(e.target)) {
                        sidebarContainer.classList.remove("show-mobile");
                    }
                });
            }

            // 2. Mock Balance Masking Visibility Toggler Trigger (Like OPay Feature)
            const balanceEye = document.querySelector(".balance-master-card .bi-eye-fill");
            const balanceString = document.querySelector(".balance-master-card h2");
            let isMasked = false;

            if (balanceEye && balanceString) {
                balanceEye.addEventListener("click", function() {
                    isMasked = !isMasked;
                    if (isMasked) {
                        this.classList.replace("bi-eye-fill", "bi-eye-slash-fill");
                        balanceString.innerHTML = "•••••••<span class='fs-5 fw-normal'></span>";
                    } else {
                        this.classList.replace("bi-eye-slash-fill", "bi-eye-fill");
                        balanceString.innerHTML = "₦142,500<span class='fs-5 fw-normal'>.00</span>";
                    }
                });
            }

        });
    </script>
</body>
</html>