<?php
namespace Dnilabs\DnilabsPetition\Task;
use \TYPO3\CMS\Core\Utility\GeneralUtility as GU;
use \TYPO3\CMS\Extbase\Object\ObjectManager;
use \Dnilabs\DnilabsPetition\Domain\Repository\ParticipantRepository;
use \TYPO3\CMS\Extbase\Persistence\PersistenceManagerInterface as PMI;

class CleverreachSyncTask extends \TYPO3\CMS\Scheduler\Task\AbstractTask {

  protected $clientid = "8jsWCh3MQr";
  protected $clientsecret = "YSPTk7bkBB7uYn8lNqAYcIhEETWIGMaF";
  protected $list = "1412706";

  public function execute() {

    $objectManager = GU::makeInstance(ObjectManager::class);
    $repo = $objectManager->get(ParticipantRepository::class);

    $querySettings = $repo->createQuery()->getQuerySettings();
    $querySettings->setRespectStoragePage(FALSE);
    $repo->setDefaultQuerySettings($querySettings);

    $users = $repo->findAllExport();

    // nothing to do, so done
    if (count($users) == 0) return true;

    $data = array();
    foreach ($users as $user) {
      $u = array(
        "email" => $user->getEmail(),
        "global_attributes" => array(
          "firstname" => $user->getFirstName(),
          "lastname" => $user->getLastName()
        )
      );
      array_push($data, $u);
      $user->setSynced(true);
      $repo->update($user);
    }

    $url = "https://rest.cleverreach.com/v3/groups.json/" . $this->list ."/receivers/insert";
    $res = $this->rest("POST", $url, $data);

    $objectManager->get(PMI::class)->persistAll();
    return true;
  }

  private function rest($method, $url, $data = false) {
    $curl = curl_init();

    switch ($method) {
    case "POST":
      curl_setopt($curl, CURLOPT_POST, 1);
      if ($data)
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode($data));
      break;
    case "PUT":
      curl_setopt($curl, CURLOPT_PUT, 1);
      break;
    default:
      if ($data)
        $url = sprintf("%s?%s", $url, http_build_query($data));
    }

    $token = $this->getToken();

    curl_setopt($curl, CURLOPT_HTTPHEADER, array(
      "Content-Type: application/json",
      "Authorization: Bearer $token"
    ));

    curl_setopt($curl, CURLOPT_URL, $url);
    curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);

    $result = curl_exec($curl);

    curl_close($curl);
    $json = json_decode($result, true);
    /* if ($json["error"]) return false; */
    return $json;
  }

  protected $token;

  private function getToken() {
    if (!$this->token) {
      $this->token = $this->requestToken($this->clientid, $this->clientsecret);
    }
    return $this->token;
  }

  private function requestToken($clientid, $clientsecret) {

    $token_url = "https://rest.cleverreach.com/oauth/token.php";

    $curl = curl_init();
    curl_setopt($curl,CURLOPT_URL, $token_url);
    curl_setopt($curl,CURLOPT_USERPWD, $clientid . ":" . $clientsecret);
    curl_setopt($curl,CURLOPT_POSTFIELDS, array("grant_type" => "client_credentials"));
    curl_setopt($curl,CURLOPT_RETURNTRANSFER, true);
    $result = curl_exec($curl);
    curl_close ($curl);

    $json = json_decode($result, true);
    $token = $json["access_token"];
    if (!$token) return false;
    return $token;
  }

}
