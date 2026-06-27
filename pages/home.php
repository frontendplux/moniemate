<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, maximum-scale=1.0">
    <title>GFL - Digital Banking & Cooperative Savings</title>
    
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <link rel="stylesheet" href="style.css">
    <style>
        /* Color Palette & Base Configurations */
:root {
    --gfl-green: #198754;
    --gfl-green-dark: #146c43;
    --gfl-whitesmoke: #f8f9fa;
    --gfl-white: #ffffff;
    --gfl-dark: #212529;
}

body {
    font-family: 'Poppins', sans-serif;
    background-color: var(--gfl-whitesmoke);
    color: var(--gfl-dark);
}

/* Announcement Top Bar */
.top-bar {
    background-color: var(--gfl-green-dark);
    letter-spacing: 0.5px;
    font-size: 0.85rem;
}

/* Navbar Customizations */
.navbar-brand .logo-icon {
    background-color: var(--gfl-green);
    width: 38px;
    height: 38px;
    border-radius: 10px;
}

.navbar-brand .brand-text {
    font-size: 1.4rem;
    letter-spacing: -0.5px;
    color: var(--gfl-dark);
}

.nav-link {
    color: #555555;
    padding: 0.5rem 1rem !important;
    transition: color 0.25s ease;
}

.nav-link:hover, .nav-link:focus {
    color: var(--gfl-green);
}

/* Custom Dropdown Styling */
.custom-dropdown {
    padding: 0.75rem;
    border-radius: 12px;
    margin-top: 10px !important;
}

.custom-dropdown .dropdown-item {
    padding: 0.6rem 1rem;
    border-radius: 8px;
    font-size: 0.95rem;
    transition: all 0.2s ease;
}

.custom-dropdown .dropdown-item:hover {
    background-color: rgba(25, 135, 84, 0.08);
    color: var(--gfl-green);
}

/* Primary Button Styling */
.btn-gfl-primary {
    background-color: var(--gfl-green);
    border: none;
}

.btn-gfl-primary:hover {
    background-color: var(--gfl-green-dark);
    transform: translateY(-1px);
}

.fs-xs {
    font-size: 0.7rem;
}

/* Global Transition Utility */
.transition-all {
    transition: all 0.3s ease;
}
    </style>
</head>
<body style="background:whitesmoke">
<header class="sticky-top bg-white">
    <nav class="navbar navbar-expand-lg navbar-light py-3">
        <div class="container">
            <a class="navbar-brand d-flex align-items-center" href="#">
                <span class="logo-icon d-flex align-items-center justify-content-center me-2">
                    <i class="bi bi-wallet2 text-white fs-5"></i>
                </span>
                <span class="brand-text fw-bold">GFL<span class="text-success">.</span></span>
            </a>

            <div class="d-flex align-items-center gap-2 gap-sm-3 order-lg-3  ms-4">
                <a href="/login" class="btn btn-link text-decoration-none text-dark fw-medium px-2 small-screen-btn">Sign In</a>
                
                <a href="/signup" class="btn btn-success px-3 px-sm-4 py-2 rounded-pill fw-medium shadow-sm transition-all btn-gfl-primary text-nowrap">
                    Register <i class="bi bi-arrow-right ms-1 d-none d-sm-inline"></i>
                </a>

                <button class="navbar-toggler border-0 shadow-none p-1 ms-1" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar" aria-controls="mainNavbar" aria-expanded="false" aria-label="Toggle navigation">
                    <i class="bi bi-list fs-2 text-dark"></i>
                </button>
            </div>

            <div class="collapse navbar-collapse order-lg-2" id="mainNavbar">
                <ul class="navbar-nav ms-auto mb-2 mb-lg-0 fw-medium pt-3 pt-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active text-success" aria-current="page" href="#">Home</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Services
                        </a>
                        <ul class="dropdown-menu border-0 shadow-sm custom-dropdown">
                            <li><a class="dropdown-item" href="#"><i class="bi bi-bank me-2 text-success"></i> Banking & Transfers</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-piggy-bank me-2 text-success"></i> Fixed Savings (50 Weeks)</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-basket me-2 text-success"></i> Food Basket Contributions</a></li>
                            <li><a class="dropdown-item" href="#"><i class="bi bi-cash-coin me-2 text-success"></i> Micro Loans & Grants</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Incentives</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">GFL Coin</a>
                    </li>
                </ul>
            </div>

        </div>
    </nav>
</header>

