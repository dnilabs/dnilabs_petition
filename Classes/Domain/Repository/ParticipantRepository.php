<?php

namespace Dnilabs\DnilabsPetition\Domain\Repository;
class ParticipantRepository extends \TYPO3\CMS\Extbase\Domain\Repository\FrontendUserRepository
{

    protected $defaultOrderings = array(
        'number' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING
    );

    public function findAllExport() {
        $query = $this->createQuery();
        $query->matching(
          $query->logicalAnd(
            $query->equals("disable", false),
            $query->equals("newsletter", true),
            $query->equals("synced", false)
          )
        );
        return $query->execute();
    }


    public function findMyUser($username) {
        $query = $this->createQuery();
        $query->getQuerySettings()->setIgnoreEnableFields(true);
        $query->matching(
            $query->equals("username", $username)
        );
        return $query->setLimit(1)->execute()->getFirst();
    }

    public function checkEmail($email) {

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
          return false;
        }

        $query = $this->createQuery();
        $query->getQuerySettings()->setIgnoreEnableFields(true);
        $query->matching(
            $query->equals("email", $email)
        );
        $cnt = $query->setLimit(1)->execute()->count();
        return $cnt > 0;
    }

    public function findPage($page, $limit, $pet) {
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
