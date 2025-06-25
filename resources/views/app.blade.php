<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Components / Accordion - NiceAdmin Bootstrap Template</title>
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
</body>

</html>