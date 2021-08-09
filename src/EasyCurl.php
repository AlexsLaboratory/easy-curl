<?php

namespace Lowem\EasyCurl;

class EasyCurl {
  private $conn;
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
  public function getExecMessage(): string {
    return $this->exec_message;
  }

  /**
   * @throws HTTPRequestException
   */
  private function errorCheck() {
    if (!curl_errno($this->conn)) {
      switch ($http_code = curl_getinfo($this->conn, CURLINFO_RESPONSE_CODE)) {
        case $http_code >= 200 && $http_code <= 226:
          break;
        default:
          throw new HTTPRequestException("", $http_code);
      }
    }
  }

  /**
   * @throws HTTPRequestException
   */
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
    $this->errorCheck();
  }

  /**
   * @throws HTTPRequestException
   */
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
    $this->errorCheck();
  }

  /**
   * @throws HTTPRequestException
   */
  public function get($header = []) {
    curl_setopt_array($this->conn, [
      CURLOPT_RETURNTRANSFER => TRUE,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => TRUE,
      CURLOPT_CUSTOMREQUEST => 'GET',
      CURLOPT_HTTPHEADER => $header
    ]);
    $this->exec_message = curl_exec($this->conn);
    $this->errorCheck();
  }

  /**
   * @throws HTTPRequestException
   */
  public function delete($header = []) {
    curl_setopt_array($this->conn, [
      CURLOPT_RETURNTRANSFER => TRUE,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => TRUE,
      CURLOPT_CUSTOMREQUEST => 'DELETE',
      CURLOPT_HTTPHEADER => $header
    ]);
    $this->exec_message = curl_exec($this->conn);
    $this->errorCheck();
  }

  public function close() {
    curl_close($this->conn);
  }
}