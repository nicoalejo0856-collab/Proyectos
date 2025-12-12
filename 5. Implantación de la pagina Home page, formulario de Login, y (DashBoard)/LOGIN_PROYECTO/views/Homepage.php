<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sitio web</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel ="stylesheet" href="css/main.css">
</head>

<body class="bg-[#07393C] ">
    
    <!-- Logo, barra de busqueda -->

    <div class="">
        <ul class="flex items-center">
        <li class="flex items-center gap-2 pl-40 ">
            <img src="../assets/logo.png" width="100" alt="logo">
            <a href="#" class=" text-stone-50 text-2xl text py-8 hover:text-sky-400 pr-10 font-bold">AGROTECH</a></li>
        </li>
        <li><a href="#" class="pl-6 pr-40 py-3 border-1 rounded-lg border-white text-slate-400  p-2 ">Buscar frutas, verduras y mas </a></li>
        <li class="flex items-center gap-2  pl-10">
            <img src="../assets/bandera.png" width="30" alt="logo">
            <a href="#"class=" hover:border-0  text-white block   hover:text-sky-400 pr-5">Español Latinoamerica | COP </a>    
            <img src="../assets/corazon.png" width="30" alt="logo">
            <li class="pl-5"><img src="../assets/carrito.png" width="30" alt="logo"></li>
            <a href="Login.php"><li class="pl-5"><img src="../assets/perfil.png" width="40" alt="logo"></li></a>
        </li>
    </ul>
    </div> 



    <!-- categorias -->
    
        <div class="bg-[#00282B] text-white  lg:block hidden  ">
            <ul class="menu  flex items-center justify-center gap-5">
                <li><a href="#" class=" hover:border-0 hover:bg-black text-white block p-5 font-bold hover:text-sky-400 ">Categorias</a></li>
                <li><a href="#"class=" hover:border-0 hover:bg-black text-white block p-5 font-bold hover:text-sky-400 ">Capacitaciones</a></li>
                <li><a href="#"class=" hover:border-0 hover:bg-black text-white block p-5 font-bold hover:text-sky-400 ">Comprar</a></li>
                <li><a href="#"class=" hover:border-0 hover:bg-black text-white block p-5 font-bold hover:text-sky-400 ">Vender</a></li>
                <li><a href="#" class="border-2 border-white text-black font-bold p-2 bg-white rounded-full hover:bg-black hover:text-white">Ofertas Flash</a></li>
                <li><a href="#"class=" hover:border-0 hover:bg-black text-white block p-5 font-bold hover:text-sky-400 ">fertilizantes</a></li>
                <li><a href="login.html"class=" hover:border-0 hover:bg-black text-white block p-5 font-bold hover:text-sky-400 ">Salir</a></li>
            </ul> 
        </div>
        <section class="header">
            <img src="../assets/frutas2.jpg" alt="frutas">
        </section>
        <section class="header">
            <div class="text-white text-5xl italic pl-50 py-10">Ofertas Especiales</div>
        </section>


