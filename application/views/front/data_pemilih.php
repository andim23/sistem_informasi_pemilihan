<link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">

<div id="page">
        <div class="header header-fixed header-logo-app">
            <a href="#" class="header-title">Data Pemilih</a>
            <a href="#" class="header-icon header-icon-1" data-back-button><i class="fas fa-arrow-left"></i></a>
            <a href="#" class="header-icon header-icon-3" data-menu="cari-pemilih"><i class="fas fa-search"></i></a>
            <a href="app/panitia" class="header-icon header-icon-4"><i class="fas fa-home"></i></a>
            <a href="#" class="header-icon header-icon-2" data-toggle-theme><i class="fas fa-moon"></i></a>
        </div>

        <!-- Pendeteksi Internet -->
        <div id="menu-offline" class="menu menu-box-modal round-medium bg-gradasi">
            <div data-height="100%" class="caption">
                <div class="caption-center">
                    <h2 class="center-text color-theme bolder font-30">Internet Terputus</h2>
                    <p class="boxed-text-huge color-theme opacity-60 bottom-30 top-15">
                        Aplikasi ini membutuhkan koneksi internet. Periksa kembali data seluler atau wifi untuk
                        melanjutkan.
                    </p>
                </div>
            </div>
        </div>

        <div class="page-content header-clear-sedang">
            <div class="profile-2">
                <div class="divider divider-margins top-5"></div>
                <div class="profile-sub-heading">
                    <div class="fac fac-radio fac-default"><span></span>
                        <a href="#" @click="type_input='tambah'" class="button button-xxs shadow-small button-round-small bg-green2-dark"
                            data-menu="menu-data-pemilih">Tambah</a>
                    </div>
                    <div class="fac fac-radio fac-green"><span></span>
                        <a href="#" class="button button-xxs shadow-small button-round-small bg-green1-dark"
                            data-menu="menu-import-pemilih">Import
                            Excel</a>
                    </div>
                    <div class="fac fac-radio fac-red"><span></span>
                        <a href="#" class="button button-xxs shadow-small button-round-small bg-red2-dark"
                            data-menu="menu-hapus-semua-pemilih">Hapus
                            Semua</a>
                    </div>
                </div>
                <div class="divider divider-margins top-5"></div>
                <div class="content">
                    <table class="table-borders" id="example">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th class="tbl-kiri2">Nama Pemilih</th>
                                <th class="tbl-kiri2">Kel</th>
                                <th class="tbl-kiri2">Kode Akun</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $no = 1;
                        foreach ($this->db->get_where('pemilih', array('id_pemilihan'=>$this->uri->segment(3)))->result() as $row) {
                         ?>
                        <tr>
                            <td><?php echo $no; ?></td>
                            <td class="tbl-kiri2"><?php echo $row->nama_pemilih ?></td>
                            <td class="tbl-kiri2"><?php echo $row->kel ?></td>
                            <td></i><?php echo $row->kode_akun ?></td>
                            <td style="display: flex">
                                <a href="#" @click="edit_pemilih('<?php echo $row->id_pemilih ?>')" data-menu="menu-data-pemilih">
                                    <i class="fa fa-edit color-green2-dark" style="margin: 2px;"></i></a>
                                <a href="#" @click="hapus_pemilih('<?php echo $row->id_pemilih ?>')" data-menu="menu-hapus-pemilih">
                                    <i class="fa fa-trash-alt color-orange-dark" style="margin: 2px;">
                                    </i>
                                </a></td>
                        </tr>
                        <?php $no++; } ?>
                        </tbody>
                        
                    </table>
                    <!-- <div class="pagination">
                        <a href="#"><i class="fa fa-angle-left"></i></a>
                        <a href="#" class="bg-highlight color-white">1</a>
                        <a href="#" class="no-border">2</a>
                        <a href="#" class="no-border">3</a>
                        <a href="#" class="no-border">4</a>
                        <a href="#" class="no-border">5</a>
                        <a href="#"><i class="fa fa-angle-right"></i></a>
                    </div> -->
                </div>
            </div>
        </div>
        <!-- Menu Tambah / Edit Pemilih -->
        <div id="menu-data-pemilih" class="menu menu-box-bottom" data-menu-height="300" data-menu-effect="menu-over">
            <div class="content">
                <h3 class="uppercase ultrabold top-20">Data Pemilih</h3>
                <p class="font-11 under-heading bottom-20">
                    Kelola data pemilih.
                </p>
                <form action="" method="post">
                    <div v-if="type_input === 'tambah'">
                    <input  type="hidden" name="type_input" value="tambah">
                    </div>
                    <div v-if="type_input === 'edit'">
                    <input type="hidden" name="type_input" value="edit">
                    <input type="hidden" name="id_pemilih" :value="data_pemilih.id_pemilih">
                    </div>
                    <!-- <div v-show="status_np">
                        <span style="background-color: green; color:white;"><i>{{status_nama}}</i></span>
                    </div> -->
                <div class="input-style has-icon input-style-1 input-required">
                    <i class="input-icon fa fa-sort-numeric-down font-11"></i>
                    <span>Nama Pemilih</span>
                    <em>(wajib)</em>
                    <input type="name" name="nama_pemilih" placeholder="Nama Pemilih" :value="data_pemilih.nama_pemilih" required>
                </div>
                <div class="input-style has-icon input-style-1 input-required">
                    <i class="input-icon fa fa-id-card font-11"></i>
                    <span>Kategori/Kelas/Kelompok dll</span>
                    <em>(wajib)</em>
                    <input type="name" name="kel" placeholder="Kategori/Kelas/Kelompok dll" :value="data_pemilih.kel" required>
                </div>
                <div class="input-style has-icon input-style-1">
                        <i class="input-icon fa fa-phone font-11"></i>
                        <span>Nomor Handphone</span>
                        <em>(boleh kosong)</em>
                        <input type="name" name="no_telp" :value="data_pemilih.no_telp" placeholder="Nomor HP (Utamakan Whatsapp)" minlength="9" maxlength="14" >
                    </div>
                <div class="input-style has-icon input-style-1 input-required">
                        <i class="input-icon fa fa-id-card font-11"></i>
                        <span>Kode Akun</span>
                        <em>(wajib)</em>
                        <input type="text" name="kode_akun" :value="data_pemilih.kode_akun" placeholder="Kode Akun" required>
                    </div>
                    <input type="hidden" name="id_pemilihan" value="<?php echo $this->uri->segment(3); ?>">
                <div class="clear"></div>
                <button type="submit" class="button button-full button-s shadow-large button-round-small bg-blue2-dark top-10">Simpan</button>
            </div>
            </form>
        </div>

        <!-- Menu Hapus Pemilih -->
        <div id="menu-hapus-pemilih" class="menu menu-box-bottom menu-nonactive" data-menu-height="200"
            data-menu-effect="menu-over" style="height: 200px; opacity: 1; display: block;">
            <h5 class="center-text uppercase ultrabold top-20">Apakah Kamu Yakin?</h5>
            <p class="boxed-text-large">
                Akan menghapus data pemilih ini.
            </p>
            <div class="content left-50 right-50">
                <div class="one-half">
                    <a :href="hapus"
                        class="button button-center-large button-s shadow-large button-round-small bg-red2-dark">Ya</a>
                </div>
                <div class="one-half last-column">
                    <a href="#"
                        class="close-menu button button-center-large button-s shadow-large button-round-small bg-green1-dark">Batal</a>
                </div>
                <div class="clear"></div>
            </div>
        </div>

        <!-- Menu Hapus Semua Pemilih -->
        <div id="menu-hapus-semua-pemilih" class="menu menu-box-bottom menu-nonactive" data-menu-height="200"
            data-menu-effect="menu-over" style="height: 200px; opacity: 1; display: block;">
            <h5 class="center-text uppercase ultrabold top-20">Apakah Kamu Yakin?</h5>
            <p class="boxed-text-large">
                Akan menghapus <strong style="color: red; font-weight: 700;">SEMUA</strong> data pemilih ini.
            </p>
            <div class="content left-50 right-50">
                <div class="one-half">
                    <a href="app/hapus_all_pemilih"
                        class="button button-center-large button-s shadow-large button-round-small bg-red2-dark">Ya</a>
                </div>
                <div class="one-half last-column">
                    <a href="#"
                        class="close-menu button button-center-large button-s shadow-large button-round-small bg-green1-dark">Batal</a>
                </div>
                <div class="clear"></div>
            </div>
        </div>

        <!-- Import Excel -->
        <div id="menu-import-pemilih" class="menu menu-box-bottom" data-menu-height="360" data-menu-effect="menu-over">
            <div class="content">
                <h3 class="uppercase ultrabold top-20">Import Pemilih</h3>
                <p class="font-11 under-heading bottom-20">
                    Download format - Isi - Upload.
                </p>
                <a class="button button-full button-xxs shadow-large button-round-small bg-green2-dark top-10"
                    type="submit" onclick="window.open('<?php echo base_url() ?>front/document/template_import_pemilih.xlsx')">Download Format Excel</a>
                <div class="garis-vertical"></div>
                <div>
                    <img class="preload-image horizontal-center" width="80" src="front/images/preload-logo.png"
                        data-src="front/images/excel-logo.png" alt="img"
                        style="border: dashed; border-width: thin; color: darkgrey; padding: 5px;">
                </div>
                <p class="font-11 under-heading bottom-15" style="text-align: center;margin-top: 5px;">
                    Upload file Excel.
                </p>

                <div class="clear"></div>
                <a href="#"
                    class="button button-full button-s shadow-large button-round-small bg-blue2-dark top-10">Simpan</a>
            </div>
        </div>

        <!-- Cari Pemilih -->
        <div id="cari-pemilih" class="menu menu-box-bottom" data-menu-height="230" data-menu-effect="menu-over">
            <div class="content">
                <p class="font-11 under-heading bottom-20 top-20">
                    Ketikan keyword untuk mencari.
                </p>
                <div class="input-style has-icon input-style-1 input-required bottom-30">
                    <i class="input-icon fa fa-search"></i>
                    <span>Masukan keyword pencarian</span>
                    <em>(wajib)</em>
                    <input type="text" placeholder="Ketik disini">
                </div>
                <a href="#" class="button button-full button-m shadow-large button-round-small bg-highlight top-20">CARI
                    Pemilih</a>
            </div>
        </div>
    </div>


    <div class="menu-hider"></div>

