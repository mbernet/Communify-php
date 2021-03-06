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

namespace Communify\SEO\parsers\interfaces;

/**
 * Interface ISEOParser
 * @package Communify\SEO\parsers\interfaces
 */
interface ISEOParser
{

  /**
   * Get information from array result.
   *
   * @param $data
   * @return mixed
   */
  public function get($data);

}