<!-- Tarjeta1 -->
 <!-- Cada tarjeta debe de estar dentro del flex gap -->
    <div class="flex gap-4 justify-center">
        <div class="left bg-no-repeat bg-contain pl-10 bg-top  ">
            <div class="card  bg-[#00282B] inline-block mx-auto mt-10  ">
                <div class="cover bg-black">
                     <img src="../assets/fresa1.jpg"  alt="fresas" width="230">
                </div>
                <div class="content bg-wave-pattern bg-repeat-x relative -top3">
                    <h2 class="font-semibold text-3xl text-white pt-3 pl-4">Fresas</h2>
                    <h3 class="text text-slate-400 pt-3 pl-4">Desde</h3>
                    <h4 class="text-4xl text-white  pl-4">$ 8000 Kg</h4>
                    <h5 class="font-black text-green-400 pl-4">10% Descuento</h5>
                    <h6 class="pl-4 pb-3"><img src="../assets/corazon.png" width="30" alt="logo"></h6>
                </div>
            </div>
        </div>
    <!-- Tarjeta2 --> 
        
        <div class="card  bg-[#00282B] inline-block  mt-10  ">
            <div class="cover bg-black">
                <img src="../assets/mango1.jpg"  alt="mango" width="230">
            </div>
            <div class="content bg-wave-pattern bg-repeat-x relative -top3">
                <h2 class="font-sans text-3xl text-white pt-3 pl-4">Mango</h2>
                <h3 class="text text-slate-400 pt-3 pl-4">Desde</h3>
                <h4 class="text-4xl text-white  pl-4">$ 8000 Kg</h4>
                <h5 class="font-black text-green-400 pl-4 ">10% Descuento</h5>
                <h6 class="pl-4 pb-3"><img src="../assets/corazon.png" width="30" alt="logo"></h6>
            </div>
        </div>

        <!-- Tarjeta3 --> 
        
        <div class="card  bg-[#00282B] inline-block  mt-10  ">
            <div class="cover bg-black">
                <img src="../assets/tomate1.jpg"  alt="tomate" width="230">
            </div>
            <div class="content bg-wave-pattern bg-repeat-x relative -top3">
                <h2 class="font-sans text-3xl text-white pt-3 pl-4">Tomate</h2>
                <h3 class="text text-slate-400 pt-3 pl-4">Desde</h3>
                <h4 class="text-4xl text-white  pl-4">$ 8000 Kg</h4>
                <h5 class="font-black text-green-400 pl-4 ">10% Descuento</h5>
                <h6 class="pl-4 pb-3"><img src="../assets/corazon.png" width="30" alt="logo"></h6>
            </div>
        </div>
    
                <!-- Tarjeta4 --> 
        
        <div class="card  bg-[#00282B] inline-block  mt-10  ">
            <div class="cover bg-black">
                <img src="../assets/naranja1.jpg"  alt="naranja" width="230">
            </div>
            <div class="content bg-wave-pattern bg-repeat-x relative -top3">
                <h2 class="font-sans text-3xl text-white pt-3 pl-4">Naranja</h2>
                <h3 class="text text-slate-400 pt-3 pl-4">Desde</h3>
                <h4 class="text-4xl text-white  pl-4">$ 8000 Kg</h4>
                <h5 class="font-black text-green-400 pl-4 ">10% Descuento</h5>
                <h6 class="pl-4 pb-3"><img src="../assets/corazon.png" width="30" alt="logo"></h6>
            </div>
        </div>

            <!-- Tarjeta5 --> 
        
        <div class="card  bg-[#00282B] inline-block  mt-10  ">
            <div class="cover bg-black">
                <img src="../assets/banano1.jpg"  alt="banano" width="230">
            </div>
            <div class="content bg-wave-pattern bg-repeat-x relative -top3">
                <h2 class="font-sans text-3xl text-white pt-3 pl-4">Banano</h2>
                <h3 class="text text-slate-400 pt-3 pl-4">Desde</h3>
                <h4 class="text-4xl text-white  pl-4">$ 8000 Kg</h4>
                <h5 class="font-black text-green-400 pl-4 ">10% Descuento</h5>
                <h6 class="pl-4 pb-3"><img src="../assets/corazon.png" width="30" alt="logo"></h6>
            </div>
        </div>
       
       
    
    
    </div>




    <ul class="menu  flex items-center justify-center gap-5 pt-15">
        <li><a href="verTodo.html" class=" pl-15 pr-15  text-lg border-2 border-black  text-sky-300 font-bold p-2 bg-black rounded-full hover:bg-white  hover:text-black hover:border-white">Ver Todo</a></li>
    </ul>
    <!-- Capacitaciones -->
        <section clss="header">
            <div class="text-white text-5xl bg-[#065A5B] mt-10  italic pl-50 py-10 pt-10">Capacitaciones</div>
        </section>


