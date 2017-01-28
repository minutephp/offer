<?php
/**
 * User: Sanchit <dev@minutephp.com>
 * Date: 10/7/2016
 * Time: 3:10 AM
 */
namespace Minute\Offer {

    use App\Model\MOffer;
    use Minute\Cache\QCache;
    use Minute\Database\Database;
    use Minute\Dom\TagUtils;
    use Minute\Event\Dispatcher;
    use Minute\Event\ResponseEvent;
    use Minute\Http\HttpResponseEx;
    use Minute\Session\Session;
    use Minute\User\UserInfo;

    class InsertOffer {
        /**
         * @var QCache
         */
        private $cache;
        /**
         * @var Session
         */
        private $session;
        /**
         * @var Dispatcher
         */
        private $dispatcher;
        /**
         * @var UserInfo
         */
        private $userInfo;
        /**
         * @var TagUtils
         */
        private $tagUtils;
        /**
         * @var Database
         */
        private $database;

        /**
         * InsertOffer constructor.
         *
         * @param QCache $cache
         * @param Session $session
         * @param UserInfo $userInfo
         *
         * @param TagUtils $tagUtils
         *
         * @param Database $database
         *
         * @internal param Dispatcher $dispatcher
         */
        public function __construct(QCache $cache, Session $session, UserInfo $userInfo, TagUtils $tagUtils, Database $database) {
            $this->cache    = $cache;
            $this->session  = $session;
            $this->userInfo = $userInfo;
            $this->tagUtils = $tagUtils;
            $this->database = $database;
        }

        public function insert(ResponseEvent $event) {
            if ($this->database->isConnected()) {
                if ($event->isSimpleHtmlResponse()) {
                    /** @var HttpResponseEx $response */
                    $response = $event->getResponse();

                    $banner = $this->cache->get("active-offer", function () {
                        if ($offer = MOffer::where('enabled', '=', 'true')->where('running', '=', 'true')->first()) {
                            $banner = json_decode($offer->banner_json);

                            return $banner;
                        }

                        return null;
                    }, 3600);

                    if (!empty($banner->html)) {
                        $uri = $_SERVER['REQUEST_URI'];

                        if ($uri === '/' || $uri === '/index') {
                            $insert = !empty($banner->placement->homepage);
                        } elseif (preg_match('~^/members~', $uri)) {
                            $insert = !empty($banner->placement->members);
                        } elseif (preg_match('~^/admin~', $uri)) {
                            $insert = !empty($banner->placement->admin);
                        } else {
                            $insert = !empty($banner->placement->website);
                        }

                        if (!empty($insert)) {
                            if (empty($banner->visibility) || $this->hasAccess($banner->visibility)) {
                                $close  = ' &nbsp;<a class="close-icon" href="javascript:void(0)" onclick="alertify.clearLogs()"></a>';
                                $popup  = sprintf('<div class="banner-alert">%s</div>', $banner->html . $close);
                                $banner = sprintf('<script>alertify.delay(60000).logPosition("bottom right").log("%s");</script>', str_replace('"', '\\"', $popup));

                                $content = $this->tagUtils->insertBeforeTag('</body>', $banner, $response->getContent());
                                $response->setContent($content);
                            }
                        }
                    }
                }
            }
        }

        private function hasAccess($visibility) {
            if ($user_id = $this->session->getLoggedInUserId()) {
                $levels = array_map('trim', explode(',', $visibility));

                return $this->userInfo->containsGroup($user_id, $levels);
            }

            return false;
        }
    }
}
