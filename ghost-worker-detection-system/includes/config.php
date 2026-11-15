<?php
session_start();
function db(){static $p=null;if(!$p)$p=new PDO('mysql:host=localhost;dbname=ghost_worker_db;charset=utf8mb4','root','',[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC]);return $p;}
function e($v){return htmlspecialchars((string)$v,ENT_QUOTES,'UTF-8');}
function auth(){if(empty($_SESSION['user'])){header('Location: login.php');exit;}}
function role($a){auth();if(!in_array($_SESSION['user']['role'],$a,true)){http_response_code(403);exit('Access denied');}}
function token(){if(empty($_SESSION['token']))$_SESSION['token']=bin2hex(random_bytes(24));return $_SESSION['token'];}
function check(){if(!hash_equals($_SESSION['token']??'',$_POST['token']??'')){http_response_code(400);exit('Invalid form token');}}
function log_action($a,$d=''){if(!empty($_SESSION['user'])){$s=db()->prepare('INSERT INTO audit_logs(user_id,action,details) VALUES(?,?,?)');$s->execute([$_SESSION['user']['id'],$a,$d]);}}
function head($t){echo '<!doctype html><html lang="en"><head><meta charset="utf-8"><meta name="viewport" content="width=device-width,initial-scale=1"><title>'.e($t).'</title><link rel="stylesheet" href="assets/css/style.css"></head><body>';if(!empty($_SESSION['user'])){echo '<header><b>GWDS</b><span>'.e($_SESSION['user']['full_name']).' · '.e($_SESSION['user']['role']).'</span><a href="logout.php">Logout</a></header><nav><a href="index.php">Dashboard</a><a href="employees.php">Employees</a><a href="payroll.php">Payroll</a><a href="investigations.php">Investigations</a><a href="import.php">CSV Import</a><a href="reports.php">Reports</a><a href="users.php">Users</a><a href="audit.php">Audit</a>'.(($_SESSION['user']['role']==='admin')?'<a href="change_password.php">Change Password</a>':'').'</nav><main>'; }else echo '<main class="auth">';if(!empty($_SESSION['flash'])){echo '<p class="notice">'.e($_SESSION['flash']).'</p>';unset($_SESSION['flash']);}}
function foot(){echo '</main><footer>Ghost Worker Detection System · Academic prototype</footer></body></html>';}
