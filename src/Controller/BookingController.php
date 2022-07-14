<?php

namespace App\Controller;

use App\Entity\Booking;
use App\Form\BookingType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Constraints\DateTime;
use Symfony\Contracts\Translation\TranslatorInterface;

class BookingController extends AbstractController
{
//    /**
//     * @Route({
//     *     "hr": "/rezervacije",
//     *     "en": "/booking",
//     *     "it": "/prenotazioni",
//     *     "de": "/reservierungen"
//     * }, name="booking", methods={"GET", "POST"})
//     */
    #[Route("/booking", name: "booking")]
    public function index(Request $request,
                          TranslatorInterface $translator,
                          MailerInterface $mailer): Response
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

            $email = (new TemplatedEmail())
                ->to('pansion.babic@gmail.com')
                ->from($form->get('email')->getData())
                ->subject('Novi upit')
                ->context([
                    'name' => $form->get('name')->getData(),
                    'surname' => $form->get('surname')->getData(),
                    'email_address' => $form->get('email')->getData(),
                    'phoneNumber' => $form->get('phoneNumber')->getData(),
                    'startDate' => $form->get('startDate')->getData(),
                    'endDate' => $form->get('endDate')->getData(),
                    'createdAt' => $booking->getCreatedAt()
                ])
                ->htmlTemplate('email/new_inquirie.html.twig');
            try {
                $mailer->send($email);
            } catch (TransportExceptionInterface $exception) {}
            return $this->redirectToRoute('booking');
        }
        return $this->renderForm('booking/index.html.twig', [
            'booking' => $booking,
            'form' => $form,
        ]);
    }
}