<script type="text/javascript">
     $('#example').DataTable();

    var vm = new Vue({
    el: "#page",
    data : {
        type_input : '',
        get_nama_pemilih: '',
        status_np: false,
        status_nama: '',
        cek_nama_pemilih: '',
        hapus : '#',
        data_pemilih: [],
    },
    computed:{
        
    }, 
    watch: {
        
    },
    methods:{
        edit_pemilih: function(id_pemilih) {
            axios
              .get('<?php echo base_url() ?>app/get_pemilih/'+id_pemilih)
              .then(response => (
                this.data_pemilih = response.data.pemilih
                ))
            this.type_input = 'edit'
        },
        hapus_pemilih: function(id_pemilih) {
            this.hapus = 'app/hapus_pemilih/'+id_pemilih+'/<?php echo $this->uri->segment(3) ?>'
        }
        // cek_nama: function() {

        //     axios
        //   .get('<?php echo base_url() ?>app/cek_nama_pemilih/'+this.cek_nama_pemilih)
        //   .then(response => (
        //     this.get_nama_pemilih = response.data
        //     ))
        //   if (this.get_nama_pemilih == 1) {
        //     this.status_nama = 'Nama Calon ini telah ada';
        //     this.status_np = false;
        //   } else {
        //     this.status_nama = 'Nama Calon bisa di gunakan';
        //     this.status_np = true;
        //   }
        //   console.log(this.status_nama);
        //   console.log(this.status_np);
        // }
    }
});

</script>