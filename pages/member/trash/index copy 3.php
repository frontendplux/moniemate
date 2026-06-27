<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GFL Hub - Unified Financial Ledger</title>
    
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
            --gfl-green-light: rgba(25, 135, 84, 0.08);
            --gfl-dark: #1e293b;
            --gfl-border: #f1f5f9;
            --opay-gray: #f8fafc;
        }
        body {
            font-family: 'Poppins', sans-serif;
            background-color: var(--opay-gray);
            color: #334155;
            overflow-x: hidden;
        }
        
        /* Fixed Sticky Header Navigation (OPay Desktop Style) */
        .opay-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            height: 70px;
            background-color: #ffffff;
            border-bottom: 1px solid var(--gfl-border);
            z-index: 1030;
            box-shadow: 0 1px 3px rgba(0,0,0,0.02);
        }

        /* Responsive Desktop Split Container Framework */
        .opay-wrapper {
            margin-top: 70px; /* Accounts for fixed header */
            min-height: calc(100vh - 70px);
        }

        /* Desktop Left Sidebar Navigation (Sticky Layout) */
        .opay-aside {
            position: fixed;
            top: 70px;
            left: 0;
            bottom: 0;
            width: 260px;
            background-color: #ffffff;
            border-right: 1px solid var(--gfl-border);
            padding: 1.5rem 1rem;
            z-index: 1020;
            overflow-y: auto;
            transition: transform 0.3s ease;
        }

        /* Desktop Right Main Viewport Area */
        .opay-main {
            margin-left: 260px;
            padding: 2rem;
            min-width: 0; /* Prevents flexbox overflow */
        }

        /* Sidebar Navigation Item Controls */
        .nav-aside-link {
            display: flex;
            align-items: center;
            gap: 0.85rem;
            padding: 0.75rem 1rem;
            color: #64748b;
            font-weight: 500;
            border-radius: 12px;
            text-decoration: none;
            transition: all 0.2s ease;
            margin-bottom: 0.25rem;
        }
        .nav-aside-link:hover {
            color: var(--gfl-green);
            background-color: var(--gfl-green-light);
        }
        .nav-aside-link.active {
            color: #ffffff;
            background-color: var(--gfl-green);
            box-shadow: 0 4px 12px rgba(25, 135, 84, 0.2);
        }

        /* Interactive Dynamic Metric Component Cards Grid */
        .wallet-card {
            background: #ffffff;
            border: 1px solid var(--gfl-border);
            border-radius: 20px;
            padding: 1.5rem;
            transition: all 0.2s ease;
        }
        .wallet-card:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.03);
            border-color: #e2e8f0;
        }

        /* Responsive Mobile Breakpoint Overrides */
        @media (max-width: 991.98px) {
            .opay-aside {
                transform: translateX(-100%); /* Hides sidebar on mobile viewports */
            }
            .opay-aside.show-mobile {
                transform: translateX(0);
            }
            .opay-main {
                margin-left: 0;
                padding: 1.25rem;
            }
        }
    </style>
