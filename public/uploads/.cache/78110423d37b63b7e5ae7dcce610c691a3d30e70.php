<?php $__env->startSection('content'); ?>

<?php if(have_posts()): ?>
    <?php while(have_posts()): ?>
        <?php echo e(the_post()); ?>

        <?php echo $__env->make('partials.mast', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <main id="content" role="main" class="sizable">
            <div class="container">
                <article class="support">
                    <header>
                        <h1><?php echo e($headline != '' ? $headline : the_title()); ?></h1>
                    </header>
                    <?php echo e(the_content()); ?>

                </article>
            </div>
        </main>
    <?php endwhile; ?>
<?php else: ?>
    <?php echo $__env->make('pages.404', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/forge/calhouncountygov.com/public/themes/wordplate/views/pages/index.blade.php ENDPATH**/ ?>