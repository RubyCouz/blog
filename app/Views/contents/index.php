<h2><?= esc($title) ?></h2>

<?php if (!empty($contents) && is_array($contents)) :
    if (!empty($flash)) :
?>
        <div class="alert alert-success alert-dismissible fade show" role="alert">

            <div>
                <?= $flash ?>
            </div>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>

    <?php
    endif;
    foreach ($contents as $content) : ?>
        <div class="row">
            <div class="col-lg-2">
                <img src="<?= base_url($content['content_pic']) ?>" class="img-thumbnail" alt="<?= esc($content['content_title']) ?>">

            </div>
            <div class="col-lg-10">
                <div class="row">
                    <div class="col-lg-10">
                        <h3><?= esc($content['content_title']) ?></h3>
                    </div>
                    <div class="col-lg-2">
                        <small class="text-muted">Publié le <?= $content['created_at'] ?></small>
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