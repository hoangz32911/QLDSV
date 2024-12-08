<?php
$conn = new mysqli("localhost", "root", null, "admin-reg");

if ($conn->connect_error) {
    die("Ket noi khong thanh cong:" . $conn->connect_error);
}
