<table border="1">
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
    @foreach($stok as $s)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $s->nama }}</td>
            <td>{{ $s->total_berat }}</td>
            <td>{{ $s->harga }}</td>
            <td>{{ $s->tgl_beli }}</td>
            <td>{{ $s->tgl_expired }}</td>
            <td>{{ $s->note }}</td>
            <td>{{ $s->created_at->diffForHumans() }}</td>
            <td>{{ $s->updated_at->diffForHumans() }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
