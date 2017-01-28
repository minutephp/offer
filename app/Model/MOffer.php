<?php
/**
 * Created by: MinutePHP Framework
 */
namespace App\Model {

    use Minute\Model\ModelEx;

    class MOffer extends ModelEx {
        protected $table      = 'm_offers';
        protected $primaryKey = 'offer_id';
    }
}