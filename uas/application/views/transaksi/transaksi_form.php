<!doctype html>
        <link rel="stylesheet" href="<?php echo base_url('assets/bootstrap/css/bootstrap.min.css') ?>"/>
        <link rel="stylesheet" href="<?php echo base_url('assets/datatables/dataTables.bootstrap.css') ?>"/>
        <link rel="stylesheet" href="<?php echo base_url('assets/datatables/dataTables.bootstrap.css') ?>"/>
        <style>
            .dataTables_wrapper {
                min-height: 500px
            }
            
            .dataTables_processing {
                position: absolute;
                top: 50%;
                left: 50%;
                width: 100%;
                margin-left: -50%;
                margin-top: -25px;
                padding-top: 20px;
                text-align: center;
                font-size: 1.2em;
                color:grey;
            }
            body{
                padding: 15px;
            }
        </style>
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
        <h2 style="margin-top:0px">Transaksi <?php echo $button ?></h2>
        <form action="<?php echo $action; ?>" method="post">
        <div class="row">
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="varchar">Nama Transaksi <?php echo form_error('nama_transaksi') ?></label>
                    <input type="text" class="form-control" name="nama_transaksi" id="nama_transaksi" placeholder="Nama Transaksi" value="<?php echo $nama_transaksi; ?>" />
                </div>
                <div class="form-group">
                    <label for="date">Tgl Transaksi <?php echo form_error('tgl_transaksi') ?></label>
                    <input type="date" class="form-control" name="tgl_transaksi" id="tgl_transaksi" placeholder="Tgl Transaksi" value="<?php echo $tgl_transaksi; ?>" />
                </div>
                <div class="form-group">
                    <label for="int">Pelanggan (Member)<?php echo form_error('id_pelanggan') ?></label>
                    <!-- <input type="text" class="form-control" name="id_pelanggan" id="id_pelanggan" placeholder="Id Pelanggan" value="<?php echo $id_pelanggan; ?>" /> -->
                    <select class="form-control" name="id_pelanggan" id="id_pelanggan">
                        <option value="0">Non Member</option>
                        <?php 
                        $pelanggan_list = $this->db->get('pelanggan')->result();
                        foreach ($pelanggan_list as $pel) { ?>
                            <option value="<?=$pel->id_pelanggan?>" <?=$id_pelanggan == $pel->id_pelanggan ? "selected" : ""?>><?=$pel->nama_pelanggan?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="form-group">
                    <label for="int">Barang <?php echo form_error('id_barang') ?></label>
                    <!-- <input type="text" class="form-control" name="id_barang" id="id_barang" placeholder="Id Barang" value="<?php echo $id_barang; ?>" /> -->
                    <select class="form-control" name="id_barang" id="id_barang">
                        <option value="">Pilih Barang</option>
                        <?php 
                        $barang_list = $this->db->get('barang')->result();
                        foreach ($barang_list as $bar) { ?>
                            <option value="<?=$bar->id_barang?>" <?=$id_barang == $bar->id_barang ? "selected" : ""?>><?=$bar->nama?></option>
                        <?php } ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="int">Harga <?php echo form_error('harga') ?></label>
                    <input type="number" class="form-control" name="harga" id="harga" placeholder="Harga" value="<?php echo $harga; ?>" />
                </div>
                <div class="form-group">
                    <label for="int">Qty <?php echo form_error('qty') ?></label>
                    <input type="number" class="form-control" name="qty" id="qty" placeholder="Qty" value="<?php echo $qty; ?>" />
                </div>
            </div>
        </div>
        <div class="text-center">
            <input type="hidden" name="id_transaksi" value="<?php echo $id_transaksi; ?>" /> 
            <button type="submit" class="btn btn-primary"><?php echo $button ?></button> 
            <!-- <a href="<?php echo site_url('transaksi') ?>" class="btn btn-default">Cancel</a> -->
        </div>
	</form>

    <div class="row" style="margin-bottom: 10px">
        <div class="col-md-4">
            <h2 style="margin-top:0px">Transaksi List</h2>
        </div>
        <div class="col-md-4 text-center">
            <div style="margin-top: 4px"  id="message">
                <?php echo $this->session->userdata('message') <> '' ? $this->session->userdata('message') : ''; ?>
            </div>
        </div>
        <div class="col-md-4 text-right">
            <?php echo anchor(site_url('transaksi/excel'), 'Excel', 'class="btn btn-primary"'); ?>
        </div>
    </div>
    <table class="table table-bordered table-striped" id="mytable">
            <thead>
                <tr>
                    <th width="80px">No</th>
                    <th>Pelanggan</th>
                    <th>Status</th>
                    <th>Kategori</th>
                    <th>Barang</th>
                    <th>Qty</th>
                    <th>Harga</th>
                    <th>Diskon</th>
                    <th>Total</th>
                </tr>
            </thead>
	    
        </table>
        <script src="<?php echo base_url('assets/js/jquery-1.11.2.min.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/jquery.dataTables.js') ?>"></script>
        <script src="<?php echo base_url('assets/datatables/dataTables.bootstrap.js') ?>"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                $.fn.dataTableExt.oApi.fnPagingInfo = function(oSettings)
                {
                    return {
                        "iStart": oSettings._iDisplayStart,
                        "iEnd": oSettings.fnDisplayEnd(),
                        "iLength": oSettings._iDisplayLength,
                        "iTotal": oSettings.fnRecordsTotal(),
                        "iFilteredTotal": oSettings.fnRecordsDisplay(),
                        "iPage": Math.ceil(oSettings._iDisplayStart / oSettings._iDisplayLength),
                        "iTotalPages": Math.ceil(oSettings.fnRecordsDisplay() / oSettings._iDisplayLength)
                    };
                };

                var t = $("#mytable").dataTable({
                    initComplete: function() {
                        var api = this.api();
                        $('#mytable_filter input')
                                .off('.DT')
                                .on('keyup.DT', function(e) {
                                    if (e.keyCode == 13) {
                                        api.search(this.value).draw();
                            }
                        });
                    },
                    oLanguage: {
                        sProcessing: "loading..."
                    },
                    processing: true,
                    serverSide: true,
                    ajax: {"url": "<?=base_url()?>transaksi/json", "type": "POST"},
                    columns: [
                        {
                            "data": "id_transaksi",
                            "orderable": false
                        },
                        {"data": "napel"},
                        {"data": "status_member"},
                        {"data": "nama_kategori"},
                        {"data": "nama_barang"},
                        {"data": "qty"},
                        {"data": "harga"},
                        {"data": "diskon"},
                        {
                            "data" : "total",
                            "className" : "text-right"
                        }
                    ],
                    order: [[0, 'desc']],
                    rowCallback: function(row, data, iDisplayIndex) {
                        var info = this.fnPagingInfo();
                        var page = info.iPage;
                        var length = info.iLength;
                        var index = page * length + (iDisplayIndex + 1);
                        $('td:eq(0)', row).html(index);
                    }
                });
            });
        </script>
    </body>
</html>