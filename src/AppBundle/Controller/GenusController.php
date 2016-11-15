<?php
/**
 * Created by PhpStorm.
 * User: bemben
 * Date: 05/11/2016
 * Time: 13:32
 */

namespace AppBundle\Controller;


use AppBundle\Entity\Genus;
use AppBundle\Entity\GenusNote;
use AppBundle\Service\MarkdownTransformer;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class GenusController extends Controller
{
    /**
     * @Route("/genus", name="admin_genus_list" )
     */
    public function listAction()
    {
        $em = $this->getDoctrine()->getManager();
        $genueses = $em->getRepository('AppBundle:Genus')
            ->findAllPublishedOrderedByRecentlyActive();
//        dump($em->getRepository('AppBundle:Genus')->findAllPublishedOrderedBySize());
//        die;
        //return new Response("Dziala");
        return $this->render('genus/showlist.html.twig',
            array(
                'genueses' => $genueses
            ));
    }

    /**
     * @return Response
     *
     */
    public function newAction()
    {
        $genus = new Genus();
        $genus->setName('Octopusi' . rand(1, 100));
        $genus->setSubFamily('Pizdopuss');
        $genus->setSpeciesCount(rand(100, 9000));

        $note = new GenusNote();
        $note->setUsername('AquaWever');
        $note->setUserAvatarFilename('ryan.jpeg');
        $note->setNote('I counted 8 legs... as they wrapped around me');
        $note->setCreateAt(new \DateTime('-1 month'));
        $note->setGenus($genus);


        $em = $this->getDoctrine()->getManager();
        $em->persist($genus);
        $em->persist($note);
        $em->flush();
        return new Response('<html><body>Genus Created</body></html>');
    }

    /**
     * @Route("/genus/{genusName}", name="genus_show")
     */
    public function showAction($genusName)
    {
        $funFact = 'ctopuses can change the color of their body in just *three-tenths* of a second!';

//        $cache = $this->get('doctrine_cache.providers.my_markdown_cache');
//        $key = md5($funFact);
//        if ($cache->contains($key)){
//            $funFact =  $cache->fetch($key);
//        }else {
//            sleep(1);
//            $funFact = $this->get('markdown.parser')
//                ->transform($funFact);
//            $cache->save($key, $funFact);
//        }

        $em = $this->getDoctrine()->getManager();
        $genus = $em->getRepository('AppBundle:Genus')
            ->findOneBy(['name' => $genusName]);

        if (!$genus) {
            throw $this->createNotFoundException('genus not found');
        }

        // normalnie
       // $markdownParser = new MarkdownTransformer($this->get('markdown.parser'));
        // teraz jako service po dodaniu w app/config/service.yml
         $markdownTransformer = $this->get('app.markdown_transformer');
        $funFact = $markdownTransformer->parse($genus->getFunFact());

        // filfter ArrayColllection and return only 3 last months notes
//        $recentNotes = $genus->getNotes()->filter(function (GenusNote $note){
//           return $note->getCreateAt() > new \DateTime('-3 month');
//        });
        // zamiast filtra custom query
        $recentNotes = $em->getRepository('AppBundle:GenusNote')
            ->findAllRecentNotesForGenus($genus);

        return $this->render('genus/show.html.twig',
            array(
                'genus' => $genus,
                'name' => $genus->getName(),
                'funFact'=> $funFact,
                'recentNoteCount'=>count($recentNotes)
            )
        );
    }

    /**
     * @Route("/genus/{name}/notes", name="genus_show_notes")
     * @Method("GET")
     */
    public function getNotesAction(Genus $genus)
    {
        $notes = [];
        foreach ($genus->getNotes() as $note) {
            $notes[] = [
                'id' => $note->getId(),
                'username' => $note->getUsername(),
                'avatarUri' => '/images/' . $note->getUserAvatarFilename(),
                'note' => $note->getNote(),
                'date' => $note->getCreateAt()->format('M d, Y')
            ];

        }

//        $notes = [
//            ['id' => 1, 'username' => 'AquaPelham', 'avatarUri' => '/images/leanna.jpeg', 'note' => 'Octopus asked me a riddle, outsmarted me', 'date' => 'Dec. 10, 2015'],
//            ['id' => 2, 'username' => 'AquaWeaver', 'avatarUri' => '/images/ryan.jpeg', 'note' => 'I counted 8 legs... as they wrapped around me', 'date' => 'Dec. 1, 2015'],
//            ['id' => 3, 'username' => 'AquaPelham', 'avatarUri' => '/images/leanna.jpeg', 'note' => 'Inked!', 'date' => 'Aug. 20, 2015'],
//        ];

//        $em = $this->getDoctrine()->getManager();
//        $genus = $em->getRepository('AppBundle:Genus')
//            ->findOneBy(['name' => $genusName]);

        $data = [
            'notes' => $notes,
        ];
        return new JsonResponse($data);
    }
}