<!DOCTYPE html>
<html>
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Buro Juridico Mercalop</title>
<link rel="shortcut icon" href="img/buro.png">
<style>
body {
    font-family: Arial, Helvetica, sans-serif; 
    height:100vh;
    display:flex;
    justify-content:center;
    align-items:center;
    background: url(login/img/juridico5.jpg) no-repeat center center fixed;
	/*background: #F3F3F3;*/
	background-size: cover;
    
}
form {
    background: #676156;
    border: 3px solid #676156; 
    width:30%;
    height:auto;
    border-radius:10px;
}

input[type=text], input[type=password] {
  width: 100%;
  padding: 12px 20px;
  margin: 8px 0;
  display: inline-block;
  border: 1px solid #ccc;
  box-sizing: border-box;
}

.conten_btn{
    display:flex;
    justify-content:center;
    align-items:center;
}
button {
  background-color: #36933c;
  color: white;
  padding: 14px 20px;
  margin: 8px 0;
  border: none;
  cursor: pointer;
  width: 70%;
  
}

button:hover {
  opacity: 0.8;
}

.cancelbtn {
  width: auto;
  padding: 10px 18px;
  background-color: #f44336;
}

.imgcontainer {
  text-align: center;
  margin: 24px 0 12px 0;
}

img.avatar {
  width: 40%;
  border-radius: 50%;
}

.container {
  padding: 16px;
}

span.psw {
  float: right;
  padding-top: 16px;
}

/* Change styles for span and cancel button on extra small screens */
@media screen and (max-width: 300px) {
  span.psw {
     display: block;
     float: none;
  }
  .cancelbtn {
     width: 100%;
  }
}
</style>
</head>
<body>


<form action="ENVIAR_CORREOS/proceso_recuperar_pass.php" method="post">
  <div class="imgcontainer">
    <h3 style="color:#f2f2f2">Recuperar contraseña</h3>
  </div>

  <div class="container">
    <label for="cedula"><b>Cédula</b></label>
    <input type="text" placeholder="Ingresar cédula" maxlength="13"   name="cedula" autocomplete="off" onpaste="return false" onkeypress="return solonumeros(event)" required>

    <label for="correo"><b>Correo</b></label>
    <input type="text" placeholder="Ingresar correo" name="correo" autocomplete="off" required>
        
   <div class="conten_btn">
        <button type="submit">Procesar</button>
   </div>
   
  </div>

  <div class="container" style="background-color:#8e877a">
    <a href="../" ><button type="button" class="cancelbtn">Regresar</button></a>
  </div>
</form>
<script>
    function solonumeros(e){
       key=e.keyCode || e.which;
       teclado=String.fromCharCode(key);//para solo numeros quitar .toLowerCase()
       numero="0123456789";
       especial="8-37-38-46-164-13-9-16";
       tecla_especial=false;
    
       for(var i in especial){
         if(key==especial[i]){
           tecla_especial=true;break;
         }
       }
       if(numero.indexOf(teclado)==-1 && !tecla_especial){
         return false;
       }
    }
    
    function mensaje(){
        let params = new URLSearchParams(location.search);
        if(params!=''){
            var msj = params.get('enviado');
            if(msj=='1'){
                alert('Contraseña Recuperada, revisa tu correo');
                window.location='../';
            }else{
                alert('Datos no coinciden, verifique y vuelva a intentar');
                window.location='../';
            }
        }
    }
    mensaje();

</script>
</body>
</html>
