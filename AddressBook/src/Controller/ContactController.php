<?php

namespace App\Controller;

use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contacts")
 */
class ContactController extends AbstractController
{
    /**
     * @Route("/", methods={"GET"})
     */
    public function list()
    {
        $repo = $this->getDoctrine()->getRepository(Contact::class);

        return $this->render('contact/list.html.twig', [
            'contacts' => $repo->findBy([], ['firstName' => 'ASC'], 100),
        ]);
    }

    /**
     * @Route("/add", methods={"GET", "POST"})
     */
    public function add(Request $request)
    {
        $form = $this->createForm(ContactType::class);

        $form->handleRequest($request);

        // if ($request->isMethod('POST')) {}
        if ($form->isSubmitted() && $form->isValid()) {
            /** @var Contact $contact */
            $contact = $form->getData();

            $manager = $this->getDoctrine()->getManager();
            $manager->persist($contact);
            $manager->flush();

            $this->addFlash('success', "{$contact->getFirstName()} a bien été créé");

            return $this->redirectToRoute('app_contact_list');
        }

        return $this->render('contact/add.html.twig', [
            'contactForm' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", methods={"GET"}, requirements={"id": "[1-9][0-9]*"})
     */
    public function show($id)
    {
        $repo = $this->getDoctrine()->getRepository(Contact::class);

        $contact = $repo->find($id);

        if (!$contact) {
            // return $this->redirectToRoute('app_contact_list');
            throw $this->createNotFoundException('Contact not found');
        }

        return $this->render('contact/show.html.twig', [
            'contact' => $contact,
        ]);
    }
}
