<?php

    $slides = sizeof($vars['object']->slides);

?>

    <h2>
        <a href="<?php echo $vars['object']->getURL(); ?>"><?php echo htmlspecialchars($vars['object']->getTitle()); ?></a>
    </h2>
    <p>
        <a href="<?php echo \Idno\Core\site()->config()->url ?>slides/<?php echo $vars['object']->getID() ?>/view" class="btn" target="_blank">
            Click here to view <?php echo $slides; ?> slide<?php if ($slides != 1) echo 's'; ?> <i class="icon-play-sign"></i>
        </a>
    </p>