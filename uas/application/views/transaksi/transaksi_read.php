<!doctype html>
<html>
    <head>
        <title>harviacode.com - codeigniter crud generator</title>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <style>
            body{
                padding: 15px;
            }
        </style>
    </head>
    <body>
        <h2 style="margin-top:0px">Transaksi Read</h2>
        <table class="table">
	    <tr><td>Nama Transaksi</td><td><?php echo $nama_transaksi; ?></td></tr>
	    <tr><td>Tgl Transaksi</td><td><?php echo $tgl_transaksi; ?></td></tr>
	    <tr><td>Harga</td><td><?php echo $harga; ?></td></tr>
	    <tr><td>Qty</td><td><?php echo $qty; ?></td></tr>
	    <tr><td>Id Barang</td><td><?php echo $id_barang; ?></td></tr>
	    <tr><td>Diskon</td><td><?php echo $diskon; ?></td></tr>
	    <tr><td>Id Pelanggan</td><td><?php echo $id_pelanggan; ?></td></tr>
	    <tr><td></td><td><a href="<?php echo site_url('transaksi') ?>" class="btn btn-default">Cancel</a></td></tr>
	</table>
        </body>
</html>