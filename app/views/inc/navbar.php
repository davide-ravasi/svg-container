 <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-3">
      <a class="navbar-brand" href="<?php echo URLROOT; ?>">
        <?php echo SITENAME; ?>
      </a>
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <ul class="navbar-nav mr-auto">
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>">
                <i class="fas fa-home"></i>
                Home <span class="sr-only">(current)</span></a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="<?php echo URLROOT; ?>pages/about">About</a>
          </li>
          <?php if(isset($_SESSION['user_id']))  : ?>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo URLROOT; ?>pages/wishlist">
                    <i class="fas fa-heart"></i>
                    Wishlist
                </a>
              </li>
            <?php endif ?>
        </ul>
        <form class="form-inline my-2 my-lg-0" action="<?php echo URLROOT; ?>pages/search" method="post">
            <input class="form-control mr-sm-2" type="search" name="search" placeholder="Search" aria-label="Search">
        </form>
        <ul class="navbar-nav ml-auto">
            <?php if(isset($_SESSION['user_id'])) : ?>
                  <li class="navbar-text">
                    <i class="fas fa-user"></i> Welcome <?php echo $_SESSION['user_name'] ?>
                  </li>               
            <?php endif ?>
            <?php if(isset($_SESSION['user_id']) && (isAdmin())) : ?>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>posts/index">Svg's list</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>categories/index">Categories</a>
                  </li>
            <?php endif ?>
            <?php if(isset($_SESSION['user_id']))  : ?>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>users/logout">
                        <i class="fas fa-sign-out-alt" aria-hidden="true"></i>
                        Logout
                    </a>
                  </li>            
            <?php else : ?>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>users/register">Register</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="<?php echo URLROOT; ?>users/login">
                        <i class="fas fa-sign-in-alt"></i>
                        Login
                    </a>
                  </li>
            <?php endif ?>
        </ul>  
      </div>
</nav>