<?php

namespace App\Controller;

#use Symfony\Component\HttpFoundation\Response;
#use Symfony\Component\Form\Extension\Core\Type\TextType;
use App\Entity\CoinHistory;
use App\Entity\JarEntity;
use App\Form\Type\counterType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\Session;
use App\Form\Type\countrType;
use Datetime;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Mapping\ClassMetadata;
use Symfony\Component\HttpFoundation\RedirectResponse;



class SwearJarController extends AbstractController
{
    /**
     * @Route("/")
     * @Route("/georgie")
     */
    public function georgie(Request $request)
    {
        return $this->preparePage();
    }
    /**
     * @Route("/add")
     */
    public function add(Request $request)
    {
        /*
        $RAW_QUERY = 'insert into coinHistory(timesignature, increase) values(NOW(), 1);update counters set amountcounter = amountcounter+1 where counterid = 1;';

        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();

        $entityManager = $this->getDoctrine()->getManager();
        */

        $request->headers->set('Location','http://localhost:8000/sub' );
        $this->changeAmount(1);
        return $this->preparePage(true);
    }

    /**
     * @Route("/sub")
     */
    public function sub(Request $request)
    {/*

        $em = $this->getDoctrine()->getManager();

        $RAW_QUERY = 'insert into coinHistory(timesignature, increase) values(NOW(), -1);update counters set amountcounter = amountcounter-1 where counterid = 1;';

        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();


        return $this->redirect($this->generateUrl('georgie'));*/

        $request->headers->set('Location','http://localhost:8000/sub' );

        $this->changeAmount(-1);

        return $this->preparePage(true);
    }

    private function changeAmount(int $delta){
        $em = $this->getDoctrine()->getManager();
        $subEntity = new CoinHistory();
        //$ch->setTimeSignature(DateTime("now"));
        $subEntity->setIncrease($delta);

        $em->persist($subEntity);

        $em->flush();
        $this->updateTotal($delta);
    }

    private function preparePage(bool $redirect = false){
        if($redirect)
            return $this->redirect('/');
        $addF = $this->createForm(counterType::class, null, ['label'=>'Add']);
        $subF = $this->createForm(counterType::class, null, ['label'=>'Subtract']);

        /*
        if ($addF->isSubmitted()) {
            return $this->redirect('http://localhost:8000/add');
        }
        if ($subF->isSubmitted()) {
            return $this->redirectToRoute('/sub');
        }*/
        $result = $this->getTotal();
        return $this->render('jar.html.twig', [
            'number' => $result['total'],
            'addF' => $addF->createView(),
            'subF' => $subF->createView(),
        ]);
    }

    private function getTotal(){
        $em = $this->getDoctrine()->getManager();

        $RAW_QUERY = 'select amountcounter  as "total" from counters where counterid = 1;'; //database is updated with trigger

        //$RAW_QUERY = 'select sum(increase)  as "total" from coin_history';
        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();

        $result = $statement->fetchAll()[0];

        return $result;
    }
    private function updateTotal(int $delta){
        $em = $this->getDoctrine()->getManager();
        $RAW_QUERY = 'update counters set amountcounter = amountcounter+'.$delta.' where counterid = 1;';
        $statement = $em->getConnection()->prepare($RAW_QUERY);
        $statement->execute();
    }
}