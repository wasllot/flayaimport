<?php $__env->startSection('page_title'); ?>
    <?php echo e(__('admin::app.cms.pages.title')); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>

    <div class="content">
        <div class="page-header">
            <div class="page-title">
                <h1><?php echo e(__('admin::app.cms.pages.pages')); ?></h1>
            </div>
            <div class="page-action">
                <div class="export-import" @click="showModal('downloadDataGrid')">
                    <i class="export-icon"></i>
                    <span >
                        <?php echo e(__('admin::app.export.export')); ?>

                    </span>
                </div>

                <a href="<?php echo e(route('admin.cms.create')); ?>" class="btn btn-lg btn-primary">
                    <?php echo e(__('admin::app.cms.pages.add-title')); ?>

                </a>
            </div>
        </div>

        <div class="page-content">
            <?php $cmsGrid = app('Webkul\Admin\DataGrids\CMSPageDataGrid'); ?>

            <?php echo $cmsGrid->render(); ?>

        </div>
    </div>

    <modal id="downloadDataGrid" :is-open="modalIds.downloadDataGrid">
        <h3 slot="header"><?php echo e(__('admin::app.export.download')); ?></h3>
        <div slot="body">
            <export-form></export-form>
        </div>
    </modal>
<?php $__env->stopSection(); ?>

<?php $__env->startPush('scripts'); ?>
    <?php echo $__env->make('admin::export.export', ['gridName' => $cmsGrid], \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<?php $__env->stopPush(); ?>


<?php echo $__env->make('admin::layouts.content', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\user\Desktop\website-builder\packages\Webkul\Admin\src\Providers/../Resources/views/cms/index.blade.php ENDPATH**/ ?>