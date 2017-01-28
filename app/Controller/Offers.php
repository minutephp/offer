<?php
/**
 * Created by: MinutePHP framework
 */
namespace App\Controller {

    use Minute\View\View;

    class Offers {
        public function index() {
            return (new View('ActiveTheme/Offers'));
        }
    }
}