<section class="position-relative overflow-hidden bg-whitesmoke text-dark">
    <div class="position-absolute top-0 start-0 w-100 h-100 d-lg-none" 
         style="background: linear-gradient(rgba(255, 255, 255, 0.9), rgba(255, 255, 255, 0.85)), url(/assets/log.png) center/cover no-repeat;">
    </div>

    <div class="container position-relative my-lg-5">
        <div class="row align-items-center g-5">
            
            <div class="col-12 col-lg-6">
                <div class="alert alert-success bg-success-subtle text-success border-0 rounded-4 d-inline-flex align-items-center mb-4 p-2 pe-3" role="alert">
                    <span class="badge bg-success rounded-pill me-2 px-3 py-2">⚡ Easy Setup</span>
                    <span class="small fw-medium">₦6,000 Registration instantly sets up your dynamic wallets.</span>
                </div>

                <h1 class="display-4 fw-bold lh-sm mb-3">
                    Smart Banking, Fixed Savings & <span class="text-success">Guaranteed Rewards</span>
                </h1>
                
                <p class="lead text-secondary mb-4">
                    Secure your financial future with GFL. Enjoy everyday modern banking services, structured 50-week savings plans yielding <strong class="text-success">30% interest</strong>, micro-loans, and food basket incentives.
                </p>

                <div class="d-flex flex-wrap gap-3 mb-4">
                    <a href="#" class="btn btn-success btn-lg px-4 py-3 rounded-pill shadow fw-medium d-flex align-items-center">
                        Open Free Account <i class="bi bi-arrow-right-short fs-4 ms-1"></i>
                    </a>
                    <a href="#" class="btn btn-outline-dark btn-lg px-4 py-3 rounded-pill fw-medium">
                        Explore Incentives
                    </a>
                </div>

                <div class="row g-3 pt-3 border-top border-light-subtle">
                    <div class="col-6 col-sm-3">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-shield-check text-success fs-4"></i>
                            <span class="small fw-semibold">BVN Secured</span>
                        </div>
                    </div>
                    <div class="col-6 col-sm-3">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-graph-up-arrow text-success fs-4"></i>
                            <span class="small fw-semibold">30% High Yield</span>
                        </div>
                    </div>
                    <div class="col-6 col-sm-3">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-percent text-success fs-4"></i>
                            <span class="small fw-semibold">0.1% Daily Loan</span>
                        </div>
                    </div>
                    <div class="col-6 col-sm-3">
                        <div class="d-flex align-items-center gap-2">
                            <i class="bi bi-gift text-success fs-4"></i>
                            <span class="small fw-semibold">Food Rewards</span>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6 d-none d-lg-block">
                <div class="position-relative p-4">
                    <img src="/assets/log.png" 
                         class="img-fluid rounded-5 shadow-lg w-100 object-fit-cover" 
                         alt="GFL Digital Mobile Banking Dashboard" 
                         style="height: 500px;">
                    
                    <div class="position-absolute top-50 start-0 translate-middle-y bg-white shadow-lg p-3 rounded-4 d-flex align-items-center gap-3 border" style="margin-left: -20px; max-width: 240px;">
                        <div class="bg-success-subtle p-3 rounded-3 text-success">
                            <i class="bi bi-arrow-down-left-circle-fill fs-4"></i>
                        </div>
                        <div>
                            <p class="text-muted small mb-0">Grant Disbursed</p>
                            <h5 class="fw-bold mb-0 text-success">Wallet Credited</h5>
                        </div>
                    </div>

                    <div class="position-absolute bottom-0 end-0 bg-white shadow-lg p-3 rounded-4 border mb-4 me-4" style="max-width: 200px;">
                        <p class="text-muted small mb-1 fw-medium">Weekly Status</p>
                        <div class="d-flex align-items-center justify-content-between gap-2">
                            <span class="badge bg-success-subtle text-success rounded-pill px-2 py-1">Active Slot</span>
                            <span class="fw-bold small">Week 12/50</span>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- About Section -->
