<?php include_once APPROOT.'/views/inc/header.php'; ?>
<div class="admin">
    <h1 class="text-center">
            <a href="/posts" class="btn-floating btn-large waves-effect waves-light teal lighten-1 mr-3 left" style="margin-top: -10px"><i class="material-icons">arrow_back</i></a>
        <?php echo $data['post']->title; ?>
    </h1>
<div class="card card-body mb-3 box_big_post">
    
    <?php if($data['post']->user_id == $_SESSION['user_id']) : ?>

        <a href="<?php URLROOT;?>/posts/edit/<?php echo $data['post']->id ?>" class="btn-floating btn-large waves-effect waves-light teal lighten-1 mr-3 btn_modify"><i class="material-icons">edit</i></a> 

        <a href="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id ?>" class="btn-floating btn-large waves-effect waves-light red btn_delete"><i class="material-icons">delete</i></a> 
    
<!--             <form action="<?php echo URLROOT; ?>/posts/delete/<?php echo $data['post']->id ?>" method="post" class="pull-right">
                <input type="submit" value="Delete" class="btn btn-danger" />    
            </form> -->
    <?php endif ?>
    
    <img width="50%" src="<?php echo '/uploads/images/'.$data['post']->image_url ?>" class="img-fluid mx-auto  show_image" alt=""> 

    <p class="text-center">
        <?php echo $data['post']->body; ?>
    </p>
    <p class="text-center">
        Written by <?php echo $data['user']->name; ?> 
        on <?php echo date("d M Y", strtotime($data['post']->created_at)); ?>
    </p>

    <div class="card-footer p-2 mb-3 text-center">
        Category : 
        <a href="<?php echo URLROOT; ?>categories" >
            <?php echo $data['category']->name; ?>
        </a>    
    </div>
</div> 
</div>    

<?php include_once APPROOT.'/views/inc/footer.php'; ?>