

<?php $__env->startSection('content'); ?>
<div class="container">
    <h2>Edit Movie</h2>
    <form action="<?php echo e(route('movies.update', $movie->id)); ?>" method="POST" enctype="multipart/form-data">
        <?php echo csrf_field(); ?>
        <?php echo method_field('PUT'); ?>

        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="<?php echo e(old('title', $movie->title)); ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Description</label>
            <textarea name="description" class="form-control"><?php echo e(old('description', $movie->description)); ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">Genre</label>
            <select name="genre" class="form-select">
                <option value="Action" <?php echo e($movie->genre === 'Action' ? 'selected' : ''); ?>>Action</option>
                <option value="Comedy" <?php echo e($movie->genre === 'Comedy' ? 'selected' : ''); ?>>Comedy</option>
                <option value="Drama" <?php echo e($movie->genre === 'Drama' ? 'selected' : ''); ?>>Drama</option>
                <option value="Fantasy" <?php echo e($movie->genre === 'Fantasy' ? 'selected' : ''); ?>>Fantasy</option>
                <option value="Horror" <?php echo e($movie->genre === 'Horror' ? 'selected' : ''); ?>>Horror</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Release Date</label>
            <input type="date" name="release_date" class="form-control" value="<?php echo e(old('release_date', $movie->release_date)); ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">Poster Image</label>
            <input type="file" name="image" class="form-control">
            <?php if($movie->image): ?>
                <p class="mt-2">Current: <img src="<?php echo e(asset('storage/' . $movie->image)); ?>" width="100"></p>
            <?php endif; ?>
        </div>

        <button type="submit" class="btn btn-success">Update Movie</button>
         <a href="<?php echo e(route('movies.index')); ?>" class="btn btn-secondary">Cancel</a>
    </form>
</div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layouts.app', array_diff_key(get_defined_vars(), ['__data' => 1, '__path' => 1]))->render(); ?><?php /**PATH D:\theater-system\resources\views/movies/edit.blade.php ENDPATH**/ ?>