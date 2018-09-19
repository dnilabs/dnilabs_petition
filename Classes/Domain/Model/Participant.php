<?php
namespace Dnilabs\DnilabsPetition\Domain\Model;
class Participant extends \TYPO3\CMS\Extbase\Domain\Model\FrontendUser {

  public function __construct() {
    //Do not remove the next line: It would break the functionality
    parent::__construct();
  }
  /**
   * @var string
   */
  protected $username = '';
  /**
   * number
   *
   * @var string
   */
  protected $number = '';

  /**
   * date
   *
   * @var \DateTime
   */
  protected $date = null;
  /**
   * @var bool
   */
  protected $disable = true;

  /**
   * newsletter
   *
   * @var bool
   */
  protected $newsletter = false;

  /**
   * petition
   *
   * @var \Dnilabs\DnilabsPetition\Domain\Model\Petition
   */
  protected $petition = null;
  /**
   * @return string $username
   */
  public function getUsername()
  {
    return $this->username;
  }

  /**
   * Sets the username
   *
   * @param string $username
   * @return void
   */
  public function setUsername($username)
  {
    $this->username = $username;
  }

  /**
   * Returns the number
   *
   * @return string $number
   */
  public function getNumber()
  {
    return $this->number;
  }

  /**
   * Sets the number
   *
   * @param string $number
   * @return void
   */
  public function setNumber($number)
  {
    $this->number = $number;
  }

  /**
   * Returns the date
   *
   * @return \DateTime $date
   */
  public function getDate()
  {
    return $this->date;
  }

  /**
   * Sets the date
   *
   * @param \DateTime $date
   * @return void
   */
  public function setDate(\DateTime $date)
  {
    $this->date = $date;
  }

  /**
   * @return bool $disable
   */
  public function getDisable()
  {
    return $this->disable;
  }

  /**
   * @param bool $disable
   * @return void
   */
  public function setDisable($disable)
  {
    $this->disable = $disable;
  }

  /**
   * Returns the newsletter
   *
   * @return bool $newsletter
   */
  public function getNewsletter()
  {
    return $this->newsletter;
  }

  /**
   * Sets the newsletter
   *
   * @param bool $newsletter
   * @return void
   */
  public function setNewsletter($newsletter)
  {
    $this->newsletter = $newsletter;
  }

  /**
   * Returns the boolean state of newsletter
   *
   * @return bool
   */
  public function isNewsletter()
  {
    return $this->newsletter;
  }

  /**
   * Returns the petition
   *
   * @return \Dnilabs\DnilabsPetition\Domain\Model\Petition $petition
   */
  public function getPetition()
  {
    return $this->petition;
  }

  /**
   * Sets the petition
   *
   * @param \Dnilabs\DnilabsPetition\Domain\Model\Petition $petition
   * @return void
   */
  public function setPetition(\Dnilabs\DnilabsPetition\Domain\Model\Petition $petition)
  {
    $this->petition = $petition;
  }
}
