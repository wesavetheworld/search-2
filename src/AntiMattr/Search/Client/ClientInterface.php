<?php

/*
 * This file is part of the AntiMattr Search library, a library by Matthew Fitzgerald.
 *
 * (c) 2014 Matthew Fitzgerald
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace AntiMattr\Search\Client;

use AntiMattr\Common\Pagination\PaginationInterface;
use AntiMattr\Search\Model\RecordInterface;

/**
 * @author Matthew Fitzgerald <matthewfitz@gmail.com>
 */
interface ClientInterface
{
    /**
     * @param AntiMattr\Common\Pagination\PaginationInterface $pagination
     */
    public function find(PaginationInterface $pagination);

    /**
     * @param AntiMattr\Search\Model\RecordInterface
     */
    public function create(RecordInterface $record);

    /**
     * @param AntiMattr\Search\Model\RecordInterface
     */
    public function update(RecordInterface $record);

    /**
     * @param AntiMattr\Search\Model\RecordInterface
     */
    public function delete(RecordInterface $record);
}