<section id="about" class="py-5 bg-white overflow-hidden">
    <div class="container py-lg-4">
        
        <!-- Section Header -->
        <div class="row justify-content-center mb-5 text-center" data-sr="fade-up">
            <div class="col-lg-7">
                <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2 fw-semibold uppercase mb-2">Who We Are</span>
                <h2 class="display-5 fw-bold text-dark">A Smart Digital Ecosystem For Financial Freedom</h2>
                <p class="text-secondary lead">GFL bridges the gap between conventional modern banking services and high-yield community-driven cooperative financial growth models.</p>
            </div>
        </div>

        <!-- Row 1: The Core Process (Registration & Wallets) -->
        <div class="row align-items-center g-5 mb-5 pb-lg-4">
            <div class="col-12 col-lg-6" data-sr="fade-right">
                <div class="pe-lg-4">
                    <h3 class="fw-bold text-dark mb-3">Onboarding Made Simple, Secure, and Instant</h3>
                    <p class="text-secondary mb-4">
                        Getting started with GFL takes less than three minutes. By integrating secure banking infrastructure, your profile is verified securely using your BVN, giving you complete peace of mind.
                    </p>
                    
                    <!-- Feature Steps -->
                    <div class="d-flex gap-3 mb-4">
                        <div class="bg-success-subtle rounded-4 p-3 d-flex align-items-center justify-content-center h-100 text-success fs-3">
                            <i class="bi bi-person-check"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-1">Secure BVN Registration</h5>
                            <p class="text-secondary small mb-0">Provide your email, phone number, and BVN. A dynamic personalized settlement wallet is assigned to you instantly.</p>
                        </div>
                    </div>

                    <div class="d-flex gap-3 mb-4">
                        <div class="bg-success-subtle rounded-4 p-3 d-flex align-items-center justify-content-center h-100 text-success fs-3">
                            <i class="bi bi-credit-card-2-front"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-1">Instant Wallet Activation</h5>
                            <p class="text-secondary small mb-0">A one-time registration fee of ₦6,000 activates your entire ecosystem. Credit your account and watch your dashboards come alive.</p>
                        </div>
                    </div>

                    <div class="d-flex gap-3">
                        <div class="bg-success-subtle rounded-4 p-3 d-flex align-items-center justify-content-center h-100 text-success fs-3">
                            <i class="bi bi-cpu-fill"></i>
                        </div>
                        <div>
                            <h5 class="fw-bold text-dark mb-1">Automated Smart Deductions</h5>
                            <p class="text-secondary small mb-0">No tedious manual trackings. Your dues and loan repayments are securely and automatically subtracted from your balance.</p>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- Right side: Visual representation of your 5 structural Wallets -->
            <div class="col-12 col-lg-6" data-sr="fade-left">
                <div class="p-4 p-sm-5 bg-light rounded-5 border border-light-subtle shadow-sm">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h4 class="fw-bold text-dark m-0">Your Unified Dashboards</h4>
                        <span class="badge bg-success text-white rounded-pill px-2 py-1 small">1 Account</span>
                    </div>
                    <p class="text-muted small mb-4">Upon entry, your single profile is systematically sub-divided into 5 unique functional wallets to protect and process distinct streams:</p>
                    
                    <!-- Wallet items simulated -->
                    <div class="vstack gap-3">
                        <div class="bg-white p-3 rounded-4 d-flex align-items-center justify-content-between border shadow-xs">
                            <div class="d-flex align-items-center gap-3">
                                <span class="p-2 rounded-3 bg-secondary-subtle text-secondary"><i class="bi bi-file-earmark-text fw-bold"></i></span>
                                <span class="fw-semibold text-dark">Dues Wallet</span>
                            </div>
                            <span class="text-muted small">Automated Deductions</span>
                        </div>
                        <div class="bg-white p-3 rounded-4 d-flex align-items-center justify-content-between border shadow-xs">
                            <div class="d-flex align-items-center gap-3">
                                <span class="p-2 rounded-3 bg-warning-subtle text-warning"><i class="bi bi-trophy"></i></span>
                                <span class="fw-semibold text-dark">Grants Wallet</span>
                            </div>
                            <span class="text-success small fw-medium">Withdraw Instantly</span>
                        </div>
                        <div class="bg-white p-3 rounded-4 d-flex align-items-center justify-content-between border shadow-xs">
                            <div class="d-flex align-items-center gap-3">
                                <span class="p-2 rounded-3 bg-danger-subtle text-danger"><i class="bi bi-bank2"></i></span>
                                <span class="fw-semibold text-dark">Loans Wallet</span>
                            </div>
                            <span class="text-danger small">0.1% Daily Interest</span>
                        </div>
                        <div class="bg-white p-3 rounded-4 d-flex align-items-center justify-content-between border shadow-xs">
                            <div class="d-flex align-items-center gap-3">
                                <span class="p-2 rounded-3 bg-success-subtle text-success"><i class="bi bi-graph-up-arrow"></i></span>
                                <span class="fw-semibold text-dark">Savings Wallet</span>
                            </div>
                            <span class="text-success small fw-medium">30% Fixed Yield</span>
                        </div>
                        <div class="bg-white p-3 rounded-4 d-flex align-items-center justify-content-between border shadow-xs">
                            <div class="d-flex align-items-center gap-3">
                                <span class="p-2 rounded-3 bg-info-subtle text-info"><i class="bi bi-basket3"></i></span>
                                <span class="fw-semibold text-dark">Food Basket Savings Wallet</span>
                            </div>
                            <span class="text-info small">Commodity Payouts</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <hr class="my-5 opacity-25 text-secondary">

        <!-- Row 2: Strict Rules Transparency (Savings & Referral Guidelines) -->
        <div class="row align-items-center g-5 flex-lg-row-reverse">
            <div class="col-12 col-lg-6" data-sr="fade-left">
                <div class="ps-lg-4">
                    <h3 class="fw-bold text-dark mb-3">Transparent Rules for Disciplined Financial Growth</h3>
                    <p class="text-secondary mb-4">
                        We achieve high consistency and reliable asset payouts by maintaining rigid, collective financial parameters. Our terms are strict, automated, and designed to reward dedicated contributors.
                    </p>

                    <div class="row g-4">
                        <div class="col-sm-6">
                            <div class="card border-0 bg-light rounded-4 h-100 p-3">
                                <h6 class="fw-bold text-dark d-flex align-items-center gap-2 mb-2">
                                    <i class="bi bi-clock-history text-success"></i> 50-Week Cycle
                                </h6>
                                <p class="text-muted small mb-0">Choose your base amount, save steadily every single week, and lock in a <strong>30% fixed interest yield</strong> at completion.</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card border-0 bg-light rounded-4 h-100 p-3">
                                <h6 class="fw-bold text-dark d-flex align-items-center gap-2 mb-2">
                                    <i class="bi bi-shield-exclamation text-danger"></i> Saturday Deadline
                                </h6>
                                <p class="text-muted small mb-0">Missed deposits attract immediate double-fines based on your total active slots. Keep your balance credited ahead of Saturday.</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card border-0 bg-light rounded-4 h-100 p-3">
                                <h6 class="fw-bold text-dark d-flex align-items-center gap-2 mb-2">
                                    <i class="bi bi-people-fill text-success"></i> Referral Bonus
                                </h6>
                                <p class="text-muted small mb-0">Earn instant <strong>₦1,000</strong> directly to your Referral Bonus wallet for every successful teammate registered.</p>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card border-0 bg-light rounded-4 h-100 p-3">
                                <h6 class="fw-bold text-dark d-flex align-items-center gap-2 mb-2">
                                    <i class="bi bi-award text-warning"></i> Growth Mandate
                                </h6>
                                <p class="text-muted small mb-0">To remain fully eligible for your total accumulated savings return (ROI), you must introduce at least 1 referral within your first month.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Left Side Grid: Core Traditional Banking Features -->
            <div class="col-12 col-lg-6" data-sr="fade-right">
                <div class="p-4 bg-whitesmoke rounded-5 border">
                    <h4 class="fw-bold text-dark mb-2">Full-Service Digital Banking</h4>
                    <p class="text-secondary small mb-4">Beyond structured cooperative targets, enjoy standard real-time commercial banking convenience:</p>
                    
                    <div class="row g-3">
                        <div class="col-6">
                            <div class="bg-white p-3 rounded-4 border text-center">
                                <i class="bi bi-arrow-left-right text-success fs-3 d-block mb-2"></i>
                                <span class="fw-medium text-dark small">Instant Transfers</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-white p-3 rounded-4 border text-center">
                                <i class="bi bi-phone text-success fs-3 d-block mb-2"></i>
                                <span class="fw-medium text-dark small">Airtime & Data</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-white p-3 rounded-4 border text-center">
                                <i class="bi bi-receipt text-success fs-3 d-block mb-2"></i>
                                <span class="fw-medium text-dark small">Utility Utility Bills</span>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="bg-white p-3 rounded-4 border text-center">
                                <i class="bi bi-currency-bitcoin text-success fs-3 d-block mb-2"></i>
                                <span class="fw-medium text-dark small">GFL Token <span class="badge bg-success-subtle text-success font-monospace d-block mt-1" style="font-size: 0.65rem;">In Development</span></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</section>


