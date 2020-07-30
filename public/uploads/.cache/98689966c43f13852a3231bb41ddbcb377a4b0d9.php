<?php $__env->startSection('content'); ?>
<?php echo $__env->make('partials.mast', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<main id="content" role="main">
    <div class="container">
        <?php if(have_posts()): ?>
            <?php while(have_posts()): ?>
                
                <?php echo $__env->make('partials.article', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>

            <?php endwhile; ?>
        <?php else: ?>
            <?php echo $__env->make('pages.404', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <?php endif; ?>
    </div>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>