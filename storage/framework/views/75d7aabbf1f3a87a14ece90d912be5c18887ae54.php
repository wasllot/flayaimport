<?php
    $isRendered = false;
    $advertisementThree = null;
?>

<?php if($velocityMetaData && $velocityMetaData->advertisement): ?>
    <?php
        $advertisement = json_decode($velocityMetaData->advertisement, true);
        
        if (isset($advertisement[3]) && is_array($advertisement[3])) {
            $advertisementThree = array_values(array_filter($advertisement[3]));
        }
    ?>

    <?php if($advertisementThree): ?>
        <?php
            $isRendered = true;
        ?>

        <div class="container-fluid advertisement-three-container">
            <div class="row">
                <?php if( isset($advertisementThree[0])): ?>
                    <a <?php if(isset($one)): ?> href="<?php echo e($one); ?>" <?php endif; ?> class="col-lg-6 col-md-12 no-padding">
                        <img src="<?php echo e(asset('/storage/' . $advertisementThree[0])); ?>" class="full-width" />
                    </a>
                <?php endif; ?>

                <div class="col-lg-6 col-md-12 second-panel">
                    <?php if( isset($advertisementThree[1])): ?>
                        <a <?php if(isset($two)): ?> href="<?php echo e($two); ?>" <?php endif; ?> class="row top-container">
                            <img src="<?php echo e(asset('/storage/' . $advertisementThree[1])); ?>" class="col-12 pr0" />
                        </a>
                    <?php endif; ?>
                    <?php if( isset($advertisementThree[2])): ?>
                        <a <?php if(isset($three)): ?> href="<?php echo e($three); ?>" <?php endif; ?> class="row bottom-container">
                            <img src="<?php echo e(asset('/storage/' . $advertisementThree[2])); ?>" class="col-12 pr0" />
                        </a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    <?php endif; ?>
<?php endif; ?>

<?php if(! $isRendered): ?>
    <div class="container-fluid advertisement-three-container">
        <div class="row">
            <a <?php if(isset($one)): ?> href="<?php echo e($one); ?>" <?php endif; ?> class="col-lg-6 col-md-12 no-padding">
                <img src="<?php echo e(asset('/themes/velocity/assets/images/headphones.png')); ?>" class="full-width" />
            </a>

            <div class="col-lg-6 col-md-12 second-panel">
                <a <?php if(isset($two)): ?> href="<?php echo e($two); ?>" <?php endif; ?> class="row top-container">
                    <img src="<?php echo e(asset('/themes/velocity/assets/images/watch.png')); ?>" class="col-12 pr0" />
                </a>
                <a <?php if(isset($three)): ?> href="<?php echo e($three); ?>" <?php endif; ?> class="row bottom-container">
                    <img src="<?php echo e(asset('/themes/velocity/assets/images/kids-2.png')); ?>" class="col-12 pr0" />
                </a>
            </div>
        </div>
    </div>
<?php endif; ?><?php /**PATH C:\Users\user\Desktop\website-builder/resources/themes/velocity/views/home/advertisements/advertisement-three.blade.php ENDPATH**/ ?>