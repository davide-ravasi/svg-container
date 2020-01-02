<div class="col-md-3">
    <div class="card card-body mb-3 flex-row flex-wrap card_front">

        <?php include APPROOT.'/views/inc/btn_wishlist.php' ?>
        
       <?php if(strtotime($post->postCreated) > strtotime('15 hours ago') )  : ?>
            <span class="badge cat_link new_post">NEW</span> 
       <?php endif ?> 

        <div class="col-md-12 text-center">
            <img width="100" src="<?php echo '/uploads/images/'.$post->image_url ?>" class="img-fluid" alt="">
        </div>
        <div class="col">
            <h5 class="card-title text-center"><?php echo $post->title; ?></h5>
<!--             <div class="card_text"><?php echo $post->body; ?></div> -->
            <a class="btn_show btn-floating btn-small waves-effect waves-light blue darken-3" href="<?php echo URLROOT; ?>pages/show/<?php echo  $post->postId ?>" class="btn btn-dark">
            <i class="material-icons">more_vert</i>
            </a>
            
            <?php if(isLoggedIn()) : ?>
                <a class="btn_download btn-floating btn-small waves-effect waves-light blue darken-3" href="<?php echo '/uploads/images/'.$post->image_url ?>" download>
                    <i class="material-icons">file_download</i>
                </a> 
            <?php endif ?>
        </div>
        <div class="card-footer w-100 text-muted">
           <div class="bg-light">
                Written by <?php echo $post->userName ?> 
               on <?php echo date("d M Y", strtotime($post->postCreated)) ?>
            </div>
            <span class="badge cat_link">
                <a href="<?php echo URLROOT; ?>pages/category/<?php echo $post->cat_name ?>" ><?php echo $post->cat_name ?></a>
            </span>
        </div>
    </div>
</div>    