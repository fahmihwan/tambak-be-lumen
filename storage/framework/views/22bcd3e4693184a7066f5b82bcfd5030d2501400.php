<table>
    <thead>
    <tr>
        <th style="font-weight: bold; color:red;">No</th>
        <th style="font-weight: bold; color:red;">Nama</th>
        <th style="font-weight: bold; color:red;">Total Berat</th>
        <th style="font-weight: bold; color:red;">Harga</th>
        <th style="font-weight: bold; color:red;">Tanggal Beli</th>
        <th style="font-weight: bold; color:red;">Tanggal Expired</th>
        <th style="font-weight: bold; color:red;">Note</th>
        <th style="font-weight: bold; color:red;">Created At</th>
        <th style="font-weight: bold; color:red;">Updated At</th>
    </tr>
    </thead>
    <tbody>
    <?php $__currentLoopData = $stok; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $s): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <tr>
            <td><?php echo e($loop->iteration); ?></td>
            <td><?php echo e($s->nama); ?></td>
            <td><?php echo e($s->total_berat); ?></td>
            <td><?php echo e($s->harga); ?></td>
            <td><?php echo e($s->tgl_beli); ?></td>
            <td><?php echo e($s->tgl_expired); ?></td>
            <td><?php echo e($s->note); ?></td>
            <td><?php echo e($s->created_at->diffForHumans()); ?></td>
            <td><?php echo e($s->updated_at->diffForHumans()); ?></td>
        </tr>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
    </tbody>
</table>
<?php /**PATH /home/programmer/Project/lumen/tambak-udang/resources/views/exports/stok_pakan.blade.php ENDPATH**/ ?>