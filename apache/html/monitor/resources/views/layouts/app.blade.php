<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<!-- CSRF Token -->
	<meta name="csrf-token" content="{{ csrf_token() }}">

	<title>{{ config('app.name', 'Monitor') }}</title>

	<!-- Styles -->
	<link href="/libs/materialize/css/materialize.css" rel="stylesheet">
	<link href="http://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
	<link href="/css/style.css" rel="stylesheet">

	<!-- Scripts -->
	<script type="text/javascript" src="/js/jquery-2.1.1.min.js"></script>
	<script type="text/javascript" src="/libs/materialize/js/materialize.js"></script>

	<!-- Scripts -->
	<script>
		window.Laravel = {!! json_encode([
			'csrfToken' => csrf_token(),
		]) !!};
	</script>
</head>
<body>

<nav>
	@if (! Auth::guest())
		<ul id="slide-out" class="side-nav">
			<li>
				<div class="userView">
					<a href="#!user"><img class="" src="/libs/materialize/logo.png"></a>
					<a href="#!name"><span class="name">{{ Auth::user()->name }}</span></a>
				</div>
			</li>
			@if ($servers = App\ServerInfo::getMyServers())
				@foreach ($servers as $server)
					<li><a href="{{ URL::to('/report/' . $server->id) }}">{{ $server->name }}</a></li>
				@endforeach
			@endif
			<li><div class="divider"></div></li>
			<li><a class="subheader">Config</a></li>
			@if (Auth::user()->hasRole('manage_users'))
				<li><a href="{{ route('register') }}"><i class="material-icons">supervisor_account</i>Register</a></li>
			@endif
			<li>
				<a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
					Sair
				</a>

				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					{{ csrf_field() }}
				</form>
			</li>
		</ul>
		<a href="#" data-activates="slide-out" class="button-collapse"><i class="material-icons">menu</i></a>
	@endif
	<h1>@yield('title')</h1>
</nav>

@yield('content')

<script>
$(".button-collapse").sideNav();
</script>
	<!-- Scripts -->
	<script src="/js/app.js"></script>
</body>
</html>
