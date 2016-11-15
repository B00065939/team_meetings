<?php
/**
 * Created by PhpStorm.
 * User: bemben
 * Date: 06/11/2016
 * Time: 19:51
 */

namespace AppBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MainController extends Controller
{
    public function homepageAction()
    {
        return $this->render('main/homepage.html.twig');
    }
}