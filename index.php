<?php 
include __DIR__."/conn.php";
session_start();
$data=parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$protocol = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') ? "https://" : "http://";
$company_info=[
    "name" => "monimate",
    "title" => "",
    "logo" => "/pygg.png",
    "description" => "", 
    "server" => $protocol . $_SERVER['HTTP_HOST'] . "/api/index.php"
];
switch ($data) {
    case '/':
    case '/home':
        include __DIR__."/pages/home.php"; 
        break;

    case '/login':
       include __DIR__."/pages/login.html"; 
        break;
    
    case '/signup':
       include __DIR__."/pages/signup.php"; 
        break;
    
    case '/confirm-passcode':
         include __DIR__."/pages/passcode.php"; 
        break;
    
    case '/create-pin':
         include __DIR__."/pages/member/create-pin.php"; 
        break;
    
    case '/reset-password':
         include __DIR__."/pages/reset-password.php"; 
        break;
    
    
    case '/signup-bvn':
       include __DIR__."/pages/bvn.php"; 
        break;
    
    case '/signup-face-caption':
            include __DIR__."/pages/face-caption.php"; 
        break;
    
    case '/forget-password':
    case '/forgot-password':
            include __DIR__."/pages/forget-password.php"; 
        break;
    
    case '/passcode':
            include __DIR__."/pages/passcode.php"; 
        break;

   /* =================================
      member start here
   ===================================================== */     
    
    case '/dashboard':
    case '/member':
            include __DIR__."/pages/member/index.php"; 
        break;
    
    default:

        break;
}