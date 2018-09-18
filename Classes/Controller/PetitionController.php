<?php
namespace Dnilabs\DnilabsPetition\Controller;
use \TYPO3\CMS\Core\Utility\GeneralUtility as GU;
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
    $this->view->assign('new', new Participant);
  }

  /**
   * @return void
   */
  public function listAction() {
    $page = intval(GU::_GET('page'));
    if ($page<=0) {
      $page = 1;
    }

    $pet = $this->settings["petition"];
    $limit = $this->settings["limit"];
    $pets = $this->petitionRepository->findPage($page, $limit, $pet);
    $this->view->assign('petitionen', $pets);
  }

  /**
   * @param \Dnilabs\DnilabsPetition\Domain\Model\Participant $new
   * @return void
   */
  public function createAction(\Dnilabs\DnilabsPetition\Domain\Model\Participant $new) {

    $fegroup = $this->settings["fegroup"];
    $usergroup = $this->frontendUserGroupRepository->findByUid($fegroup);
    if (!$usergroup) return "no usergroup";
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
