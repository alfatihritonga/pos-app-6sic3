<nav class="navbar navbar-expand-lg bg-body-tertiary container">
  <div class="container-fluid">
    <a class="navbar-brand" href="/">{{ config('app.name') }}</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <a class="nav-link" href="/">Home</a>
        </li>
        @if (Auth::user()->role == 'admin')    
          <li class="nav-item">
            <a class="nav-link" href="/category">Category</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/product">Product</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="/transaction">Transaction</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="{{ route('user.index') }}">User</a>
          </li>
        @else
            <li class="nav-item">
              <a class="nav-link" href="/transaction">Transaction</a>
            </li>
        @endif

        <li class="nav-item">
          <form action="{{ route('logout') }}" method="POST" class="d-inline">
              @csrf
              <button type="submit" class="btn btn-danger">
                  Logout
              </button>
          </form>
      </li>
      </ul>
    </div>
  </div>
</nav>