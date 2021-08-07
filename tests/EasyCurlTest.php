<?php

use Lowem\EasyCurl\EasyCurl;
use Lowem\EasyCurl\HTTPRequestException;
use PHPUnit\Framework\TestCase;

class EasyCurlTest extends TestCase {
  public function testPut() {
    $test = new EasyCurl("https://jsonplaceholder.typicode.com/posts/1");
    $error = FALSE;
    try {
      $data = [
        "id" => 1,
        "title" => "foo",
        "body" => "bar",
        "userId" => 1
      ];
      $test->put(json_encode($data), [
        "Content-type: application/json; charset=UTF-8",
      ]);
    } catch (HTTPRequestException $e) {
      $error = TRUE;
      echo $e->getCustomMessage();
    }
    self::assertFalse($error, "Something happened");
    print_r($test->getExecMessage());
    $test->close();
  }

  public function testPost() {
    $test = new EasyCurl("https://jsonplaceholder.typicode.com/posts");
    $error = FALSE;
    try {
      $data = [
        "title" => "foo",
        "body" => "bar",
        "userId" => 1
      ];
      $test->post(json_encode($data), [
        "Content-type: application/json; charset=UTF-8",
      ]);
    } catch (HTTPRequestException $e) {
      $error = TRUE;
      echo $e->getCustomMessage();
    }
    self::assertFalse($error, "Something happened");
    print_r($test->getExecMessage());

    $test->close();
  }

  public function testGet() {
    $test = new EasyCurl("https://jsonplaceholder.typicode.com/posts");
    $error = FALSE;
    try {
      $test->get();
    } catch (HTTPRequestException $e) {
      $error = TRUE;
      echo $e->getCustomMessage();
    }
    self::assertFalse($error, "Something happened");
    print_r($test->getExecMessage());

    $test->close();
  }

  public function testDelete() {
    $test = new EasyCurl("https://jsonplaceholder.typicode.com/posts/1");
    $error = FALSE;
    try {
      $test->delete();
    } catch (HTTPRequestException $e) {
      $error = TRUE;
      echo $e->getCustomMessage();
    }
    self::assertFalse($error, "Something happened");
    print_r($test->getExecMessage());

    $test->close();
  }
}
