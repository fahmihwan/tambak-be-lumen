<table border="1">
    <thead>
    <tr>
        <th style="font-weight: bold; color:red;">No</th>
        <th style="font-weight: bold; color:red;">Nama</th>
        <th style="font-weight: bold; color:red;">Negara</th>
        <th style="font-weight: bold; color:red;">Alamat</th>
        <th style="font-weight: bold; color:red;">Jumlah Kolam</th>
        <th style="font-weight: bold; color:red;">Zona Waktu</th>
        <th style="font-weight: bold; color:red;">Nama Awal Kolam</th>
        <th style="font-weight: bold; color:red;">Luas</th>
        <th style="font-weight: bold; color:red;">Created At</th>
        <th style="font-weight: bold; color:red;">Updated At</th>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $tambak; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($loop->iteration); ?></td>
            <td><?php echo e($t->nama); ?></td>
            <td><?php echo e($t->negara); ?></td>
            <td><?php echo e($t->alamat); ?></td>
            <td><?php echo e($t->jumlah_kolam); ?></td>
            <td><?php echo e($t->zona_waktu); ?></td>
            <td><?php echo e($t->nama_awal_kolam); ?></td>
            <td><?php echo e($t->luas); ?></td>
            <td><?php echo e($t->created_at->diffForHumans()); ?></td>
            <td><?php echo e($t->updated_at->diffForHumans()); ?></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH /home/programmer/Project/lumen/tambak-udang/resources/views/exports/tambak.blade.php ENDPATH**/ ?>