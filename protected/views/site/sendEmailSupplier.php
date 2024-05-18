
<style>
    table p{
        font-size: 1.3rem;
    }
    .text-bold{
        font-weight: 700;
    }
    .table-bordered>tbody>tr>td, .table-bordered>tbody>tr>th, .table-bordered>tfoot>tr>td, .table-bordered>tfoot>tr>th, .table-bordered>thead>tr>td, .table-bordered>thead>tr>th {
        border: 1px solid #848484;
    }
    .table-bordered th, .table-bordered td {
        padding: 10px 5px;
    } 
    table > thead > tr > th, table > thead > tr > td, table > tbody > tr > td {
        border: 1px solid #848484;
    }
</style>
<body style="background: #fff;font-family: Georgia, 'Times New Roman', Times, serif;
        line-height: 16px;">
	
<div class="email-head" style="display: inline-block;
    height: 100px;
    width: 100%;
    text-align: center;
    background-color: #F6DA62;color: #fff;">
    <img src="<?php echo SERVER.'/images/logo_text.png'; ?>" class="lazy" style="width: 20%;
    vertical-align: middle;padding: 10px;">
</div>

<div class="email-body" style="padding: 20px;">

<table class="table" style="width:100%;padding: 10px;">
    <thead>
        <tr>
            <th colspan="2" style="text-align: center;text-align:center;font-weight: 700;">
                <h3 style="font-size: 2rem;"><?= strtoupper('Surat Permintaan Harga Barang') ?></h3>
                <p>Nomor: <?= $modelPenawaran->id_penawaran; ?></p>
            </th>
        </tr>
        <tr><th colspan="2" style="padding: 15px;"><div class="clearfix" style="margin:10px;"></div></th></tr>
        <tr>
            <td colspan="2">
                <p>Kepada</p>
                <p><?= $supplier->nama_supplier; ?></p>
            </td>
        </tr>
        <tr>
            <td><p><?= $modelPenawaran->alamat_pengiriman ?></p></td>
            <td style="text-align: right"><p><?= $this->IndonesiaTgl($modelPenawaran->created_date); ?></p></td>
        </tr>
    </thead>
</table>

<div class="clearfix" style="margin:10px;"></div>

<table class="table table-bordered" style="border: 1px solid #848484;
    border-collapse: collapse;
    width: 100%;text-align: left;">
    <thead>
            <tr>
                <th style="width:10px">No.</th>
                <th>ID Barang</th>
                <th>Parts Number</th>
                <th>Nama Barang (Parts Name)</th>
                <th>Satuan</th>
                <th>Kuantitas</th>
            </tr>
        </thead>
        <tbody>
           <?php
           if (isset($modelPenawaran->orderBarang) && !empty($modelPenawaran->orderBarang)){
                $no=1;
                foreach ($modelPenawaran->orderBarang as $orderBarang_) {
                    ?>
                    <tr>
                        <td><?= $no++; ?></td>
                        <td><?= isset($orderBarang_->barang) ? $orderBarang_->barang->id_barang : '-'; ?></td>
                        <td><?= isset($orderBarang_->barang) ? $orderBarang_->barang->parts_number : '-'; ?></td>
                        <td><?= isset($orderBarang_->barang) ? $orderBarang_->barang->nama_barang : '-'; ?></td>
                        <td><?= isset($orderBarang_->barang) ? $orderBarang_->barang->satuan : '-'; ?></td>
                        <td><?= $orderBarang_->kuantitas; ?></td>
                    </tr>
                    <?php
                }
           } else { ?>
            <tr>
                <td colspan="8" class="text-center">
                    <span class="text-bold">Belum ada Order Terpilih</span>
                </td>
            </tr>
           <?php }
           ?>
        </tbody>
</table>

    <div class="email-footer">
        <div class="kontak-description">
            <div class="contain-description" style="padding: 10px 0px;">
            <?php
            $level_string = "";
            switch($modelPenawaran->level) {
                case '0':
                    $level_string = "Biasa";
                    break;
                case '1':
                    $level_string = "Segera";
                    break;
                case '2':
                    $level_string = "Mendesak";
                    break;
            }
            ?>
                <p style="padding: 3px 0px;
                font-size: 1.2rem;
                font-weight: 700;
            "><?= strtoupper($level_string); ?></p>

            <div class="clearfix" style="margin:10px;"></div>
            <p style="padding: 3px 0px;">Silakan kunjungi website berikut untuk input harga Barang : <a href="<?= SERVER . '/'; ?>"><?= SERVER . '/'; ?></a></p>
            </div>
        </div> 

    </div>
</div>

</body>