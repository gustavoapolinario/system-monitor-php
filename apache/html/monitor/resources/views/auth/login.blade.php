@extends('layouts.app')

@section('title')
Login
@endsection
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-8 col-md-offset-2">
			<div class="panel panel-default">
				<h1>Login</h1>
				<div class="panel-body">
					<form class="form-horizontal" role="form" method="POST" action="{{ route('login') }}">
                        {{ csrf_field() }}
                        
						<div class="row">
							<div class="input-field col s12">
								<i class="material-icons prefix">email</i>
								<input id="email" type="email" class="validate" name="email" required>
								<label for="email">E-mail</label>
							</div>
						</div>

						<div class="row">
							<div class="input-field col s12">
								<i class="material-icons prefix">vpn_key</i>
								<input id="password" type="password" class="validate" name="password" required>
								<label for="password">Senha</label>
							</div>
						</div>

						<div class="form-group">
							<div class="col-md-8 col-md-offset-4">
								<button type="submit" class="btn waves-effect waves-light">
									Login
									<i class="material-icons right">send</i>
								</button>

								<a class="btn btn-link" href="{{ route('password.request') }}">
									Esqueceu a senha?
								</a>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
$(function() {
    Materialize.updateTextFields();
});
</script>
@endsection
