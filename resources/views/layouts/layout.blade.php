<!doctype html>
<html>
	<head>
		<meta charset="utf-8">

		<title>Laravel</title>

		<!-- Fonts -->
		<link rel="stylesheet" type="text/css" href="{{url('/css/style.css')}}" /> 
		<script src="{{ url('jquery-3.3.1.js')}}"></script>
		<script type="text/javascript">
			var doc  = $(document);
			var scrolled = false;
			doc.on("scroll", function(){
				if(doc.scrollTop()>100 && !scrolled){
					scrolled = true;
					$("#header").addClass("scrolled");
					$("p#title").css("margin-top", "-1px");
					$("ul").css("margin-top", "-15px");
				}
				else if(doc.scrollTop()<50 && scrolled){
					scrolled = false;
					$("#header").removeClass("scrolled");
					$("p#title").css("margin-top", "30px");
					$("ul").css("margin-top", "16px");
				}
			});
			var show = false;
			function clickBtn(event){
				var node = event.target;
				var id = "#" + node.value;
				element = document.getElementById(node.value),
    			style = window.getComputedStyle(element),
    			display = style.getPropertyValue('display');
    			
        		if(display == "none"){
        			$(id).css("display", "initial");
        		}
        		else{
      				$(id).css("display", "none");	
        		}	
			}
			
		</script>
	</head>

	<body>
		<nav id="header">
			<div>
				<p id="title">website</p>
				<ul>
					@auth
					<li>
						<a class="dropdown-item" href="{{ route('logout') }}"
	                       onclick="event.preventDefault();
	                       document.getElementById('logout-form').submit();">
							{{ __('logout') }}
	                    </a>
	                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	                        @csrf
	                    </form>
					</li>
					<li><a href=""> profile </a></li>

					<li><a href="/posts/create"> make post </a></li>
						@else
					<li><a href="/login"> log in </a></li>
					<li><a href="/register"> register </a></li>
						@endauth
					<li><a href="/posts/"> posts </a></li>
				</ul>
			</div>
		</nav>
		
		<nav id="body"> 
			<div id="sidebar">
				
			</div>
			<div id="content">
				@yield('content')
			</div>
		</nav>
		@yield('footer')
	</body>
</html>
