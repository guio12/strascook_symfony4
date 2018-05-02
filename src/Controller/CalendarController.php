<?php
namespace Controller;
use Controller\App\Validator;
use Controller\Calendar\Month;
use Model\Events;
use Model\MenusManager;

require 'boostrapCalendar/bootstrap.php';


/**
 * Created by PhpStorm.
 * User: root
 * Date: 11/10/17
 * Time: 15:38
 */

class CalendarController extends AbstractController
{

    public function index()
    {
        session_start();

        if (isset($_SESSION['user_id'])) {

            $admin = true;
            $pdo = get_pdo();
            $events = new Events($pdo);
            $month = new Month($_GET['month'] ?? null, $_GET['year'] ?? null);
            $start = $month->getStartingDay();
            $start = $start->format('N') === '1' ? $start : $month->getStartingDay()->modify('last monday');
            $weeks = $month->getWeeks();
            $end = $start->modify('+' . (6 + 7 * ($weeks - 1)) . ' days');
            $events = $events->getEventsBetweenByDay($start, $end);
            $success = false;
            if (isset($_GET['success'])) {
                $success = true;
            }
            $success_delete = false;
            if (isset($_GET['success_delete'])) {
                $success_delete = true;
            }
            return $this->twig->render('StrasCook/calendar/reservation_index.html.twig',
                ['month' => $month,
                    'weeks' => $weeks,
                    'start' => $start,
                    'today' => date('Y-m-d'),
                    'events' => $events,
                    'success' => $success,
                    'success_delete' => $success_delete,
                    'end' => $end,
                    'admin' => $admin
                ]);
        } else {

            $pdo = get_pdo();
            $events = new Events($pdo);
            $month = new Month($_GET['month'] ?? null, $_GET['year'] ?? null);
            $start = $month->getStartingDay();
            $start = $start->format('N') === '1' ? $start : $month->getStartingDay()->modify('last monday');
            $weeks = $month->getWeeks();
            $end = $start->modify('+' . (6 + 7 * ($weeks - 1)) . ' days');
            $events = $events->getEventsBetweenByDay($start, $end);
            $success = false;
            if (isset($_GET['success'])) {
                $success = true;
            }
            $success_delete = false;
            if (isset($_GET['success_delete'])) {
                $success_delete = true;
            }
            return $this->twig->render('StrasCook/calendar/reservation_index.html.twig',
                ['month' => $month,
                    'weeks' => $weeks,
                    'start' => $start,
                    'today' => date('Y-m-d'),
                    'events' => $events,
                    'success' => $success,
                    'success_delete' => $success_delete,
                    'end' => $end
                ]);
        }
    }

    public function add()
    {
        $donnees = [];
        $menusManager = new MenusManager();

        $resultatClassiques = $menusManager->affichageMenusClassiques();
        $resultatVegetariens = $menusManager->affichageMenusVegetariens();
        $resultatVegans = $menusManager->affichageMenusVegans();

        //return $this->twig->render('StrasCook/calendar/reservation_add.html.twig', ['donneesClassiques' => $resultatClassiques, 'donneesVegetariens' => $resultatVegetariens, 'donneesVegans' => $resultatVegans]);

        $data = [
            'date'  => $_GET['date'] ?? date('Y-m-d'),
            'start' => date('H:i'),
            'end'   => date('H:i')
        ];
        $validator = new Validator($data);
        if (!$validator->validate('date', 'date')) {
            $data['date'] = date('Y-m-d');
        }
        $errors = [];
        //echo $_GET['date'];
        $date_jour ='';
        if (isset($_GET['date'])) {
            $date_jour = $_GET['date'];
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $data = $_POST;
            $validator = new Calendar\EventValidator();

            $errors = $validator->validates($_POST);
            if (empty($errors)) {
                $events = new \Model\Events(get_pdo());
                $event = $events->hydrate(new \Model\Event(), $data);
                $events->create($event);
                header('Location: /reservation?success=1');
                exit();
            }
        }
        return $this->twig->render('StrasCook/calendar/reservation_add.html.twig',
            ['errors'=>$errors,
                'data'=>$data,
                'donneesClassiques' => $resultatClassiques,
                'donneesVegetariens' => $resultatVegetariens,
                'donneesVegans' => $resultatVegans,
                'date_jour' => $date_jour
            ]);
    }

    public function edit()
    {
        $pdo = get_pdo();
        $events = new \Model\Events($pdo);
        $errors = [];


        try {
            $event = $events->find($_GET['id'] ?? null);
        } catch (\Exception $e) {
            e404();
        } catch (\Error $e) {
            e404();
        }

        $menusManager = new MenusManager();

        $resultatClassiques = $menusManager->affichageMenusClassiques();
        $resultatVegetariens = $menusManager->affichageMenusVegetariens();
        $resultatVegans = $menusManager->affichageMenusVegans();
        $resultEventsName = $menusManager->recupNameEvents();

        $data = [
            'name'        => $event->getName(),
            'date'        => $event->getStart()->format('Y-m-d'),
            'start'       => $event->getStart()->format('H:i'),
            'end'         => $event->getEnd()->format('H:i'),
            'description' => $event->getDescription(),
            'id'          => $event->getId()
        ];

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $data = $_POST;
            $validator = new Calendar\EventValidator();
            $errors = $validator->validates($data);
            if (empty($errors)) {
                $events->hydrate($event, $data);
                $events->update($event);
                header('Location: /reservation?success=1');
                exit();
            }
        }
        return $this->twig->render('StrasCook/calendar/reservation_edit.html.twig',
            ['errors'=>$errors,
                'name'=> $event->getName(),
                'data'=>$data,
                'event'=>$event,
                'date'=> $event->getStart()->format('Y-m-d'),
                'start'=>$event->getStart()->format('H:i'),
                'end'=>$event->getEnd()->format('H:i'),
                'description' => $event->getDescription(),
                'donneesClassiques' => $resultatClassiques, 'donneesVegetariens' => $resultatVegetariens, 'donneesVegans' => $resultatVegans, 'eventsName' => $resultEventsName
            ]);
    }

    public function event()
    {
        $pdo = get_pdo();
        $events = new Calendar\Events($pdo);
        if (!isset($_GET['id'])) {
            header('location: /404.php');
        }
        try {
            $event = $events->find($_GET['id']);
        } catch (\Exception $e) {
            e404();
        }

        ?>

        <h1><?= h($event->getName()); ?></h1>

        <ul>
            <li>Date: <?= $event->getStart()->format('d/m/Y'); ?></li>
            <li>Heure de démarrage: <?= $event->getStart()->format('H:i'); ?></li>
            <li>Heure de fin: <?= $event->getEnd()->format('H:i'); ?></li>
            <li>
                Description:<br>
                <?= h($event->getDescription()); ?>
            </li>
        </ul>

        <?php
    }

    /**
     * @return string
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function delete (int $id)
    {
        $pdo = get_pdo();
        $errors = [];

        $events = new Events($pdo);
        //$eventToDelete = ($_POST['delete']);
        //$data = $_POST['delete'];

        $events->delete($id);
        header('Location: /reservation?success_delete=1');
        exit();

        return $this->twig->render('StrasCook/calendar/reservation_edit.html.twig',
            ['errors'=>$errors,
                'id'=>$id,
                'eventToDelete'=>$eventToDelete
            ]);
    }



}