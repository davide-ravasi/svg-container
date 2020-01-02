<?php include_once APPROOT.'/views/inc/header.php'; ?>
    <?php flash('categorie_added') ?>
    <div class="row mb-3 admin">
        <div class="col-md-12">
            <h1>
                Categories
            </h1>         
            <a href="<?php echo URLROOT; ?>categories/add" class="btn-floating btn-large waves-effect waves-light teal lighten-1 right" style="margin-top: -60px;"><i class="material-icons">add</i></a>
        
        </div>
    </div>    
        
    <?php foreach ($data['categories'] as $cat) : ?>
        <div class="card card-body mb-3 flex-row flex-wrap <?php if($cat->name != 'miscellaneous') : ?> special<?php endif ?>">
            <div class="col">
                <h5 class="card-title"><?php echo $cat->name; ?></h5>
            </div>
            <?php if($cat->name != 'miscellaneous') : ?>  
                    <a href="<?php echo URLROOT; ?>categories/edit/<?php echo  $cat->id ?>" class="btn-floating btn-medium waves-effect waves-light teal lighten-1 mr-3"><i class="material-icons">edit</i></a> 
                    
<!--             <form action="<?php echo URLROOT; ?>/categories/delete/<?php echo  $cat->id ?>" method="post" class="pull-right">
                <input type="submit" value="Delete" class="btn btn-danger" />    
            </form> -->
            <a href="<?php echo URLROOT; ?>/categories/delete/<?php echo  $cat->id ?>" class="btn-floating btn-medium waves-effect waves-light red"><i class="material-icons">delete</i></a> 
            <?php endif ?>
        </div>
    <?php endforeach ?>
    
<?php include_once APPROOT.'/views/inc/footer.php'; ?>