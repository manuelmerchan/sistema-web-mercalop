$('#formLogin').submit(function(e){
   e.preventDefault();
   var usuario = $.trim($("#usuario").val());
   var password =$.trim($("#password").val());


   if(usuario.length == "" || password == ""){
      Swal.fire({
          type:'warning',
          title:'Complete los campos.',
      });
      return false;
    }else{
        $.ajax({
           url:"app/login.php",
           type:"POST",
           datatype: "json",
           data: {usuario:usuario, password:password},
           success:function(data){
               if(data == "null"){

                   Swal.fire({
                       type:'error',
                       title:'Usuario y/o password incorrecta',
                   });
               }else{

                 const Toast = Swal.mixin({
                   toast: true,
                   position: 'top-end',
                   showConfirmButton: false,
                   timer: 2000,
                   timerProgressBar: true,
                   onOpen: (toast) => {
                     toast.addEventListener('mouseenter', Swal.stopTimer)
                     toast.addEventListener('mouseleave', Swal.resumeTimer)
                   }
                 })

                 var dtentro =Toast.fire({
                   icon: 'success',
                   title: '¡Conexión exitosa!'
                 })
                 if(dtentro) {
                   window.location.href = "inicio.php";
                 }


               }
           }
        });
    }
});
