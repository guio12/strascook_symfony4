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
            'success'=>$success
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
        ?>

        <div class="container">

            <?php if (!empty($errors)): ?>
                <div class="alert alert-danger">
                    Merci de corriger vos erreurs
                </div>
            <?php endif; ?>
            <div class="calendar__container">
                <h1>Ajouter un évènement</h1>
            </div>
            <br>
            <form action="" method="post" class="form">
                <?php render('calendar/form', ['data' => $data, 'errors' => $errors]); ?>
                <div class="form-group calendar__container">
                    <button class="btn btn-primary bouton">Ajouter l'évènement</button>
                </div>
            </form>
        </div>
        <?php
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
            'description' => $event->getDescription()
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
        ?>

        <div class="container">

            <h1>Editer l'évènement
                <small><?= h($event->getName()); ?></small>
            </h1>

            <form action="" method="post" class="form">
                <?php render('calendar/form', ['data' => $data, 'errors' => $errors]); ?>
                <div class="form-group">
                    <button class="btn btn-primary">Modifier l'évènement</button>
                </div>
            </form>
        </div>

        <?php
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
}