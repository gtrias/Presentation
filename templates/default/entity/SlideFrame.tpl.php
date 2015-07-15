<!doctype html>
<head>
    <title><?php echo htmlspecialchars($vars['object']->getTitle()); ?></title>
    <link rel="stylesheet" href="http://shwr.me/shower/themes/bright/styles/screen.css">
    <meta charset="utf-8" />
</head>
<body>
<header class="caption">
    <h1><a href="<?php echo $vars['object']->getURL(); ?>"><?php echo $vars['object']->getTitle(); ?></a></h1>

    <p>
        <a href="<?php echo $vars['object']->getURL(); ?>">Hosted
            on <?php echo \Idno\Core\site()->config()->title; ?></a>
    </p>
</header>
<?php

    if (!empty($vars['object']->slides) && is_array($vars['object']->slides)) {

        foreach ($vars['object']->slides as $slide) {

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
</body>
</html>