<section id="pricing" class="py-5 bg-whitesmoke">
    <div class="container py-lg-4">
        
        <div class="row justify-content-center mb-5 text-center">
            <div class="col-lg-7">
                <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2 fw-semibold mb-2">Fees & Projections</span>
                <h2 class="display-5 fw-bold text-dark">Clear Pricing. Transparent Earnings.</h2>
                <p class="text-secondary">No hidden charges. Know your setup costs, slot configurations, and exactly how much you can earn or secure through disciplined accumulation.</p>
            </div>
        </div>

        <div class="row g-4 align-items-stretch">
            
            <div class="col-12 col-lg-5">
                <div class="d-flex flex-column h-100 justify-content-between gap-4">
                    
                    <div class="bg-white p-4 rounded-5 border shadow-sm">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <span class="text-muted small fw-medium uppercase">Platform Entry</span>
                                <h4 class="fw-bold text-dark my-1">System Activation Fee</h4>
                            </div>
                            <span class="badge bg-danger-subtle text-danger rounded-pill px-2.5 py-1 small">One-time</span>
                        </div>
                        <h2 class="display-5 fw-bold text-success mb-2">₦6,000</h2>
                        <p class="text-secondary small mb-0">Debited instantly upon crediting your profile wallet to secure your node, assign personal wallets, and link verified BVN parameters.</p>
                    </div>

                    <div class="bg-white p-4 rounded-5 border shadow-sm">
                        <div class="d-flex justify-content-between align-items-start mb-3">
                            <div>
                                <span class="text-muted small fw-medium uppercase">Cooperative Ledger</span>
                                <h4 class="fw-bold text-dark my-1">Savings Ledger Activation</h4>
                            </div>
                            <span class="badge bg-success-subtle text-success rounded-pill px-2.5 py-1 small">Fixed</span>
                        </div>
                        <h2 class="display-5 fw-bold text-dark mb-2">₦1,500 <span class="fs-5 text-muted fw-normal">/ account</span></h2>
                        <p class="text-secondary small mb-3">Compulsory maintenance ledger charge required to initiate your 50-week investment channels.</p>
                        <div class="p-3 bg-light rounded-4 border-start border-success border-3">
                            <span class="small fw-medium text-dark d-block mb-1">Slot Subscription Requirement:</span>
                            <span class="text-muted small d-block">Each standalone active savings slot requires a minimum of <strong>₦1,000</strong> compilation capital to successfully activate.</span>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-12 col-lg-7">
                <div class="bg-white p-4 p-sm-5 rounded-5 border shadow-sm h-100">
                    <div class="d-flex align-items-center gap-3 mb-4">
                        <div class="bg-success text-white rounded-4 p-2.5 d-inline-block fs-4 line-height-1">
                            <i class="bi bi-calculator"></i>
                        </div>
                        <div>
                            <h4 class="fw-bold text-dark mb-0">Investment Simulator</h4>
                            <p class="text-muted small mb-0">Adjust your slots to compute targets, potential returns, and risk vectors.</p>
                        </div>
                    </div>

                    <form id="gflCalculatorForm" class="row g-4">
                        <div class="col-sm-6">
                            <label for="slotCount" class="form-label fw-semibold text-dark small">Number of Savings Slots</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-layers-half text-muted"></i></span>
                                <input type="number" id="slotCount" class="form-control form-control-lg border-start-0" value="1" min="1" placeholder="e.g. 3">
                            </div>
                            <div class="form-text text-muted fs-xs">Each slot costs ₦1,500 weekly commitment.</div>
                        </div>

                        <div class="col-sm-6">
                            <label class="form-label fw-semibold text-dark small">Fixed Cycle Tenure</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light"><i class="bi bi-calendar-check text-muted"></i></span>
                                <input type="text" class="form-control form-control-lg bg-light text-muted" value="50 Weeks" disabled>
                            </div>
                            <div class="form-text text-success fs-xs fw-medium">Guaranteed fixed rate: 30% yield.</div>
                        </div>
                    </form>

                    <div class="row g-3 mt-4 pt-4 border-top">
                        <div class="col-sm-6">
                            <div class="p-3 bg-light rounded-4">
                                <span class="text-muted d-block small mb-1">Compulsory Weekly Debit</span>
                                <h4 class="fw-bold text-dark m-0" id="weeklyDebitOut">₦1,500</h4>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-3 bg-light rounded-4">
                                <span class="text-muted d-block small mb-1">Total Contribution (50 Wks)</span>
                                <h4 class="fw-bold text-dark m-0" id="totalContributionOut">₦75,000</h4>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-3 bg-success-subtle rounded-4 border border-success-subtle">
                                <span class="text-success d-block small mb-1 fw-medium">30% ROI Interest Payout</span>
                                <h4 class="fw-bold text-success m-0" id="roiPayoutOut">₦22,500</h4>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="p-3 bg-light rounded-4">
                                <span class="text-muted d-block small mb-1">Total Expected Return</span>
                                <h4 class="fw-bold text-dark m-0 text-decoration-underline" id="grandTotalOut">₦97,500</h4>
                            </div>
                        </div>
                    </div>

                    <div class="mt-4 p-3 bg-danger-subtle rounded-4 border border-danger-subtle d-flex gap-3 align-items-start">
                        <i class="bi bi-exclamation-octagon-fill text-danger fs-4 mt-1"></i>
                        <div>
                            <h6 class="fw-bold text-danger mb-1">Risk Parameter: Late Penalty Alert</h6>
                            <p class="text-danger small mb-0 opacity-85">
                                Failure to credit your wallet before Saturday midnight triggers a double fine penalty of <strong id="penaltyFineOut">₦3,000</strong> for that week, alongside forfeiture of interest accruals for the affected period.
                            </p>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- Services Section -->
