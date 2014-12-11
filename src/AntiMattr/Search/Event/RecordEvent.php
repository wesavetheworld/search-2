<?php

/*
 * This file is part of the AntiMattr Search library, a library by Matthew Fitzgerald.
 *
 * (c) 2014 Matthew Fitzgerald
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AntiMattr\Search\Event;

use AntiMattr\Search\Model\RecordInterface;
use Symfony\Component\EventDispatcher\Event;

/**
 * @author Matthew Fitzgerald <matthewfitz@gmail.com>
 */
class RecordEvent extends Event
{
    private $record;

    public function __construct(RecordInterface $record)
    {
        $this->record = $record;
    }

    public function getRecord()
    {
        return $this->record;
    }
}
