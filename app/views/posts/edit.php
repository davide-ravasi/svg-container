<?php include_once APPROOT.'/views/inc/header.php'; ?>
    <div class="row justify-content-center admin">
        <h1 class="text-center">
            <a href="/posts/show/<?php echo $data['post_id'] ?>" class="btn-floating btn-large waves-effect waves-light teal lighten-1 mr-3 left" ><i class="material-icons">arrow_back</i></a>
        </h1>
        <?php echo flash('post_edited'); ?>
        <div class="col-md-6">
            <div class="card card-body bg-light mt-5">
                <h2>Edit SVG</h2>
                <form action="<?php echo URLROOT; ?>posts/edit/<?php echo $data['post_id'] ?>" method="post" enctype="multipart/form-data">
                    <div class="form group">
                        <label for="name">
                            Title: <sup>*</sup>
                        </label>
                        <input type="text" name="title" class="form-control form-control-lg <?php echo (!empty($data['title_err'])) ? 'is-invalid' : ''; ?>" value="<?php echo $data['title'] ?>">
                        <span class="invalid-feedback"><?php echo $data['title_err']; ?></span>
                    </div>
                    <div class="form group">
                        <label for="password">
                            Text: <sup>*</sup>
                        </label>
                        <textarea name="body" class="form-control form-control-lg <?php echo (!empty($data['body_err'])) ? 'is-invalid' : ''; ?>"><?php echo $data['body'] ?></textarea>
                        <span class="invalid-feedback"><?php echo $data['body_err']; ?></span>
                    </div>
                    <div class="form group">
                        <label for="category">
                            Category
                        </label>    
                            <select name="category" style="display:block;">
                                <?php foreach($data['categories'] as $category) : ?>
                                    <option value="<?php echo $category->id ?>" <?php if ($data['cat_id'] == $category->id) :?>selected <?php endif ?></option><?php echo $category->name ?></option>
                                <?php endforeach ?>
                            </select> 
                    </div>
                    <div class="form group">
                        <label for="file">
                            Image: <sup>*</sup>
                        </label>
                        <input type="file" id="file" class="form-control form-control-lg <?php echo (!empty($data['image_err'])) ? 'is-invalid' : ''; ?>" name="file" value="<?php echo $data['image_url'] ?>">
                        <span class="invalid-feedback"><?php echo $data['image_err']; ?></span>
                    </div>
                    <div class="row">
                        <div class="col"><input type="submit" value="edit" class="btn btn-success btn-block"></div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    
<?php include_once APPROOT.'/views/inc/footer.php'; ?>