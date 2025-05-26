<?php
include_once __DIR__ . '/config.php';

function createConnection() {
    $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if ($conn->connect_error) {
        die("Kết nối thất bại: " . $conn->connect_error);
    }
    return $conn;
}

function execute($conn, $sql) {
    $result = $conn->query($sql);
    return $result;
}

function executeResult($conn, $sql) {
    $result = $conn->query($sql);
    $data = [];
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    return $data;
}

function executeInsert($conn, $sql) {
    $conn->query($sql);
    return $conn->insert_id;
}

function executePrepared($conn, $sql, $params) {
    $stmt = $conn->prepare($sql);
    $stmt->execute($params);
    return $stmt;
}
?>