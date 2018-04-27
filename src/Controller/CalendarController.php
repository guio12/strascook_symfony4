<?php
namespace Controller;
use Controller\App\Validator;
use Controller\Calendar\Month;
use Model\Events;

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
        $pdo = get_pdo();
        $events = new Events($pdo);
        $month = new Month($_GET['month'] ?? null, $_GET['year'] ?? null);
        $start = $month->getStartingDay();
        $start = $start->format('N') === '1' ? $start : $month->getStartingDay()->modify('last monday');
        $weeks = $month->getWeeks();
        $end = $start->modify('+' . (6 + 7 * ($weeks -1)) . ' days');
        $events = $events->getEventsBetweenByDay($start, $end);

        $success=false;
        if (isset($_GET['success']))
        {$success = true;
        }

        return $this->twig->render('StrasCook/calendar/reservation_index.html.twig',
        ['month'=>$month,
            'weeks'=>$weeks,
            'start'=>$start,
            'today'=>date('Y-m-d'),
            'events'=>$events,
            'success'=>$success,
            'end'=>$end
        ]);
    }

    public function add()
    {
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
                'data'=>$data
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
                'description' => $event->getDescription()
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
    public function delete ()
    {
        $pdo = get_pdo();
        $event = new \Model\Events($pdo);
        $errors = [];

        $id = $_GET['id'];
        if (isset($_GET['deleteEvent'])) {
            $id = $_GET['id'];
            $events = new \Model\Events($pdo);
            //$eventToDelete = ($_POST['delete']);
            //$data = $_POST['delete'];

            $events->delete($id);
            header('Location: /reservation?success=1');
            exit();
        }
        $id = $event->getId();
        return $this->twig->render('StrasCook/calendar/reservation_edit.html.twig',
            ['errors'=>$errors,
                'id'=>$id,
                'eventToDelete'=>$eventToDelete
            ]);
        }



}