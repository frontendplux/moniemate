CREATE TABLE IF NOT EXISTS users (
    id BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,

    uid VARCHAR(50) NOT NULL UNIQUE,

    /* Banking Details */
    account_number VARCHAR(20) NOT NULL UNIQUE,
    account_name VARCHAR(255) NOT NULL,

    account_type ENUM(
        'savings',
        'current',
        'business',
        'fixed'
    ) DEFAULT 'savings',

    account_level ENUM(
        'tier1',
        'tier2',
        'tier3'
    ) DEFAULT 'tier1',

    currency VARCHAR(10) NOT NULL DEFAULT 'NGN',

    balance DECIMAL(18,2) NOT NULL DEFAULT 0.00,
    available_balance DECIMAL(18,2) NOT NULL DEFAULT 0.00,
    total_credit DECIMAL(18,2) NOT NULL DEFAULT 0.00,
    total_debit DECIMAL(18,2) NOT NULL DEFAULT 0.00,

    daily_transfer_limit DECIMAL(18,2) DEFAULT 50000.00,

    /* Personal Information */
    first_name VARCHAR(100) NOT NULL,
    middle_name VARCHAR(100) DEFAULT NULL,
    last_name VARCHAR(100) NOT NULL,

    date_of_birth DATE DEFAULT NULL,
    gender ENUM('male','female','other') DEFAULT NULL,

    occupation VARCHAR(150) DEFAULT NULL,

    /* Contact */
    email VARCHAR(255) NOT NULL UNIQUE,
    password_hash VARCHAR(255) NOT NULL,

    phone VARCHAR(30) NOT NULL,
    phone_code VARCHAR(10) NOT NULL,
    country_code VARCHAR(5) NOT NULL,
    country VARCHAR(100) NOT NULL,

    address TEXT,
    city VARCHAR(100) DEFAULT NULL,
    state VARCHAR(100) DEFAULT NULL,
    postal_code VARCHAR(20) DEFAULT NULL,

    /* Verification */
    email_verified TINYINT(1) DEFAULT 0,
    phone_verified TINYINT(1) DEFAULT 0,

    kyc_status ENUM(
        'pending',
        'verified',
        'rejected'
    ) DEFAULT 'pending',

    bvn VARCHAR(20) DEFAULT NULL,
    nin VARCHAR(20) DEFAULT NULL,

    /* Security */
    transaction_pin_hash VARCHAR(255) DEFAULT NULL,
    pin_created TINYINT(1) DEFAULT 0,

    forgot_pin VARCHAR(20) DEFAULT NULL,
    forgot_pin_expires DATETIME DEFAULT NULL,

    failed_pin_attempts INT DEFAULT 0,

    login_token VARCHAR(255) DEFAULT NULL,
    login_token_expires DATETIME DEFAULT NULL,

    login_attempts INT DEFAULT 0,

    /* Session Information */
    last_login DATETIME DEFAULT NULL,
    last_transaction DATETIME DEFAULT NULL,

    last_ip VARCHAR(45) DEFAULT NULL,
    last_device TEXT DEFAULT NULL,

    /* Account Status */
    account_status ENUM(
        'active',
        'pending',
        'suspended',
        'blocked',
        'closed'
    ) DEFAULT 'active',

    account_frozen TINYINT(1) DEFAULT 0,

    /* Profile */
    profile_photo VARCHAR(255) DEFAULT NULL,

    preferred_language VARCHAR(20) DEFAULT 'en',

    referral_code VARCHAR(50) DEFAULT NULL,
    referred_by VARCHAR(50) DEFAULT NULL,

    is_admin TINYINT(1) DEFAULT 0,

    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
        ON UPDATE CURRENT_TIMESTAMP,

    INDEX idx_uid (uid),
    INDEX idx_email (email),
    INDEX idx_phone (phone),
    INDEX idx_account_number (account_number),
    INDEX idx_country (country),
    INDEX idx_status (account_status),
    INDEX idx_login_token (login_token),
    INDEX idx_bvn (bvn),
    INDEX idx_nin (nin)
);


