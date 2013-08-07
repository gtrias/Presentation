<link rel="stylesheet" href="http://shwr.me/shower/themes/ribbon/styles/screen.css">
<?php

    if (!empty($vars['object']->slides) && is_array($vars['object']->slides)) {

        foreach($vars['object']->slides as $slide) {

            ?>

            <section class="slide">
                <div>
                    <?php

                        echo $this->autop($this->parseHashtags($slide));

                    ?>
                </div>
            </section>

        <?php

        }

    }

?>
<script src="/IdnoPlugins/Presentation/external/shower/shower.min.js"></script>