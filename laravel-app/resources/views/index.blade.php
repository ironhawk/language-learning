<!DOCTYPE html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <title>{{ __('texts.title') }}</title>

        <script type="text/javascript" src="/js/jquery-3.2.0.min.js"></script>
        
        <link rel="stylesheet" href="/css/bootstrap/bootstrap.min.css" >
        <script type="text/javascript" src="/js/bootstrap.min.js"></script>

        <link rel="stylesheet" href="/css/styles.css">
        
        <script type="text/javascript" src="/js/common.js"></script>
        <link rel="stylesheet" href="/css/common.css">
    </head>
    <body>

		@include ('elements/navbar')

	    <section class="jumbotron">
	    
			<div class="container">
				@yield('content')
			</div>
			
		</section>

		<script type="text/javascript">
			handleHtmlLoaded();
		</script>
    </body>
</html>
