        <script src="https://kit.fontawesome.com/761f284d42.js" crossorigin="anonymous"></script>
        <nav class="navbar navbar-expand-lg barra-superior mb-5">
          <a class="navbar-brand" href="./Inicio">Liquidacion de sueldo</a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation" >
           <i class="fas fa-bars"></i>
          </button>
          <div class="collapse navbar-collapse" id="navbarNav">
          
            <ul class="navbar-nav">
            @guest
              <li class="nav-item active">
                <a class="nav-link" href="./">Descubre el sueldo base <span class="sr-only"></span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./BaseaLiquido">Obtén sueldo líquido</a>
              </li>


            @else
                        @if(auth()->user()->rol == 'administrador')
              <li class="nav-item active">
                <a class="nav-link" href="./LiquidoAbase">Descubre el sueldo base <span class="sr-only"></span></a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="./BaseaLiquido">Obtén sueldo líquido</a>
              </li>


              <li class="nav-item">
                <a class="nav-link" href="./Importando">Sueldo Masivo</a>
              </li>  

  
    
              <li class="nav-item">
                <a class="nav-link" href="./IngresoImpuestos">Impuestos</a>
              </li> 

             <li class="nav-item">
                <a class="nav-link" href="./IngresoAfp">AFP</a>
              </li> 


             <li class="nav-item">
                <a class="nav-link" href="./IngresoParametros">Parametros</a>
              </li> 
              <!--<li class="nav-item">
                <a class="nav-link" href="#">Pricing</a>
              </li>
              <li class="nav-item">
                <a class="nav-link disabled" href="#">Disabled</a>
              </li>-->
            @endif

            @endguest  




            </ul>
            <!-- Incluir barra lateral con register y login -->






            <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
              </ul>



          </div>
        </nav>
        <style type="text/css">
          nav.barra-superior{
            background-color: #1c4b82;
            color: #dae1e7;
            font-family: 'Roboto', sans-serif;
          }

          .fas{
            color:white;
          }

          nav.barra-superior > a.navbar-brand{
            color: #dd6b4d;
            font-weight: 900;
            font-family: 'Roboto Mono', sans-serif;
          }       

          nav.barra-superior > div.collapse > ul > li > a{
            color: #dae1e7;
            font-weight: 600;
            font-family: 'Roboto', sans-serif;
          }   
          nav.barra-superior > button.navbar-toggler > span.navbar-toggler-icon {
            color: #dae1e7;
          }
        </style>                                                                                                              