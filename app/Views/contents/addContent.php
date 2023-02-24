<h1><?= esc($title) ?></h1>
<div class="row">
    <div class="col-lg-6 offset-lg-3">
        <?php foreach ($errors as $error) : ?>
            <li><?= esc($error) ?></li>
        <?php endforeach ?>
        <form action="/contents/addContent" method="post" enctype="multipart/form-data">
            <?= csrf_field() ?>
            <div class="mb-3">
                <label for="content_title" class="form-label">Titre</label>
                <input type="text" name="content_title" class="form-control" id="content_title" placeholder="name@example.com">
            </div>
            <div class="mb-3">
                <label for="content_text" class="form-label">Texte</label>
                <textarea name="content_text" class="form-control" id="content_text" rows="3"></textarea>
            </div>
            <div class="mb-3">
                <label for="content_pic" class="form-label">Ajouter une photo</label>
                <input class="form-control" name="content_pic" type="file" id="content_pic">
            </div>
            <input type="submit" name="submit" value="Créer un post" class="btn btn-success">
        </form>
    </div>
</div>