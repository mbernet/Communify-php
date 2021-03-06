<?php
/**
 * Copyright 2014 Communify.com, Inc. or its affiliates. All Rights Reserved.
 *
 * Licensed under the Apache License, Version 2.0 (the "License").
 * You may not use this file except in compliance with the License.
 * A copy of the License is located at
 *
 * http://dev.communify.com/apache2.0
 *
 * or in the "license" file accompanying this file. This file is distributed
 * on an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either
 * express or implied. See the License for the specific language governing
 * permissions and limitations under the License.
 */

namespace tests\Communify\C2;

use Communify\C2\C2Validator;
use Communify\C2\interfaces\IC2Response;

/**
 * @covers Communify\C2\C2Validator
 */
class C2ValidatorTest extends \PHPUnit_Framework_TestCase
{

  /**
   * @var C2Validator
   */
  private $sut;

  public function setUp()
  {
    $this->sut = new C2Validator();
  }

  /**
  * dataProvider getCheckDataNoStatusThrowExceptionData
  */
  public function getCheckDataNoStatusThrowExceptionData()
  {
    return array(
      array(null),
      array(array()),
      array(array('dummy value')),
      array(array('dummy' => 'value')),
    );
  }

  /**
  * method: checkData
  * when: called
  * with: noStatus
  * should: throwException
   * @dataProvider getCheckDataNoStatusThrowExceptionData
   * @expectedException \Communify\C2\C2Exception
   * @expectedExceptionMessage communify-error-json-status
   * @expectedExceptionCode 102
  */
  public function test_checkData_called_noStatus_throwException($data)
  {
    $this->sut->checkData($data);
  }

  /**
  * method: checkData
  * when: called
  * with: invalidStatusValue
  * should: throwException
   * @expectedException \Communify\C2\C2Exception
   * @expectedExceptionMessage communify-error-status-value
   * @expectedExceptionCode 102
  */
  public function test_checkData_called_invalidStatusValue_throwException()
  {
    $this->sut->checkData(array('status' => 'dummy value'));
  }

  /**
  * dataProvider getCheckDataNoDataThrowExceptionData
  */
  public function getCheckDataNoDataThrowExceptionData()
  {
    return array(
      array(array('status' => 'ok')),
      array(array('status' => 'ko')),
      array(array('status' => 'ok', 'dummy' => 'value')),
      array(array('status' => 'ko', 'dummy' => 'value')),
    );
  }

  /**
  * method: checkData
  * when: called
  * with: noData
  * should: throwException
   * @dataProvider getCheckDataNoDataThrowExceptionData
   * @expectedException \Communify\C2\C2Exception
   * @expectedExceptionMessage communify-error-json-data
   * @expectedExceptionCode 102
  */
  public function test_checkData_called_noData_throwException($data)
  {
    $this->sut->checkData($data);
  }

  /**
  * dataProvider getCheckDataKoStatusWithoutMessageThrowExceptionData
  */
  public function getCheckDataKoStatusWithoutMessageThrowExceptionData()
  {
    return array(
      array(array('status' => 'ko', 'data' => 'value')),
      array(array('status' => 'ko', 'data' => array('dummy' => 'value'))),
    );
  }

  /**
  * method: checkData
  * when: called
  * with: koStatusWithoutMessage
  * should: throwException
   * @dataProvider getCheckDataKoStatusWithoutMessageThrowExceptionData
   * @expectedException \Communify\C2\C2Exception
   * @expectedExceptionMessage communify-error-json-msg
   * @expectedExceptionCode 102
  */
  public function test_checkData_called_koStatusWithoutMessage_throwException($data)
  {
    $this->sut->checkData($data);
  }

  /**
   * method: checkData
   * when: called
   * with: koStatus
   * should: throwException
   * @expectedException \Communify\C2\C2Exception
   * @expectedExceptionMessage communify-error
   * @expectedExceptionCode 101
   */
  public function test_checkData_called_koStatus_throwException()
  {
    $this->sut->checkData(array('status' => 'ko', 'data' => array('message' => 'dummy message')));
  }

  /**
  * dataProvider getCheckData
  */
  public function getCheckData()
  {
    return array(
      array(array('status' => 'ok', 'data' => 'value')),
      array(array('status' => 'ok', 'data' => array('dummy value'))),
      array(array('status' => 'ok', 'data' => array('dummy' => 'value'))),
    );
  }

  /**
  * method: checkData
  * when: called
  * with: correctData
  * should: returnTrue
   * @dataProvider getCheckData
  */
  public function test_checkData_called_correctData_returnTrue($data)
  {
    $actual = $this->sut->checkData($data);
    $this->assertEquals(IC2Response::STATUS_OK, $actual);
  }

}