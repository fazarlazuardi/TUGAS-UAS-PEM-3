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
        <h2 style="margin-top:0px">Pelanggan <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="char">Nama Pelanggan <?php echo form_error('nama_pelanggan') ?></label>
            <input type="text" class="form-control" name="nama_pelanggan" id="nama_pelanggan" placeholder="Nama Pelanggan" value="<?php echo $nama_pelanggan; ?>" />
        </div>
	    <div class="form-group">
            <label for="varchar">No Telp <?php echo form_error('no_telp') ?></label>
            <input type="text" class="form-control" name="no_telp" id="no_telp" placeholder="No Telp" value="<?php echo $no_telp; ?>" />
        </div>
	    <div class="form-group">
            <label for="char">Status <?php echo form_error('status') ?></label>
            <!-- <input type="text" class="form-control" name="status" id="status" placeholder="Status" value="<?php echo $status; ?>" /> -->
            <select class="form-control" name="status" id="status">
                <option value="">Pilih</option>
                <option value="Active" <?=$status == 'Active' ? "selected" : ""?>>Aktif</option>
                <option value="Not Active" <?=$status == 'Not Active' ? "selected" : ""?>>Not Active</option>
            </select>
        </div>
	    <input type="hidden" name="id_pelanggan" value="<?php echo $id_pelanggan; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('pelanggan') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>