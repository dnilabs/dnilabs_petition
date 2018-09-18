<?php
namespace Dnilabs\DnilabsPetition\Domain\Repository;
class ParticipantRepository extends \TYPO3\CMS\Extbase\Persistence\Repository {

  protected $defaultOrderings = array(
    'number' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING
  );

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
