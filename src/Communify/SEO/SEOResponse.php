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

namespace Communify\SEO;

use Communify\C2\abstracts\C2AbstractResponse;
use Communify\C2\C2Exception;
use Communify\C2\C2Validator;
use Guzzle\Http\Message\Response;

/**
 * Class S2OResponse
 * @package Communify\S2O
 */
class SEOResponse extends C2AbstractResponse
{

  /**
   * @var SEOFactory
   */
  private $factory;

  /**
   * @var SEOEngine
   */
  private $engine;

  /**
   * @var array
   */
  private $context;

  /**
   * Constructor with injection dependencies.
   *
   * @param C2Validator $validator
   * @param SEOEngine $template
   * @param SEOFactory $factory
   */
  function __construct(C2Validator $validator = null, SEOEngine $template = null, SEOFactory $factory = null)
  {

    if($factory == null)
    {
      $factory = SEOFactory::factory();
    }

    if($template == null)
    {
      $template = SEOEngine::factory();
    }

    $this->factory = $factory;
    $this->engine = $template;

    parent::__construct($validator);

  }

  /**
   * Set Guzzle Response data to S2OResponse as elements on S2OMetaIterator.
   *
   * @param Response $response
   */
  public function set(Response $response)
  {
    try
    {
      $result = $response->json();
      $this->validator->checkData($result);
      $parser = $this->factory->parser($result);
      $this->context = array_merge($parser->getTopic(), $parser->getOpinions(), $parser->getLang());
    }
    catch(C2Exception $e)
    {
      $this->context = null;
    }
  }

  /**
   * @return string
   */
  public function html()
  {
    return $this->context == null ? '' : $this->engine->render($this->context);
  }

  /**
   * @param mixed $context
   */
  public function setContext($context)
  {
    $this->context = $context;
  }

} 