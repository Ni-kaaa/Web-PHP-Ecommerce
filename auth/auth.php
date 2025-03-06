<?php
require_once("../lib/db.php");
class Auth
{
  private $db;

  public function __construct()
  {
    session_start();
    $this->db = new Database();
  }

  public function register($username, $password, $fullname = null, $contact = '', $enable = 1, $role = "customer")
  {
    $existingUser = $this->db->select("tb_user", "*", "name = '$username'");
    if ($existingUser) {
      return "Username already exists!";
    }
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
    $data = [
      "name" => $username,
      "password" => $hashedPassword,
      "fullname" => $fullname,
      "role" => $role,
      "contact" => $contact,
      "enable" => $enable
    ];

    return $this->db->insert("tb_user", $data) ? "Registration successful!" : "Error in registration.";
  }

  public function login($username, $password)
  {
    $user = $this->db->select("tb_user", "*", "name = '$username'");

    if (!$user || password_verify($password, $user[0]["password"])) {
      return "Invalid username or password!";
    }

    $_SESSION["user_id"] = $user[0]["id"];
    $_SESSION["name"] = $user[0]["username"];
    $_SESSION["role"] = $user[0]["role"];

    $token = bin2hex(random_bytes(32));
    setcookie("auth_token", $token, time() + (86400 * 30), "/", "", false, true);

    $this->db->insert("tb_user_token", [
      "user_id" => $user[0]["id"],
      "token" => $token,
      "expires_at" => date("Y-m-d H:i:s", time() + (86400 * 30))
    ]);

    return "Login successful!";
  }

  public function is_logged_in()
  {
    if (isset($_SESSION["user_id"])) {
      return true;
    }

    if (isset($_COOKIE["auth_token"])) {
      $token = $_COOKIE["auth_token"];
      $userToken = $this->db->select("tb_user_token", "user_id", "token = '$token' AND expires_at > NOW()");

      if ($userToken) {
        $_SESSION["user_id"] = $userToken[0]["user_id"];
        return true;
      }
    }

    return false;
  }

  public function logout()
  {
    session_start();
    session_unset();
    session_destroy();
    setcookie("auth_token", "", time() - 3600, "/");
  }
}
