<div class="col-md-6">
<p>
<h3>What happen when I click integrate button?</h3>
It will integrate adminLTE Backend layouts for laravel project.
<h4><label class="label label-warning">Warning</label></h4>
Click only once at the begining of Project setup
<h4><label class="label label-info">Step</label></h4>
<ul>
	<li>Run php artisan make:auth</li>
	<li>Click in Integrate adminLTE Button below</li>
	<li>Open app/Http/Auth/LoginController.php</li>
	<li>Update protected $redirectTo = '/home'; to protected $redirectTo = '/dashboard';</li>
	<li>Open app/Http/Auth/RegisterController.php</li>
	<li>Update protected $redirectTo = '/home'; to protected $redirectTo = '/dashboard';</li>
	<li>Run php artisan migrate</li>
	<li>Now visit http://localhost:8000/dashboard</li>
	<li>Add laravel Modular <a href="https://github.com/nWidart/laravel-modules"></a></li>
	<li>Run compusoer dump-autoload</li>
	<li>Create test module as php artisan module:make test</li>
	<li>open laratree as localhost/yourpojectfolder/laratreemodular</li>
	<li>All done adminLTE is integrated Enjoy!!</li>
</ul>
</p>
	<a href="system/process/adminlte/generate_adminlte.php" Onclick="return ConfirmDelete()" class="btn btn-success">Integrate adminLTE</a>
</div>
<script type="text/javascript">
	function ConfirmDelete() {
	  return confirm("Are you sure you want to Integrate?");
	}
</script>