<nav class="navbar navbar-expand-lg bg-primary navbar-dark">
    <div class="container">
      <a class="navbar-brand" href="/">Blonjo.com</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
          <li class="nav-item">
            <a class="nav-link  {{ $title === "Beranda" ? 'active' : '' }}" href="/">Beranda</a>
          </li>
          {{-- <li class="nav-item">
            <a class="nav-link {{ $title === "About" ? 'active' : '' }}" href="/about">About</a>
          </li> --}}
          <li class="nav-item">
            <a class="nav-link {{ $title === "Keranjang" ? 'active' : '' }}" href="/keranjang">Keranjang</a>
          </li>
          <li class="nav-item">
            <a class="nav-link {{ $title === "Akun" ? 'active' : '' }}" href="/akun">Akun</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>