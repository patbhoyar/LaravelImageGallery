<!doctype html>
<html>
<head>
	{{ HTML::style('css/styles.css') }}
	{{ HTML::script('js/jquery.js') }}
	{{ HTML::script('js/script.js') }}
        <?php 
            $pageTitle = isset($pageTitle)?$pageTitle:""; 
            $errorMsg = Session::get('errorMsg');
        ?>
	<title>{{ $pageTitle }}</title>
</head>
<body>
    <div id="headerContainer">
        <div id="header">
            <ul id="menu">
                    <li id="home">{{ HTML::link('/', 'Home') }}</li>
                    <li id="albums">{{ HTML::link('/albums', 'Albums') }}</li>
                    <li id="home">{{ HTML::link('/', 'Test') }}</li>
            </ul>
            
            <div id="loginRegister">
                 @if(Auth::check())
                    {{Auth::user()->email;}}
                    {{ HTML::link('/logout', '(logout)')}}
                @else
                    {{ HTML::link('/login', 'Login')}}
                @endif
            </div>
	</div>
    </div>
	
        
        @if(isset($errorMsg) && $errorMsg !== '')
            <div id="errorNotifier">{{ $errorMsg }}</div>
        @endif
    
	<div id="displayContainer">
            <div id="pageTitle">{{ $pageTitle }}</div>
            @yield('content')
	</div>
</body>
</html>