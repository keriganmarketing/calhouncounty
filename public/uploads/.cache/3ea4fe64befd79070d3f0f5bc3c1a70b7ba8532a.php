<?php $__env->startSection('content'); ?>

<?php if(have_posts()): ?>
    <?php while(have_posts()): ?>
        <?php echo e(the_post()); ?>

        <?php echo $__env->make('partials.mast', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
        <main id="content" role="main">
            <div class="container">
                <article class="support">
                    <header>
                        <h1><?php echo e($headline != '' ? $headline : the_title()); ?></h1>
                    </header>
                    <div class="row">
                        <div class="col-md-4">
                            <img class="img-fluid" src="<?php echo e($team['image']['url']); ?>" alt="<?php echo e($team['image']['alt']); ?>">
                            <p>&nbsp;</p>
                        </div>
                        <div class="col-md-8">
                            <div class="row">
                            <?php if($team['email'] != ''): ?>
                                <div class="col-auto">
                                    <a href="mailto:<?php echo e($team['email']); ?>">
                                    <span class="icon">
                                        <i class="fa fa-envelope-o" aria-hidden="true"></i>
                                    </span>&nbsp;<?php echo e($team['email']); ?></a>
                                </div>
                            <?php endif; ?>
                            <?php if($team['phone'] != ''): ?>
                                <div class="col-auto">
                                    <a href="mailto:<?php echo e($team['phone']); ?>">
                                    <span class="icon">
                                        <i class="fa fa-phone" aria-hidden="true"></i>
                                    </span>&nbsp;<?php echo e($team['phone']); ?></a>
                                </div>
                            <?php endif; ?>
                            </div>
                        <hr>
                        <?php echo e(the_content()); ?>


                        </div>
                    </div>
                    
                </article>
            </div>
        </main>
    <?php endwhile; ?>
<?php else: ?>
    <?php echo $__env->make('pages.404', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
<?php endif; ?>

<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>