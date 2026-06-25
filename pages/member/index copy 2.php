<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GFL Member Node Portal - Unified Dashboard</title>
    
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
            --gfl-green-light: #20c997;
            --gfl-green-subtle: rgba(25, 135, 84, 0.08);
            --gfl-dark: #212529;
            --gfl-whitesmoke: #f4f6f8;
            --sidebar-width: 260px;
            --header-height: 70px;
        }

        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--gfl-whitesmoke);
            overflow-x: hidden;
        }

        /* --- Desktop Header Section (OPay Layout Style) --- */
        .gfl-header {
            height: var(--header-height);
            background-color: #ffffff;
            border-bottom: 1px solid #e9ecef;
            position: fixed;
            top: 0;
            right: 0;
            left: 0;
            z-index: 1030;
        }

        /* --- Split Layout Container Mechanics --- */
        .dashboard-wrapper {
            margin-top: var(--header-height);
            min-height: calc(100vh - var(--header-height));
            display: flex;
        }

        /* Left Side: Desktop Sidebar Navigation (Aside) */
        .gfl-sidebar {
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

        /* Right Side: Main Dashboard Panel Space */
        .gfl-main-content {
            flex-grow: 1;
            margin-left: var(--sidebar-width);
            padding: 2rem;
            transition: all 0.3s ease;
            max-width: calc(100% - var(--sidebar-width));
        }

        /* --- Navigation Items Link Styling --- */
        .nav-link-gfl {
            display: flex;
            align-items: center;
            gap: 12px;
            padding: 12px 16px;
            color: #495057;
            font-weight: 500;
            font-size: 0.9rem;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.2s ease;
            margin-bottom: 4px;
        }

        .nav-link-gfl:hover {
            color: var(--gfl-green);
            background-color: var(--gfl-green-subtle);
        }

        .nav-link-gfl.active {
            color: #ffffff;
            background-color: var(--gfl-green);
            box-shadow: 0 4px 12px rgba(25, 135, 84, 0.2);
        }

        /* --- OPay Style Feature Component Elements --- */
        .balance-card {
            background: linear-gradient(135deg, var(--gfl-dark), #2c3034);
            border-radius: 24px;
            color: #ffffff;
            position: relative;
            overflow: hidden;
            box-shadow: 0 8px 24px rgba(0,0,0,0.08);
        }

        .balance-card::before {
            content: '';
            position: absolute;
            top: -50%;
            right: -20%;
            width: 250px;
            height: 250px;
            background: rgba(25, 135, 84, 0.15);
            border-radius: 50%;
            pointer-events: none;
        }

        .quick-action-btn {
            background-color: #ffffff;
            border: 1px solid #e9ecef;
            border-radius: 16px;
            padding: 1rem;
            text-align: center;
            color: var(--gfl-dark);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.85rem;
            display: flex;
            flex-column;
            flex-direction: column;
            align-items: center;
            gap: 8px;
            transition: all 0.2s ease;
            box-shadow: 0 2px 6px rgba(0,0,0,0.02);
        }

        .quick-action-btn:hover {
            transform: translateY(-2px);
            border-color: var(--gfl-green);
            color: var(--gfl-green);
        }

        .quick-action-btn i {
            font-size: 1.5rem;
            color: var(--gfl-green);
        }

        /* --- Mobile Navigation Bar (Bottom Dock style) --- */
        .mobile-bottom-nav {
            display: none;
            position: fixed;
            bottom: 0;
            left: 0;
            right: 0;
            background-color: #ffffff;
            box-shadow: 0 -4px 16px rgba(0,0,0,0.06);
            z-index: 1040;
            border-top: 1px solid #e9ecef;
        }

        .mobile-nav-item {
            flex: 1;
            text-align: center;
            padding: 8px 0;
            color: #6c757d;
            text-decoration: none;
            font-size: 0.7rem;
            font-weight: 500;
        }

        .mobile-nav-item i {
            font-size: 1.25rem;
            display: block;
            margin-bottom: 2px;
        }

        .mobile-nav-item.active {
            color: var(--gfl-green);
        }

        /* --- RESPONSIVE MEDIA QUERIES BREAKPOINTS (OPay Screen Adaptive Standard) --- */
        @media (max-width: 991.98px) {
            .gfl-sidebar {
                transform: translateX(-100%); /* Stash sidebar out of view on tablet/mobile */
                pointer-events: none;
            }
            .gfl-main-content {
                margin-left: 0;
                max-width: 100%;
                padding: 1.25rem;
                padding-bottom: 80px; /* Safe padding block loop above the bottom mobile dock */
            }
            .mobile-bottom-nav {
                display: flex; /* Activate dock view layout */
            }
            .gfl-header {
                padding-left: 1rem;
                padding-right: 1rem;
            }
        }
    </style>
</head>
<body>

    <!-- ================== FIXED TOP UTILITY HEADER ================== -->
    <header class="gfl-header d-flex align-items-center px-4 justify-content-between">
        <!-- Brand Identity Block -->
        <div class="d-flex align-items-center">
            <span class="bg-success rounded-3 d-flex align-items-center justify-content-center me-2 text-white shadow-sm" style="width: 36px; height: 36px;">
                <i class="bi bi-wallet2 fs-6"></i>
            </span>
            <span class="fs-4 fw-bold text-dark tracking-tight">GFL<span class="text-success">.</span></span>
            <span class="badge bg-light text-success border border-success-subtle rounded-pill ms-3 px-2.5 py-1 small d-none d-sm-inline-block fw-semibold" style="font-size: 0.72rem;">Cooperative Node Active</span>
        </div>

        <!-- Right Side: Profile Widget & Virtual Wallet Indicator -->
        <div class="d-flex align-items-center gap-3">
            <div class="text-end d-none d-md-block">
                <span class="text-muted d-block small" style="font-size: 0.72rem;">Internal GFL ID</span>
                <span class="fw-mono fw-bold text-dark" style="font-size: 0.85rem;">GFL-7890-NG</span>
            </div>
            
            <div class="vr h-25 d-none d-md-block text-secondary opacity-20"></div>

            <!-- Profile Interactive Dropdown -->
            <div class="dropdown">
                <button class="btn btn-light rounded-pill p-1.5 pe-3 d-flex align-items-center gap-2 border" type="button" id="profileDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                    <div class="bg-success text-white rounded-circle d-flex align-items-center justify-content-center fw-bold" style="width: 32px; height: 32px; font-size: 0.85rem;">SA</div>
                    <span class="small fw-semibold text-dark d-none d-sm-inline-block">S. Adebayo</span>
                    <i class="bi bi-chevron-down text-muted small" style="font-size: 0.7rem;"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 rounded-4 mt-2" aria-labelledby="profileDropdown">
                    <li><a class="dropdown-item py-2 small" href="#"><i class="bi bi-person me-2 text-muted"></i> My Profile Identity</a></li>
                    <li><a class="dropdown-item py-2 small" href="#"><i class="bi bi-shield-check me-2 text-muted"></i> BVN Account Tiers</a></li>
                    <li><hr class="dropdown-divider opacity-50"></li>
                    <li><a class="dropdown-item py-2 small text-danger" href="#"><i class="bi bi-power me-2"></i> Disconnect Node</a></li>
                </ul>
            </div>
        </div>
    </header>


    <!-- ================== LAYOUT WRAPPER SPACE ================== -->
    <div class="dashboard-wrapper">
        
        <!-- ================== LEFT ASIDE SIDEBAR (DESKTOP VIEW) ================== -->
        <aside class="gfl-sidebar">
            <div class="vstack justify-content-between h-100">
                <div class="nav flex-column">
                    <span class="text-uppercase tracking-wider text-muted font-monospace d-block mb-2 px-3 fw-bold" style="font-size: 0.68rem;">Main Board</span>
                    
                    <a href="#" class="nav-link-gfl active"><i class="bi bi-grid-1x2-fill"></i> Central Terminal</a>
                    <a href="#" class="nav-link-gfl"><i class="bi bi-cash-coin"></i> Cooperative Slots</a>
                    <a href="#" class="nav-link-gfl"><i class="bi bi-basket3"></i> Food Incentives</a>
                    <a href="#" class="nav-link-gfl"><i class="bi bi-arrow-down-up"></i> Ledger Statements</a>
                    
                    <span class="text-uppercase tracking-wider text-muted font-monospace d-block mt-4 mb-2 px-3 fw-bold" style="font-size: 0.68rem;">Financing Hub</span>
                    <a href="#" class="nav-link-gfl"><i class="bi bi-shield-plus"></i> Micro Grants</a>
                    <a href="#" class="nav-link-gfl"><i class="bi bi-bank"></i> Secure Funding</a>
                    <a href="#" class="nav-link-gfl"><i class="bi bi-people"></i> Referral Network</a>
                </div>

                <!-- Saturday Deadline Floating Warning Card inside Sidebar -->
                <div class="p-3 bg-light rounded-4 border border-warning-subtle mt-4">
                    <div class="d-flex align-items-center gap-2 mb-1.5 text-warning">
                        <i class="bi bi-exclamation-octagon-fill"></i>
                        <span class="fw-bold small" style="font-size: 0.75rem;">Saturday Ledger Rule</span>
                    </div>
                    <p class="text-muted m-0 p-0" style="font-size: 0.7rem; line-height: 1.35;">Ensure portfolio balances sync completely prior to midnight parameters to protect active slots against fines.</p>
                </div>
            </div>
        </aside>


        <!-- ================== MAIN CONTENT PANEL AREA ================== -->
        <main class="gfl-main-content">
            
            <!-- Context Welcoming Title Row Box -->
            <div class="row align-items-center mb-4 g-3" data-reveal="fade-up">
                <div class="col-sm">
                    <h3 class="fw-bold text-dark m-0">Good Day, Samuel</h3>
                    <p class="text-secondary small m-0">Monitor your dynamic wallet allocations and 50-week automated ledger structures.</p>
                </div>
                <div class="col-sm-auto">
                    <span class="badge bg-success-subtle text-success border border-success-subtle rounded-pill py-2 px-3 fw-medium">
                        <i class="bi bi-calendar-check me-1"></i> Week Cycle: **24 / 50**
                    </span>
                </div>
            </div>

            <!-- Financial Assets Row (Classic OPay Multi-Card Layout Grid) -->
            <div class="row g-3 mb-4" data-reveal="fade-up">
                <!-- Master Wallet Balances Card (Dark Accent) -->
                <div class="col-12 col-xl-6">
                    <div class="p-4 balance-card h-100 d-flex flex-column justify-content-between">
                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-white-50 small tracking-wide text-uppercase fw-semibold" style="font-size: 0.72rem;">Combined Multi-Wallet Fluid Balance</span>
                                <i class="bi bi-eye-slash-fill text-white-50 cursor-pointer"></i>
                            </div>
                            <h1 class="display-6 fw-bold font-monospace m-0">₦245,600<span class="fs-4 text-white-50">.50</span></h1>
                        </div>
                        
                        <!-- Mini Virtual Bank Assignment Footer Panel inside Card -->
                        <div class="mt-4 pt-3 border-top border-secondary-subtle border-opacity-20 d-flex justify-content-between align-items-center text-white-50 small" style="font-size: 0.75rem;">
                            <div>
                                <span class="d-block text-white-30" style="font-size: 0.65rem;">Linked Settlement Bank</span>
                                <span class="text-white fw-medium"><i class="bi bi-building-check text-success"></i> Wema Bank (GFL Dynamic)</span>
                            </div>
                            <div class="text-end">
                                <span class="d-block text-white-30" style="font-size: 0.65rem;">Settlement Account</span>
                                <span class="text-white font-monospace fw-bold tracking-wider">9923458110</span>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Secondary Trackers Matrix Mini Grid (Slots Tracker) -->
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="bg-white p-4 rounded-5 border shadow-sm h-100 d-flex flex-column justify-content-between">
                        <div>
                            <span class="text-muted d-block small text-uppercase tracking-wider fw-bold mb-1" style="font-size: 0.68rem;">Food Basket Slots Portfolio</span>
                            <h3 class="fw-bold text-dark font-monospace m-0">₦42,000</h3>
                        </div>
                        <div class="mt-3">
                            <div class="progress rounded-pill bg-light mb-1" style="height: 6px;">
                                <div class="progress-bar bg-success rounded-pill" style="width: 60%"></div>
                            </div>
                            <span class="text-muted" style="font-size: 0.7rem;">3 of 5 active slot targets unlocked</span>
                        </div>
                    </div>
                </div>

                <!-- Third Mini Tracker Matrix Grid (Active Loan Ledger) -->
                <div class="col-12 col-md-6 col-xl-3">
                    <div class="bg-white p-4 rounded-5 border shadow-sm h-100 d-flex flex-column justify-content-between">
                        <div>
                            <span class="text-muted d-block small text-uppercase tracking-wider fw-bold mb-1" style="font-size: 0.68rem;">Approved Micro-Loan Balance</span>
                            <h3 class="fw-bold text-danger font-monospace m-0">₦15,000</h3>
                        </div>
                        <div class="mt-3 text-start">
                            <span class="badge bg-danger-subtle text-danger rounded-pill px-2 py-1" style="font-size: 0.68rem;"><i class="bi bi-percent"></i> 0.1% Daily Parameter Active</span>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Action Controls Operations Shortcuts (OPay Dashboard Grid Style) -->
            <div class="mb-4" data-reveal="fade-up">
                <h6 class="text-muted fw-bold text-uppercase tracking-wider mb-3 font-monospace" style="font-size: 0.7rem;">Instant Utility Actions</h6>
                <div class="row g-2 row-cols-2 row-cols-sm-4 row-cols-xl-6">
                    <div class="col"><a href="#" class="quick-action-btn"><i class="bi bi-plus-circle"></i>Fund Wallet</a></div>
                    <div class="col"><a href="#" class="quick-action-btn"><i class="bi bi-send"></i>Send Money</a></div>
                    <div class="col"><a href="#" class="quick-action-btn"><i class="bi bi-phone-vibrate"></i>Buy Airtime</a></div>
                    <div class="col"><a href="#" class="quick-action-btn"><i class="bi bi-lightning-charge"></i>Pay Utilities</a></div>
                    <div class="col"><a href="#" class="quick-action-btn"><i class="bi bi-cart-check"></i>Food Cycle</a></div>
                    <div class="col"><a href="#" class="quick-action-btn"><i class="bi bi-question-square"></i>Help Desk</a></div>
                </div>
            </div>

            <!-- Detailed Activity Audit Ledger Table Container Module -->
            <div class="bg-white rounded-5 border shadow-sm p-4" data-reveal="fade-up">
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <h5 class="fw-bold text-dark m-0">Recent Portfolio Log Activities</h5>
                    <a href="#" class="text-success text-decoration-none small fw-semibold">View Master Ledger Statement <i class="bi bi-arrow-right"></i></a>
                </div>
                <div class="table-responsive">
                    <table class="table table-hover align-middle border-0 mb-0">
                        <thead>
                            <tr class="table-light text-muted small" style="font-size: 0.75rem;">
                                <th class="border-0 px-3 py-2.5 rounded-start-3">Reference Tracking ID</th>
                                <th class="border-0 py-2.5">Activity Context Description</th>
                                <th class="border-0 py-2.5">Wallet Partition Link</th>
                                <th class="border-0 py-2.5">Value Change Metrics</th>
                                <th class="border-0 px-3 py-2.5 rounded-end-3 text-end">Execution Settle Timestamp</th>
                            </tr>
                        </thead>
                        <tbody class="small" style="font-size: 0.85rem;">
                            <tr>
                                <td class="px-3 font-monospace fw-bold text-secondary">TXN-902381-NG</td>
                                <td>Virtual Settlement Wema Bank Wallet Topup</td>
                                <td><span class="badge bg-light text-dark font-monospace rounded-pill border">Fluid Wallet</span></td>
                                <td class="text-success fw-bold">+₦15,000.00</td>
                                <td class="px-3 text-end text-muted">Today, 2:15 PM</td>
                            </tr>
                            <tr>
                                <td class="px-3 font-monospace fw-bold text-secondary">TXN-894112-NG</td>
                                <td>₦700 Ultimate Food Basket Slot Contribution</td>
                                <td><span class="badge bg-success-subtle text-success font-monospace rounded-pill">Food Slot Ledger</span></td>
                                <td class="text-dark fw-medium">-₦4,900.00</td>
                                <td class="px-3 text-end text-muted">Yesterday, 11:00 AM</td>
                            </tr>
                            <tr>
                                <td class="px-3 font-monospace fw-bold text-secondary">TXN-881203-NG</td>
                                <td>Late Vault Funding Automatic Penalty Fee</td>
                                <td><span class="badge bg-danger-subtle text-danger font-monospace rounded-pill">Fines Ledger</span></td>
                                <td class="text-danger fw-bold">-₦1,500.00</td>
                                <td class="px-3 text-end text-muted">20 Jun 2026</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

        </main>
    </div>


    <!-- ================== DYNAMIC BOTTOM MOBILE NAVIGATION DOCK ================== -->
    <nav class="mobile-bottom-nav">
        <a href="#" class="mobile-nav-item active"><i class="bi bi-grid-1x2-fill"></i>Home</a>
        <a href="#" class="mobile-nav-item"><i class="bi bi-cash-coin"></i>Slots</a>
        <a href="#" class="mobile-nav-item"><i class="bi bi-basket3"></i>Food</a>
        <a href="#" class="mobile-nav-item"><i class="bi bi-people"></i>Referral</a>
        <a href="#" class="mobile-nav-item" id="mobileMenuTrigger" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-list"></i>Menu</a>
        <!-- Dropup array block configuration under menu button trigger links -->
        <ul class="dropdown-menu dropdown-menu-end dropup shadow border-0 rounded-4 p-2 mb-2" aria-labelledby="mobileMenuTrigger">
            <li><a class="dropdown-item py-2.5 small" href="#"><i class="bi bi-arrow-down-up me-2"></i> Statements Ledger</a></li>
            <li><a class="dropdown-item py-2.5 small" href="#"><i class="bi bi-shield-plus me-2"></i> Micro Grants</a></li>
            <li><a class="dropdown-item py-2.5 small" href="#"><i class="bi bi-bank me-2"></i> Secure Funding</a></li>
        </ul>
    </nav>


    <!-- Bootstrap 5 JS Bundle Link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- ScrollReveal CDN Library Link -->
    <script src="https://unpkg.com/scrollreveal"></script>

    <!-- Custom Viewport Animations Engine Mapping Logic Scripts -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            
            // Initialize scannable layout reveal states 
            if (typeof ScrollReveal !== 'undefined') {
                ScrollReveal().reveal('[data-reveal="fade-up"]', {
                    origin: 'bottom',
                    distance: '25px',
                    duration: 800,
                    delay: 100,
                    easing: 'ease-out',
                    interval: 100 // Stagger consecutive items loaded 
                });
            }

        });
    </script>
</body>
</html>