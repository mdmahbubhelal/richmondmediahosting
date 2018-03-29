<div class="modal fade" id="landingPageLoginModal">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-body">
				<div class="clearfix">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="row">
					<div class="col-sm-6 text-center">
						<p class="text-uppercase title" style="margin: 0">FOR SPECIAL PRICING</p> 
						<hr class="devider">
						<div class="row">
							<p class="text-uppercase title main">register</p>
							<!-- <p class="text-uppercase  ">some dialog or logo may be <br> another dialog<br> another dialog<br> another dialog</p> -->
							<div class="clearfix imageContainer"><img src="http://via.placeholder.com/150x80"></div>
							<div class="col-sm-6"><a href="#" class="btn btn-block btn-primary text-uppercase">professional</a></div>
							<div class="col-sm-6"><a href="#" class="btn btn-block btn-danger text-uppercase">professional</a></div>
						</div>
					</div>
					<div class="col-sm-6">
						<p class="text-uppercase title">log in</p>
						<hr class="devider">
						<form action="" method="post" role="form" id="landingPageLoginModalLoginForm">
							<div class="form-group">
								<input type="text" name="username" id="username" placeholder="Username or email">
								<span class="text-danger validationError usernameError"></span>
							</div>
							<div class="form-group">
								<input type="password" name="password" id="password" placeholder="Password">
								<span class="text-danger validationError passwordError"></span>
							</div>
							<div class="checkbox">
								<label> <input type="checkbox" name="remember" id="remember" value="true" style="width: initial;"> Remember me </label>
							</div>
							<button type="submit" class="btn btn-primary btn-block btn-submit text-uppercase"> Login </button> 
						</form>
					</div>
					<div class="col-sm-12 text-danger text-center errorContainer"></div>
				</div>
			</div>
		</div>
	</div>
</div>