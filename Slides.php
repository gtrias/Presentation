<?php

    namespace IdnoPlugins\Presentation {

        class Slides extends \Idno\Common\Entity {

            function getTitle() {
                if (empty($this->title)) return 'Untitled';
                return $this->title;
            }

            function getDescription() {
                if (!empty($this->slides)) {
                    if (is_array($this->slides)) {
                        return implode(' ',$this->slides);
                    } else {
                        return $this->slides;
                    }
                }
                return '';
            }

            function getShortDescription() {
                $slides = sizeof($this->slides);
                if ($slides == 1) {
                    $s = '';
                } else {
                    $s = 's';
                }
                return 'Presentation with ' . sizeof($this->slides) . ' slide' . $s;
            }

            function getURL() {
                if (($this->getID())) {
                    return \Idno\Core\site()->config()->url . 'slides/' . $this->getID(); // . '/' . $this->getPrettyURLTitle();
                } else {
                    return parent::getURL();
                }
            }

            /**
             * Slides objects have type 'article'
             * @return 'article'
             */
            function getActivityStreamsObjectType() {
                return 'article';
            }

            function saveDataFromInput() {

                if (empty($this->_id)) {
                    $new = true;
                } else {
                    $new = false;
                }
                $slides = \Idno\Core\site()->currentPage()->getInput('slide');
                $title = \Idno\Core\site()->currentPage()->getInput('title');

                // Remove blank slides
                if (is_array($slides)) {
                    foreach($slides as $key => $slide) {
                        if (empty($slide)) {
                            unset($slides[$key]);
                        }
                    }
                } else {
                    $slides = array();
                }

                $this->slides = $slides;
                $this->title = $title;
                $this->body = $this->getDescription();
                $this->setAccess('PUBLIC');
                if ($this->save()) {
                    if ($new) {
                        // Add it to the Activity Streams feed
                        $this->addToFeed();
                    }
                    \Idno\Core\Webmention::pingMentions(\Idno\Core\site()->config()->url . 'slideframe/' . $this->getID(), \Idno\Core\site()->template()->parseURLs($this->getDescription()));
                    \Idno\Core\site()->session()->addMessage('Your slides were successfully saved.');
                    return true;
                }
                return false;

            }

            function deleteData() {
                \Idno\Core\Webmention::pingMentions($this->getURL(), \Idno\Core\site()->template()->parseURLs($this->getDescription()));
            }

        }

    }