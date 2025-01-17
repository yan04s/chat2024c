<?php if (isset($component)) { $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54 = $component; } ?>
<?php if (isset($attributes)) { $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54 = $attributes; } ?>
<?php $component = App\View\Components\AppLayout::resolve([] + (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag ? $attributes->all() : [])); ?>
<?php $component->withName('app-layout'); ?>
<?php if ($component->shouldRender()): ?>
<?php $__env->startComponent($component->resolveView(), $component->data()); ?>
<?php if (isset($attributes) && $attributes instanceof Illuminate\View\ComponentAttributeBag): ?>
<?php $attributes = $attributes->except(\App\View\Components\AppLayout::ignoredParameterNames()); ?>
<?php endif; ?>
<?php $component->withAttributes([]); ?>
     <?php $__env->slot('header', null, []); ?> 
        <div class="row" style="min-height: 1rem;">
            <div class="col-6">
                <h2 class="text-xl font-semibold leading-tight text-gray-800" style="float: left;">
                    <?php echo e($friend->name); ?>

                </h2>
            </div>
            <div class="col-6" style="float: right; margin-top: -0.5rem;">
                <div class="relative inline-block text-left">
                    <!-- Dropdown Trigger Button -->
                    <button id="dropdownButtonHeader" type="button" class="inline-flex justify-center w-full px-4 py-2 text-sm font-medium text-white rounded-md shadow-sm hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2" aria-expanded="false" aria-haspopup="true" style="background-color: #3982F7;"><!-- bg-blue-600-->
                        <!-- Dropdown
                        <svg class="-mr-1 ml-2 h-5 w-5" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                            <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg> -->
                        <svg height="24px" name="icon" role="presentation" viewBox="0 0 36 36" width="24px"><g transform="translate(18,18)scale(1.2)translate(-18,-18)"><path d="M18,10 C16.6195,10 15.5,11.119 15.5,12.5 C15.5,13.881 16.6195,15 18,15 C19.381,15 20.5,13.881 20.5,12.5 C20.5,11.119 19.381,10 18,10 Z M16,25 C16,25.552 16.448,26 17,26 L19,26 C19.552,26 20,25.552 20,25 L20,18 C20,17.448 19.552,17 19,17 L17,17 C16.448,17 16,17.448 16,18 L16,25 Z M18,30 C11.3725,30 6,24.6275 6,18 C6,11.3725 11.3725,6 18,6 C24.6275,6 30,11.3725 30,18 C30,24.6275 24.6275,30 18,30 Z" fill="currentColor" stroke="currentColor"></path></g></svg>
                    </button>

                    <!-- Dropdown Menu -->
                    <div id="dropdownMenuHeader" class="hidden absolute right-0 z-10 mt-2 w-56 origin-top-right rounded-md bg-white shadow-lg ring-1 ring-black ring-opacity-5">
                        <div class="py-1" role="menu" aria-orientation="vertical" aria-labelledby="dropdownButtonHeader">
                            <a href="<?php echo e(route('messages.transcript', [$friend])); ?>" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Export Chat</a>
                            <!-- <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Option 2</a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 hover:text-gray-900" role="menuitem">Option 3</a> -->
                        </div>
                    </div>
                </div>
                <script>
                    document.addEventListener('DOMContentLoaded', () => {
                        const dropdownButtonHeader = document.getElementById('dropdownButtonHeader');
                        const dropdownMenuHeader = document.getElementById('dropdownMenuHeader');

                        // Ensure the button and menu exist
                        if (dropdownButtonHeader && dropdownMenuHeader) {
                            dropdownButtonHeader.addEventListener('click', (event) => {
                                event.stopPropagation(); // Prevent the click event from bubbling
                                dropdownMenuHeader.classList.toggle('hidden'); // Toggle the 'hidden' class
                            });

                            // Close the dropdown when clicking outside
                            document.addEventListener('click', (event) => {
                                if (!dropdownMenuHeader.contains(event.target) && !dropdownButtonHeader.contains(event.target)) {
                                    dropdownMenuHeader.classList.add('hidden'); // Add the 'hidden' class to close the dropdown
                                }
                            });
                        } else {
                            console.error('Dropdown button or menu not found.');
                        }
                    });
                </script>
            </div>
        </div>
     <?php $__env->endSlot(); ?>

    <div class="py-12">
        <div class="mx-auto max-w-7xl sm:px-6 lg:px-8">
            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <chat-component :friend="<?php echo e($friend); ?>" :current-user="<?php echo e(auth()->user()); ?>" />
                </div>
            </div>
        </div>
    </div>
 <?php echo $__env->renderComponent(); ?>
<?php endif; ?>
<?php if (isset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $attributes = $__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__attributesOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?>
<?php if (isset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54)): ?>
<?php $component = $__componentOriginal9ac128a9029c0e4701924bd2d73d7f54; ?>
<?php unset($__componentOriginal9ac128a9029c0e4701924bd2d73d7f54); ?>
<?php endif; ?><?php /**PATH /var/www/chat.sxags.com/themes/tailwind/views/chat.blade.php ENDPATH**/ ?>