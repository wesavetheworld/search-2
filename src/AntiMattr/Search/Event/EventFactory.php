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

/**
 * @author Matthew Fitzgerald <matthewfitz@gmail.com>
 */
class EventFactory implements EventFactoryInterface
{
    /**
     * @param AntiMattr\Search\RecordInterface $record
     *
     * @return AntiMattr\Search\Event\RecordEvent $event
     */
    public function createEvent(RecordInterface $record)
    {
        return new RecordEvent($record);
    }
}
