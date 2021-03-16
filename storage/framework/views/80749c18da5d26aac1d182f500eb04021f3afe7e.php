<?php $__env->startSection('css'); ?>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="row ">
        <div class="col-md-12 pl-3 pt-2">
            <div class="pl-3">
                <h3>Add Bullet Points </h3>

            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12 pl-3 pt-4">
            <div class="row pl-3">
                <div class="col-md-12">
                    <div class="d-flex justify-content-between">
                        <div class="d-flex">
                            <img src="<?php echo e($product->img); ?>" alt="" style="width: 90px; height: auto">
                            <h5 class="align-middle my-auto ml-2"><?php echo e($product->title); ?></h5>
                        </div>
                    </div>

                    <?php if(count($product->extra_details) > 0): ?>
                        <?php $__currentLoopData = $product->extra_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <label class="fs-3 mt-3">Bullet Points</label>

                            <br>
                            <ul class="list-unstyled">
                                <?php echo $details->description; ?>

                            </ul>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    <?php endif; ?>

                    <table class="table table-striped mt-5">
                        <thead>
                            <tr>
                                <th class="align-middle font-weight-bold"><span class="ml-2">Description</span></th>
                                <th class="text-right align-middle btn-group">
                                    <button class="btn btn-primary generate-description-btn">Generate Extra Details</button>
                                    <form class="d-flex description-form" action="<?php echo e(route('products.store')); ?>" method="POST">
                                        <?php echo csrf_field(); ?>
                                        <textarea  name="description" class="description_text d-none"></textarea>
                                        <textarea  name="description_details_array" class="description_details_array d-none"></textarea>
                                        <input type="hidden" name="product_id" value="<?php echo e($product->id); ?>">
                                        <button type="button" class="btn btn-success align-middle my-auto save-btn" disabled>Save</button>
                                    </form>
                                </th>

                            </tr>
                        </thead>
                        <tbody class="table-body">
                            <?php if(count($product->extra_details) > 0): ?>
                                <?php $__currentLoopData = $product->extra_details; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $details): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <?php $__currentLoopData = explode( ',', $details->description_details_array); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $description): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <?php if($description !== ''): ?>
                                            <tr class="single-row">
                                                <td class="" style="width: 100% !important;">
                                                    <input type="text" class="form-control description" value="<?php echo e($description); ?>">
                                                </td>
                                                <td class="align-middle text-right">
                                                    <div class=" btn-group btn-group" role="group">
                                                        <button type="button" class="btn btn btn-primary add-row-btn" id="<?php echo e($product->id); ?>">+</button>
                                                        <button type="button" class="btn btn btn-danger remove-btn">-</button>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            <?php endif; ?>
                            <tr class="single-row">
                                <td class="" style="width: 100% !important;">
                                    <input type="text" class="form-control description">
                                </td>
                                <td class="align-middle text-right">
                                    <div class=" btn-group btn-group" role="group">
                                        <button type="button" class="btn btn btn-primary add-row-btn" id="<?php echo e($product->id); ?>">+</button>
                                        <button type="button" class="btn btn btn-danger remove-btn">-</button>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>



                    <div class="results">
                        <ul class="list-unstyled description-list">
                        </ul>
                    </div>


                </div>
            </div>
        </div>
 <input type="hidden" id="color_w" value="<?php echo e($settings != null ? $settings->color : null); ?>">
        <input type="hidden" id="icon_w" value="<?php echo e($settings != null ? $settings->icon : null); ?>">
        <input type="hidden" id="emoji_w" value="<?php echo e($settings != null ? $settings->emoji : null); ?>">

    </div>
<?php $__env->stopSection(); ?>

<?php $__env->startSection('js'); ?>
    <script>
        $(document).ready(function(){
            $(document).on('click', '.add-row-btn', function() {
                var id = $(this).attr('id');
                $(this).closest( ".table-body" ).append(`
                    <tr class="single-row">
                        <td class="" style="width: 100% !important;">
                            <input type="text" class="form-control description">
                        </td>
                        <td class="align-middle text-right">
                            <div class=" btn-group btn-group" role="group">
                                <button type="button" class="btn btn btn-primary add-row-btn" id="${id}">+</button>
                                <button type="button" class="btn btn btn-danger remove-btn">-</button>
                            </div>
                        </td>
                    </tr>
                `);
            });

            $(document).on('click', '.remove-btn', function() {
                $(this).closest( ".single-row" ).empty();
                $('.generate-description-btn').click();
            });

            $('.generate-description-btn').click(function() {

                let descriptions = [];
 let color = $("#color_w").val();
            let icon = $("#icon_w").val();
            let emoji = $("#emoji_w").val();
               


                $('.single-row').each(function(){
                    descriptions.push($(this).find('.description').val());
                });

                let filtered = descriptions.filter(function (el) {
                    return el != null;
                });

                $('.description-list').empty();

                filtered.forEach(function(item) {
                    if(item !== "") {
                        $('.save-btn').prop('disabled', false);                        
			if(icon !== "") {
				console.log(icon);
                            $('.description-list').append(`
                                <li class=""><i class="fa ${icon} fa-lg ml-3 description-list-item" style="color: ${color}"></i> ${item}</li>
                            `);
                        }else {
			console.log(emoji);
                            $('.description-list').append(`
                                <li class=""><span> ${emoji}</span>${item}</li>
                            `);
                        }

                    }
                });

            });

            $('.save-btn').click(function() {
                let descriptions = [];
                $('.single-row').each(function(){
                    descriptions.push($(this).find('.description').val());
                });

                let filtered = descriptions.filter(function (el) {
                    return el != null;
                });

                let descriptions_body = String($('.description-list').prop('innerHTML'));
                $('.description_text').val(descriptions_body);
                $('.description_details_array').val(filtered);
                $('.description-form').submit();

            });

        });
    </script>

<?php $__env->stopSection(); ?>
B

<?php echo $__env->make('layouts.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH /home/516655.cloudwaysapps.com/fwkpfhbxsv/public_html/resources/views/products/show.blade.php ENDPATH**/ ?>