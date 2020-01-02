<?php if(isLoggedIn()) : ?>
    <?php if(isLoggedIn() && isInWishlist($data['wishlist'],$post->postId)) : ?>
        <a class="link-addwishlist btn-floating btn-small waves-effect waves-light blue lighten-5" href="<?php echo URLROOT; ?>posts/removewishlist/<?php echo $post->postId ?>">
            <i class="material-icons">favorite</i>
        </a>
    <?php else : ?>
        <a class="link-addwishlist btn-floating btn-small waves-effect waves-light blue lighten-5" href="<?php echo URLROOT; ?>posts/addwishlist/<?php echo $post->postId ?>">
            <i class="material-icons">favorite_border</i>
        </a>
    <?php endif ?>
<?php endif ?>
