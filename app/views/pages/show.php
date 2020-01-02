<?php include_once APPROOT.'/views/inc/header.php'; ?>
<?php $post =$data['post']; ?>
<?php $post->postId = $data['post']->id ?>
<h1 class="text-center">
      <a href="/pages" class="btn-floating btn-large waves-effect waves-light blue darken-3 mr-3 left" style="margin-top: -10px"><i class="material-icons">arrow_back</i></a>
    <?php echo $data['post']->title; ?>
</h1>

<div class="card card-body mb-3 box_big_post">
    
    <?php include APPROOT.'/views/inc/btn_wishlist.php' ?>
    
    <?php if(isLoggedIn()) : ?>
    <a class="btn_download btn-floating btn-large waves-effect waves-light blue darken-3" href="<?php echo '/uploads/images/'.$data['post']->image_url ?>" download="<?php echo '/uploads/images/'.$data['post']->image_url ?>">
                <i class="material-icons">file_download</i>
    </a>
<?php endif ?>
    
        <img width="50%" src="<?php echo '/uploads/images/'.$data['post']->image_url ?>" class="img-fluid mx-auto  show_image" alt="">    
    <p class="text-center">
        <?php echo $data['post']->body; ?>
    </p>
    
    <p class="text-center">
        Written by <?php echo $data['user']->name; ?> on <?php echo date("d M Y", strtotime($data['post']->created_at)); ?>
        
    </p>

    <div class="card-footer p-2 mb-3 text-center">
        Category : 
        <a href="<?php echo URLROOT; ?>pages/category/<?php echo $post->cat_name ?>" >
            <?php echo $data['category']->name; ?>
        </a>
    </div>



</div>    

<h1>
    Related posts for <?php echo $data['category']->name; ?>
</h1>
<div class="row">
    <?php foreach ($data['posts'] as $post) : ?>
        <?php if ( $post->cat_name == $data['category']->name) : ?>
            <?php include APPROOT.'/views/inc/box_post.php' ?>
        <?php endif ?>
    <?php endforeach ?>
</div>

<?php include_once APPROOT.'/views/inc/footer.php'; ?>