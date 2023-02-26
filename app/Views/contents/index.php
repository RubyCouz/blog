<h2><?= esc($title) ?></h2>

<?php if (!empty($contents) && is_array($contents)) : ?>

    <?php foreach ($contents as $content) : ?>
        <div class="row">
            <div class="col-lg-2">
                <img src="<?= base_url($content['content_pic']) ?>" class="img-thumbnail" alt="...">

            </div>
            <div class="col-lg-10">
                <div class="row">
                    <div class="col-lg-12">
                        <h3><?= esc($content['content_title']) ?></h3>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <?= esc($content['content_text']) ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-12">
                        <p><a href="/contents/<?= esc($content['content_id'], 'url') ?>">View article</a></p>
                    </div>
                </div>
            </div>
        </div>

    <?php endforeach ?>

<?php else : ?>

    <h3>No News</h3>

    <p>Unable to find any news for you.</p>

<?php endif ?>