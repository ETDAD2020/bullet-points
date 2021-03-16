<?php $__env->startSection('content'); ?>
    <div class="row ">
        <div class="col-md-12 pl-3 pt-2">
            <div class="pl-3 d-flex justify-content-between">
                <h3>Products</h3>
                <div>
                    <a href="<?php echo e(route('sync.products')); ?>" class="btn btn-primary">Sync Products</a>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 pl-3 pt-2">
            <div class="row pl-3">
                <div class="col-md-12">
                    <table class="table table-vcenter table-striped">
                        <thead class="border-0">
                        <tr>
                            <th scope="col"></th>
                            <th scope="col" class="font-weight-bold w-100">Title</th>
                            <th scope="col"></th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php $__currentLoopData = $products; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $product): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <tr>
                                <th scope="row"><img src="<?php echo e($product->img); ?>" alt="" style="width: 90px; height: auto"></th>
                                <td class="align-middle"><?php echo e($product->title); ?></td>
                                <td class="align-middle"><a class="btn btn-primary" href="<?php echo e(route('products.show', $product->id)); ?>">Add Bullet Points</a></td>
                            </tr>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </tbody>
                    </table>
                    <div class="d-flex justify-content-end">
                        <?php echo e($products->links()); ?>

                    </div>
                </div>
            </div>
        </div>

    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/516655.cloudwaysapps.com/fwkpfhbxsv/public_html/resources/views/products/index.blade.php ENDPATH**/ ?>