<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Contact;
use App\Form\ContactType;
use App\Entity\EmailModel;
use App\Services\EmailSender;
use App\Repository\ContactRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/contact")
 */
class ContactController extends AbstractController
{
   
    /**
     * @Route("/", name="contact_new", methods={"GET","POST"})
     */
    public function new(Request $request, EmailSender $emailsender): Response
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
            $entityManager->flush();

            // Envoi d'email
            $user = (new User())
                    ->setEmail('magassamalle82@gmail.com')
                    ->setFirstname('Ousmane')
                    ->setLastname('Diawara');

            $email = (new EmailModel())
                    ->setTitle("Bonjour ".$user->getFullName())
                    ->setSubject("Nouveau contact depuis votre site Web")
                    ->setContent("<br>À partir de : ".$contact->getEmail()
                                ."<br>Nom : ".$contact->getName()
                                ."<br>Sujet : ".$contact->getSubject()
                                ."Message : <br><br>".$contact->getContent());
            
            $emailsender->sendEmailNotificationByMailJet($user,$email);


            $contact = new Contact();
            $form = $this->createForm(ContactType::class, $contact);
            $this->addFlash('contact_success', 'Votre message a été envoyé. Un conseiller vous répondra très rapidement !');
        }

        if($form->isSubmitted() && !$form->isValid()){
            $this->addFlash('contact_error', 'Le formulaire contient des erreurs. Veuillez corriger et réessayer.');
        }

        return $this->render('contact/new.html.twig', [
            'contact' => $contact,
            'form' => $form->createView(),
        ]);
    }

}
