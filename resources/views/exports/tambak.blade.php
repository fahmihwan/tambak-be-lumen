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
    @foreach($tambak as $t)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $t->nama }}</td>
            <td>{{ $t->negara }}</td>
            <td>{{ $t->alamat }}</td>
            <td>{{ $t->jumlah_kolam }}</td>
            <td>{{ $t->zona_waktu }}</td>
            <td>{{ $t->nama_awal_kolam }}</td>
            <td>{{ $t->luas }}</td>
            <td>{{ $t->created_at->diffForHumans() }}</td>
            <td>{{ $t->updated_at->diffForHumans() }}</td>
        </tr>
    @endforeach
    </tbody>
</table>
