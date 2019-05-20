<?php

declare(strict_types=1);

/**
 * Pimcore
 *
 * This source file is available under two different licenses:
 * - GNU General Public License version 3 (GPLv3)
 * - Pimcore Enterprise License (PEL)
 * Full copyright and license information is available in
 * LICENSE.md which is distributed with this source code.
 *
 * @copyright  Copyright (c) Pimcore GmbH (http://www.pimcore.org)
 * @license    http://www.pimcore.org/license     GPLv3 and PEL
 */

namespace Pimcore\Event\Webservice;

use Symfony\Component\EventDispatcher\Event;
use Symfony\Component\HttpFoundation\Request;

class FilterEvent extends Event
{
    /** @var Request */
    public $request;

    /** @var string */
    public $type;

    /** @var string */
    public $action;

    /** @var string */
    public $condition;

    /** @var bool */
    protected $conditionDirty;

    /**
     * FilterEvent constructor.
     *
     * @param $request
     * @param $type
     * @param $action
     * @param $list
     */
    public function __construct($request, $type, $action, $condition)
    {
        $this->request = $request;
        $this->type = $type;
        $this->action = $action;
        $this->condition = $condition;
    }

    /**
     * @return Request
     */
    public function getRequest()
    {
        return $this->request;
    }

    /**
     * @param mixed $request
     */
    public function setRequest($request): void
    {
        $this->request = $request;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * @param mixed $type
     */
    public function setType($type): void
    {
        $this->type = $type;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action): void
    {
        $this->action = $action;
    }

    /**
     * @return string
     */
    public function getCondition()
    {
        return $this->condition;
    }

    /**
     * @param string $condition
     */
    public function setCondition($condition)
    {
        $this->condition = $condition;
        $this->conditionDirty = true;
    }

    /**
     * @return bool
     */
    public function isConditionDirty()
    {
        return $this->conditionDirty;
    }
}
