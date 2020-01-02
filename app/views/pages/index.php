<?php include_once APPROOT.'/views/inc/header.php'; ?>
    <div class="jumbotron jumbotron-fluid text-center">
        <div class="container">
            <h1 class="display-4"><?php echo $data['title']; ?></h1>
            <p class="lead"><?php echo $data['description']; ?></p>
            <p>Version: <?php echo APPVERSION; ?></p>
        </div>
    </div>
    <?php flash('pages_msg') ?>

    <h1>
        Our categories
    </h1>
    <div class="row home_list_cat">
    <?php foreach($data['categories'] as $cat) : ?>
        <a href="<?php echo URLROOT; ?>pages/index/<?php echo $cat->name ?>" class="new badge blue darken-1" ><?php echo $cat->name ?></a>
    <?php endforeach ?>
    </div>    
<?php if ($data['name']) : ?>
    <h1>
        Post found for <?php echo $data['name']; ?>
    </h1>
    <div class="row">
        <?php foreach ($data['catPosts'] as $post) : ?>
                <?php include APPROOT.'/views/inc/box_post.php' ?>
        <?php endforeach ?>
    </div>
<?php endif ?>

<h1>
    Last 4 SVG uploaded
</h1>
<div class="row">
    <?php foreach ($data['lastPosts'] as $post) : ?>
            <?php include APPROOT.'/views/inc/box_post.php' ?>
    <?php endforeach ?>
</div>
<h1>
    All the SVG
</h1>

<div class="row">
    <?php foreach ($data['posts'] as $post) : ?>
            <?php include APPROOT.'/views/inc/box_post.php' ?>
    <?php endforeach ?>
</div>    
    
<?php include_once APPROOT.'/views/inc/footer.php'; ?>