<!-- Tarjeta1 -->
 <!-- Cada tarjeta debe de estar dentro del flex gap -->
    <div class="flex gap-4 bg-[#065A5B] justify-center p-6">
        <div class="left bg-no-repeat bg-contain pl-10 bg-top  ">
            <div class="card  bg-[#00282B] inline-block mx-auto mt-5  ">
                <div class="cover bg-black">
                     <img src="../assets/fresa1.jpg"  alt="Uso de fertilizantes" width="230">
                </div>
                <div class="content bg-wave-pattern bg-repeat-x relative -top3">
                    <h2 class="font-sans text-3xl text-white pt-3 pl-4">Uso  fertilizantes</h2>
                    <h3 class="text text-slate-400 pt-3 pl-4">Desde</h3>
                    <h4 class="text-4xl text-white  pl-4">$ 8000 Kg</h4>
                    <h5 class="font-black text-green-400 pl-4 ">10% Descuento</h5>
                    <h6 class="pl-4 pb-3"><img src="../assets/corazon.png" width="30" alt="logo"></h6>
                </div>
            </div>
        </div>
    <!-- Tarjeta2 --> 
        
        <div class="card  bg-[#00282B] inline-block  mt-5  ">
            <div class="cover bg-black">
                <img src="../assets/fresa1.jpg"  alt="fresas" width="230">
            </div>
            <div class="content bg-wave-pattern bg-repeat-x relative -top3">
                <h2 class="font-sans text-3xl text-white pt-3 pl-4">Mango</h2>
                <h3 class="text text-slate-400 pt-3 pl-4">Desde</h3>
                <h4 class="text-4xl text-white  pl-4">$ 8000 Kg</h4>
                <h5 class="font-black text-green-400 pl-4 ">10% Descuento</h5>
                <h6 class="pl-4 pb-3"><img src="../assets/corazon.png" width="30" alt="logo"></h6>
            </div>
        </div>

        <!-- Tarjeta3 --> 
        
        <div class="card  bg-[#00282B] inline-block  mt-5  ">
            <div class="cover bg-black">
                <img src="../assets/fresa1.jpg"  alt="fresas" width="230">
            </div>
            <div class="content bg-wave-pattern bg-repeat-x relative -top3">
                <h2 class="font-sans text-3xl text-white pt-3 pl-4">Tomate</h2>
                <h3 class="text text-slate-400 pt-3 pl-4">Desde</h3>
                <h4 class="text-4xl text-white  pl-4">$ 8000 Kg</h4>
                <h5 class="font-black text-green-400 pl-4 ">10% Descuento</h5>
                <h6 class="pl-4 pb-3"><img src="../assets/corazon.png" width="30" alt="logo"></h6>
            </div>
        </div>
    
                <!-- Tarjeta4 --> 
        
        <div class="card  bg-[#00282B] inline-block  mt-5  ">
            <div class="cover bg-black">
                <img src="../assets/fresa1.jpg"  alt="fresas" width="230">
            </div>
            <div class="content bg-wave-pattern bg-repeat-x relative -top3">
                <h2 class="font-sans text-3xl text-white pt-3 pl-4">Naranja</h2>
                <h3 class="text text-slate-400 pt-3 pl-4">Desde</h3>
                <h4 class="text-4xl text-white  pl-4">$ 8000 Kg</h4>
                <h5 class="font-black text-green-400 pl-4 ">10% Descuento</h5>
                <h6 class="pl-4 pb-3"><img src="../assets/corazon.png" width="30" alt="logo"></h6>
            </div>
        </div>

            <!-- Tarjeta5 --> 
        
        <div class="card  bg-[#00282B] inline-block  mt-5  ">
            <div class="cover bg-black">
                <img src="../assets/fresa1.jpg"  alt="fresas" width="230">
            </div>
            <div class="content bg-wave-pattern bg-repeat-x relative -top3">
                <h2 class="font-sans text-3xl text-white pt-3 pl-4">Banano</h2>
                <h3 class="text text-slate-400 pt-3 pl-4">Desde</h3>
                <h4 class="text-4xl text-white  pl-4">$ 8000 Kg</h4>
                <h5 class="font-black text-green-400 pl-4 ">10% Descuento</h5>
                <h6 class="pl-4 pb-3"><img src="../assets/corazon.png" width="30" alt="logo"></h6>
            </div>
        </div>



</body>

</html>