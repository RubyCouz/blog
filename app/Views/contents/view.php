<div class="row">
    <div class="col-lg-12">
        <h2><?= esc($contents['content_title']) ?></h2>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <small class="text-muted">Publié le <?= $contents['created_at'] ?></small>
    </div>
</div>
<div class="row">
    <div class="col-lg-6">
        <img src="<?= base_url($contents['content_pic']) ?>" class="img-thumbnail" alt="<?= esc($contents['content_title']) ?>">
    </div>
    <div class="col-lg-6">
        <p><?= esc($contents['content_text']) ?></p>
    </div>
</div>