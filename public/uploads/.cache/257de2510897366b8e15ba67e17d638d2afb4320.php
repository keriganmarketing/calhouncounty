<?php $__env->startSection('content'); ?>
<?php if(have_posts()): ?>
    <?php while(have_posts()): ?>
        <?php echo e(the_post()); ?>

                
        <kma-slider class="slider-container"></kma-slider>
        
        <div class="welcome position-absolute">
            <div class="text-center">
            <p class="biggest text-white">WELCOME</p>
            <?php echo e(get_search_form()); ?>

            </div>
        </div>
        <?php echo $__env->make('partials.buttongallery', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <main id="content" role="main" class="sizable">
            <div class="container">

                <div class="row py-4 align-items-center">
                    <div class="col-lg-6 py-4">
                        <article class="front">
                            
                            <?php echo e(the_content()); ?>


                        </article>
                    </div>
                    <div class="col-lg-6 py-4">
                        <div class="embed-responsive embed-responsive-16by9">
                        <?php echo $video; ?>

                        <button v-if="!videoPlaying" class="video-button" aria-hidden="true" @click="playVideo" ref="videobutton"></button>
                        </div>
                    </div>
                </div>

            </div>
        </main>

    <?php endwhile; ?>
<?php else: ?>
    <?php echo $__env->make('pages.404', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php endif; ?>
<?php $__env->stopSection(); ?>
<?php echo $__env->make('layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/forge/calhouncountygov.com/public/themes/wordplate/views/pages/front.blade.php ENDPATH**/ ?>