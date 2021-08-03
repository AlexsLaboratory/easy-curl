<?php

namespace Lowem\EasyCurl;

class EasyCurl {
  private $conn;
  private string $error_message = "";
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
  public function getErrorMessage(): string {
    return $this->error_message;
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

    if (curl_errno($this->conn)) {
      $this->error_message = curl_error($this->conn);
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
      CURLOPT_HTTPHEADER => $header,
    ]);
    $this->exec_message = curl_exec($this->conn);
    if (curl_errno($this->conn)) {
      $this->error_message = curl_error($this->conn);
    }
  }

  public function close() {
    curl_close($this->conn);
  }
}