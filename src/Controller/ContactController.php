<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\ContactType;

class ContactController extends AbstractController
{
    /**
     * @Route("/contact", name="contact")
     * @param \Swift_Mailer $mailer
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function index(Request $request, \Swift_Mailer $mailer)
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contactFormData = $form->getData();

            $message = (new \Swift_Message('Vous avez recu un mail'))
                ->setFrom($contactFormData->getEmail())
                ->setTo('christophelesieur45800@gmail.com')
                ->setReplyTo($contactFormData->getEmail())
                ->setBody(
                    'Message venant de :  ' .
                    ucwords($contactFormData->getLastName()) .' ' .
                    ucwords($contactFormData->getFirstname()) . ' : ' .
                    ' message :'.
                    $contactFormData->getMessage(),
                    'text/plain'
                );

            $mailer->send($message);

            $this->addFlash(
                'success',
                'Votre mail a bien été envoyé!'
            );
            return $this->redirectToRoute('contact');
        }
        return $this->render(
            '/contact/index.html.twig',
            [
                'form' => $form->createView()
            ]
        );
    }

}
