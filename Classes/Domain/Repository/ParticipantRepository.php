<?php

namespace Dnilabs\DnilabsPetition\Domain\Repository;
class ParticipantRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    protected $defaultOrderings = array(
        'number' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING
    );

    public function findOneByUsername($name)
    {
        $query = $this->createQuery();
        $query->matching(
            $query->equals("username", $name)
        );
        return $query->setLimit(1)->execute()->getFirst();
    }

    public function findPage($page, $limit, $pet)
    {
        $limit = (int)$limit;
        $query = $this->createQuery();
        $query->matching(
            $query->equals("petition", $pet)
        );
        if ($page > 1) {
            $offset = $page * $limit;
            $query->setOffset($offset);
        }
        return $query->setLimit($limit)->execute();
    }

}