<section id="services" class="py-5 bg-white overflow-hidden">
    <div class="container py-lg-5">
        
        <!-- Section Header -->
        <div class="row justify-content-center text-center mb-5" data-reveal="fade-up">
            <div class="col-lg-7">
                <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2 fw-semibold mb-2">Our Capabilities</span>
                <h2 class="display-5 fw-bold text-dark">Empowering Financial Utilities</h2>
                <p class="text-secondary">Explore our custom ecosystem designed to give you optimal transactional ease alongside unmatched structural investment frameworks.</p>
            </div>
        </div>

        <!-- Services Main Grid Layout -->
        <div class="row g-4 justify-content-center">
            
            <!-- Service 1: Traditional Banking Infrastructure -->
            <div class="col-md-6 col-lg-4" data-reveal="fade-right">
                <div class="card border-0 bg-light p-4 rounded-5 h-100 transition-all hover-shadow">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="bg-white rounded-4 p-3 text-success shadow-xs fs-3 line-height-1">
                            <i class="bi bi-bank"></i>
                        </div>
                        <span class="badge bg-success-subtle text-success rounded-pill small">Instant</span>
                    </div>
                    <h4 class="fw-bold text-dark mb-2">Banking & Core Utilities</h4>
                    <p class="text-secondary small mb-3">
                        Execute seamless transfers, pay your utility bills, top-up airtime and data bundles instantly. Your day-to-day transaction parameters are unified under one secured wallet dashboard.
                    </p>
                    <div class="mt-auto pt-2 border-top border-light-subtle">
                        <span class="text-dark small fw-medium d-flex align-items-center gap-1">
                            Realtime Settlements <i class="bi bi-chevron-right fs-xs"></i>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Service 2: 50-Week High Yield Savings -->
            <div class="col-md-6 col-lg-4" data-reveal="fade-up">
                <div class="card border-success bg-white border border-2 p-4 rounded-5 h-100 position-relative hover-shadow">
                    <!-- Featured Corner Ribbon -->
                    <span class="position-absolute top-0 end-0 bg-success text-white px-3 py-1 rounded-bl-5 small rounded-top-right-5 fw-medium" style="border-bottom-left-radius: 20px;">
                        30% Return
                    </span>
                    
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="bg-success text-white rounded-4 p-3 shadow-sm fs-3 line-height-1">
                            <i class="bi bi-piggy-bank"></i>
                        </div>
                    </div>
                    <h4 class="fw-bold text-dark mb-2">Fixed 50-Week Savings</h4>
                    <p class="text-secondary small mb-3">
                        Commit your capital across as many slots as you want. Save diligently every week for 50 weeks to achieve your target. Strict parameters keep you on track to secure your guaranteed yield at maturation.
                    </p>
                    <div class="mt-auto pt-2 border-top border-light-subtle">
                        <span class="text-success small fw-bold d-flex align-items-center gap-1">
                            ₦1,500 Base Weekly Slot <i class="bi bi-chevron-right fs-xs"></i>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Service 3: Food Basket Savings -->
            <div class="col-md-6 col-lg-4" data-reveal="fade-left">
                <div class="card border-0 bg-light p-4 rounded-5 h-100 transition-all hover-shadow">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="bg-white rounded-4 p-3 text-success shadow-xs fs-3 line-height-1">
                            <i class="bi bi-basket3"></i>
                        </div>
                        <span class="badge bg-info-subtle text-info rounded-pill small">Commodity</span>
                    </div>
                    <h4 class="fw-bold text-dark mb-2">Food Basket Savings</h4>
                    <p class="text-secondary small mb-3">
                        Insulate your household from inflation by joining structured food saving allocations. Convert continuous capital into raw foodstuffs like rice, pasta, oil, and spices seamlessly distributed to you.
                    </p>
                    <div class="mt-auto pt-2 border-top border-light-subtle">
                        <span class="text-dark small fw-medium d-flex align-items-center gap-1">
                            View Food Tiers <i class="bi bi-chevron-right fs-xs"></i>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Service 4: Micro Loans & Grants -->
            <div class="col-md-6 col-lg-4" data-reveal="fade-right">
                <div class="card border-0 bg-light p-4 rounded-5 h-100 transition-all hover-shadow">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="bg-white rounded-4 p-3 text-success shadow-xs fs-3 line-height-1">
                            <i class="bi bi-cash-coin"></i>
                        </div>
                        <span class="badge bg-danger-subtle text-danger rounded-pill small">0.1% Daily</span>
                    </div>
                    <h4 class="fw-bold text-dark mb-2">Instant Loans & Grants</h4>
                    <p class="text-secondary small mb-3">
                        Apply for institutional micro-grants or scalable dynamic short-term credit loans. Once approved, the funds drop instantly into your main system wallet for deployment. Repayments are fully automated.
                    </p>
                    <div class="mt-auto pt-2 border-top border-light-subtle">
                        <span class="text-dark small fw-medium d-flex align-items-center gap-1">
                            Auto Debit Safeguards <i class="bi bi-chevron-right fs-xs"></i>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Service 5: Referral & Affiliate Growth Tier -->
            <div class="col-md-6 col-lg-4" data-reveal="fade-up">
                <div class="card border-0 bg-light p-4 rounded-5 h-100 transition-all hover-shadow">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="bg-white rounded-4 p-3 text-success shadow-xs fs-3 line-height-1">
                            <i class="bi bi-people"></i>
                        </div>
                        <span class="badge bg-warning-subtle text-warning rounded-pill small">₦1,000 Bonus</span>
                    </div>
                    <h4 class="fw-bold text-dark mb-2">Network Acceleration</h4>
                    <p class="text-secondary small mb-3">
                        Earn cash fast by inviting others into the GFL cooperative circle. Receive immediate payouts directly inside your referral wallet on registration. Remember to onboard 1 team member monthly to protect your savings ROI eligibility.
                    </p>
                    <div class="mt-auto pt-2 border-top border-light-subtle">
                        <span class="text-dark small fw-medium d-flex align-items-center gap-1">
                            Track Referral Conditions <i class="bi bi-chevron-right fs-xs"></i>
                        </span>
                    </div>
                </div>
            </div>

            <!-- Service 6: Proprietary GFL Coin -->
            <div class="col-md-6 col-lg-4" data-reveal="fade-left">
                <div class="card border-0 bg-light p-4 rounded-5 h-100 opacity-85 transition-all hover-shadow">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <div class="bg-white rounded-4 p-3 text-muted shadow-xs fs-3 line-height-1">
                            <i class="bi bi-currency-exchange"></i>
                        </div>
                        <span class="badge bg-secondary text-white rounded-pill small">Next Phase</span>
                    </div>
                    <h4 class="fw-bold text-muted mb-2">GFL Native Token</h4>
                    <p class="text-secondary small mb-3">
                        We are building a native crypto asset to revolutionize decentralized ledger rewards. The token layer will power automated cashbacks, fluid governance options, and lightning-fast non-custodial cross-border payments.
                    </p>
                    <div class="mt-auto pt-2 border-top border-light-subtle">
                        <span class="badge bg-success-subtle text-success small font-monospace">Whitepaper Coming Soon</span>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- Contact Us Section -->
