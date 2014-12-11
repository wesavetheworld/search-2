<?php

/*
 * This file is part of the AntiMattr Search library, a library by Matthew Fitzgerald.
 *
 * (c) 2014 Matthew Fitzgerald
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AntiMattr\Search;

use AntiMattr\Search\Client\ClientInterface;
use AntiMattr\Search\Event\EventFactoryInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * @author Matthew Fitzgerald <matthewfitz@gmail.com>
 */
class ProcessorFactory
{
    /**
     * The Processor instances.
     *
     * @var array
     */
    private $processors = array();

    /**
     * @param string                                                     $alias
     * @param AntiMattr\Search\Client\ClientInterface                    $client
     * @param Symfony\Component\EventDispatcher\EventDispatcherInterface $eventDispatcher
     * @param AntiMattr\Search\Event\EventFactoryInterface               $eventFactory
     *
     * @return AntiMattr\Search\Processor
     */
    public function getProcessor(
        $alias,
        ClientInterface $client,
        EventDispatcherInterface $eventDispatcher,
        EventFactoryInterface $eventFactory)
    {
        if (isset($this->processors[$alias])) {
            return $this->processors[$alias];
        }

        $processor = new Processor($client, $eventDispatcher, $eventFactory, $alias);

        $this->processors[$alias] = $processor;

        return $processor;
    }
}
