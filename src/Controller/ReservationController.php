<?php

namespace Controller;
//ajout bootstrap
require 'boostrapCalendar/bootstrap.php';
//fin ajout bootstrap

use Model\Month;
use Controller\Event;
use Controller\Events;
use Controller\EventValidator;
use \PDO;

class ReservationController extends AbstractController
{
    //ajout bootstrap.php
    function e404 () {
        require '../public/404.php';
        exit();
    }

    function dd(...$vars) {
        foreach($vars as $var) {
            echo '<pre>';
            var_dump($var);
            echo '</pre>';
        }
    }

    function get_pdo (): PDO {
        return new PDO('mysql:host=localhost;dbname=strascook', 'root', 'Wild3r', [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
        ]);
    }

    function h(?string $value): string {
        if ($value === null) {
            return '';
        }
        return htmlentities($value);
    }

    function render(string $view, $parameters = []) {
        extract($parameters);
        include "../views/{$view}.php";
    }
    // fin ajout bootstrap

    public function index()
    {
        $pdo = $this->get_pdo();
        $events = new Calendar\Events($pdo);
        $month = new Calendar\Month($_GET['month'] ?? null, $_GET['year'] ?? null);
        $start = $month->getStartingDay();
        $start = $start->format('N') === '1' ? $start : $month->getStartingDay()->modify('last monday');
        $weeks = $month->getWeeks();
        $end = $start->modify('+' . (6 + 7 * ($weeks -1)) . ' days');
        $events = $events->getEventsBetweenByDay($start, $end);

        return $this->twig->render('View/StrasCook/reservation.html.twig');
    }



    /**
     * @param $id
     * @return string
     */
    public function show(int $id)
    {
        $itemManager = new ItemManager();
        $item = $itemManager->findOneById($id);

        return $this->twig->render('Item/show.html.twig', ['item' => $item]);
    }

    /**
     * @param $id
     * @return string
     */
    public function edit(int $id)
    {
        // TODO : edit item with id $id
        return $this->twig->render('Item/edit.html.twig', ['item', $id]);
    }

    /**
     * @param $id
     * @return string
     */
    public function add()
    {
        // TODO : add a new item
        return $this->twig->render('Item/add.html.twig');
    }

    /**
     * @param $id
     * @return string
     */
    public function delete(int $id)
    {
        // TODO : delete the item with id $id
        return $this->twig->render('Item/index.html.twig');
    }
}
