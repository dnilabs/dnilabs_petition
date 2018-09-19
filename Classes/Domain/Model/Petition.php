<?php
namespace Dnilabs\DnilabsPetition\Domain\Model;

/***
 *
 * This file is part of the "dnilabs petition" Extension for TYPO3 CMS.
 *
 * For the full copyright and license information, please read the
 * LICENSE.txt file that was distributed with this source code.
 *
 *  (c) 2018
 *
 ***/

/**
 * Petition
 */
class Petition extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity
{
    /**
     * title
     *
     * @var string
     */
    protected $title = '';

    /**
     * total
     *
     * @var int
     */
    protected $total = 0;

    /**
     * count
     *
     * @var int
     */
    protected $count = 0;

    /**
     * Returns the title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the title
     *
     * @param string $title
     * @return void
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Returns the total
     *
     * @return int $total
     */
    public function getTotal()
    {
        return $this->total;
    }

    /**
     * Sets the total
     *
     * @param int $total
     * @return void
     */
    public function setTotal($total)
    {
        $this->total = $total;
    }

    /**
     * Returns the count
     *
     * @return int $count
     */
    public function getCount()
    {
        return $this->count;
    }

    /**
     * Sets the count
     *
     * @param int $count
     * @return void
     */
    public function setCount($count)
    {
        $this->count = $count;
    }
}
