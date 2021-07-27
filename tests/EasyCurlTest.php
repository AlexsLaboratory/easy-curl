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

    $this->assertEmpty($test->getErrorMessage());
  }
}