<section id="contact" class="py-5 bg-whitesmoke overflow-hidden">
    <div class="container py-lg-5">
        
        <!-- Section Header -->
        <div class="row justify-content-center text-center mb-5" data-reveal="fade-up">
            <div class="col-lg-7">
                <span class="badge bg-success-subtle text-success rounded-pill px-3 py-2 fw-semibold mb-2">Get In Touch</span>
                <h2 class="display-5 fw-bold text-dark">We Are Here To Help</h2>
                <p class="text-secondary">Have questions about your active savings slots, loan calculations, or food basket delivery cycles? Reach out to our verified support nodes.</p>
            </div>
        </div>

        <div class="row g-5 align-items-stretch">
            
            <!-- Left Side: Interactive Quick Help & Channels -->
            <div class="col-12 col-lg-5" data-reveal="fade-right">
                <div class="d-flex flex-column h-100 justify-content-between gap-4">
                    
                    <!-- Core Corporate Office Info Card -->
                    <div class="bg-white p-4 rounded-5 border shadow-sm">
                        <h4 class="fw-bold text-dark mb-4">Support Channels</h4>
                        
                        <div class="vstack gap-4">
                            <!-- Location Channels -->
                            <div class="d-flex align-items-start gap-3">
                                <div class="bg-success-subtle text-success rounded-4 p-2.5 fs-4 line-height-1">
                                    <i class="bi bi-geo-alt"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-1">Headquarters</h6>
                                    <p class="text-secondary small mb-0">Victoria Island, Lagos, Nigeria.</p>
                                </div>
                            </div>

                            <!-- Phone Channels (Crucial for mobile banking users) -->
                            <div class="d-flex align-items-start gap-3">
                                <div class="bg-success-subtle text-success rounded-4 p-2.5 fs-4 line-height-1">
                                    <i class="bi bi-telephone-inbound"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-1">Direct Call Center</h6>
                                    <p class="text-secondary small mb-1">+234 (0) 800-GFL-BANK</p>
                                    <span class="badge bg-light text-muted fw-normal">Mon - Fri, 8:00 AM - 5:00 PM</span>
                                </div>
                            </div>

                            <!-- Email Channel -->
                            <div class="d-flex align-items-start gap-3">
                                <div class="bg-success-subtle text-success rounded-4 p-2.5 fs-4 line-height-1">
                                    <i class="bi bi-envelope-check"></i>
                                </div>
                                <div>
                                    <h6 class="fw-bold text-dark mb-1">Digital Enquiries</h6>
                                    <p class="text-secondary small mb-0">support@gflplatform.com</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Operations Notice & Saturday Reminder Box -->
                    <div class="bg-success text-white p-4 rounded-5 shadow-sm position-relative overflow-hidden">
                        <!-- Abstract backround icon watermark -->
                        <i class="bi bi-shield-lock-fill position-absolute text-white opacity-10" style="font-size: 10rem; bottom: -30px; right: -20px;"></i>
                        
                        <h5 class="fw-bold mb-2"><i class="bi bi-patch-check-fill me-2"></i>Automated Systems Active</h5>
                        <p class="small mb-0 opacity-90">
                            Our transaction engines run 24/7. Wallet funding, BVN assignment, and referral bonus credits settle instantly. If you are disputing a Saturday slot double penalty, please attach your specific Wallet Transaction Reference ID.
                        </p>
                    </div>

                </div>
            </div>

            <!-- Right Side: Clean Modern Secured Ticket Form -->
            <div class="col-12 col-lg-7" data-reveal="fade-left">
                <div class="bg-white p-4 p-sm-5 rounded-5 border shadow-sm h-100">
                    <h4 class="fw-bold text-dark mb-2">Log A Support Ticket</h4>
                    <p class="text-muted small mb-4">Fill out the secure fields below. Your entry maps into our system based on your selected help desk parameters.</p>

                    <form id="gflContactForm" class="row g-3">
                        <!-- Full Name Input -->
                        <div class="col-sm-6">
                            <label for="contactName" class="form-label fw-semibold text-dark small">Full Name</label>
                            <input type="text" id="contactName" class="form-control form-control-lg border bg-light fs-6" placeholder="e.g., John Doe" required>
                        </div>

                        <!-- Registered Phone Input -->
                        <div class="col-sm-6">
                            <label for="contactPhone" class="form-label fw-semibold text-dark small">Registered Phone Number</label>
                            <input type="tel" id="contactPhone" class="form-control form-control-lg border bg-light fs-6" placeholder="e.g., 08012345678" required>
                        </div>

                        <!-- Email Address Input -->
                        <div class="col-12">
                            <label for="contactEmail" class="form-label fw-semibold text-dark small">Email Address</label>
                            <input type="email" id="contactEmail" class="form-control form-control-lg border bg-light fs-6" placeholder="name@example.com" required>
                        </div>

                        <!-- Dynamic Department Router Dropdown -->
                        <div class="col-12">
                            <label for="contactDept" class="form-label fw-semibold text-dark small">What are you inquiring about?</label>
                            <select id="contactDept" class="form-select form-select-lg border bg-light fs-6" required>
                                <option value="" selected disabled>Choose operational desk...</option>
                                <option value="onboarding">Registration Fee & BVN Wallet Setup (₦6,000)</option>
                                <option value="savings">Fixed 50-Week Savings / Penalty Disputes</option>
                                <option value="food">Food Basket Contribution & Payout Cycles</option>
                                <option value="loans">Micro-Loans & Grants (0.1% Daily Interest)</option>
                                <option value="tech">Digital Utilities / GFL Crypto Token Core</option>
                            </select>
                        </div>

                        <!-- Message Box -->
                        <div class="col-12">
                            <label for="contactMessage" class="form-label fw-semibold text-dark small">Message Details</label>
                            <textarea id="contactMessage" class="form-control border bg-light fs-6" rows="4" placeholder="Describe your issue or query clearly..." required></textarea>
                        </div>

                        <!-- Submit Button -->
                        <div class="col-12 pt-2">
                            <button type="submit" class="btn btn-success btn-lg w-100 rounded-pill py-3 fw-medium transition-all shadow-sm d-flex align-items-center justify-content-center gap-2">
                                <i class="bi bi-shield-lock"></i> Send Secure Message
                            </button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
