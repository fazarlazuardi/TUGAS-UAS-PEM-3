<!DOCTYPE html>
<html lang="en">
<head>
  <title>Bootstrap Example</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <a class="navbar-brand" href="#">CUP<b class="text-danger">-</b>CUP</a>
    </div>
    <ul class="nav navbar-nav">
      <li class=""><a href="<?=base_url()?>transaksi/create">Transaksi</a></li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Master Data <span class="caret"></span></a>
        <ul class="dropdown-menu">
          <li><a href="<?=base_url()?>barang">Barang</a></li>
          <li><a href="<?=base_url()?>kategori">Kategori</a></li>
          <li><a href="<?=base_url()?>satuan">Satuan</a></li>
          <li><a href="<?=base_url()?>pelanggan">Pelanggan</a></li>
        </ul>
      </li>
      <li class="dropdown"><a class="dropdown-toggle" data-toggle="dropdown" href="#">Laporan Transaksi<span class="caret"></span></a>
        <ul class="dropdown-menu">
            <li><a href="<?=base_url()?>transaksi/member/yes">Member</a></li>
            <li><a href="<?=base_url()?>transaksi/member/non">Non Member</a></li>
        </ul>
      </li>
    </ul>
  </div>
</nav>
<div class="container">