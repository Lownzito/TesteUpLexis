<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
        <div class="navbar-nav">
          <a class="nav-link" aria-current="page" href="{{route('home')}}">Home</a>
          @auth
            <a class="nav-link" href="{{route('logout')}}">Logout</a>
            @if (Auth::user()->isAdmin)
              <a class="nav-link" href="{{route('admin.page')}}">Admin page</a>
            @endif
          @else
            <a class="nav-link" href="{{route('login')}}">Login</a>
            <a class="nav-link" href="{{route('registration.form')}}">Cadastrar-se</a>
          @endauth
        
        </div>
      </div>
    </div>
</nav>