</section>


<!-- Footer Section -->
<footer class="bg-dark text-white pt-5 pb-3 position-relative border-top border-success border-4">
    <!-- Inner Container -->
    <div class="container pt-lg-4">
        <div class="row g-4 justify-content-between mb-5">
            
            <!-- Column 1: Brand Pitch & Core Compliance Statement -->
            <div class="col-12 col-lg-4">
                <div class="mb-3">
                    <a class="navbar-brand d-flex align-items-center text-white text-decoration-none" href="#">
                        <span class="logo-icon d-flex align-items-center justify-content-center me-2 bg-success rounded-3" style="width: 35px; height: 35px;">
                            <i class="bi bi-wallet2 text-white fs-6"></i>
                        </span>
                        <span class="fs-4 fw-bold tracking-tight">GFL<span class="text-success">.</span></span>
                    </a>
                </div>
                <p class="text-secondary small mb-4">
                    GFL is a unified fintech ecosystem merging commercial banking solutions with high-yield cooperative asset management, micro-grants, and structured food inflation protection savings slots.
                </p>
                <!-- Essential Risk Callout Text -->
                <div class="p-3 bg-secondary-subtle bg-opacity-10 rounded-4 border-start border-warning border-3 mb-2">
                    <span class="text-warning small d-block fw-semibold mb-1"><i class="bi bi-exclamation-triangle-fill me-1"></i> Weekly Operational Mandate</span>
                    <p class="text-secondary p-0 m-0 custom-lh-sm" style="font-size: 0.75rem;">
                        All slot portfolios must maintain an active funding balance before Saturday midnight. Delayed deposits prompt immediate system automated double fines. 
                    </p>
                </div>
            </div>

            <!-- Column 2: Digital Banking Utilities Services Links -->
            <div class="col-6 col-sm-4 col-lg-2">
                <h6 class="fw-bold text-white mb-3 text-uppercase tracking-wider small">Core Ecosystem</h6>
                <ul class="list-unstyled vstack gap-2 small">
                    <li><a href="#" class="text-secondary text-decoration-none transition-all hover-link-success">Instant Bank Transfers</a></li>
                    <li><a href="#" class="text-secondary text-decoration-none transition-all hover-link-success">Utility Bills Payment</a></li>
                    <li><a href="#" class="text-secondary text-decoration-none transition-all hover-link-success">Airtime & Data Topup</a></li>
                    <li><a href="#" class="text-secondary text-decoration-none transition-all hover-link-success">Fixed 50-Wks Ledger</a></li>
                    <li><a href="#" class="text-secondary text-decoration-none transition-all hover-link-success">Micro Loans Portal</a></li>
                </ul>
            </div>

            <!-- Column 3: Food Basket & Incentive Tiers Links -->
            <div class="col-6 col-sm-4 col-lg-2">
                <h6 class="fw-bold text-white mb-3 text-uppercase tracking-wider small">Incentive Schemes</h6>
                <ul class="list-unstyled vstack gap-2 small">
                    <li><a href="#" class="text-secondary text-decoration-none transition-all hover-link-success">Food Basket Savings</a></li>
                    <li><a href="#" class="text-secondary text-decoration-none transition-all hover-link-success">₦100 Daily Food Slot</a></li>
                    <li><a href="#" class="text-secondary text-decoration-none transition-all hover-link-success">₦200 Daily Economy</a></li>
                    <li><a href="#" class="text-secondary text-decoration-none transition-all hover-link-success">₦300 Premium Matrix</a></li>
                    <li><a href="#" class="text-secondary text-decoration-none transition-all hover-link-success">₦700 Ultimate Commodity</a></li>
                </ul>
            </div>

            <!-- Column 4: Newsletter & Tokenization Framework Info -->
            <div class="col-12 col-sm-4 col-lg-3">
                <h6 class="fw-bold text-white mb-3 text-uppercase tracking-wider small">GFL Native Coin Node</h6>
                <p class="text-secondary small mb-3">Subscribe to receive exclusive access metrics, whitepaper indicators, and our platform launch release dates.</p>
                
                <form class="input-group mb-3">
                    <input type="email" class="form-control bg-transparent border-secondary text-white placeholder-secondary text-sm rounded-start-pill py-2.5 px-3 fs-7" placeholder="Your work email" required style="font-size: 0.85rem;">
                    <button class="btn btn-success rounded-end-pill px-3" type="submit"><i class="bi bi-send-fill"></i></button>
                </form>

                <!-- Social Vectors Connect handles -->
                <div class="d-flex gap-2">
                    <a href="#" class="btn btn-sm btn-outline-secondary rounded-circle d-inline-flex align-items-center justify-content-center" style="width:32px; height:32px;"><i class="bi bi-facebook"></i></a>
                    <a href="#" class="btn btn-sm btn-outline-secondary rounded-circle d-inline-flex align-items-center justify-content-center" style="width:32px; height:32px;"><i class="bi bi-twitter-x"></i></a>
                    <a href="#" class="btn btn-sm btn-outline-secondary rounded-circle d-inline-flex align-items-center justify-content-center" style="width:32px; height:32px;"><i class="bi bi-instagram"></i></a>
                    <a href="#" class="btn btn-sm btn-outline-secondary rounded-circle d-inline-flex align-items-center justify-content-center" style="width:32px; height:32px;"><i class="bi bi-linkedin"></i></a>
                </div>
            </div>

        </div>

        <hr class="border-secondary opacity-20 my-4">

        <!-- Bottom Copyright, Verification Trust Badges and Regulatory Text -->
        <div class="row g-3 align-items-center justify-content-between small text-secondary">
            <div class="col-12 col-md-6 text-center text-md-start">
                <p class="m-0 mb-1">&copy; 2026 GFL Financial Cooperative Platforms Inc. All Rights Reserved.</p>
                <span class="fw-normal text-muted" style="font-size: 0.72rem;">BVN verification protocol integration protected under standard regulatory guidelines. Referral ROI eligibility resets metrics exactly one month from node setup.</span>
            </div>
            
            <!-- Visual Trust Badges (Simulating Secure Payments Providers) -->
            <div class="col-12 col-md-6 text-center text-md-end">
                <div class="d-inline-flex flex-wrap align-items-center justify-content-center justify-content-md-end gap-3 opacity-50">
                    <span class="d-flex align-items-center gap-1 text-uppercase font-monospace tracking-widest text-xs" style="font-size: 0.7rem;"><i class="bi bi-shield-fill-check text-success"></i> Secured Nodes</span>
                    <span class="d-flex align-items-center gap-1 text-uppercase font-monospace tracking-widest text-xs" style="font-size: 0.7rem;"><i class="bi bi-cpu-fill text-success"></i> Auto Ledger</span>
                </div>
            </div>
        </div>
    </div>
