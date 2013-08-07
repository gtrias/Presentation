<?php

    /**
     * Slide viewer
     */

    namespace IdnoPlugins\Presentation\Pages {

        class Slide extends \Idno\Common\Page
        {

            // Handle GET requests to the entity

            function getContent()
            {
                if (!empty($this->arguments[0])) {
                    $object = \Idno\Common\Entity::getByID($this->arguments[0]);
                }
                if (empty($object)) {
                    $this->goneContent();
                }

                $this->setPermalink();  // This is a permalink
                $t = \Idno\Core\site()->template();
                echo $t->__(['object'=> $object])->draw('entity/SlideFrame');
                /*$t->__(array(

                    'title' => $object->getTitle(),
                    'body' => $t->__(array('object' => $object->getRelatedFeedItems()))->draw('entity/shell'),
                    'description' => $object->getShortDescription()

                ))->drawPage();*/
            }

            // Get webmention content and handle it

            function webmentionContent($source, $target, $source_content, $source_mf2) {
                if (!empty($this->arguments[0])) {
                    $object = \Idno\Common\Entity::getByID($this->arguments[0]);
                }
                if (empty($object)) return false;

                $return = true;

                if ($object instanceof \Idno\Common\Entity) {
                    $return = $object->addWebmentions($source, $target, $source_content, $source_mf2);
                }

                return $return;
            }

            // Handle POST requests to the entity

            function postContent() {
                if (!empty($this->arguments[0])) {
                    $object = \Idno\Common\Entity::getByID($this->arguments[0]);
                }
                if (empty($object)) $this->forward(); // TODO: 404
                if ($object->saveDataFromInput($this)) {
                    $this->forward($object->getURL());
                }
                $this->forward($_SERVER['HTTP_REFERER']);
            }

            // Handle DELETE requests to the entity

            function deleteContent() {
                if (!empty($this->arguments[0])) {
                    $object = \Idno\Common\Entity::getByID($this->arguments[0]);
                }
                if (empty($object)) $this->forward(); // TODO: 404
                if ($object->delete()) {
                    \Idno\Core\site()->session()->addMessage($object->getTitle() . ' was deleted.');
                }
                $this->forward($_SERVER['HTTP_REFERER']);
            }

        }

    }