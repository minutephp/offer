<?php
/**
 * User: Sanchit <dev@minutephp.com>
 * Date: 11/5/2016
 * Time: 11:04 AM
 */
namespace Minute\Todo {

    use App\Model\MOffer;
    use Minute\Config\Config;
    use Minute\Event\ImportEvent;

    class OfferTodo {
        /**
         * @var TodoMaker
         */
        private $todoMaker;

        /**
         * MailerTodo constructor.
         *
         * @param TodoMaker $todoMaker - This class is only called by TodoEvent (so we assume TodoMaker is be available)
         */
        public function __construct(TodoMaker $todoMaker, Config $config) {
            $this->todoMaker = $todoMaker;
        }

        public function getTodoList(ImportEvent $event) {
            $todos[] = ['name' => 'Create at least one special offer for site', 'description' => 'Like christmas sale, new year sale, etc',
                        'status' => MOffer::where('enabled', '=', 'true')->count() ? 'complete' : 'incomplete', 'link' => '/admin/offers'];

            $event->addContent(['Offers' => $todos]);
        }
    }
}