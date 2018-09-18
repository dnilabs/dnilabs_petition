<?php
namespace Dnilabs\DnilabsPetition\Controller;
use \Dnilabs\DnilabsPetition\Domain\Model\Participant;
class PetitionController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

  /**
   * @var \Dnilabs\DnilabsPetition\Domain\Repository\ParticipantRepository
   * @inject
   */
  protected $participantRepository = NULL;

  /**
   * @var \Dnilabs\DnilabsPetition\Domain\Repository\PetitionRepository
   * @inject
   */
  protected $petitionRepository = NULL;

  /**
   * @var \TYPO3\CMS\Extbase\Domain\Repository\FrontendUserGroupRepository
   * @inject
   */
  protected $frontendUserGroupRepository;

  /**
   * @return void
   */
  public function showAction() {
    $uid = $this->settings["petition"];
    $this->view->assign('petition', $this->petitionRepository->findByUid($uid));
    $new = new Participant;
    $this->view->assign('new', $new);
  }

  /**
   * @param \Dnilabs\DnilabsPetition\Domain\Model\Participant $new
   * @return void
   */
  public function createAction(\Dnilabs\DnilabsPetition\Domain\Model\Participant $new) {

    $fegroup = $this->settings["fegroup"];
    $usergroup = $this->frontendUserGroupRepository->findByUid($fegroup);
    $new->addUsergroup($usergroup);

    $new->setUsername(md5(time()));
    $new->setPassword("8oHb^2qBjE/z),+L8oHb^2qBjE/z),+L");

    $pet =  $new->getPetition();
    $nr = $pet->getCount() + 1;
    $pet->setCount($nr);
    $new->setNumber($nr);
    $new->setDate(new \Datetime);

    $this->participantRepository->add($new);
    $this->petitionRepository->update($pet);
    return "success";

  }
}
