<?php

namespace Dnilabs\DnilabsPetition\Controller;

use \TYPO3\CMS\Core\Utility\GeneralUtility as GU;
use \Dnilabs\DnilabsPetition\Domain\Model\Participant;

class PetitionController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * @var \Dnilabs\DnilabsPetition\Service\EmailService
     * @inject
     */
    protected $emailService = NULL;

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
    public function showAction()
    {
        $uid = $this->settings["petition"];
        $this->view->assign('petition', $this->petitionRepository->findByUid($uid));
        $this->view->assign('new', new Participant);
        //assign arguments
        $this->view->assign('arguments', $this->request->getArguments());
    }

    /**
     * @return void
     */
    public function activationAction()
    {
        $token = GU::_GET('uniquehash');
        if (!$token) return "kein token";
        $user = $this->participantRepository->findMyUser($token);
        if (!$user) return "token nicht gefunden";
        if (!$user->getDisable()) return "bereits aktiviert";
        $this->view->assign("participant", $user);
        $user->setDisable(false);

        // count up
        $pet = $user->getPetition();
        $nr = $pet->getCount() + 1;
        $pet->setCount($nr);
        $user->setDate(new \Datetime);
        $user->setNumber($nr);

        // save
        $this->petitionRepository->update($pet);
        $this->participantRepository->update($user);
    }

    /**
     * @return void
     */
    public function listAction()
    {
        $page = intval(GU::_GET('page'));
        if ($page <= 0) {
            $page = 1;
        }
        $pet = $this->settings["petition"];
        $limit = $this->settings["limit"];
        /* $pets = $this->participantRepository>findPage($page, $limit, $pet); */
        $pets = $this->participantRepository->findAll();
        $this->view->assign('petitionen', $pets);
    }

    /**
     * @param \Dnilabs\DnilabsPetition\Domain\Model\Participant $new
     * @return void
     */
    public function createAction(\Dnilabs\DnilabsPetition\Domain\Model\Participant $new)
    {
        // check if email is already in use
        if ($this->participantRepository->checkEmail($new->getEmail())) {
            return $this->redirect('show', null, null, ['duplicateemail' => true]);
        }

        $fegroup = $this->settings["fegroup"];
        $usergroup = $this->frontendUserGroupRepository->findByUid($fegroup);
        if (!$usergroup) return "no usergroup";

        // set attributes
        $new->addUsergroup($usergroup);
        $new->setDisable(true);
        $new->setUsername(md5(time()));
        $new->setPassword("8oHb^2qBjE/z),+L8oHb^2qBjE/z),+L");

        // save
        $this->participantRepository->add($new);

        // send activation email
        $to = [$new->getEmail()];
        $from = [$this->settings["emailfrom"]];
        $subject = $this->settings["emailsubject"];
        $this->emailService->sendTemplateEmail($to, $from, $subject, "Activation", [
            "confirmurl" => $this->settings["baseurl"],
            "confirmpid" => $this->settings["success2"],
            "token"      => $new->getUsername()
        ]);

        // redirect to success1
        $pageUid = $this->settings['success1'];
        $uri = $this->uriBuilder->setTargetPageUid($pageUid)->build();
        $this->redirectToURI($uri);

    }
}
