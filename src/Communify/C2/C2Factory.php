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

namespace Communify\C2;

/**
 * Class S2OFactory
 * @package Communify\S2O
 */
class C2Factory
{

  /**
   * Create C2Factory.
   *
   * @return C2Factory
   */
  public static function factory()
  {
    return new C2Factory();
  }

  /**
   * Create C2Credential.
   *
   * @return C2Credential
   */
  public function credential()
  {
    return C2Credential::factory();
  }

  /**
   * @return C2Encryptor
   */
  public function encryptor()
  {
    return C2Encryptor::factory();
  }

  /**
   * Create C2MetaIterator.
   *
   * @return C2MetaIterator
   */
  public function metaIterator()
  {
    return C2MetaIterator::factory();
  }

  /**
   * Create S2OMeta.
   *
   * @param $name
   * @param $content
   * @return C2Meta
   */
  public function meta($name, $content)
  {
    return C2Meta::factory($name, $content);
  }

}