</head>
<body>

    <!-- Header Block (OPay Fixed Utility Navigation Shell) -->
    <header class="opay-header d-flex align-items-center justify-content-between px-4">
        <!-- Left Wing Logo Container -->
        <div class="d-flex align-items-center gap-3">
            <button class="btn btn-light d-lg-none rounded-3 border-0" type="button" id="mobileMenuToggler">
                <i class="bi bi-list fs-4"></i>
            </button>
            <a class="navbar-brand d-flex align-items-center m-0 text-decoration-none" href="#">
                <span class="bg-success rounded-3 d-flex align-items-center justify-content-center me-2 text-white shadow-sm" style="width: 36px; height: 36px;">
                    <i class="bi bi-wallet2 fs-6"></i>
                </span>
                <span class="fs-4 fw-bold text-dark tracking-tight">GFL<span class="text-success">.</span></span>
            </a>
        </div>

        <!-- Right Wing Identity and Security Node Indicators -->
        <div class="d-flex align-items-center gap-3">
            <!-- Security System Ledger Node Check -->
            <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2 border border-success border-opacity-10 d-none d-sm-inline-flex align-items-center gap-1.5 small fw-semibold">
                <i class="bi bi-shield-check-fill"></i> BVN Node Linked
            </span>
            
            <!-- User Access Context Profile Controls Dropdown -->
            <div class="dropdown">
                <button class="btn btn-white border-0 d-flex align-items-center gap-2 p-1" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://images.unsplash.com/photo-1534528741775-53994a69daeb?auto=format&fit=crop&w=100&q=80" alt="Avatar" class="rounded-circle border" style="width: 38px; height: 38px; object-fit: cover;">
                    <div class="text-start d-none d-md-block lh-1">
                        <span class="fw-bold text-dark small d-block">Jane Doe</span>
                        <span class="text-muted font-monospace" style="font-size: 0.68rem;">ID: GFL-108246</span>
                    </div>
                    <i class="bi bi-chevron-down text-muted small ms-1 d-none d-md-inline"></i>
                </button>
                <ul class="dropdown-menu dropdown-menu-end rounded-4 border-0 shadow-sm p-2 mt-2">
                    <li><a class="dropdown-item rounded-3 py-2 small" href="#"><i class="bi bi-person me-2 text-muted"></i>Profile Settings</a></li>
                    <li><a class="dropdown-item rounded-3 py-2 small" href="#"><i class="bi bi-security me-2 text-muted"></i>Security Matrix</a></li>
                    <li><hr class="dropdown-divider opacity-50"></li>
                    <li><a class="dropdown-item rounded-3 py-2 small text-danger" href="#"><i class="bi bi-box-arrow-right me-2"></i>Terminate Session</a></li>
                </ul>
            </div>
        </div>
    </header>

    <!-- Navigation Split Body Frame Wrapper -->
    <div class="opay-wrapper">
        
        <!-- Left Aside Sidebar Component Element Container -->
        <aside class="opay-aside" id="sidebarMenuElement">
            <div class="d-flex flex-column h-100 justify-content-between">
                
                <!-- Upper Core Operational Nav Links Queue -->
                <nav class="nav flex-column">
                    <a class="nav-aside-link active" href="#">
                        <i class="bi bi-grid-1x2-fill"></i> <span>Dashboard Core</span>
                    </a>
                    <a class="nav-aside-link" href="#">
                        <i class="bi bi-arrow-left-right"></i> <span>Fund Transfers</span>
                    </a>
                    <a class="nav-aside-link" href="#">
                        <i class="bi bi-piggy-bank"></i> <span>50-Wks Ledger Slots</span>
                    </a>
                    <a class="nav-aside-link" href="#">
                        <i class="bi bi-basket3"></i> <span>Food Basket Logs</span>
                    </a>
                    <a class="nav-aside-link" href="#">
                        <i class="bi bi-cash-coin"></i> <span>Micro Loans / Grants</span>
                    </a>
                    <a class="nav-aside-link" href="#">
                        <i class="bi bi-people"></i> <span>Referrals Portal</span>
                    </a>
                </nav>

                <!-- Bottom System Parameter Rules Context Block Card -->
                <div class="p-3 bg-light rounded-4 border border-light-subtle">
                    <span class="text-danger small d-block fw-bold mb-1"><i class="bi bi-exclamation-octagon-fill"></i> System Warning</span>
                    <p class="m-0 text-muted p-0" style="font-size: 0.72rem; line-height: 1.4;">
                        Ensure active balances populate your slot matrices before Saturday midnight to prevent standard double penalty settlement executions.
                    </p>
                </div>

            </div>
        </aside>

        <!-- Right Side Main Core Display Component Panel Window -->
        <main class="opay-main">
            <div class="container-fluid p-0" data-reveal="fade-in">
                
                <!-- Quick User Welcome Greeting and Virtual Account Box banner banner -->
                <div class="row g-4 align-items-center justify-content-between mb-4">
                    <div class="col-12 col-md-7">
                        <h3 class="fw-bold text-dark mb-1">Hello, Jane Doe</h3>
                        <p class="text-secondary small m-0">Monitor your continuous multi-wallet ledger tracking updates and account balances instantly.</p>
                    </div>
                    
                    <!-- OPay Style Dedicated Virtual Inbound Account Indicator Card -->
                    <div class="col-12 col-md-5 col-xl-4">
                        <div class="bg-white border rounded-4 p-3 d-flex align-items-center justify-content-between shadow-sm">
                            <div>
                                <span class="text-muted d-block uppercase tracking-wider mb-1" style="font-size: 0.65rem; font-weight: 600;">YOUR VIRTUAL BANK ACCOUNT</span>
                                <h6 class="fw-bold text-dark font-monospace mb-0">9023485710</h6>
                                <span class="text-success small fw-medium" style="font-size: 0.75rem;">Wema Bank Settlement Hub</span>
                            </div>
                            <button class="btn btn-success-subtle btn-sm rounded-3 px-2.5 py-2 text-success" type="button" onclick="alert('Account Number Copied!')">
                                <i class="bi bi-copy"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <!-- Core Matrix Grid: The 5 Platform Functional Wallets Row Block -->
                <h5 class="fw-bold text-dark mb-3">Multi-Wallet Assets Matrix</h5>
                <div class="row g-3 mb-4">
                    
                    <!-- Wallet 1: Primary Funding Account -->
                    <div class="col-12 col-sm-6 col-xl-4">
                        <div class="wallet-card border-start border-success border-4 shadow-sm">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-secondary small fw-medium">Primary Spending Wallet</span>
                                <span class="bg-success-subtle text-success rounded-3 p-1 px-2 font-monospace fw-bold" style="font-size:0.7rem;">Main</span>
                            </div>
                            <h3 class="fw-bold text-dark font-monospace mb-1">₦142,500<span class="text-muted" style="font-size:1rem;">.00</span></h3>
                            <span class="text-muted font-monospace" style="font-size: 0.7rem;">Ready Liquid Asset Balance</span>
                        </div>
                    </div>

                    <!-- Wallet 2: Fixed 50-Week Savings Ledger Wallet -->
                    <div class="col-12 col-sm-6 col-xl-4">
                        <div class="wallet-card shadow-sm">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-secondary small fw-medium">Fixed 50-Weeks Ledger</span>
                                <i class="bi bi-piggy-bank-fill text-primary"></i>
                            </div>
                            <h3 class="fw-bold text-dark font-monospace mb-1">₦35,000<span class="text-muted" style="font-size:1rem;">.00</span></h3>
                            <span class="text-primary small fw-medium" style="font-size: 0.7rem;"><i class="bi bi-graph-up-arrow"></i> Target: 50w Cycle</span>
                        </div>
                    </div>

                    <!-- Wallet 3: Food Basket Contribution Wallet -->
                    <div class="col-12 col-sm-6 col-xl-4">
                        <div class="wallet-card shadow-sm">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-secondary small fw-medium">Food Basket Savings</span>
                                <i class="bi bi-basket3-fill text-warning"></i>
                            </div>
                            <h3 class="fw-bold text-dark font-monospace mb-1">₦12,400<span class="text-muted" style="font-size:1rem;">.00</span></h3>
                            <span class="text-warning small fw-medium" style="font-size: 0.7rem;"><i class="bi bi-truck"></i> Cycle 3 Active Allocation</span>
                        </div>
                    </div>

                </div>

                <!-- Split Content Architecture: Main Tracking Details Grid Logs -->
                <div class="row g-4">
                    
                    <!-- Left: Recent Transaction History Stack Logs Ledger -->
                    <div class="col-12 col-xl-8">
                        <div class="bg-white border rounded-5 p-4 shadow-sm">
                            <div class="d-flex justify-content-between align-items-center mb-4">
                                <h5 class="fw-bold text-dark m-0">Recent Activity Log</h5>
                                <a href="#" class="text-success text-decoration-none small fw-medium">See All Transactions <i class="bi bi-arrow-right"></i></a>
                            </div>

                            <div class="vstack gap-3">
                                <!-- Log Item A: Credit Funding -->
                                <div class="d-flex justify-content-between align-items-center p-2.5 rounded-4 hover-bg-light transition-all">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-success-subtle text-success rounded-4 d-flex align-items-center justify-content-center" style="width:44px; height:44px;">
                                            <i class="bi bi-arrow-down-left-circle-fill fs-5"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold text-dark mb-0 small">Virtual Account Deposit</h6>
                                            <span class="text-muted font-monospace" style="font-size: 0.7rem;">Ref: TXN-928410284</span>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <span class="fw-bold text-success font-monospace d-block">+₦50,000.00</span>
                                        <span class="text-muted small" style="font-size: 0.68rem;">Today, 2:14 PM</span>
                                    </div>
                                </div>

                                <!-- Log Item B: Automated Debit Slot Allocation -->
                                <div class="d-flex justify-content-between align-items-center p-2.5 rounded-4 hover-bg-light transition-all">
                                    <div class="d-flex align-items-center gap-3">
                                        <div class="bg-danger-subtle text-danger rounded-4 d-flex align-items-center justify-content-center" style="width:44px; height:44px;">
                                            <i class="bi bi-arrow-up-right-circle-fill fs-5"></i>
                                        </div>
                                        <div>
                                            <h6 class="fw-bold text-dark mb-0 small">Daily Food Slot Allocation</h6>
                                            <span class="text-muted font-monospace" style="font-size: 0.7rem;">₦200 Daily Economy Tier</span>
                                        </div>
                                    </div>
                                    <div class="text-end">
                                        <span class="fw-bold text-dark font-monospace d-block">-₦1,400.00</span>
                                        <span class="text-muted small" style="font-size: 0.68rem;">Yesterday, 11:59 PM</span>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <!-- Right: Quick Dashboard Action Modules Interactivities Panels -->
                    <div class="col-12 col-xl-4">
                        <div class="bg-white border rounded-5 p-4 shadow-sm h-100">
                            <h5 class="fw-bold text-dark mb-3">Quick Actions</h5>
                            <div class="row g-2">
                                <div class="col-6">
                                    <button type="button" class="btn btn-light border rounded-4 p-3 w-100 text-center text-dark transition-all hover-shadow-sm d-flex flex-column align-items-center gap-2">
                                        <i class="bi bi-send text-success fs-3"></i>
                                        <span class="fw-medium small d-block">Send Money</span>
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-light border rounded-4 p-3 w-100 text-center text-dark transition-all hover-shadow-sm d-flex flex-column align-items-center gap-2">
                                        <i class="bi bi-phone text-success fs-3"></i>
                                        <span class="fw-medium small d-block">Airtime Node</span>
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-light border rounded-4 p-3 w-100 text-center text-dark transition-all hover-shadow-sm d-flex flex-column align-items-center gap-2">
                                        <i class="bi bi-shield-plus text-success fs-3"></i>
                                        <span class="fw-medium small d-block">Topup Slot</span>
                                    </button>
                                </div>
                                <div class="col-6">
                                    <button type="button" class="btn btn-light border rounded-4 p-3 w-100 text-center text-dark transition-all hover-shadow-sm d-flex flex-column align-items-center gap-2">
                                        <i class="bi bi-file-earmark-text text-success fs-3"></i>
                                        <span class="fw-medium small d-block">Statements</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </main>
    </div>

    <!-- Bootstrap 5 JS Bundle Link -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- ScrollReveal UI Animation Engine -->
    <script src="https://unpkg.com/scrollreveal"></script>

    <!-- Interactive Toggle Management Scripts Layout Framework -->
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            
            const mobileToggler = document.getElementById("mobileMenuToggler");
            const sidebarMenu = document.getElementById("sidebarMenuElement");

            // 1. OPay Style Responsive Menu Toggling Functionality
            if (mobileToggler && sidebarMenu) {
                mobileToggler.addEventListener("click", function (e) {
                    e.stopPropagation();
                    sidebarMenu.classList.toggle("show-mobile");
                });

                // Clear side-menu focus cleanly whenever clicking away into main body parts
                document.addEventListener("click", function (e) {
                    if (!sidebarMenu.contains(e.target) && !mobileToggler.contains(e.target)) {
                        sidebarMenu.classList.remove("show-mobile");
                    }
                });
            }

            // 2. Continuous UI Interactions Hover Transitions Class Hooking
            const listItems = document.querySelectorAll('.hover-bg-light');
            listItems.forEach(item => {
                item.addEventListener('mouseover', () => item.style.backgroundColor = '#f8fafc');
                item.addEventListener('mouseout', () => item.style.backgroundColor = 'transparent');
            });

            // 3. ScrollReveal Engine Initialization Array Blocks
            if (typeof ScrollReveal !== 'undefined') {
                ScrollReveal().reveal('[data-reveal="fade-in"]', {
                    duration: 800,
                    opacity: 0,
                    easing: 'ease-out'
                });
            }
        });
    </script>
</body>
</html>