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

use AntiMattr\Common\Pagination\PaginationInterface;
use AntiMattr\Search\Client\ClientInterface;
use AntiMattr\Search\Event\EventFactoryInterface;
use AntiMattr\Search\Model\RecordInterface;
use Symfony\Component\EventDispatcher\EventDispatcherInterface;

/**
 * @author Matthew Fitzgerald <matthewfitz@gmail.com>
 */
class Processor
{
    const EVENT_PATTERN = 'antimattr.search_processor.%s.%s';

    /**
     * @var string 'default'
     */
    protected $alias;

    /** @var AntiMattr\Search\Client\ClientInterface */
    protected $client;

    /** @var Symfony\Component\EventDispatcher\EventDispatcherInterface */
    protected $eventDispatcher;

    /** @var AntiMattr\Search\Event\EventFactoryInterface */
    protected $eventFactory;

    /**
     * @param AntiMattr\Search\Client\ClientInterface                    $client
     * @param Symfony\Component\EventDispatcher\EventDispatcherInterface $eventdispatcher
     * @param AntiMattr\Search\Event\EventFactoryInterface               $eventFactory
     * @param string                                                     $alias
     */
    public function __construct(
        ClientInterface $client,
        EventDispatcherInterface $eventDispatcher,
        EventFactoryInterface $eventFactory,
        $alias = 'default')
    {
        $this->alias = $alias;
        $this->client = $client;
        $this->eventDispatcher = $eventDispatcher;
        $this->eventFactory = $eventFactory;
    }

    /**
     * @param AntiMattr\Common\Pagination\PaginationInterface $pagination
     */
    public function find(PaginationInterface $pagination)
    {
        $this->client->find($pagination);
    }

    /**
     * Listen on antimattr.search_processor.default.pre_create
     * Listen on antimattr.search_processor.default.post_create
     *
     * @param AntiMattr\Search\Model\RecordInterface $record
     */
    public function create(RecordInterface $record)
    {
        $pre = $this->getEventName('pre_create');
        $preEvent = $this->eventFactory->createEvent($record);
        $this->dispatch($pre, $preEvent);

        $postEvent = $this->client->create($record);

        $post = $this->getEventName('post_create');
        $this->dispatch($post, $postEvent);
    }

    /**
     * Listen on antimattr.search_processor.default.pre_update
     * Listen on antimattr.search_processor.default.post_update
     *
     * @param AntiMattr\Search\Model\RecordInterface $record
     */
    public function update(RecordInterface $record)
    {
        $pre = $this->getEventName('pre_update');
        $preEvent = $this->eventFactory->createEvent($record);
        $this->dispatch($pre, $preEvent);

        $postEvent = $this->client->update($record);

        $post = $this->getEventName('post_update');
        $this->dispatch($post, $postEvent);
    }

    /**
     * Listen on antimattr.search_processor.default.pre_delete
     * Listen on antimattr.search_processor.default.post_delete
     *
     * @param AntiMattr\Search\Model\RecordInterface $record
     */
    public function delete(RecordInterface $record)
    {
        $pre = $this->getEventName('pre_delete');
        $preEvent = $this->eventFactory->createEvent($record);
        $this->dispatch($pre, $preEvent);

        $postEvent = $this->client->delete($record);

        $post = $this->getEventName('post_delete');
        $this->dispatch($post, $postEvent);
    }

    /**
     * @param string                             $eventName
     * @param AntiMattr\Search\Event\RecordEvent $event
     */
    protected function dispatch($eventName, $event)
    {
        $this->eventDispatcher->dispatch($eventName, $event);
    }

    /**
     * @param string $action 'pre_create' | 'pre_update' | 'pre_delete' | 'post_create' | 'post_update' | 'post_delete'
     *
     * @return string $eventName 'antimattr.search_processor.default.pre_create'
     */
    protected function getEventName($action)
    {
        return sprintf(self::EVENT_PATTERN, $this->alias, $action);
    }
}
