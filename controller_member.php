<?php
include("model_member.php");

session_start(); // start session to store memberlist in session

// create session memberlist if not exist
if (!isset($_SESSION['memberlist'])) {
    $_SESSION['memberlist'] = array();
}

function createMember() {
    $member = new model_member();
    $member->name = $_POST['inputName'];
    $member->phone = $_POST['inputPhone'];
    $member->email = $_POST['inputEmail'];
    $member->note = $_POST['inputNote'];
    array_push($_SESSION['memberlist'], $member);
}

function getAllMembers() {
    return $_SESSION['memberlist'];
}

function deleteMember($memberIndex) {
    unset($_SESSION['memberlist'][$memberIndex]); // array index = 0,1,2
}

function getMemberWithId($memberID) {
    return $_SESSION['memberlist'][$memberID];
}

function updateMember($memberID) {
    $member = $_SESSION['memberlist'][$memberID]; //ambil data dengan index tertentu
    $member->name = $_POST['inputName'];
    $member->phone = $_POST['inputPhone'];
    $member->email = $_POST['inputEmail'];
    $member->note = $_POST['inputNote'];
}

// jika button register di klik
if (isset($_POST['button_register'])) {
    createMember();
    header("Location: view_member.php"); //kembali ke halaman utama
    exit();
}

// jika button delete di klik  
if (isset($_GET['deleteID'])) {
    $memberIndex = $_GET['deleteID'];
    deleteMember($memberIndex);
    header("Location: view_member.php"); //kembali ke halaman utama
    exit();
}

// jika button update di klik
if (isset($_POST['button_update'])) {
    updateMember($_POST['input_id']);
    header("Location: view_member.php"); //kembali ke halaman utama
    exit();
}
?>