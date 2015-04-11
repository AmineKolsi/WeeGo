<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MailController
 *
 * @author Nanou
 */

namespace BestTrip\MailBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use BestTrip\MailBundle\Entity\MailContact;
use BestTrip\MailBundle\Form\MailType; 
use Symfony\Component\HttpFoundation\Request;
use Swift_File;



class NewsletterController extends Controller {

    

    public function sendMailAction(Request $request) {

       
       $from = "weego003@gmail.com"; 
        $mail = new MailContact(); 
        $file =$mail->getFile();
        $form=$this->container->get('form.factory')->create(new MailType(),  $mail); 
        $request=$this->get('request');
        //if ($request->getMethod() == 'POST')
            if ($form->handleRequest($request)->isValid()) {
        //if ($form->isValid()) { 
            
            $message = \Swift_Message::newInstance() 
                    ->setSubject($mail->getSubject()) 
                    ->setFrom($from) 
                    ->setTo($mail->getEmail()) 
                    ->setBody($mail->getMessage());
          //->attach(new Swift_Attachment(new Swift_File($file)));   
                  // ->attach(\Swift_Attachment::fromPath($mail->getFile()));
               // ->attach(\Swift_Attachment::fromPath($mail->getFile().$filename_Accreditation), "application/octet-stream")
               // ->attach(\Swift_Attachment::fromPath($mail->getFile().$filename_ID), "application/octet-stream");         
         // var_dump(unserialize($message));
            $this->get('mailer')->send($message); 
           return $this->render('BestTripMailBundle:Default:mail.html.twig',array('to' => $mail->getEmail(), 
                            'from' =>  $from
                )); 
        
        }

        return $this->redirect($this->generateUrl('my_app_mail_form'));
        
    }

    public function newAction() {

        $mail = new MailContact(); 
        
       //$user=new u;
       /* $em=$this->getDoctrine()->getManager();
        $userManager=$this->get('fos_user.user_manager');  
         $email =$userManager->findUsers();*/
          
           // var_dump(unserialize($email));
 
        $form=  $this->container->get('form.factory')->create(new MailType(),  $mail); 
        $request = $this->getRequest(); 
        if ($request->getMethod() == 'POST') { 
            $form->bind($request); 
            if (($form->handleRequest($request)->isValid()) ) { 
                $this->sendMailAction( $mail->getEmail(),'weego003@gmail.com', $mail->getSubject(),
            $mail->getMessage());

            } 
        }        
        return $this->render('BestTripMailBundle:Default:new.html.twig', array('form' =>$form->createView())); 
        } 
        
        
       
    

}
