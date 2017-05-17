<nav class="navbar navbar-default navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="index.php?menu=home"><?php echo AppName; ?></a>
    </div>
    <ul class="nav navbar-nav">
      <li <?php if($_SESSION['menu']==''||$_SESSION['menu']=='home'){?> class="active" <?php } ?> >
      	<a href="index.php?menu=home">
      		Home
      	</a>
      </li>
      <li <?php if($_SESSION['menu']==''||$_SESSION['menu']=='modules'){?> class="active" <?php } ?> >
        <a href="index.php?menu=modules">
          Modules
        </a>
      </li>
      <li <?php if($_SESSION['menu']=='migration'){?> class="active" <?php } ?> >
      	<a href="index.php?menu=migration&action=create">
      		Create Migration
      	</a>
      </li>
      <li <?php if($_SESSION['menu']=='repository'){?> class="active" <?php } ?> >
        <a href="index.php?menu=repository&action=create">
          Create Repository
        </a>
      </li>
      <li <?php if($_SESSION['menu']=='controller'){?> class="active" <?php } ?> >
        <a href="index.php?menu=controller&action=create">
          Create Controller
        </a>
      </li>
      <li <?php if($_SESSION['menu']=='views'){?> class="active" <?php } ?> >
        <a href="index.php?menu=views&action=create">
          Create Views
        </a>
      </li>
      <li <?php if($_SESSION['menu']=='addmodule'){?> class="active" <?php } ?> >
        <a href="index.php?menu=addmodule&action=create">
          Add Module
        </a>
      </li>
      <li <?php if($_SESSION['menu']=='file'){?> class="active" <?php } ?> >
        <a href="index.php?menu=file&action=read">
          Read File
        </a>
      </li>
      <?php if($_SESSION['module']){ ?>
      <li>
        <a href="#" class="navbar-brand">
          Selected Module : <?= $_SESSION['module']; ?>
        </a>
      </li>
      <?php } ?>
      
      
    </ul>
  </div>
</nav>