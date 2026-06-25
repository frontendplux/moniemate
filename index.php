<?php 
include __DIR__."/conn.php";
session_start();
$data=parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
$company_info=[
    "name" => "",
    "title" => "",
    "description" => "", 
    "server" => "/api/index.php",
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
    
    case '/signup-bvn':
       include __DIR__."/pages/bvn.php"; 
        break;
    
    case '/signup-face-caption':
            include __DIR__."/pages/face-caption.php"; 
        break;
    
    case '/forget-password':
            include __DIR__."/pages/forget-password.php"; 
        break;
    
    case '/passcode':
            include __DIR__."/pages/passcode.php"; 
        break;
    
    case '/member':
            include __DIR__."/pages/member/index.php"; 
        break;
    
    default:

        break;
}