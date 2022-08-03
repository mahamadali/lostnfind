<!-- ======= Footer ======= -->
<footer id="footer" class="footer">

<div class="container">
  <div class="row gy-4">
    <div class="col-lg-3 col-md-12 footer-info">
      <a href="{{ url('/') }}" class="logo d-flex align-items-center">
        <!-- <span>Logis</span> -->
        <img src="{{ url(company()->logo) }}" height="50">
      </a>
      <p>{{ company()->info }}</p>
      <div class="social-links d-flex mt-4">
        @foreach(social_icons() as $icon): 
            <a href="{{ $icon->url }}" class="{{ $icon->title }}"><img src="{{ url($icon->icon) }}" class="img-fluid" style="border-radius:50%" height="100%" weight="100%"> </a>
        @endforeach
      </div>
    </div>

    <div class="col-lg-3 col-6 footer-links">
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

    

    <div class="col-lg-3 col-md-12 footer-contact text-center text-md-start">
      <h4>Contact Us</h4>
      <p>
        {{ company()->address }}
        <strong>Phone:</strong>  {{ company()->phone_number }}<br>
        <strong>Email:</strong> {{ company()->email }}<br>
      </p>
    </div>

    <div class="col-lg-3 col-6 footer-links">
      <h4>Newsletter</h4>
      <form method="post" action="{{ route('newsletter.store') }}" id="newsletter-form">
      {{ prevent_csrf() }}
      <div class="input-group mb-3">
          <input type="email" class="form-control"name="email" id="newsletter_email" placeholder="Enter your email..." aria-label="Recipient's username" aria-describedby="basic-addon2">
          <div class="input-group-append">
            <button type="submit" class="btn btn-primary" style="height: -webkit-fill-available;border-radius: 0;">Submit</button>
          </div>
        </div>
      </form> 
      <div class="row mt-4">
          <div class="col-lg-12">
              <div id="messages"></div>
          </div>
      </div>
    </div>

  </div>
</div>

<div class="container mt-4">
  <div class="copyright">
    &copy; Copyright <strong><span>{{ company()->name }}</span></strong>. All Rights Reserved
  </div>
</div>

</footer>
<!-- End Footer -->