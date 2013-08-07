<?php

    namespace IdnoPlugins\Presentation {

        class Main extends \Idno\Common\Plugin {
            function registerPages() {
                \Idno\Core\site()->addPageHandler('/slides/edit/?', '\IdnoPlugins\Presentation\Pages\Edit');
                \Idno\Core\site()->addPageHandler('/slides/edit/([A-Za-z0-9]+)/?', '\IdnoPlugins\Presentation\Pages\Edit');
                \Idno\Core\site()->addPageHandler('/slides/delete/([A-Za-z0-9]+)/?', '\IdnoPlugins\Presentation\Pages\Delete');
                \Idno\Core\site()->addPageHandler('/slides/([A-Za-z0-9]+)(/.*)?', '\Idno\Pages\Entity\View');
                \Idno\Core\site()->addPageHandler('/slideframe/([A-Za-z0-9]+)(/.*)?', '\IdnoPlugins\Presentation\Pages\Slide');
            }
        }

    }