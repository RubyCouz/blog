<h2><?= esc($title) ?></h2>

<?php if (!empty($contents) && is_array($contents)) : ?>

    <?php foreach ($contents as $content) : ?>

        <h3><?= esc($content['content_title']) ?></h3>
        <div>
            <img src="<?= $content['content_pic'] ?>" class="img-thumbnail" alt="...">
        </div>
        <div class="main">
            <?= esc($content['content_text']) ?>
        </div>
        <p><a href="/contents/<?= esc($content['content_id'], 'url') ?>">View article</a></p>

    <?php endforeach ?>

<?php else : ?>

    <h3>No News</h3>

    <p>Unable to find any news for you.</p>

<?php endif ?>