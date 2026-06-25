<?php
   include __DIR__."/../conn.php";
   $data=json_decode(file_get_contents("php://input"), true) ?? $_POST ?? [];
   $action=$data['action'];
   switch ($action) {
    case '/auth/register':
        
        break;
    
    default:
        # code...
        break;
   }