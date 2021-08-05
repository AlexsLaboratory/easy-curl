<?php

use Lowem\EasyCurl\EasyCurl;
use PHPUnit\Framework\TestCase;

class EasyCurlTest extends TestCase {
  public function testPut() {
    $test = new EasyCurl("http://192.168.160.137:8080/geoserver/rest/workspaces/World_Claim/coveragestores/test7/file.geotiff?configure=first&coverageName=test7");
    $test->setBasicAuth("admin", "geoserver");
    $file = file_get_contents('C:/Users/LoweM/Downloads/wc2.1_2.5m_prec_2010-2018/wc2.1_2.5m_prec_2010-01.tif');
    $test->put($file, [
      "Content-Type: image/tiff",
    ]);

    $this->assertEmpty($test->getErrorCode());
    $test->close();
  }

  public function testPost() {
    $test = new EasyCurl("http://192.168.160.137:8080/geoserver/rest/workspaces?default=false");
    $test->setBasicAuth("admin", "geoserver");
    $test->post("<?xml version=\"1.0\" encoding=\"UTF-8\"?>
<workspace>
    <name>Test11</name>
</workspace>", [
      "Content-Type: application/xml"
    ]);

    $this->assertEmpty($test->getErrorCode());
    $test->close();
  }

  public function testGet() {
    $test = new EasyCurl("http://192.168.160.137:8080/geoserver/rest/workspace");
    $test->setBasicAuth("admin", "geoserver");
    $test->get();
    print_r($test->getExecMessage());

    $this->assertEmpty($test->getErrorCode());
    $test->close();
  }

  public function testDelete() {
    $test = new EasyCurl("http://192.168.160.137:8080/geoserver/rest/workspaces/Test1?recurse=true");
    $test->setBasicAuth("admin", "geoserver");
    $test->delete();

    $this->assertEmpty($test->getErrorCode());
    $test->close();
  }
}
