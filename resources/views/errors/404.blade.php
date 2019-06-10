@extends('layouts.auth')

@section('content')
	<div class="container login">
		<div class="login__header">
			<a href="/">
				<img src="/img/logo.png" alt="Cyberbog">
			</a>
		</div>
		<div class="error-404">
			<div class="error-404__text">
				<h1><span class="pink">4</span>0<span class="pink">4</span></h1>
				<h2>Stránka neexistuje</h2>
				<p>Omlouváme se, ale tato stránka na našem webu není.<br/>
					Je možné, že byla stránka přemístěna nebo odstraněna.</p>
				<p>Ujistěte se, že jste neudělali chybu v URL adrese.</p>
			</div>
		</div>
	</div>


@endsection