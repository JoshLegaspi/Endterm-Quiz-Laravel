

<?php $__env->startSection('content'); ?>
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4 flex-wrap gap-3">
        <h2 class="mb-0">Movies</h2>
        <?php if(auth()->guard()->check()): ?>
        <div>
            <span class="me-3">Hi, <?php echo e(Auth::user()->name); ?> (<?php echo e(Auth::user()->role); ?>)</span>
            <a href="<?php echo e(route('logout')); ?>" 
               onclick="event.preventDefault(); document.getElementById('logout-form').submit();" 
               class="btn btn-outline-danger btn-sm">Logout</a>
            <form id="logout-form" action="<?php echo e(route('logout')); ?>" method="POST" class="d-none"><?php echo csrf_field(); ?></form>
        </div>
        <?php endif; ?>
    </div>

    <?php if(Auth::user()->role === 'admin'): ?>
    <div class="mb-4">
        <a href="<?php echo e(route('movies.create')); ?>" class="btn btn-primary">Add New Movie</a>
    </div>
    <?php endif; ?>

    <form method="GET" class="row gy-2 gx-3 mb-4">
        <div class="col-12 col-md-4">
            <input type="text" name="search" value="<?php echo e(request('search')); ?>" class="form-control" placeholder="Search title...">
        </div>
        <div class="col-6 col-md-3">
            <select name="genre" class="form-select">
                <option value="">All Genres</option>
                <option value="Action" <?php echo e(request('genre') === 'Action' ? 'selected' : ''); ?>>Action</option>
                <option value="Comedy" <?php echo e(request('genre') === 'Comedy' ? 'selected' : ''); ?>>Comedy</option>
                <option value="Drama" <?php echo e(request('genre') === 'Drama' ? 'selected' : ''); ?>>Drama</option>
                <option value="Fantasy" <?php echo e(request('genre') === 'Fantasy' ? 'selected' : ''); ?>>Fantasy</option>
                <option value="Horror" <?php echo e(request('genre') === 'Horror' ? 'selected' : ''); ?>>Horror</option>
            </select>
        </div>
        <div class="col-6 col-md-2">
            <select name="sort" class="form-select">
                <option value="title" <?php echo e(request('sort') === 'title' ? 'selected' : ''); ?>>Title</option>
                <option value="release_date" <?php echo e(request('sort') === 'release_date' ? 'selected' : ''); ?>>Release Date</option>
            </select>
        </div>
        <div class="col-6 col-md-2">
            <select name="direction" class="form-select">
                <option value="asc" <?php echo e(request('direction') === 'asc' ? 'selected' : ''); ?>>ASC</option>
                <option value="desc" <?php echo e(request('direction') === 'desc' ? 'selected' : ''); ?>>DESC</option>
            </select>
        </div>
        <div class="col-6 col-md-1 d-grid">
            <button type="submit" class="btn btn-secondary">Go</button>
        </div>
    </form>

    <div class="row row-cols-1 row-cols-md-2 g-4">
        <?php $__currentLoopData = $movies; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $movie): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <div class="col">
            <div class="card h-100 shadow-sm">
                <?php if($movie->image): ?>
                <img src="<?php echo e(asset('storage/' . $movie->image)); ?>" class="card-img-top" alt="<?php echo e($movie->title); ?> poster" style="height: 300px; object-fit: cover;">
                <?php endif; ?>
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><?php echo e($movie->title); ?></h5>
                    <p class="card-text flex-grow-1"><?php echo e(Str::limit($movie->description, 140)); ?></p>
                    <p class="mb-1"><small class="text-muted">Genre: <?php echo e($movie->genre); ?></small></p>
                    <p><small class="text-muted">Release Date: <?php echo e($movie->release_date); ?></small></p>

                    <?php if(Auth::user()->role === 'admin'): ?>
                    <div class="mt-auto d-flex gap-2">
                        <a href="<?php echo e(route('movies.edit', $movie->id)); ?>" class="btn btn-sm btn-warning flex-grow-1">Edit</a>
                        <form action="<?php echo e(route('movies.destroy', $movie->id)); ?>" method="POST" onsubmit="return confirm('Are you sure you want to delete this movie?');" class="flex-grow-1">
                            <?php echo csrf_field(); ?>
                            <?php echo method_field('DELETE'); ?>
                            <button type="submit" class="btn btn-sm btn-danger w-100">Delete</button>
                        </form>
                    </div>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </div>

    <div class="mt-4">
        <?php echo e($movies->appends(request()->query())->links()); ?>

    </div>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\theater-system\resources\views/movies/index.blade.php ENDPATH**/ ?>