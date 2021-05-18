<footer class="sticky-footer bg-light pt-4 sizable">
    <div class="container footer-container">
        <div class="row py-4">
            <div class="col-lg-9 text-center text-lg-left">
                <footer-menu :nav-items="{{ website_menu('footer-navigation') }}" ></footer-menu>
            </div>
            <div class="col-lg-3 text-center text-lg-left py-3" tabindex="0">
                <p class="subtitle">Contact Us</p>
                <p class="contact-info">{!! nl2br(get_field('address', 'option')) !!}</p>
                <p class="contact-info">
                    <strong>Phone:</strong> 
                    <a href="https://calhouncountygov.com/departments/">See Departments and Community pages for specific department phone numbers.</a>
                    {{-- <a href="tel:{{ get_field('phone', 'option') }}">{{ get_field('phone', 'option') }}</a></p> --}}
                <p class="contact-info"><strong>Hours:</strong> {{ get_field('hours', 'option') }}</p>
            </div>
        </div>
    </div>
    <hr>
    <p class="copyright text-center py-4" tabindex="0">&copy;{{ date('Y') }} {{ get_bloginfo() }}. All Rights&nbsp;Reserved. 
        <a class="text-underline d-block d-md-inline text-secondary text-uppercase" href="/privacy-policy/" >Privacy&nbsp;Policy</a> 
        <span class="d-none d-md-inline ">|</span>
        <a class="text-underline d-block d-md-inline text-secondary text-uppercase" href="/accessibility-policy/" >Accessibility&nbsp;Policy</a> 
        <span class="d-none d-md-inline">|</span>
        <a class="text-underline d-block d-md-inline text-secondary text-uppercase" href="/sitemap_index.xml" >Site Map</a> 
        <span class="siteby">
            <svg version="1.1" id="kma" xmlns="http://www.w3.org/2000/svg"
                xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" height="14" width="20"
                viewBox="0 0 12.5 8.7" style="enable-background:new 0 0 12.5 8.7;"
                xml:space="preserve">
                    <path fill="#b4be35"
                d="M6.4,0.1c0,0,0.1,0.3,0.2,0.9c1,3,3,5.6,5.7,7.2l-0.1,0.5c0,0-0.4-0.2-1-0.4C7.7,7,3.7,7,0.2,8.5L0.1,8.1 c2.8-1.5,4.8-4.2,5.7-7.2C6,0.4,6.1,0.1,6.1,0.1H6.4L6.4,0.1z"></path>
            </svg> &nbsp;<a href="https://keriganmarketing.com">Site&nbsp;by&nbsp;KMA</a>.
        </span></p>
</footer>