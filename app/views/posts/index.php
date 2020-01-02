<?php include_once APPROOT.'/views/inc/header.php'; ?>
    <?php flash('post_added') ?>
    <div class="row mb-3 admin">
        <div class="col-md-12">
            <h1>
                SVG List
            </h1>
            <a href="<?php echo URLROOT; ?>posts/add" class="btn-floating btn-large waves-effect waves-light teal lighten-1 right" style="margin-top: -60px;"><i class="material-icons">add</i></a>
        </div>
<!--         <div class="col-md-6">
            <a href="<?php echo URLROOT; ?>posts/add" class="btn btn-primary pull-right">
                <i class="fa fa-pencil">add post</i>
            </a>    
        </div> -->
    </div>    
   
    <div class="row">
        <?php foreach ($data['posts'] as $post) : ?>
            <div class="col-md-3 box_post_admin">
               <a href="<?php echo URLROOT; ?>posts/show/<?php echo  $post->postId ?>" class="btn-floating btn-medium waves-effect waves-light teal lighten-1 mr-3 btn_edit_post_admin"><i class="material-icons">more_vert</i></a>
                <div class="card card-body mb-3 flex-row flex-wrap">
                    <div class="col-md-12 text-center">
                        <img width="100" src="<?php echo '/uploads/images/'.$post->image_url ?>" class="img-fluid" alt="">
                    </div>
                    <div class="col">
                        <h5 class="card-title text-center"><?php echo $post->title; ?></h5>
<!--                         <a href="<?php echo URLROOT; ?>posts/show/<?php echo  $post->postId ?>" class="btn btn-dark">More</a> -->
                    </div>
                    <div class="card-footer w-100 text-muted">
                       <div class="bg-light p-2">
                            Written by <?php echo $post->userName ?> 
                           on <?php echo date("d M Y", strtotime($post->postCreated)) ?> 
                        <div>
                            Category : <a href="<?php echo URLROOT; ?>categories"><?php echo $post->cat_name ?></a>
                        </div>
                    </div>
                </div>
            </div> 
        </div>     
        <?php endforeach ?>
    </div>
<?php include_once APPROOT.'/views/inc/footer.php'; ?>