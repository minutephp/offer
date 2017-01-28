<?php
/**
 * User: Sanchit <dev@minutephp.com>
 * Date: 7/8/2016
 * Time: 7:57 PM
 */
namespace Minute\Menu {

    use Minute\Event\ImportEvent;

    class OfferMenu {
        public function adminLinks(ImportEvent $event) {
            $links = [
                'offers' => ['title' => 'Site offers', 'icon' => 'fa-gift', 'priority' => 3, 'href' => '/admin/offers']
            ];

            $event->addContent($links);
        }
    }
}