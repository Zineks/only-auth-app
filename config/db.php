<?php
$host = 'localhost';
$db = 'auth_app_db';
$user = 'root';
$pass = 'mysql';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES   => false,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    global $pdo;
} catch (PDOException $e) {
    echo "Ошибка подключения: " . $e->getMessage();
    throw new PDOException($e->getMessage(), (int)$e->getCode());
}

function selectAll($table, $params = []) {
    global $pdo;
    $sql = "SELECT * FROM $table";

    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key => $value) {
            if (!is_numeric($value)) {
                $value = "'".$value."'";
            }
            if ($i === 0) {
                $sql .= " WHERE $key = $value";
            } else {
                $sql .= " AND $key = $value";
            }
            $i++;
        }
    }

    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetchAll(PDO::FETCH_ASSOC);
}

function selectOne($table, $params = []) {
    global $pdo;
    $sql = "SELECT * FROM $table";

    if (!empty($params)) {
        $i = 0;
        foreach ($params as $key => $value) {
            if (!is_numeric($value)) {
                $value = "'".$value."'";
            }
            if ($i === 0) {
                $sql .= " WHERE $key = $value";
            } else {
                $sql .= " AND $key = $value";
            }
            $i++;
        }
    }

    $query = $pdo->prepare($sql);
    $query->execute();
    return $query->fetch(PDO::FETCH_ASSOC);
}

function insert($table, $params) {
    global $pdo;
    $columns = implode(", ", array_keys($params));
    $values = implode(", ", array_map(function($value) {
        return "'".$value."'";
    }, array_values($params)));

    $sql = "INSERT INTO $table ($columns) VALUES ($values)";

    $query = $pdo->prepare($sql);
    $query->execute();
    return $pdo->lastInsertId();
}


function update($table, $id, $params) {
    global $pdo;

    $setParts = [];
    foreach ($params as $key => $value) {
        $setParts[] = "$key = :$key";
    }
    $setString = implode(", ", $setParts);

    $sql = "UPDATE $table SET $setString WHERE id = :id";

    $query = $pdo->prepare($sql);

    $params['id'] = $id;

    $query->execute($params);
}
