<?php
/**
 * User: Sanchit <dev@minutephp.com>
 * Date: 10/7/2016
 * Time: 1:04 PM
 */
namespace Minute\Event {

    class OfferEvent extends Event {
        const OFFER_START = 'offer.start';
        const OFFER_END   = 'offer.end';
        /**
         * @var
         */
        private $offer_id;

        /**
         * OfferEvent constructor.
         *
         * @param $offer_id
         */
        public function __construct($offer_id) {
            $this->offer_id = $offer_id;
        }

        /**
         * @return mixed
         */
        public function getOfferId() {
            return $this->offer_id;
        }

    }
}