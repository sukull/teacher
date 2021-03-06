<?php

 namespace Entity;


 /**
  * @Table()
  *
  * @Entity()
  */
 class File
 {

   /**
    * @var integer $id
    *
    * @Column(name="id", type="integer")
    * @Id
    * @GeneratedValue(strategy="AUTO")
    */
   protected $id;

   /**
    * @var smallint $active
    *
    * @Column(name="active", type="smallint")
    */
   protected $active;

   /**
    * @var smallint $type
    *
    * @Column(name="type", type="smallint")
    */
   protected $type;

   /**
    * @var string $fileName
    *
    * @Column(name="file_name", type="string", nullable=true, length=255)
    */
   protected $fileName;

   /**
    * @var string $name
    *
    * @Column(name="name", type="string", nullable=true, length=255)
    */
   protected $name;


   /**
    * @ManyToOne(targetEntity="Entity\Member")
    * @ORM\JoinColumn(nullable=false)
    */
   protected $resp;
   

   /**
    * @var datetime $creation
    *
    * @Column(name="creation", type="datetime", nullable=true)
    */
   protected $creation;


   public function __construct() {
     $this->creation = new \Datetime();
     do {
       $this->fileName = mt_rand();
     }while (file_exists('files/'+$this->fileName));
     $this->active = 1;
   }

  /**
   * Get id
   *
   * @return integer 
   */
  public function getId()
  {
    return $this->id;
  }
  

  /**
   * Set active
   *
   * @param smallint $active
   */
  public function setActive($active)
  {
    $this->active = $active;
  }

  /**
   * Get active
   *
   * @return smallint 
   */
  public function getActive()
  {
    return $this->active;
  }



  /**
   * Set type
   *
   * @param smallint $type
   */
  public function setType($type)
  {
    $this->type = $type;
  }

  /**
   * Get type
   *
   * @return smallint 
   */
  public function getType()
  {
    return $this->type;
  }

  /**
   * Set name
   *
   * @param string $name
   */
  public function setName($name)
  {
    $this->name = $name;
  }
  
  /**
   * Get name
   *
   * @return string 
   */
  public function getName()
  {
    return $this->name;
  }


  /**
   * Set fileName
   *
   * @param string $fileName
   */
  public function setFileName($fileName)
  {
    $this->fileName = $fileName;
  }
  
  /**
   * Get fileName
   *
   * @return string 
   */
  public function getFileName()
  {
    return $this->fileName;
  }

  
  /**
   * Set creation
   *
   * @param datetime $creation
   */
  public function setCreation($creation)
  {
    $this->creation = $creation;
  }

  /**
   * Get creation
   *
   * @return datetime 
   */
  public function getCreation()
  {
    return $this->creation;
  }

  /**
   * Set resp
   *
   * @param Entity\Member $resp
   */
  public function setResp(\Entity\Member $resp)
  {
    $this->resp = $resp;
  }
  
  /**
   * Get resp
   *
   * @return Entity\Resp 
   */
  public function getResp()
  {
    return $this->resp;
  }

  public function setData(&$data) {
    $fichier = fopen('files/'.$this->fileName, 'w');
    fwrite($fichier, $data);
    fclose($fichier);
  }

  public function getData() {
    $fichier = fopen('files/'.$this->fileName, 'r');
    $size = filesize('files/'.$this->fileName);
    $data = fread($fichier, $size);
    fclose($fichier);
    return $data;
  } 
  
 }