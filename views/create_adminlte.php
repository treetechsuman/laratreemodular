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
	<li>All done adminLTE is integrated Enjoy!!</li>
</ul>
</p>
	<a href="system/process/adminlte/generate_adminlte.php" class="btn btn-success">Integrate adminLTE</a>
</div>