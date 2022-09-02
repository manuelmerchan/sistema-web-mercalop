<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Modal</title>
	<script src="jquery.js" charset="utf-8"></script>
</head>
<body>
<style media="screen">
  *{
  margin:0;
  padding:0;
  box-sizing: border-box;
  }

  body{
  background: #f2f2f2;
  font-family: 'Raleway', sans-serif;
  }

  header{
  width: 100%;
  height:600px;
  background: rgb(31, 31, 31);
  background-attachment: fixed;
  background-position: center;
  background-size: cover;
  }

  .flex{
  width: 100%;
  height:100%;
  display: flex;
  justify-content: space-between;
  align-items: center;
  }

  .textos{
  padding:300px;
  color:#fff;
  text-align: center;
  }

  h1{
  font-size: 40px;
  margin-bottom:20px;
  }

  a{
  text-decoration: none;
  font-size:20px;
  display: inline-block;
  padding: 7px;
  width: 220px;
  border:1px solid #fff;
  border-radius: 10px;
  color:#fff;
  }
  a:hover{background: #000; color:#fff; border:1px solid #000;}

  .modal{
  display: none;
  position: fixed;
  z-index:1;
  overflow: auto;
  left: 0;
  top:0;
  width: 100%;
  height:100%;
  background: rgba(0, 0, 0, 0.452);
  }

  .contenido-modal{
  position: relative;
  background-color: #fefefe;
  margin: auto;
  width:90%;
  box-shadow: 0 0 6px 0 rgba(0, 0, 0, .4);
  animation-name: modal;
  animation-duration: 0.5s;
  }
  @keyframes modal{
  from{left:-330px; opacity:0;}
  to{left:0; opacity:1;}
  }
  .close{
  color: #f2f2f2;
  font-size:30px;
  font-weight: bold;
  }
  .close:hover{
  color:#7f8c8d;
  text-decoration: none;
  cursor: pointer;
  }

  .modal-header, .footer{
  padding: 8px 16px;
  background: #34495e;
  color:#f2f2f2;
  }

  p{
  text-align: justify;
  }

  .modal-body{
  padding: 20px 16px;
  }

  @media screen and (max-width:900px){
  .contenido-modal{
    width: 99%;
  }
  .textos{
    padding: 150px;
  }
  }

  @media screen and (max-width:500px){
  .textos{
    padding:50px;
  }
  }
</style>
	<header>
		<div class="textos">
			<h1>Modal animado | AlexCG Design</h1>
			<a href="#" id="abrir">Suscribete a este canal</a>
		</div>
	</header>
	<div id="miModal" class="modal">
		<div class="flex" id="flex">
			<div class="contenido-modal">
				<div class="modal-header flex">
					<h2>AlexCG Design</h2>
					<span class="close" id="close">&times;</span>
				</div>
				<div class="modal-body">
					<p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Nam voluptatum illum temporibus voluptas debitis! Et labore minus praesentium consequuntur mollitia dolores perferendis, voluptas nemo ratione consequatur illum quidem rerum, saepe eveniet ullam eaque quasi neque quo quisquam impedit ducimus voluptatem illo. Quod tenetur aliquam, soluta labore ipsam delectus. Id iusto distinctio minima quaerat nobis asperiores ullam, mollitia illo soluta quisquam natus dicta sint voluptates molestiae! Perferendis quos ea assumenda nulla?</p>
				</div>
				<div class="footer">
					<h3>AlexCG Design &copy;</h3>
				</div>
			</div>
		</div>
	</div>
	<script>
  let modal = document.getElementById('miModal');
let flex = document.getElementById('flex');
let abrir = document.getElementById('abrir');
let cerrar = document.getElementById('close');

abrir.addEventListener('click', function(){
  modal.style.display = 'block';
});

cerrar.addEventListener('click', function(){
  modal.style.display = 'none';
});

window.addEventListener('click', function(e){
  console.log(e.target);
  if(e.target == flex){
      modal.style.display = 'none';
  }
});
  </script>
</body>
</html>
