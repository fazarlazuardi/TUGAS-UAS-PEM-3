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
        <h2 style="margin-top:0px">Barang <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
	    <div class="form-group">
            <label for="varchar">Nama <?php echo form_error('nama') ?></label>
            <input type="text" class="form-control" name="nama" id="nama" placeholder="Nama" value="<?php echo $nama; ?>" />
        </div>
	    <div class="form-group">
            <label for="int">Kategori<?php echo form_error('kategori_id') ?></label>
            <select class="form-control" name="kategori_id" id="kategori_id">
                <option value="">Pilih Kategori</option>
                <?php 
                $kategori_list = $this->db->get('kategori')->result();
                foreach ($kategori_list as $kat) { ?>
                    <option value="<?=$kat->id_kategori?>" <?=$kategori_id == $kat->id_kategori ? "selected" : ""?>><?=$kat->nama?></option>
                <?php } ?>
            </select>
            <!-- <input type="text" class="form-control" name="kategori_id" id="kategori_id" placeholder="Kategori Id" value="<?php echo $kategori_id; ?>" /> -->
        </div>
	    <div class="form-group">
            <label for="int">Satuan<?php echo form_error('satuan_id') ?></label>
            <select class="form-control" name="satuan_id" id="satuan_id">
                <option value="">Pilih satuan</option>
                <?php 
                $satuan_list = $this->db->get('satuan')->result();
                foreach ($satuan_list as $sat) { ?>
                    <option value="<?=$sat->id_satuan?>" <?=$satuan_id == $sat->id_satuan ? "selected" : ""?>><?=$sat->nama?></option>
                <?php } ?>
            </select>
            <!-- <input type="text" class="form-control" name="satuan_id" id="satuan_id" placeholder="Satuan Id" value="<?php echo $satuan_id; ?>" /> -->
        </div>
	    <input type="hidden" name="id_barang" value="<?php echo $id_barang; ?>" /> 
	    <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
	    <a href="<?php echo site_url('barang') ?>" class="btn btn-default">Cancel</a>
	</form>
    </body>
</html>