<form action="<?=$vars['object']->getURL()?>" method="post">

    <div class="row">
        <div class="span12">
            <label>
                Presentation title<br />
                <input type="text" name="title" id="title" value="<?=htmlspecialchars($vars['object']->title)?>" class="span11" placeholder="Enter a descriptive name for your presentation" />
            </label>
        </div>
    </div>
    <div id="slides">

        <?php

            if (!empty($vars['object']->slides)) {
                foreach($vars['object']->slides as $slide) {

                    ?>
                    <div class="row">
                        <div class="span12">
                            <p>
                                <label>
                                    Slide body <small><a href="#" onclick="$(this).parent().parent().parent().parent().parent().remove(); return false;">- Remove</a></small><br />
                                    <textarea name="slide[]" class="span11 bodyInput" ><?php echo htmlspecialchars($slide); ?></textarea>
                                </label>
                            </p>
                        </div>
                    </div>
                <?php

                }
            }

        ?>

    </div>
    <div class="row">
        <div class="span12">
            <p>
                <a href="#" onclick="$('#slides').append($('#hidden-template').html()); return false;">+ Add a new slide</a>
            </p>
        </div>
    </div>
    <div id="hidden-template" style="display: none">
        <div class="row">
            <div class="span12">
                <p>
                    <label>
                        Slide body <small><a href="#" onclick="$(this).parent().parent().parent().parent().parent().remove(); return false;">- Remove</a></small><br />
                        <textarea name="slide[]" class="span11 bodyInput"></textarea>
                    </label>
                </p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="span12">
            <?php if (empty($vars['object']->_id)) echo $this->drawSyndication('article'); ?>
            <p>
                <?= \Idno\Core\site()->actions()->signForm('/slides/edit') ?>
                <input type="submit" class="btn btn-primary" value="Save" />
                <input type="button" class="btn" value="Cancel" onclick="hideContentCreateForm();" />
            </p>
        </div>
    </div>

</form>