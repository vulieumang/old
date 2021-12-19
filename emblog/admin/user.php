<?php
/**
 * Quan ly nguoi dung
 * @copyright (c) Emlog All Rights Reserved
 * $Id: user.php 1791 2010-10-21 14:35:27Z emloog $
 */

require_once 'globals.php';

$User_Model = new User_Model();

// Nap thogn tin nguoi dung
if ($action == '') {
	$users = $User_Model->getUsers();
	include View::getView('header');
	require_once View::getView('user');
	include View::getView('footer');
	View::output();
}
if ($action== 'new') {
	$login = isset($_POST['login']) ? addslashes(trim($_POST['login'])) : '';
	$password = isset($_POST['password']) ? addslashes(trim($_POST['password'])) : '';
	$password2 = isset($_POST['password2']) ? addslashes(trim($_POST['password2'])) : '';
	$role = 'writer';// Nhom nguoi dung: Nguoi viet cung

	if ($login == '') {
		header("Location: ./user.php?error_login=true");
		exit;
	}
	if ($User_Model->isUserExist($login)) {
		header("Location: ./user.php?error_exist=true");
		exit;
	}
	if (strlen($password) < 6) {
		header("Location: ./user.php?error_pwd_len=true");
		exit;
	}
	if ($password != $password2) {
		header("Location: ./user.php?error_pwd2=true");
		exit;
	}

	$PHPASS = new PasswordHash(8, true);
	$password = $PHPASS->HashPassword($password);

	$User_Model->addUser($login, $password, $role);
	$CACHE->updateCache(array('sta','user'));
	header("Location: ./user.php?active_add=true");
}
if ($action== 'edit') {
	$uid = isset($_GET['uid']) ? intval($_GET['uid']) : '';

	$data = $User_Model->getOneUser($uid);
	extract($data);

	include View::getView('header');
	require_once View::getView('useredit');
	include View::getView('footer');View::output();
}
if ($action=='update') {
	$login = isset($_POST['username']) ? addslashes(trim($_POST['username'])) : '';
	$nickname = isset($_POST['nickname']) ? addslashes(trim($_POST['nickname'])) : '';
	$password = isset($_POST['password']) ? addslashes(trim($_POST['password'])) : '';
	$password2 = isset($_POST['password2']) ? addslashes(trim($_POST['password2'])) : '';
	$email = isset($_POST['email']) ? addslashes(trim($_POST['email'])) : '';
	$description = isset($_POST['description']) ? addslashes(trim($_POST['description'])) : '';
	$uid = isset($_POST['uid']) ? intval($_POST['uid']) : '';

	if ($login == '') {
		header("Location: ./user.php?action=edit&uid={$uid}&error_login=true");
		exit;
	}
	if ($User_Model->isUserExist($login, $uid)) {
		header("Location: ./user.php?action=edit&uid={$uid}&error_exist=true");
		exit;
	}
	if (strlen($password) > 0 && strlen($password) < 6) {
		header("Location: ./user.php?action=edit&uid={$uid}&error_pwd_len=true");
		exit;
	}
	if ($password != $password2) {
		header("Location: ./user.php?action=edit&uid={$uid}&error_pwd2=true");
		exit;
	}

    $userData = array('username'=>$login, 
                        'nickname'=>$nickname, 
                        'email'=>$email, 
                        'description'=>$description
                        );

    if (!empty($password)) {
    	$PHPASS = new PasswordHash(8, true);
    	$password = $PHPASS->HashPassword($password);
        $userData['password'] = $password;
    }

	$User_Model->updateUser($userData, $uid);
	$CACHE->updateCache('user');
	header("Location: ./user.php?active_update=true");
}
if ($action== 'del') {
	$users = $User_Model->getUsers();
	$uid = isset($_GET['uid']) ? intval($_GET['uid']) : '';
	$User_Model->deleteUser($uid);
	$CACHE->updateCache(array('sta','user'));
	header("Location: ./user.php?active_del=true");
}
