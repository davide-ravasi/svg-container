<?php include_once APPROOT.'/views/inc/header.php'; ?>
    <div class="row justify-content-center admin">
       <h1 class="text-center">
            <a href="/categories ?>" class="btn-floating btn-large waves-effect waves-light teal lighten-1 mr-3 left" ><i class="material-icons">arrow_back</i></a>
        </h1>
        <div class="col-md-6">
            <div class="card card-body bg-light mt-5">
                <h2>Edit categorie</h2>
                <form action="<?php echo URLROOT; ?>categories/edit/<?php echo $data['id'] ?>" method="post">
                    <div class="form group">
                        <label for="name">
                            Name: <sup>*</sup>
                        </label>
                        <input type="text" name="name" class="form-control form-control-lg <?php echo (!empty($data['name_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['name'] ?>">
                        <span class="invalid-feedback"><?php echo $data['name_err']; ?></span>
                    </div>
                    <div class="row">
                        <div class="col"><input type="submit" value="edit" class="btn btn-success btn-block"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
<?php include_once APPROOT.'/views/inc/footer.php'; ?>