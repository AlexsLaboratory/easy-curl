<h3 align="center">Easy Curl</h3>

<div align="center">

[![Status](https://img.shields.io/badge/status-active-success.svg?style=flat-square)]()
![GitHub issues](https://img.shields.io/github/issues/Lowe-Man/easy-curl?style=flat-square)
![GitHub pull requests](https://img.shields.io/github/issues-pr/Lowe-Man/easy-curl?style=flat-square)
![GitHub](https://img.shields.io/github/license/Lowe-Man/easy-curl?color=blue&style=flat-square)
![GitHub tag (latest SemVer)](https://img.shields.io/github/v/tag/Lowe-Man/easy-curl?label=release&style=flat-square)

</div>

---

<p align="center"> This is a PHP wrapper for cURL
    <br> 
</p>

## 📝 Table of Contents

- [About](#about)
    - [Changelog](CHANGELOG.md)
- [Getting Started](#getting_started)
- [API Usage](#api_usage)
- [Authors](#authors)

## 🧐 About <a name="about"></a>

---
This project was created to help developers easily interact with the underlying cURL API.

## 🏁 Getting Started <a name="getting_started"></a>

---
These instructions will get you a copy of Easy Curl up and running.

### Prerequisites

In order to install this package you have to install `composer` which can be done by following the steps based on your system [here](https://getcomposer.org/doc/00-intro.md).

If you have not done so already run `composer init` in the root of your project directory, do so now to start using composer. Just follow the prompts as they appear.

### Installing

To install Easy Curl run the command below while in your project root.

```php
composer require lowem/easy-curl
```

Create a new PHP file and add the code below to the top of the file to automatically load in the package as well as any others you may have installed. The `use` statement prevents you from having to type in the full namespace of the package.

```php
require_once "vendor/autoload.php";
use Lowem\EasyCurl\EasyCurl;
```

## 🎈 API Usage <a name="api_usage"></a>

### GET Request `get(header)`

- `header`: This is an array of [HTTP header fields](https://en.wikipedia.org/wiki/List_of_HTTP_header_fields)
    - **Example**:
        ```php
        [
          "Content-Type: application/json",
          "Accept: application/json"
        ]
        ```
  #### Example Usage:
  ```php
  $test = new EasyCurl("https://jsonplaceholder.typicode.com/posts");
  try {
    $test->get();
  } catch (HTTPRequestException $e) {
    echo $e->getCustomMessage();
  }
  print_r($test->getExecMessage());

  $test->close();
  ```

### POST Request `post(postFields, header)`

- `postFields`: This is the data that you want to send to the API. It can be JSON, XML, an array with key value pairs, etc.
    - **Example**:
        ```php
        [
          "title" => "foo",
          "body" => "bar",
          "userId" => 1
        ]
        ```
- `header`: This is an array of [HTTP header fields](https://en.wikipedia.org/wiki/List_of_HTTP_header_fields)
    - **Example**:
        ```php
        [
          "Content-Type: application/json",
          "Accept: application/json"
        ]
        ```
  #### Example Usage:
  ```php
  $test = new EasyCurl("https://jsonplaceholder.typicode.com/posts");
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
    echo $e->getCustomMessage();
  }
  print_r($test->getExecMessage());
  
  $test->close();
  ```

### PUT Request `put(postFields, header)`

- `postFields`: This is the data that you want to send to the API. It can be JSON, XML, an array with key value pairs, etc.
    - **Example**:
        ```php
        [
          "id" => 1,
          "title" => "foo",
          "body" => "bar",
          "userId" => 1
        ]
        ```
- `header`: This is an array of [HTTP header fields](https://en.wikipedia.org/wiki/List_of_HTTP_header_fields)
    - **Example**:
        ```php
        [
          "Content-Type: application/json",
          "Accept: application/json"
        ]
        ```
  #### Example Usage:
  ```php
  $test = new EasyCurl("https://jsonplaceholder.typicode.com/posts/1");
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
    echo $e->getCustomMessage();
  }
  print_r($test->getExecMessage());
  
  $test->close();
  ```

### DELETE Request `delete()`

<ul style="list-style-type:none;">

#### Example Usage:

```php
$test = new EasyCurl("https://jsonplaceholder.typicode.com/posts/1");
try {
  $test->delete();
} catch (HTTPRequestException $e) {
  echo $e->getCustomMessage();
}
print_r($test->getExecMessage());

$test->close();
```

</ul>

## ✍️ Authors <a name="authors"></a>

- [@Lowe-Man](https://github.com/Lowe-Man) - Idea & Initial work

See also the list of [contributors](https://github.com/Lowe-Man/easy-curl/contributors) who participated in this project.
