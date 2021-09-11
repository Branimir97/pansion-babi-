<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Form\BookingType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

/**
 * @Route("/booking/{_locale}")
 */
class BookingController extends AbstractController
{
    /**
     * @Route(name="booking", methods={"GET", "POST"})
     */
    public function index(Request $request, TranslatorInterface $translator): Response
    {
        $booking = new Booking();
        $form = $this->createForm(BookingType::class, $booking);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($booking);
            $entityManager->flush();

            $this->addFlash('success',
                $translator->trans('flash_message.inquirie_sent',
                    [], 'booking'));
            return $this->redirectToRoute('booking');
        }

        return $this->renderForm('booking/index.html.twig', [
            'booking' => $booking,
            'form' => $form,
        ]);
    }
}
