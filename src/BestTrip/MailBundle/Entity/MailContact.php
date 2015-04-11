<?php


/**
 * Description of MailContact
 *
 * @author Nanou
 */
namespace BestTrip\MailBundle\Entity;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Validator\Constraints as Assert;

use Doctrine\ORM\Mapping as ORM;

class MailContact
{
    
    private $id;
     
    private $subject;

   
    private $email;

    
    private $message;
    
    
    protected $file;

    
    public $path;
    
    public function getId()
    {
        return $this->id;
    }

    
    
    public function setSubject($subject)
    {
        $this->subject = $subject;

        return $this;
    }

    
    public function getSubject()
    {
        return $this->subject;
    }

    
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

   
    public function getEmail()
    {
        return $this->email;
    }

    
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

   
    public function getMessage()
    {
        return $this->message;
    }
    
  
    
    
    public function getAbsolutePath()
    {
        return null === $this->path ? null : $this->getUploadRootDir().'/'.$this->path;
    }

    
    /**
     * @ORM\PrePersist()
     * @ORM\PreUpdate()
     */
    public function preUpload()
    {
        if (null !== $this->file) {
            // faites ce que vous voulez pour générer un nom unique
            $this->path =$this->file->getClientOriginalName();
        }
    }
    
    
     public function setFile(UploadedFile $file = null)
    {
    // set the value of the holder
    $this->file = $file;
    // check if we have an old image path
    if (isset($this->path)) {
        // store the old name to delete after the update
        $this->t = $this->profilePicturePath;
        $this->tempPath = null;
    } else {
        $this->path = 'initial';
    }

    return $this;
    }
    
    public function getFile()
    {

        return $this->file;
    }
    
  public function __sleep()
{
	$ref   = new \ReflectionClass(__CLASS__);
	$props = $ref->getProperties(\ReflectionProperty::IS_PROTECTED);
	 
	$serialize_fields = array();
	 
	foreach ($props as $prop) {
		$serialize_fields[] = $prop->name;
	}
	
	return $serialize_fields;
}
public function __toString() {
    return $this->email;
}
}