</footer>
<style>
    /* Footer Custom Utility Elements */
.hover-link-success {
    transition: color 0.25s cubic-bezier(0.4, 0, 0.2, 1);
}

.hover-link-success:hover {
    color: var(--gfl-green) !important;
    padding-left: 3px; /* Soft hover pull indicator */
}

.placeholder-secondary::placeholder {
    color: #6c757d !important;
    opacity: 0.6;
}

.custom-lh-sm {
    line-height: 1.4 !important;
}

.fs-7 {
    font-size: 0.85rem !important;
}
</style>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="script.js"></script>

    <script>
        document.addEventListener("DOMContentLoaded", function () {
    // Select calculator elements
    const slotInput = document.getElementById("slotCount");
    const weeklyDebitOut = document.getElementById("weeklyDebitOut");
    const totalContributionOut = document.getElementById("totalContributionOut");
    const roiPayoutOut = document.getElementById("roiPayoutOut");
    const grandTotalOut = document.getElementById("grandTotalOut");
    const penaltyFineOut = document.getElementById("penaltyFineOut");

    // Constants based on business parameters
    const BASE_WEEKLY_SLOT_RATE = 1500;
    const TOTAL_WEEKS = 50;
    const INTEREST_RATE = 0.30; // 30% flat yield

    function calculateSavings() {
        // Fallback to 0 if input values are invalid or cleared
        let slots = parseInt(slotInput.value);
        if (isNaN(slots) || slots < 1) slots = 0;

        // Perform equations 
        const weeklyDebit = slots * BASE_WEEKLY_SLOT_RATE;
        const totalContribution = weeklyDebit * TOTAL_WEEKS;
        const roiPayout = totalContribution * INTEREST_RATE;
        const grandTotal = totalContribution + roiPayout;
        
        // Penalty is calculated as: double of the money contributed times total slots
        // (i.e. 2 * weekly contribution rate per slot * number of slots)
        const penaltyFine = 2 * BASE_WEEKLY_SLOT_RATE * slots;

        // Format values to Nigerian Currency Display format (NGN)
        weeklyDebitOut.textContent = "₦" + weeklyDebit.toLocaleString();
        totalContributionOut.textContent = "₦" + totalContribution.toLocaleString();
        roiPayoutOut.textContent = "₦" + roiPayout.toLocaleString();
        grandTotalOut.textContent = "₦" + grandTotal.toLocaleString();
        penaltyFineOut.textContent = "₦" + penaltyFine.toLocaleString();
    }

    // Attach reactive trigger handle listeners
    slotInput.addEventListener("input", calculateSavings);
    slotInput.addEventListener("change", calculateSavings);
});



document.addEventListener("DOMContentLoaded", function () {
    
    // Check if ScrollReveal is loaded globally on the window
    if (typeof ScrollReveal !== 'undefined') {
        
        // Initialize Base configuration
        const sr = ScrollReveal({
            origin: 'bottom',
            distance: '60px',
            duration: 1000,
            delay: 200,
            easing: 'cubic-bezier(0.5, 1, 0.89, 1)',
            mobile: true,
            reset: false // Keeps elements static once revealed
        });

        // 1. Reveal basic Fade-Up items
        sr.reveal('[data-reveal="fade-up"]');

        // 2. Reveal Left-sliding items
        sr.reveal('[data-reveal="fade-left"]', {
            origin: 'right',
            distance: '50px'
        });

        // 3. Reveal Right-sliding items
        sr.reveal('[data-reveal="fade-right"]', {
            origin: 'left',
            distance: '50px'
        });

    } else {
        console.warn("ScrollReveal CDN missing or failed to initialize.");
    }
});


document.addEventListener("DOMContentLoaded", function () {
    const contactForm = document.getElementById("gflContactForm");

    if (contactForm) {
        contactForm.addEventListener("submit", function (e) {
            e.preventDefault(); // Prevents page reload

            // Extract data values safely
            const name = document.getElementById("contactName").value.trim();
            const department = document.getElementById("contactDept").value;

            // --- Custom Alert Integration Hook ---
            // If using standard sweetalert2, alertjs, or custom layouts, hook them right here:
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    title: 'Ticket Logged!',
                    text: `Hello ${name}, your query has been routed to our ${department} unit. We will respond within 24 business hours.`,
                    icon: 'success',
                    confirmButtonColor: '#198754'
                });
            } else {
                // Fallback elegant native alert if script libraries are loading slowly
                alert(`Thank you, ${name}! Your secure message has been received and routed to our dedicated teams.`);
            }

            // Reset the form fields smoothly
            contactForm.reset();
        });
    }
});
    </script>
</body>
</html>