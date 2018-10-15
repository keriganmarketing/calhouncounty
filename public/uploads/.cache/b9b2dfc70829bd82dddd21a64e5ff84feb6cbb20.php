<?php $__env->startSection('content'); ?>
<main id="content" class="sizable">
    <div class="container">
        <article class="support">
            <header class="text-primary">
                <h1><?php echo e($headline != '' ? $headline : the_title()); ?></h1>
            </header>
            <?php echo e(the_content()); ?>

            <?php echo e(wp_reset_query()); ?>

            test
        </article>
        <?php if(!empty($results)): ?>
            <?php $__currentLoopData = $results; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $post): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <?php echo $__env->make('partials.result', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php else: ?>
            <article>
                <p>Nothing was found using the requested search criteria.</p>
            </article>
        <?php endif; ?>
    </div>
</main>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), array('__data', '__path')))->render(); ?>