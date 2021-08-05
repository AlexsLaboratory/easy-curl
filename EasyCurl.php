<?php

namespace Lowem\EasyCurl;

class EasyCurl {
  private $conn;
  private string $error_code = "";
  private string $exec_message = "";

  public function __construct($url) {
    $this->conn = curl_init($url);
  }

  public function setBasicAuth($username, $password) {
    curl_setopt($this->conn, CURLOPT_USERPWD, "$username:$password");
  }

  /**
   * @return string
   */
  public function getErrorCode(): string {
    return $this->error_code;
  }

  /**
   * @return string
   */
  public function getExecMessage(): string {
    return $this->exec_message;
  }

  public function put($postField, $header = []) {
    curl_setopt_array($this->conn, [
      CURLOPT_CUSTOMREQUEST => "PUT",
      CURLOPT_ENCODING => "",
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => TRUE,
      CURLOPT_POSTFIELDS => $postField,
      CURLOPT_RETURNTRANSFER => TRUE,
      CURLOPT_HTTPHEADER => $header
    ]);
    $this->exec_message = curl_exec($this->conn);

    if (!curl_errno($this->conn)) {
      switch ($http_code = curl_getinfo($this->conn, CURLINFO_RESPONSE_CODE)) {
        case 200:
          break;
        default:
          $this->error_code = $http_code;
      }
    }
  }

  public function post($postField, $header = []) {
    curl_setopt_array($this->conn, [
      CURLOPT_RETURNTRANSFER => TRUE,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => TRUE,
      CURLOPT_CUSTOMREQUEST => 'POST',
      CURLOPT_POSTFIELDS => $postField,
      CURLOPT_HTTPHEADER => $header
    ]);
    $this->exec_message = curl_exec($this->conn);

    if (!curl_errno($this->conn)) {
      switch ($http_code = curl_getinfo($this->conn, CURLINFO_RESPONSE_CODE)) {
        case 200:
          break;
        default:
          $this->error_code = $http_code;
      }
    }
  }

  public function get() {
    curl_setopt_array($this->conn, [
      CURLOPT_RETURNTRANSFER => TRUE,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => TRUE,
      CURLOPT_CUSTOMREQUEST => 'GET'
    ]);
    $this->exec_message = curl_exec($this->conn);

    if (!curl_errno($this->conn)) {
      switch ($http_code = curl_getinfo($this->conn, CURLINFO_RESPONSE_CODE)) {
        case 200:
          break;
        default:
          $this->error_code = $http_code;
      }
    }
  }

  public function delete() {
    curl_setopt_array($this->conn, [
      CURLOPT_RETURNTRANSFER => TRUE,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => TRUE,
      CURLOPT_CUSTOMREQUEST => 'DELETE'
    ]);
    $this->exec_message = curl_exec($this->conn);

    if (!curl_errno($this->conn)) {
      switch ($http_code = curl_getinfo($this->conn, CURLINFO_RESPONSE_CODE)) {
        case 200:
          break;
        default:
          $this->error_code = $http_code;
      }
    }
  }

  public function close() {
    curl_close($this->conn);
  }
}