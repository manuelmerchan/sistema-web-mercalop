
function sololetras(e){
  key=e.keyCode || e.which;
  teclado=String.fromCharCode(key).toLowerCase();//para solo numeros quitar .toLowerCase()
  // numero=" abcdefghiyjklmnñopqrstuvwxyz._-,óíáéú";
  numero=" abcdefghiyjklmnñopqrstuvwxyz/óíáéú";
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

 function solonumeros(e){
   key=e.keyCode || e.which;
   teclado=String.fromCharCode(key);//para solo numeros quitar .toLowerCase()
   numero="0123456789.";
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

function solonumeroRUC(e){
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


  function enable(e){
    key=e.keyCode || e.which;
    teclado=String.fromCharCode(key);//para solo numeros quitar .toLowerCase()
    numero="";
    especial="9";
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




   function validarcorreo(){
       var correo = document.getElementById('correo');
       //alert(correo);

       var emailRegex = /^[-\w.%+]{1,64}@(?:[a-zA-z]{1,63}\.){1,125}[a-z]{2,63}$/i;
       if (emailRegex.test(correo.value)) {
         //alert("correo correcto");
       } else {
         const Toast = Swal.mixin({
       toast: true,
       position: 'top-end',
       showConfirmButton: false,
       timer: 3000,
       timerProgressBar: true,
       onOpen: (toast) => {
         toast.addEventListener('mouseenter', Swal.stopTimer)
         toast.addEventListener('mouseleave', Swal.resumeTimer)
       }
     })

     Toast.fire({
       icon: 'warning',
       title: 'Correo no válido'
     })
         document.getElementById('correo').value="";
       }
   }

   function validarCedula(){
    // $(function(){
    var cedula = document.getElementById('cedula').value;
     if(cedula.length == 10){
       if(cedula=="2222222222" || cedula=="1800000000" || cedula=="1212121212" || cedula=="1313131313" || cedula=="1414141414" || cedula=="1515151515" || cedula=="1616161616" || cedula=="1717171717" || cedula=="1818181818" || cedula=="1919191919"){
         // alert( "La c\xe9dula NO es v\xe1lida!!!" );
         const Toast = Swal.mixin({
           toast: true,
           position: 'top-end',
           showConfirmButton: false,
           timer: 3000,
           timerProgressBar: true,
           onOpen: (toast) => {
             toast.addEventListener('mouseenter', Swal.stopTimer)
             toast.addEventListener('mouseleave', Swal.resumeTimer)
           }
         })

         Toast.fire({
           icon: 'warning',
           title: 'La cédula no es válida'
         })
         document.getElementById('cedula').value="";
         $("#cedula").css({
           "background-color": "rgba(0,0,0,0)"
         });
       }

             //Obtenemos el digito de la region que sonlos dos primeros digitos
             var digito_region = cedula.substring(0,2);
             //Pregunto si la region existe ecuador se divide en 24 regiones
             if( digito_region >= 1 && digito_region <=24 ){
               // Extraigo el ultimo digito
               var ultimo_digito   = cedula.substring(9,10);
               //Agrupo todos los pares y los sumo
               var pares = parseInt(cedula.substring(1,2)) + parseInt(cedula.substring(3,4)) + parseInt(cedula.substring(5,6)) + parseInt(cedula.substring(7,8));
               //Agrupo los impares, los multiplico por un factor de 2, si la resultante es > que 9 le restamos el 9 a la resultante
               var numero1 = cedula.substring(0,1);
               var numero1 = (numero1 * 2);
               if( numero1 > 9 ){ var numero1 = (numero1 - 9); }
               var numero3 = cedula.substring(2,3);
               var numero3 = (numero3 * 2);
               if( numero3 > 9 ){ var numero3 = (numero3 - 9); }
               var numero5 = cedula.substring(4,5);
               var numero5 = (numero5 * 2);
               if( numero5 > 9 ){ var numero5 = (numero5 - 9); }
               var numero7 = cedula.substring(6,7);
               var numero7 = (numero7 * 2);
               if( numero7 > 9 ){ var numero7 = (numero7 - 9); }
               var numero9 = cedula.substring(8,9);
               var numero9 = (numero9 * 2);
               if( numero9 > 9 ){ var numero9 = (numero9 - 9); }
               var impares = numero1 + numero3 + numero5 + numero7 + numero9;

               //Suma total
               var suma_total = (pares + impares);
               //extraemos el primero digito
               var primer_digito_suma = String(suma_total).substring(0,1);
               //Obtenemos la decena inmediata
               var decena = (parseInt(primer_digito_suma) + 1)  * 10;
               //Obtenemos la resta de la decena inmediata - la suma_total esto nos da el digito validador
               var digito_validador = decena - suma_total;
               //Si el digito validador es = a 10 toma el valor de 0
               if(digito_validador == 10)
                 var digito_validador = 0;
               //Validamos que el digito validador sea igual al de la cedula
               if(digito_validador == ultimo_digito){
                 // console.log('la cedula:' + cedula + ' es correcta');
                 $("#cedula").css({
                   "background-color": "rgba(56,208,49,0.5)"
                 });
               }else{
                 const Toast = Swal.mixin({
                   toast: true,
                   position: 'top-end',
                   showConfirmButton: false,
                   timer: 3000,
                   timerProgressBar: true,
                   onOpen: (toast) => {
                     toast.addEventListener('mouseenter', Swal.stopTimer)
                     toast.addEventListener('mouseleave', Swal.resumeTimer)
                   }
                 })

                 Toast.fire({
                   icon: 'warning',
                   title: 'La cédula no es válida'
                 })
                 document.getElementById('cedula').value="";
                 cedula = '';
                 $("#cedula").css({
                   "background-color": "#2d2d2d"
                 });
               }

             }else{
               // imprimimos en consola si la region no pertenece
               // console.log('Esta cedula no pertenece a ninguna region');
               const Toast = Swal.mixin({
                 toast: true,
                 position: 'top-end',
                 showConfirmButton: false,
                 timer: 3000,
                 timerProgressBar: true,
                 onOpen: (toast) => {
                   toast.addEventListener('mouseenter', Swal.stopTimer)
                   toast.addEventListener('mouseleave', Swal.resumeTimer)
                 }
               })

               Toast.fire({
                 icon: 'warning',
                 title: 'La cédula no es válida'
               })
               document.getElementById('cedula').value="";
               cedula = '';
               $("#cedula").css({
                 "background-color": "#2d2d2d"
               });
             }
          }else{
             //imprimimos en consola si la cedula tiene mas o menos de 10 digitos
             // console.log('Esta cedula tiene menos de 10 Digitos');
             const Toast = Swal.mixin({
               toast: true,
               position: 'top-end',
               showConfirmButton: false,
               timer: 3000,
               timerProgressBar: true,
               onOpen: (toast) => {
                 toast.addEventListener('mouseenter', Swal.stopTimer)
                 toast.addEventListener('mouseleave', Swal.resumeTimer)
               }
             })

             Toast.fire({
               icon: 'warning',
               title: 'La cédula no es válida, menos de 10 digitos'
             })
             document.getElementById('cedula').value="";
             cedula = '';
             $("#cedula").css({
               "background-color": "#2d2d2d"
             });
          }

     // });

  }

//  MAYUSCULA PRIMERA LETRA DE CADA PALABRA

   function toTitleCase(str) {
     return str.replace(/(?:^|\s)\w/g, function(match) {
         return match.toUpperCase();
     });
 }
//  MAYUSCULA PRIMERA LETRA DE TODOO EL TEXTO
   function MaysPrimera(string){
     return string.charAt(0).toUpperCase() + string.slice(1);
   }
// VALIDACION DE MAYUSCULAS EN CAJA DESCRIPCION
   // $(document).on('keyup','#descrip', function(){
   //   var valr= $('#descrip').val();
   //   if(valr!=""){
   //    texto = MaysPrimera(valr.toLowerCase());  //  MAYUSCULA PRIMERA LETRA DE TODOO EL TEXTO
   //    // texto =toTitleCase(valr);  //  MAYUSCULA PRIMERA LETRA DE CADA PALABRA
   //     //texto = valr.toUpperCase();// TODO0 MAYUSCULA
   //     //texto = valr.toLowerCase();// TODO0 MINUSCULA
   //     document.getElementById('descrip').value=texto;
   //   }
   // });
