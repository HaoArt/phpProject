<?php
$hname = 'localhost';
$uname = 'root';
$pass = "";
$db = "hue_hotel";

$con = mysqli_connect($hname, $uname, $pass, $db);

if (!$con) {
    die("Không thể kết nối đến database" . mysqli_connect_error());
}


if (!function_exists('filteration')) {
    function filteration($data)
    {
        foreach ($data as $key => $value) {
            $data[$key] = trim($value);
            $data[$key] = stripcslashes($value);
            $data[$key] = htmlspecialchars($value);
            $data[$key] = strip_tags($value);
        }
        return $data;
    }
}
function select($sql, $value, $datatype)
{
    $con = $GLOBALS['con'];
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatype, ...$value);
        if (mysqli_stmt_execute($stmt)) {
            $res = mysqli_stmt_get_result($stmt);
            return $res;
        } else {
            die("Không thể thực hiện câu lệnh SELECT!!!");
        }
    } else {
        die("Không thể truy vấn dữ liệu!!!");
    }
}
function insert($sql, $value, $datatype)
{
    $con = $GLOBALS['con'];
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatype, ...$value);
        if (mysqli_stmt_execute($stmt)) {
            return true;
        } else {
            die("Không thể thực hiện câu lệnh insert!!!");
        }
    } else {
        die("Không thể truy vấn dữ liệu!!!");
    }
}
function update($sql, $value, $datatype)
{
    $con = $GLOBALS['con'];
    if ($stmt = mysqli_prepare($con, $sql)) {
        mysqli_stmt_bind_param($stmt, $datatype, ...$value);
        if (mysqli_stmt_execute($stmt)) {
            if (mysqli_stmt_affected_rows($stmt) > 0) {
                return true;
            } else {
                return false;
            }
        } else {
            die(" Không thể thực hiện câu lệnh UPDATE!!!");
        }
    } else {
        die(" Không thể chuẩn bị truy vấn dữ liệu!!!");
    }
}

function selectAll($tableName)
{
    $con = $GLOBALS['con'];

    if (!preg_match('/^[a-zA-Z0-9_]+$/', $tableName)) {
        die("Tên bảng không hợp lệ!");
    }

    $sql = "SELECT * FROM `$tableName`";

    $res = mysqli_query($con, $sql);
    if (!$res) {
        die("Không thể truy vấn dữ liệu: " . mysqli_error($con));
    }

    return $res;
}
