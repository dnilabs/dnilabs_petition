<?php
namespace Dnilabs\DnilabsPetition\Controller;
class PetitionController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

  /**
   * @var \Dnilabs\DnilabsPetition\Domain\Repository\PetitionRepository
   * @inject
   */
  protected $petitionRepository = NULL;

  /**
   * action show
   *
   * @return void
   */
  public function showAction() {
    $this->view->assign('petition', $this->petitionRepository->findByUid(1));
  }
}
