<!doctype html>
<html>
<head>
	{{ HTML::style('css/styles.css') }}
	{{ HTML::script('js/jquery.js') }}
	{{ HTML::script('js/script.js') }}
	<title>Hello</title>
</head>
<body>
	<div id="header">
		<ul id="menu">
			<li id="home">{{ HTML::link('/', 'Home') }}</li>
			<li id="albums">{{ HTML::link('/albums', 'Albums') }}</li>
			<li id="home">{{ HTML::link('/', 'Test') }}</li>
		</ul>
	</div>
	<div id="displayContainer">
		@yield('content')
	</div>
</body>
</html>