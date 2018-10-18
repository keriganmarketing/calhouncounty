<!DOCTYPE html>
<html {{ language_attributes() }}>
<head>
  <meta charset="{{ bloginfo('charset') }}">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="theme-color" content="#253217">
  <meta name="google-site-verification" content="LBTxVuxOIXlbaFFhNxZdI8Qv5d15zPpduyT2XyfgtXU" />
  {{ wp_head() }}
</head>
<body {{ body_class() }}>
    <a class="skip-link screen-reader-text" href="#content"><?php _e( 'Skip to content', 'wordplate' ); ?></a>
    <div id="app">
        <div 
            class="site-wrapper" 
            :class="{
                'full-height': footerStuck, 
                'scrolling': isScrolling,
                'mobile-menu-open': mobileMenuOpen,
                'text-normal': textSize === 0,
                'text-large': textSize === 1,
                'text-larger': textSize === 2,
                'text-largest': textSize === 3,
            }">
            @include('partials.header')

            @yield('content')

            @include('partials.footer')
        </div>
    </div>

    {{ wp_footer() }}
    @yield('footer-scripts')
</body>
</html>