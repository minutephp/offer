<?php
/**
 * Created by: MinutePHP Framework
 */
namespace App\Model {

    use Minute\Model\ModelEx;

    class MOfferWaitlist extends ModelEx {
        protected $table      = 'm_offer_waitlist';
        protected $primaryKey = 'offer_waitlist_id';
    }
}