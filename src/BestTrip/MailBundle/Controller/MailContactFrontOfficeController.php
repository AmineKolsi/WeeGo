<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of MailContactController
 *
 * @author Nanou
 */
namespace BestTrip\MailBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use BestTrip\MailBundle\Entity\MailContact;
use BestTrip\MailBundle\Form\MailContactType; 
use Symfony\Component\HttpFoundation\Request;
use Swift_Attachment;

class MailContactFrontOfficeController   extends Controller{
   

       
    public function sendMailAction(Request $request) { 
        $to = "weego003@gmail.com"; 
        $mail = new MailContact(); 
        $form=$this->container->get('form.factory')->create(new MailContactType(),  $mail); 
        $request=$this->get('request');
        //if ($request->getMethod() == 'POST')
            if ($form->handleRequest($request)->isValid()) {
        //if ($form->isValid()) { 
            
            $message = \Swift_Message::newInstance() 
                    ->setSubject($mail->getSubject()) 
                    ->setFrom($mail->getEmail()) 
                    ->setTo($to) 
                    ->setBody($mail->getMessage());
            
                    //->attach(Swift_Attachment::fromPath($mail->getFile()));
            $this->get('mailer')->send($message); 
           return $this->render('BestTripMailBundle:MailContact:mailC.html.twig', array('to' => $to, 
                            'from' => $mail->getEmail() 
                )); 
        } 
        return $this->redirect($this->generateUrl('wee_go_mail_form_contact_front_office')); 
    } 
        //return $this->redirect($this->generateUrl('wee_go_mail_form')); 
    
    
    public function newAction() { 
        $mail = new MailContact(); 
        $form=  $this->container->get('form.factory')->create(new MailContactType(),  $mail); 
        $request = $this->getRequest(); 
        if ($request->getMethod() == 'POST') { 
            $form->bind($request); 
            if (($form->handleRequest($request)->isValid()) ) { 
                $this->sendMailAction('weego003@gmail.com', $mail->getEmail(), $mail->getSubject(),
            $mail->getMessage());

            } 
        }
        return $this->render('BestTripMailBundle:MailContact:Contact.html.twig', array('form' =>$form->createView())); 
        } 
}



