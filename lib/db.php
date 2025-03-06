<?php

class Database
{
	private $host = "127.0.0.1";
	private $user = "root";
	private $password = "";
	private $dbname = "vk-store";
	private $conn;

	public function __construct()
	{
		try {
			$dsn = "mysql:host={$this->host};dbname={$this->dbname};charset=utf8";
			$this->conn = new PDO($dsn, $this->user, $this->password);
			$this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		} catch (PDOException $e) {
			die("Connection failed: " . $e->getMessage());
		}
	}

	public function select($table, $columns = "*", $criteria = "", $clause = "")
	{
		$sql = "SELECT $columns FROM $table";
		if (!empty($criteria)) {
			$sql .= " WHERE $criteria";
		}
		if (!empty($clause)) {
			$sql .= " $clause";
		}
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_ASSOC);
	}

	public function insert($table, $data)
	{
		$fields = implode(", ", array_keys($data));
		$placeholders = ":" . implode(", :", array_keys($data));
		$sql = "INSERT INTO $table ($fields) VALUES ($placeholders)";
		$stmt = $this->conn->prepare($sql);
		return $stmt->execute($data);
	}

	public function update($table, $data, $criteria)
	{
		$setClause = "";
		foreach ($data as $key => $value) {
			$setClause .= "$key = :$key, ";
		}
		$setClause = rtrim($setClause, ", ");
		$sql = "UPDATE $table SET $setClause WHERE $criteria";
		$stmt = $this->conn->prepare($sql);
		return $stmt->execute($data);
	}

	public function delete($table, $column, $value)
	{
		$sql = "DELETE FROM $table WHERE $column = :value";
		$stmt = $this->conn->prepare($sql);
		$stmt->execute([":value" => $value]);
		$this->conn->exec("SET @num := 0;");
		$this->conn->exec("UPDATE $table SET id = @num := @num + 1;");
		$this->conn->exec("ALTER TABLE $table AUTO_INCREMENT = 1;");
		return true;
	}

	public function delete_User($table, $column, $value)
	{
		$sql = "DELETE FROM $table WHERE $column = :value";
		$stmt = $this->conn->prepare($sql);
		return $stmt->execute([":value" => $value]);
	}
	public function count($table, $criteria = "")
	{
		$sql = "SELECT COUNT(*) FROM $table";
		if (!empty($criteria)) {
			$sql .= " WHERE $criteria";
		}
		$stmt = $this->conn->prepare($sql);
		$stmt->execute();
		return $stmt->fetchColumn();
	}
}
