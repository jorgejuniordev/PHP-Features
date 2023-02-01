<?php

// CRUD com mysqli
function createRecord($table, $data)
{
    $conn = connection();
    if (!$conn) return false;

    $fields = implode(", ", array_keys($data));
    $values = "'" . implode("', '", array_values($data)) . "'";

    $query = "INSERT INTO $table ($fields) VALUES ($values)";

    return mysqli_query($conn, $query);
}

function readRecords($table, $where = "")
{
    $conn = connection();
    if (!$conn) return [];

    $query = "SELECT * FROM $table";

    if (!empty($where)) {
        $query .= " WHERE $where";
    }

    $result = mysqli_query($conn, $query);
    if (!$result) return [];

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function updateRecord($table, $data, $where)
{
    $conn = connection();
    if (!$conn) return false;

    $set = "";
    foreach ($data as $field => $value) {
        $set .= "$field = '$value', ";
    }

    $set = rtrim($set, ", ");

    $query = "UPDATE $table SET $set WHERE $where";

    return mysqli_query($conn, $query);
}

function deleteRecord($table, $where)
{
    $conn = connection();
    if (!$conn) return false;

    $query = "DELETE FROM $table WHERE $where";

    return mysqli_query($conn, $query);
}
