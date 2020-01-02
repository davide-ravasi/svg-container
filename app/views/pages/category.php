<?php include_once APPROOT.'/views/inc/header.php'; ?>
    <div class="jumbotron jumbotron-fluid text-center">
        <div class="container">
            <h1 class="display-3"><?php echo $data['title']; ?></h1>
            <p class="lead"><?php echo $data['description']; ?></p>
            <p>Version: <?php echo APPVERSION; ?></p>
        </div>
    </div>
    <?php flash('pages_msg') ?>

<h1>
    <i class="fas fa-heart"></i> <?php echo $data['category']; ?>
</h1>

<div class="row">
    <?php foreach ($data['posts'] as $post) : ?>
        <?php if ( trim($post->cat_name) == $data['category']) : ?>
            <?php include APPROOT.'/views/inc/box_post.php' ?>
        <?php endif ?>
    <?php endforeach ?>
</div>

<?php include_once APPROOT.'/views/inc/footer.php'; ?>