<?php include_once APPROOT.'/views/inc/header.php'; ?>
    <div class="jumbotron jumbotron-fluid text-center">
        <div class="container">
            <h1 class="display-4"><?php echo $data['title']; ?></h1>
            <p class="lead"><?php echo $data['description']; ?></p>
            <p>We have found <?php echo "4" ?> results</p>
        </div>
    </div>

    <h1>
        All the SVG
    </h1>

    <div class="row">
        <?php if (count($data['posts']) > 0) : ?>
            <?php foreach ($data['posts'] as $post) : ?>
                    <?php include APPROOT.'/views/inc/box_post.php' ?>
            <?php endforeach ?>
        <?php else : ?>
            <p style="font-size: 20px">
                No results for this term :(    
            </p>
        <?php endif ?>
    </div>    
    
<?php include_once APPROOT.'/views/inc/footer.php'; ?>