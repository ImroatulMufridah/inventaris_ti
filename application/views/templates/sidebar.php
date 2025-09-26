<?php defined('BASEPATH') OR exit('No direct script access allowed'); ?>
<!-- Layout -->
<div class="wrapper">
    <!-- Sidebar -->
    <nav class="sidebar" id="sidebar">
        <h4>Menu</h4>
        <a href="<?= base_url('index.php/user') ?>" class="<?=($link!='' && $link=='user') ? 'active' : ''?>">User</a>
        <a href="<?= base_url('index.php/barang') ?>" class="<?=($link!='' && $link=='barang') ? 'active' : ''?>">Barang</a>
        <!-- <a href="<?= base_url('index.php/tambah') ?>">Tambah Barang</a> -->
        <a href="<?= base_url('index.php/laporan') ?>" class="<?=($link!='' && $link=='laporan') ? 'active' : ''?>">Laporan</a>
        <a href="<?= base_url('index.php/kirim_email') ?>" class="<?=($link!='' && $link=='kirim_email') ? 'active' : ''?>">Kirim Email</a>
        <!-- <a href="<?= base_url('index.php/user') ?>">User</a> -->
    </nav>