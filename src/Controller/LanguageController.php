<?php

namespace App\Controller;

/**
 * Class LanguageController
 */
class LanguageController extends AppController
{
    /**
     * Set language
     */
    public function language()
    {
        $lang = $this->request->getQueryParam('lang');
        $this->session->set('lang', $lang);
        $referer = $this->request->getHeaders();
    }
}
