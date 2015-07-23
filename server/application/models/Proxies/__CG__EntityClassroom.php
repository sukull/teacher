<?php

namespace DoctrineProxies\__CG__\Entity;

/**
 * THIS CLASS WAS GENERATED BY THE DOCTRINE ORM. DO NOT EDIT THIS FILE.
 */
class Classroom extends \Entity\Classroom implements \Doctrine\ORM\Proxy\Proxy
{
    private $_entityPersister;
    private $_identifier;
    public $__isInitialized__ = false;
    public function __construct($entityPersister, $identifier)
    {
        $this->_entityPersister = $entityPersister;
        $this->_identifier = $identifier;
    }
    /** @private */
    public function __load()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;

            if (method_exists($this, "__wakeup")) {
                // call this after __isInitialized__to avoid infinite recursion
                // but before loading to emulate what ClassMetadata::newInstance()
                // provides.
                $this->__wakeup();
            }

            if ($this->_entityPersister->load($this->_identifier, $this) === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            unset($this->_entityPersister, $this->_identifier);
        }
    }

    /** @private */
    public function __isInitialized()
    {
        return $this->__isInitialized__;
    }

    
    public function getId()
    {
        if ($this->__isInitialized__ === false) {
            return (int) $this->_identifier["id"];
        }
        $this->__load();
        return parent::getId();
    }

    public function setName($name)
    {
        $this->__load();
        return parent::setName($name);
    }

    public function getName()
    {
        $this->__load();
        return parent::getName();
    }

    public function setCode($code)
    {
        $this->__load();
        return parent::setCode($code);
    }

    public function getCode()
    {
        $this->__load();
        return parent::getCode();
    }

    public function setCreation($creation)
    {
        $this->__load();
        return parent::setCreation($creation);
    }

    public function getCreation()
    {
        $this->__load();
        return parent::getCreation();
    }

    public function setYear($year)
    {
        $this->__load();
        return parent::setYear($year);
    }

    public function getYear()
    {
        $this->__load();
        return parent::getYear();
    }

    public function setSchool(\Entity\School $school)
    {
        $this->__load();
        return parent::setSchool($school);
    }

    public function getSchool()
    {
        $this->__load();
        return parent::getSchool();
    }

    public function setResp(\Entity\Teacher $resp)
    {
        $this->__load();
        return parent::setResp($resp);
    }

    public function getResp()
    {
        $this->__load();
        return parent::getResp();
    }

    public function cannotBeEditedBy(&$teacher)
    {
        $this->__load();
        return parent::cannotBeEditedBy($teacher);
    }

    public function addFile($file)
    {
        $this->__load();
        return parent::addFile($file);
    }

    public function getFiles()
    {
        $this->__load();
        return parent::getFiles();
    }


    public function __sleep()
    {
        return array('__isInitialized__', 'id', 'name', 'code', 'files', 'creation', 'year', 'school', 'resp');
    }

    public function __clone()
    {
        if (!$this->__isInitialized__ && $this->_entityPersister) {
            $this->__isInitialized__ = true;
            $class = $this->_entityPersister->getClassMetadata();
            $original = $this->_entityPersister->load($this->_identifier);
            if ($original === null) {
                throw new \Doctrine\ORM\EntityNotFoundException();
            }
            foreach ($class->reflFields as $field => $reflProperty) {
                $reflProperty->setValue($this, $reflProperty->getValue($original));
            }
            unset($this->_entityPersister, $this->_identifier);
        }
        
    }
}