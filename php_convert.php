<?php
// Establish default connection
global $link1;
$link1 = mysqli_connect("localhost", "username", "password", "database_name");

if (!$link1) {
    die("Connection failed: " . mysqli_connect_error());
}

// Wrapper for mysql_query
function mysql_query($query, $conn = null) {
    global $link1;
    $conn = $conn ?: $link1;

    $normalized = strtolower(trim($query));
    $charsetCommands = [
        'set character_set_results=utf8',
        'set names=utf8',
        'set character_set_client=utf8',
        'set character_set_connection=utf8',
        'set collation_connection=utf8_general_ci'
    ];

    if (in_array($normalized, $charsetCommands)) {
        return mysqli_set_charset($conn, 'utf8');
    }

    $result = mysqli_query($conn, $query);

    if ($result === false) {
        trigger_error("mysql_query() error: " . mysqli_error($conn) . " | Query: $query", E_USER_WARNING);
    }

    return $result;
}

// Fetch wrappers
function mysql_fetch_array($result) {
    return mysqli_fetch_array($result, MYSQLI_BOTH);
}

function mysql_fetch_assoc($result) {
    return mysqli_fetch_assoc($result);
}

function mysql_fetch_row($result) {
    return mysqli_fetch_row($result);
}

// Result info
function mysql_num_rows($result) {
    return mysqli_num_rows($result);
}

// Escape strings
function mysql_real_escape_string($string, $conn = null) {
    global $link1;
    $conn = $conn ?: $link1;
    return mysqli_real_escape_string($conn, $string);
}

function mysql_escape_string($string) {
    // Alias of mysql_real_escape_string
    return mysql_real_escape_string($string);
}

// Compatibility no-op
function mysql_select_db($dbname, $conn = null) {
    // Already selected in mysqli_connect
    return true;
}

// Insert info
function mysql_insert_id($conn = null) {
    global $link1;
    $conn = $conn ?: $link1;
    return mysqli_insert_id($conn);
}

// Error info
function mysql_error($conn = null) {
    global $link1;
    $conn = $conn ?: $link1;
    return mysqli_error($conn);
}

function mysql_affected_rows($conn = null) {
    global $link1;
    $conn = $conn ?: $link1;
    return mysqli_affected_rows($conn);
}
?>
