<?php
/**
 * User: Sanchit <dev@minutephp.com>
 * Date: 10/7/2016
 * Time: 2:24 AM
 */
namespace App\Controller\Cron {

    use App\Model\MArBroadcast;
    use App\Model\MOffer;
    use App\Model\MPage;
    use Carbon\Carbon;
    use Minute\Event\Dispatcher;
    use Minute\Event\OfferEvent;

    class OfferCron {
        /**
         * @var Dispatcher
         */
        private $dispatcher;

        /**
         * OfferCron constructor.
         *
         * @param Dispatcher $dispatcher
         */
        public function __construct(Dispatcher $dispatcher) {
            $this->dispatcher = $dispatcher;
        }

        public function checkOffers() {
            if ($offers = MOffer::where('enabled', '=', 'true')->get()) {
                /** @var MOffer $offer */
                foreach ($offers as $offer) {
                    list($year, $month, $day) = explode('-', $offer->start_at);

                    $now   = Carbon::now();
                    $start = $offer->repeat === 'yearly' ? Carbon::create(null, $month, $day, 0, 0, 0) :
                        ($offer->repeat === 'monthly' ? Carbon::create(null, null, $day, 0, 0, 0) : Carbon::create($year, $month, $day, 0, 0, 0));

                    if ($now > $start) {
                        $diff = $now->diffInHours($start);

                        if ($diff < ($offer->duration + $offer->grace_period)) {
                            if ($offer->running === 'false') {
                                $offer->running = 'true';

                                if ($offer->save()) {
                                    MArBroadcast::unguard();
                                    MArBroadcast::updateOrCreate(['ar_campaign_id' => $offer->ar_campaign_id], ['send_at' => $now, 'mailing_time' => 1, 'status' => 'queued']);

                                    $this->updatePage($offer);
                                    $this->dispatcher->fire(OfferEvent::OFFER_START, new OfferEvent($offer->offer_id));
                                }
                            }
                        } elseif ($offer->running === 'true') {
                            $offer->running = 'false';

                            if ($offer->save()) {
                                $this->updatePage($offer);
                                $this->dispatcher->fire(OfferEvent::OFFER_END, new OfferEvent($offer->offer_id));
                            }
                        }
                    }
                }
            }
        }

        private function updatePage(MOffer $offer) {
            /** @var MPage $page */
            if ($page = MPage::find($offer->page_id)) {
                $page->redirect = $offer->running === 'true' ? null : "/offers/$offer->offer_id";

                return $page->save();
            }

            return false;
        }
    }
}