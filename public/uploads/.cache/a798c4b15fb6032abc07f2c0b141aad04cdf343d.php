<!DOCTYPE html>
<html <?php echo e(language_attributes()); ?>>
<head>
  <meta charset="<?php echo e(bloginfo('charset')); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="theme-color" content="#253217">
  <meta name="google-site-verification" content="LBTxVuxOIXlbaFFhNxZdI8Qv5d15zPpduyT2XyfgtXU" />
  <?php echo e(wp_head()); ?>

</head>
<body <?php echo e(body_class()); ?>>
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
            <?php echo $__env->make('partials.header', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <?php echo $__env->yieldContent('content'); ?>

            <?php echo $__env->make('partials.footer', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        </div>
    </div>

    <?php echo e(wp_footer()); ?>

    <?php echo $__env->yieldContent('footer-scripts'); ?>
</body>
</html><?php /**PATH /home/forge/calhouncountygov.com/public/themes/wordplate/views/layouts/main.blade.php ENDPATH**/ ?>