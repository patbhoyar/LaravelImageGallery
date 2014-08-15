<!doctype html>
<html>
<head>
	{{ HTML::style('css/styles.css') }}
	{{ HTML::script('js/jquery.js') }}
	{{ HTML::script('js/script.js') }}
    {{ HTML::script('js/albumEdit.js') }}
        <?php 
            $pageTitle = isset($pageTitle)?$pageTitle:""; 
            $errorMsg = Session::get('errorMsg');
            $position = Session::get('position');
        ?>
	<title>{{ $pageTitle }}</title>
</head>
<body>
    <div id="headerContainer">
        <div id="header">
            <ul id="menu">
                    <li id="home">{{ HTML::link('/', 'Home') }}</li>
                    <li id="albums">{{ HTML::link('/albums', 'Albums') }}</li>
                    <li id="create">{{ HTML::link('/album/makeNew', 'Create') }}</li>
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
        
    @if(isset($errorMsg) && $errorMsg !== '' && isset($position) && $position == 'top')
        <div id="errorNotifier">{{ $errorMsg }}</div>
    @endif
    
	<div id="displayContainer">

        @if(isset($pageType) && ($pageType == 'album'))
            <div id="pageTitleContainer">
                <div id="pageTitle">{{ $pageTitle }}</div>
                <div id="albumModifyContainer">
                    <div id="albumEdit">
                        <div class="buttons" id="albumEditButton">{{ HTML::link('/album/'.$albumId.'/edit', 'Edit') }}</div>
                    </div>
                    <div id="albumAddImages">
                        <div class="buttons" id="albumAddImagesButton">{{ HTML::link('/album/upload/'.$albumId, 'Add Images') }}</div>
                    </div>
                </div>
            </div>
        @elseif(isset($pageType) && ($pageType == 'albumEdit'))
            {{ Form::open(array('url' => '/album/'. $albumId .'/update', 'method' => 'post', 'id' => 'albumUpdateForm')) }}
            <div id="pageTitleContainer">
                <div id="pageTitle">{{ $pageTitle }}</div>
                <div id="albumModifyContainer">
                    <div id="albumEditDone">
                        <div id="albumEditDoneButton">{{ Form::submit('Done Editing', array('class' => 'buttons')) }}</div>
                    </div>
                    <div id="albumCancelEdit">
                        <div class="buttons" id="albumCancelEditButton">{{ HTML::link('/album/show/'.$albumId, 'Cancel') }}</div>
                    </div>
                </div>
            </div>
        @else
            <div id="pageTitleContainer">
                <div id="pageTitle">{{ $pageTitle }}</div>
            </div>
        @endif

        @if(isset($errorMsg) && $errorMsg !== '' && isset($position) && $position == 'middle')
            <div id="errorNotifier">{{ $errorMsg }}</div>
        @endif

        @yield('content')
	</div>
</body>
</html>