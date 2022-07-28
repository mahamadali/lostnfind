<!-- ======= Footer ======= -->
<footer id="footer" class="footer">

<div class="container">
  <div class="row gy-4">
    <div class="col-lg-5 col-md-12 footer-info">
      <a href="{{ url('/') }}" class="logo d-flex align-items-center">
        <!-- <span>Logis</span> -->
        <img src="{{ url(company()->logo) }}" height="50">
      </a>
      <p>{{ company()->info }}</p>
      <div class="social-links d-flex mt-4">
        @foreach(social_icons() as $icon): 
            <a href="{{ $icon->url }}" class="{{ $icon->title }}"><i class="bi {{ $icon->icon }}"></i></a>
        @endforeach
      </div>
    </div>

    <div class="col-lg-2 col-6 footer-links">
      <h4>Useful Links</h4>
      <ul>
        @foreach(pages() as $page): 
        <li><a href="{{ route('cms.page', ['page' => $page->title]) }}">{{ $page->title_beautify }}</a></li>
        @endforeach
        <!-- <li><a href="#">Home</a></li>
        <li><a href="#">About us</a></li>
        <li><a href="#">Services</a></li>
        <li><a href="#">Terms of service</a></li>
        <li><a href="#">Privacy policy</a></li> -->
      </ul>
    </div>

    <div class="col-lg-2 col-6 footer-links">
      <!-- <h4>Our Services</h4>
      <ul>
        <li><a href="#">Web Design</a></li>
        <li><a href="#">Web Development</a></li>
        <li><a href="#">Product Management</a></li>
        <li><a href="#">Marketing</a></li>
        <li><a href="#">Graphic Design</a></li>
      </ul> -->
    </div>

    <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
      <h4>Contact Us</h4>
      <p>
        {{ company()->address }}
        <strong>Phone:</strong>  {{ company()->phone_number }}<br>
        <strong>Email:</strong> {{ company()->email }}<br>
      </p>

    </div>

  </div>
</div>

<div class="container mt-4">
  <div class="copyright">
    &copy; Copyright <strong><span>{{ company()->name }}</span></strong>. All Rights Reserved
  </div>
  <!-- <div class="credits"> -->
    <!-- All the links in the footer should remain intact. -->
    <!-- You can delete the links only if you purchased the pro version. -->
    <!-- Licensing information: https://bootstrapmade.com/license/ -->
    <!-- Purchase the pro version with working PHP/AJAX contact form: https://bootstrapmade.com/logis-bootstrap-logistics-website-template/ -->
    <!-- Designed by <a href="{{ url('/') }}">BootstrapMade</a> -->
  <!-- </div> -->
</div>

</footer><!-- End Footer -->
<!-- End Footer -->