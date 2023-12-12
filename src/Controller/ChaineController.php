<?php
namespace App\Controller;

use App\Entity\Chaine;
use App\Form\ChaineType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChaineController extends AbstractController
{
    /**
     * @Route("/", name="accueil")
     */
    public function listeChaines(): Response
    {
        $chaines = $this->getDoctrine()->getRepository(Chaine::class)->findAll();

        return $this->render('chaine/listeChaines.html.twig', [
            'chaines' => $chaines,
        ]);
    }

    /**
     * @Route("/recherche", name="recherche")
     */
    public function rechercheChaines(Request $request): Response
    {
        $libelle = $request->query->get('libelle');

        $chaines = $this->getDoctrine()->getRepository(Chaine::class)->findByLibelle($libelle);

        return $this->render('chaine/rechercheChaines.html.twig', [
            'chaines' => $chaines,
        ]);
    }

    /**
     * @Route("/chaine/ajouter", name="ajouter_chaine")
     */
    public function ajouterChaine(Request $request): Response
    {
        $chaine = new Chaine();
        $form = $this->createForm(ChaineType::class, $chaine);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($chaine);
            $entityManager->flush();

            return $this->redirectToRoute('accueil');
        }

        return $this->render('chaine/ajouterChaine.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/chaine/editer/{id}", name="editer_chaine")
     */
    public function editerChaine(Request $request, int $id): Response
    {
        $chaine = $this->getDoctrine()->getRepository(Chaine::class)->find($id);

        if (!$chaine) {
            throw $this->createNotFoundException('Chaine non trouvée');
        }

        $form = $this->createForm(ChaineType::class, $chaine);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('accueil');
        }

        return $this->render('chaine/editerChaine.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
