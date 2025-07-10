<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>{{ $title ?? '' }}</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  @include('inc.css');
</head>

<body>

  <!-- ======= Header ======= -->
  @include('inc.header');

  <!-- ======= Sidebar ======= -->
  @include('inc.sidebar');

  <main id="main" class="main">
    @include('sweetalert::alert')

    <div class="pagetitle">
      <h1>Blank Page</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="index.html">Home</a></li>
          <li class="breadcrumb-item">Pages</li>
          <li class="breadcrumb-item active">Blank</li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <div class="content">
      @yield('content')
      
    </div>


  </main><!-- End #main -->

  <!-- ======= Footer ======= -->
  @include('inc.footer');
  <a href="#" class="back-to-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  @include('inc.script');
  @include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])


<script type="text/javascript" src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

<script>
    document.getElementById('paymentForm').addEventListener('submit', function(e){
        e.preventDefault();

        const form = e.target;
        const method = form.querySelector('[name="payment_method"]:checked, [name="payment_method"]:focus') ?.value;

        const data = {
          order_pay: document.getElementById('order_pay').value,
          order_change: document.getElementById('order_change').value,
          payment_method: method,
          _token: '{{ csrf_token() }}'
        };

        const orderId = form.dataset.orderId;

        if (method === 'cash') {
            form.submit();
        } else {
          fetch(`/order/${orderId}/snap`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': data._token,
            },
            body: JSON.stringify(data)
          })
          .then(res => res.json())
          .then(res => {
              if (res.token) {
                  snap.pay(res.token, {
                    onSuccess: function(result){
                      window.location.href = `order`;
                    },
                    onPending: function(result){
                      alert("Please finish payment");
                    },
                    onError: function(result){
                      alert("Failed");
                    }
                  });
              } else {
                alert("Failed to get token payment");
              }
          });

        }
    });
</script>
</body>

</html>