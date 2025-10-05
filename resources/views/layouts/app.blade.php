<!doctype html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width,initial-scale=1">
  <title>Customer CRM</title>
  <!-- Bootstrap 5 -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- DataTables Bootstrap5 CSS -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.7/css/dataTables.bootstrap5.css" />
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.js"></script>
    <script src="https://cdn.datatables.net/2.0.7/js/dataTables.bootstrap5.js"></script>
  @stack('head')
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light">
  <div class="container">
    <a class="navbar-brand" href="{{ route('customers.index') }}">Customer CRM</a>
    <div class="ms-auto">
      @auth
        <form method="POST" action="{{ route('logout') }}">@csrf
          <button class="btn btn-link">Çıkış</button>
        </form>
      @else
        <a href="{{ route('login') }}" class="btn btn-primary me-2">Giriş</a>
        <a href="{{ route('register') }}" class="btn btn-outline-primary">Kayıt</a>
      @endauth
    </div>
  </div>
</nav>

<div class="container mt-4">
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif
  @yield('content')
</div>

@stack('scripts')
</body>
</html>
