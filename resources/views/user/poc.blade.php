<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0" />
	<title>Canvas</title>
	<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css"
		integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous" />
	<link media="screen" rel="stylesheet" href="{{ asset('poc/css/style.css')}}" />
</head>

<body>
	<div class="container mt-5">
		<div class="row">
			<div class="col-md-2">
				<h5>Photo Bank</h5>
				<small>(Drag and drop to canvas)</small>
				<div class="item-container mt-3">
					<img class="img" id="ele1" draggable="true" ondragstart="startDrag(event)" src="{{ asset('poc/images/1.png') }}" />
					<img class="img" id="ele2" draggable="true" ondragstart="startDrag(event)" src="{{ asset('poc/images/2.png') }}" />
					<img class="img" id="ele3" draggable="true" ondragstart="startDrag(event)" src="{{ asset('poc/images/3.png') }}" />
					<img class="img" id="ele4" draggable="true" ondragstart="startDrag(event)" src="{{ asset('poc/images/4.png') }}" />
					<img class="img" id="ele5" draggable="true" ondragstart="startDrag(event)" src="{{ asset('poc/images/5.png') }}" />
					<img class="img" id="ele6" draggable="true" ondragstart="startDrag(event)" src="{{ asset('poc/images/6.png') }}" />
					<img class="img" id="ele7" draggable="true" ondragstart="startDrag(event)" src="{{ asset('poc/images/7.png') }}" />
				</div>
			</div>
			<div class="col-md-8">
				<div id="canvasContainer" ondragover="dragOver(event)" ondrop="dropItem(event)">
					<canvas id="scene" style="border: 1px solid #000000; margin: 0 auto"></canvas>
				</div>
				<div class="row mt-5">
					<div class="col-md-12 text-center">
						<h5>Shapes</h5>
						<button class="btn btn-info text-red" type="button" onclick="addRect()">
							Rectangle
						</button>
						<button class="btn btn-info" type="button" onclick="addCircle()">
							Circle
						</button>
						<button class="btn btn-info" type="button" onclick="addTriangle()">
							Triangle
						</button>
						<button class="btn btn-info" type="button" onclick="addEllipse()">
							Ellipse
						</button>
						<button class="btn btn-info" type="button" onclick="addPolygon()">
							Polygon
						</button>
					</div>
				</div>
				<div class="row mt-3">
					<div class="col-md-12 text-center">
						<button class="btn btn-success" type="button" onclick="getImage()">
							Get Image
						</button>
					</div>
				</div>
				<div class="row mt-3 mb-5">
					<div class="col-md-12">
						<img class="preview" />
					</div>
				</div>
			</div>
			<div class="col-md-2">
				<h5>Backgrounds</h5>
				<small>(Click to select)</small>
				<div class="bg-container mt-3">
					<img src="{{ asset('poc/images/bgs/1.jpg') }}"/>
					<img src="{{ asset('poc/images/bgs/2.jpg') }}" />
					<img src="{{ asset('poc/images/bgs/3.jpg') }}" />
					<img src="{{ asset('poc/images/bgs/4.jpg') }}" />
				</div>
			</div>
		</div>
	</div>
	<script src="https://code.jquery.com/jquery-3.6.4.min.js"
		integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/fabric.js/5.3.1/fabric.min.js"
		integrity="sha512-CeIsOAsgJnmevfCi2C7Zsyy6bQKi43utIjdA87Q0ZY84oDqnI0uwfM9+bKiIkI75lUeI00WG/+uJzOmuHlesMA=="
		crossorigin="anonymous" referrerpolicy="no-referrer"></script>

	<script>
		var canvas;
		var deleteIcon =
			"data:image/svg+xml,%3C%3Fxml version='1.0' encoding='utf-8'%3F%3E%3C!DOCTYPE svg PUBLIC '-//W3C//DTD SVG 1.1//EN' 'http://www.w3.org/Graphics/SVG/1.1/DTD/svg11.dtd'%3E%3Csvg version='1.1' id='Ebene_1' xmlns='http://www.w3.org/2000/svg' xmlns:xlink='http://www.w3.org/1999/xlink' x='0px' y='0px' width='595.275px' height='595.275px' viewBox='200 215 230 470' xml:space='preserve'%3E%3Ccircle style='fill:%23E86759;' cx='299.76' cy='439.067' r='218.516'/%3E%3Cg%3E%3Crect x='267.162' y='307.978' transform='matrix(0.7071 -0.7071 0.7071 0.7071 -222.6202 340.6915)' style='fill:white;' width='65.545' height='262.18'/%3E%3Crect x='266.988' y='308.153' transform='matrix(0.7071 0.7071 -0.7071 0.7071 398.3889 -83.3116)' style='fill:white;' width='65.544' height='262.179'/%3E%3C/g%3E%3C/svg%3E";

		var imgDel = document.createElement("img");
		imgDel.src = deleteIcon;

		function deleteObject(eventData, transform) {
			var target = transform.target;
			var canvas = target.canvas;
			canvas.remove(target);
			canvas.requestRenderAll();
		}

		function renderIcon(ctx, left, top, styleOverride, fabricObject) {
			var size = this.cornerSize;
			ctx.save();
			ctx.translate(left, top);
			ctx.rotate(fabric.util.degreesToRadians(fabricObject.angle));
			ctx.drawImage(imgDel, -size / 2, -size / 2, size, size);
			ctx.restore();
		}

		$(function () {
			var a = {
				"version": "5.3.0",
				"objects": [
					{
						"type": "image",
						"version": "5.3.0",
						"originX": "left",
						"originY": "top",
						"left": 90,
						"top": 85,
						"width": 710,
						"height": 710,
						"fill": "rgb(0,0,0)",
						"stroke": null,
						"strokeWidth": 0,
						"strokeDashArray": null,
						"strokeLineCap": "butt",
						"strokeDashOffset": 0,
						"strokeLineJoin": "miter",
						"strokeUniform": false,
						"strokeMiterLimit": 4,
						"scaleX": 0.14,
						"scaleY": 0.14,
						"angle": 0,
						"flipX": false,
						"flipY": false,
						"opacity": 1,
						"shadow": null,
						"visible": true,
						"backgroundColor": "",
						"fillRule": "nonzero",
						"paintFirst": "fill",
						"globalCompositeOperation": "source-over",
						"skewX": 0,
						"skewY": 0,
						"cropX": 0,
						"cropY": 0,
						"src": "file:///D:/poc/images/1.png",
						"crossOrigin": null,
						"filters": []
					},
					{
						"type": "image",
						"version": "5.3.0",
						"originX": "left",
						"originY": "top",
						"left": 412,
						"top": 104,
						"width": 600,
						"height": 600,
						"fill": "rgb(0,0,0)",
						"stroke": null,
						"strokeWidth": 0,
						"strokeDashArray": null,
						"strokeLineCap": "butt",
						"strokeDashOffset": 0,
						"strokeLineJoin": "miter",
						"strokeUniform": false,
						"strokeMiterLimit": 4,
						"scaleX": 0.17,
						"scaleY": 0.17,
						"angle": 0,
						"flipX": false,
						"flipY": false,
						"opacity": 1,
						"shadow": null,
						"visible": true,
						"backgroundColor": "",
						"fillRule": "nonzero",
						"paintFirst": "fill",
						"globalCompositeOperation": "source-over",
						"skewX": 0,
						"skewY": 0,
						"cropX": 0,
						"cropY": 0,
						"src": "file:///D:/poc/images/2.png",
						"crossOrigin": null,
						"filters": []
					}
				],
				"backgroundImage": {
					"type": "image",
					"version": "5.3.0",
					"originX": "left",
					"originY": "top",
					"left": 0,
					"top": 0,
					"width": 1600,
					"height": 1033,
					"fill": "rgb(0,0,0)",
					"stroke": null,
					"strokeWidth": 0,
					"strokeDashArray": null,
					"strokeLineCap": "butt",
					"strokeDashOffset": 0,
					"strokeLineJoin": "miter",
					"strokeUniform": false,
					"strokeMiterLimit": 4,
					"scaleX": 0.5,
					"scaleY": 0.39,
					"angle": 0,
					"flipX": false,
					"flipY": false,
					"opacity": 1,
					"shadow": null,
					"visible": true,
					"backgroundColor": "",
					"fillRule": "nonzero",
					"paintFirst": "fill",
					"globalCompositeOperation": "source-over",
					"skewX": 0,
					"skewY": 0,
					"cropX": 0,
					"cropY": 0,
					"src": "file:///D:/poc/images/bgs/1.jpg",
					"crossOrigin": null,
					"filters": []
				}
			};


			var tmp = JSON.stringify(a);
			canvas = new fabric.Canvas("scene");

			fabric.Object.prototype.transparentCorners = false;
			fabric.Object.prototype.cornerColor = "blue";
			fabric.Object.prototype.cornerStyle = "circle";

			canvas.setWidth(800);
			canvas.setHeight(400);
			canvas.loadFromJSON(tmp, function (objects, options) {
				canvas.requestRenderAll();


			});

			fabric.Object.prototype.controls.deleteControl = new fabric.Control({
				x: 0.5,
				y: -0.5,
				offsetY: 16,
				cursorStyle: "pointer",
				mouseUpHandler: deleteObject,
				render: renderIcon,
				cornerSize: 24,
			});

			$(".bg-container img").on("click", function () {
				var imageURL = $(this).attr("src");
				fabric.Image.fromURL(imageURL, function (img, isError) {
					img.set({
						originX: "left",
						originY: "top",
						scaleX: canvas.getWidth() / img.width, //new update
						scaleY: canvas.getHeight() / img.height, //new update
					});

					canvas.setBackgroundImage(img, canvas.renderAll.bind(canvas));
				});
				// canvas.setBackgroundImage(imageURL, canvas.renderAll.bind(canvas), {
				// 	backgroundImageOpacity: 1,
				// 	originX: "left",
				// 	originY: "top",
				// 	top: 0,
				// 	left: 0,
				// });
			});
		});

		const startDrag = function (e) {
			e.dataTransfer.setData("id", e.target.id); //transfer the "data" i.e. id of the target dragged.
		};
		const dragOver = function (e) {
			e.preventDefault();
		};

		const dropItem = function (e) {
			e.preventDefault();
			var data = e.dataTransfer.getData("id"); //receiving the "data" i.e. id of the target dropped.

			var imag = document.getElementById(data); //getting the target image info through its id.
			var img = new fabric.Image(imag, {
				//initializing the fabric image.
				left: e.layerX - 80, //positioning the target on exact position of mouse event drop through event.layerX,Y.
				top: e.layerY - 40,
			});
			img.scaleToWidth(imag.width); //scaling the image height and width with target height and width, scaleToWidth, scaleToHeight fabric inbuilt function.
			img.scaleToHeight(imag.height);
			canvas.add(img);
			canvas.setActiveObject(img);
		};

		function addRect() {
			var rect = new fabric.Rect({
				left: 100,
				top: 100,
				fill: "red",
				width: 150,
				height: 100,
				objectCaching: false,
			});

			canvas.add(rect);
			canvas.setActiveObject(rect);
		}
		function addCircle() {
			var circle = new fabric.Circle({
				radius: 50,
				fill: "blue",
				left: 100,
				top: 100,
				objectCaching: false,
			});
			canvas.add(circle);
			canvas.setActiveObject(circle);
		}

		function addTriangle() {
			var triangle = new fabric.Triangle({
				width: 100,
				height: 100,
				angle: 0,
				fill: "green",
				left: 100,
				top: 100,
				objectCaching: false,
			});
			canvas.add(triangle);
			canvas.setActiveObject(triangle);
		}
		function addEllipse() {
			var ellipse = new fabric.Ellipse({
				rx: 100,
				ry: 50,
				angle: 0,
				fill: "yellow",
				left: 100,
				top: 100,
				objectCaching: false,
			});
			canvas.add(ellipse);
			canvas.setActiveObject(ellipse);
		}
		function addPolygon() {
			var polygon = new fabric.Polygon(
				[
					{ x: 200, y: 10 },
					{ x: 250, y: 50 },
					{ x: 250, y: 180 },
					{ x: 150, y: 180 },
					{ x: 150, y: 50 },
				],
				{
					fill: "orange",
				}
			);
			canvas.add(polygon);
			canvas.setActiveObject(polygon);
		}

		function getImage() {
			// let img = new Image();
			$(".preview").attr("src", canvas.toDataURL("image/png"));
			// img.src = canvas.toDataURL("image/png");
			// img.onload = function () {
			// 	console.log("you have an image with text");
			// };
		}
	</script>
</body>

</html>