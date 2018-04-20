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
        ?>

        <div class="calendar">

            <div class="calendar__container">
                <h1><?= $month->toString(); ?></h1>

                <?php if (isset($_GET['success'])): ?>
                    <div class="container">
                        <div class="alert alert-success">
                            L'évènement a bien été enregistré
                        </div>
                    </div>
                <?php endif; ?>

            </div>

            <div class="container calendar__nav col-md-8 col-sm-10 col-xs-12"">
            <div class="nav__previous">
                <a href="/reservation?month=<?= $month->previousMonth()->month; ?>&year=<?= $month->previousMonth()->year; ?>" class="btn btn-primary bouton"><</a>
            </div>
            <div class="nav__next">
                <a href="/reservation?month=<?= $month->nextMonth()->month; ?>&year=<?= $month->nextMonth()->year; ?>" class="btn btn-primary bouton">></a>
            </div>
        </div>
        <br>

        <div class="container col-md-8 col-sm-10 col-xs-12">
            <table class="calendar__table calendar__table--<?= $weeks; ?>weeks">
                <?php for ($i = 0; $i < $weeks; $i++): ?>
                    <tr>
                        <?php
                        foreach($month->days as $k => $day):
                            $date = $start->modify("+" . ($k + $i * 7) . " days");
                            $eventsForDay = $events[$date->format('Y-m-d')] ?? [];
                            $isToday = date('Y-m-d') === $date->format('Y-m-d');
                            ?>
                            <td class="<?= $month->withinMonth($date) ? '' : 'calendar__othermonth'; ?> <?= $isToday ? 'is-today' : ''; ?>">
                                <?php if ($i === 0): ?>
                                    <div class="calendar__weekday"><?= $day; ?></div>
                                <?php endif; ?>
                                <a class="calendar__day" href="/reservation/add?date=<?= $date->format('Y-m-d'); ?>"><?= $date->format('d'); ?></a>
                                <?php foreach($eventsForDay as $event): ?>
                                    <div class="calendar__event">
                                        <?= $event->getStart()->format('H:i') ?> - <a href="/reservation/edit?id=<?= $event->getId(); ?>"><?= h($event->getName()); ?></a>
                                    </div>
                                <?php endforeach; ?>
                            </td>
                        <?php endforeach; ?>
                    </tr>
                <?php endfor; ?>
            </table>
        </div>

        <a href="/reservation/add" class="calendar__button bouton">+</a>

        </div>

        <?php
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
                header('Location: /index?success=1');
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
        $events = new Calendar\Events($pdo);
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
                header('Location: /index?success=1');
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