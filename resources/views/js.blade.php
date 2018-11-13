<!DOCTYPE html>
<html>
<head>
	<title>testing jscript</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>

		<script type="text/javascript">
			Number.prototype.clamp = function(min, max) {
  				return Math.min(Math.max(this, min), max);
			};

			function point(x, y, width, height)
			{
				this.x = x;
				this.y = y;
				this.w = width;
				this.h = height;

			}
			Array.prototype.draw = function(){
				var c = document.getElementById("canvas");
				var ctx = c.getContext("2d");
				for(i = 0; i<this.length; i++){
					ctx.fillRect(this[i].x, this[i].y, this[i].w, this[i].h);
				}
			}
			Array.prototype.update = function(e){
				for(i = 0; i<this.length; i++){
					var a = e.clientX - this[i].x;
					var b = e.clientY - this[i].y;
					var r = Math.sqrt(a*a + b*b);

					this[i].w =  (15 - r/20).clamp(1, 20);
					this[i].h =  (15 - r/20).clamp(1, 20);
				}
			}
			$(document).ready(function(){
				var c = document.getElementById("canvas");
				var ctx = c.getContext("2d");
				var st = 20;

				var pointY = c.height / st;
				var pointX = c.width / st;
				var numPoints = pointX * pointY;
				var j = 0;
				var k = 0;
				var points = new Array(numPoints);
				for (var i = 0; i <= numPoints; i++) {
					j+=st;
					if(j >= c.width){
						k+=st;	
						j=0;
					}
					points[i] = new point(j, k, 2, 2);
				}
				document.getElementById("canvas").addEventListener("mousemove", function(event){
					ctx.clearRect(0, 0, c.width, c.height);
					points.update(event);
					points.draw();
				});


			});
		</script>
	<style type="text/css">
		html, body{
			margin: 0;
		}
		#canvas{
			margin: 0;
			padding: 0;
			border: 1px solid gray;
		}
	</style>
</head>
<body>
	<div id="canvas-div">
		<canvas id="canvas" height="960" width="1900"d>
			
		</canvas>

	</div>
</body>
</html>
