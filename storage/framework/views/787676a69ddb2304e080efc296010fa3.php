<style>
    table, th, td {
    border: 1px solid black;
    border-collapse: collapse;
    }
</style>
<table class="min-w-full divide-y divide-gray-200" style="border: 1px solid black;border-collapse: collapse;">
    <thead class="bg-gray-50">
        <tr>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Sender
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Receiver
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Text
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Images
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Schedule Time
            </th>
            <th scope="col" class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                Create Time
            </th>
        </tr>
    </thead>
    <tbody class="bg-white divide-y divide-gray-200">
        <!-- Example row -->
         <?php $__currentLoopData = $messages; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $m): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <?php echo e($m->sender->name); ?>

            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <?php echo e($m->receiver->name); ?>

            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <?php echo e($m->text); ?>

            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500"><!-- style="justify-content: center;align-items: center;text-align: center;" -->
                <?php $__currentLoopData = $m->images; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $index => $image): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <?php if(count($m->images) == 1 || (($index % 2) == 0 && $index > 0)): ?>
                        <div style="width: 10.25rem;">
                    <?php elseif(count($m->images) > 1 && ($index % 2) == 0 && $index == 0): ?>
                        <div style="width: 10.25rem;margin-top: 1rem;">
                    <?php endif; ?>
                        <img src="<?php echo e($imageDisplayPath); ?><?php echo e($image); ?>" alt="Image" style="width: 5rem;">
                    <?php if(($index % 2) == 1): ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <?php echo e($m->scheduleAt ? $m->scheduleAt : 'N/A'); ?>

            </td>
            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                <?php echo e($m->created_at); ?>

            </td>
        </tr>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <!-- More rows... -->
    </tbody>
</table><?php /**PATH /var/www/chat.sxags.com/themes/tailwind/views/chatTranscript.blade.php ENDPATH**/ ?>