
<template>
    <div class="modal fade" :id="modalid" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">{{ title }}</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                        <v-stepper v-model="e1">
                            <v-stepper-header>
                                <v-stepper-step :complete="e1 > 1" step="1">Pilih Master Barang</v-stepper-step>

                                <v-divider></v-divider>

                                <v-stepper-step step="2">Masukkan Data Detail Barang</v-stepper-step>
                            </v-stepper-header>

                            <v-stepper-items>
                                <v-stepper-content step="1">
                                    <div class="row">
                                        <div class="col">
                                            <div v-if="master_satker.length > 0">
                                                <input type="text" list="satkerList" id="defaultContactFormEmail"
                                                    @change="selectSatker" class="form-control mb-4"
                                                    v-model="pack.Nama_Satker" placeholder="Nama Satker">
                                                <datalist id="satkerList">
                                                    <option v-for="satker in master_satker"> {{ satker.Nama_Satker }}
                                                    </option>
                                                </datalist>
                                            </div>
                                            <div v-else>
                                                <input readonly type="text" class="form-control"
                                                    value="Waiting for data">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <input type="text" id="defaultContactFormEmail" class="form-control "
                                                v-model="pack.Kode_Satker" name="Kode_Satker" placeholder="Kode Satker">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div v-if="master_barang == []">
                                                <input readonly type="text" class="form-control"
                                                    value="Waiting for data">
                                            </div>
                                            <div v-else>
                                                <input type="text" @change="selectBarang" v-model="pack.Nama_Barang"
                                                    name="Nama_Barang" class="form-control mb-4"
                                                    placeholder="Nama Barang" list="list_barang">
                                                <datalist id="list_barang">
                                                    <option v-for="barang in master_barang ">{{ barang.Nama_Barang }}
                                                    </option>
                                                </datalist>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <input type="text" name="Kode_Barang" v-model="pack.Kode_Barang"
                                                id="defaultContactFormEmail" class="form-control mb-4"
                                                placeholder="Kode Barang">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" id="defaultContactFormEmail" name="Merk_Tipe"
                                                v-model="pack.Merk_Tipe" class="form-control mb-4"
                                                placeholder="Merk/Tipe">
                                        </div>
                                        <div class="col">
                                            <input type="text" id="defaultContactFormEmail" class="form-control mb-4"
                                                v-model="pack.NUP" placeholder="NUP">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <v-autocomplete  :loading="isLoading"
                                             v-model="pack.Lokasi" no-filter @change="selectLokasi" :items="list_lokasi" :search-input.sync="search"
                                                  label="Lokasi Ruangan Penyimpanan Aset" dense
                                                filled></v-autocomplete>
                                        </div>
                                    </div>
                                    <v-btn color="primary" @click="e1 = 2" :disabled="isValid">
                                        Next
                                    </v-btn>
                                </v-stepper-content>

                                <v-stepper-content step="2">
                                    <form :id="form" method="POST" :action="_url">
                                        <input type="hidden" name="_token" :value="csrf">
                                        <input type="hidden" v-model="pack.Kode_Barang" name="Kode_Barang" />
                                        <input type="hidden" v-model="pack.Kode_Ruangan" name="Kode_Ruangan" />
                                        <input type="hidden" v-model="pack.Kode_Satker" name="Kode_Satker" />
                                        <input type="hidden" v-model="pack.NUP" name="NUP" />
                                        <div class="row">
                                            <div class="col">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Tgl Rekam Pertama</span>
                                                    </div>
                                                    <input type="date" id="defaultContactFormEmail"
                                                        name="Tgl_Rekam_Pertama" v-model="details.Tgl_Rekam_Pertama"
                                                        class="form-control">
                                                </div>
                                            </div>
                                            <div class="col">

                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Tgl Perolehan</span>
                                                    </div>
                                                    <input type="date" id="defaultContactFormEmail"
                                                        class="form-control " name="Tgl_Perolehan"
                                                        v-model="details.Tgl_Perolehan" placeholder="Tgl Perolehan">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" id="defaultContactFormEmail"
                                                    class="form-control mb-4" v-model="details.Nilai_Perolehan_Pertama"
                                                    name="Nilai_Perolehan_Pertama"
                                                    placeholder="Nilai Perolehan Pertama">
                                            </div>
                                            <div class="col">
                                                <input type="text" id="defaultContactFormEmail"
                                                    class="form-control mb-4" v-model="details.Nilai_Mutasi"
                                                    placeholder="Nilai Mutasi" name="Nilai_Mutasi">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" id="defaultContactFormEmail"
                                                    class="form-control mb-4" name="Nilai_Perolehan"
                                                    v-model="details.Nilai_Perolehan" placeholder="Nilai Perolehan">
                                            </div>
                                            <div class="col">
                                                <input type="text" id="defaultContactFormEmail"
                                                    class="form-control mb-4" v-model="details.Nilai_Penyusutan"
                                                    placeholder="Nilai Penyusutan" name="Nilai_Penyusutan">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" id="defaultContactFormEmail"
                                                    class="form-control mb-4" v-model="details.Nilai_Buku"
                                                    placeholder="Nilai Buku" name="Nilai_Buku">
                                            </div>
                                            <div class="col">
                                                <input type="text" id="defaultContactFormEmail"
                                                    class="form-control mb-4" v-model="details.Kuantitas"
                                                    placeholder="KUANTITAS" name="Kuantitas">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" id="defaultContactFormEmail"
                                                    class="form-control mb-4" v-model="details.Jml_Foto"
                                                    placeholder="Jml Foto" name="Jml_Foto">
                                            </div>
                                            <div class="col">
                                                <input type="text" id="defaultContactFormEmail"
                                                    class="form-control mb-4" v-model="details.Status_Penggunaan"
                                                    placeholder="Status Penggunaan" name="Status_Penggunaan">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" id="defaultContactFormEmail"
                                                    class="form-control mb-4" v-model="details.Status_Pengelolaan"
                                                    placeholder="Status Pengelolaan" name="Status_Pengelolaan">
                                            </div>
                                            <div class="col">


                                                <input type="text" id="defaultContactFormEmail"
                                                    class="form-control mb-4" v-model="details.No_PSP"
                                                    placeholder="NO PSP" name="No_PSP">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" id="defaultContactFormEmail"
                                                    class="form-control mb-4" v-model="details.Jumlah_KIB"
                                                    placeholder="Jumlah KIB" name="Jumlah_KIB">
                                            </div>
                                            <div class="col">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Tgl PSP</span>
                                                    </div>
                                                    <input type="date" id="defaultContactFormEmail"
                                                        class="form-control " v-model="details.Tgl_PSP"
                                                        placeholder="Tgl PSP" name="Tgl_PSP">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <textarea class="form-control mb-5" row="5" name="Kondisi"
                                                placeholder="Kondisi..." v-model="details.Kondisi"></textarea>
                                        </div>
                                    </form>


                                    <v-btn color="primary" @click="e1 = 1">
                                        Back
                                    </v-btn>

                                </v-stepper-content>
                            </v-stepper-items>
                        </v-stepper>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" :disabled="isValid || isCompleted" class="btn btn-primary"
                        :value="modalid == 'mdlUpdate' ? 'Update Data' : 'Tambah Data'" :form="form" />
                </div>
            </div>
        </div>
    </div>
</template>



<script>
export default {
    props: {
        url: String,
        id: String,
        title: String,
        form: String,
        csrf: String,
        modalid: String,
    },
    computed: {
        isValid() {
            let pack = this.pack;
            console.log({pack: this.pack});
            return (pack.Kode_Ruangan == "") || (pack.Kode_Barang == "") || (pack.Kode_Satker == "" || pack.Kode_Ruangan == undefined) || (pack.Kode_Barang == undefined) || (pack.Kode_Satker == undefined) || (pack.NUP == undefined || pack.NUP == "");
        },
        isCompleted() {
            let d = Object.values(this.details);
            return d.some(x => x == '');
        }
        , _url() {
            return this.URL;
        }
    },
    mounted() {
        this.URL = this.$props.url;
        this.retrieveNama("");
        this.retrieveSatker("");
        this.retrieveLokasi("");
        if (this.id != "")
            this.retrieveDetails(this.id);
    },
    watch: {
        search(val, old) {
            this.retrieveLokasi(val);
        }
    },
    data() {
        return {
            isLoading: false,
            search: "",
            e1: 1,
            URL: "",
            pack: {
                Nama_Barang: "",
                Kode_Barang: "",
                Merk_Tipe: "",
                Kode_Satker: "",
                Nama_Satker: "",
                Lokasi: "",
                Kode_Ruangan: "",
                NUP: ""
            },
            details: {
                Kondisi: "",
                Tgl_Rekam_Pertama: new Date().toLocaleDateString('en-US'),
                Tgl_Perolehan: new Date().toLocaleDateString('en-US'),
                Nilai_Perolehan_Pertama: "",
                Nilai_Mutasi: "",
                Nilai_Perolehan: "",
                Nilai_Penyusutan: "",
                Nilai_Buku: "",
                Kuantitas: "",
                Jml_Foto: "",
                Status_Penggunaan: "",
                Status_Pengelolaan: "",
                No_PSP: "",
                Tgl_PSP: new Date().toLocaleDateString('en-US'),
                Jumlah_KIB: ""
            },
            master_barang: [],
            master_satker: [],
            list_lokasi: ["None"],
            lokasi_dict: []
        };
    },
    methods: {
        setUrl(url) {
            this.URL = url;
        },
        retrieveDetails(id) {
            console.log("RETRIEVE");
            axios.get("/aset/barang/detail/" + id).then((res) => {
                let d = res.data[0];
                this.pack = {
                    ...this.pack,
                    Kode_Barang: d.Kode_Barang,
                    Kode_Satker: d.Kode_Satker,
                    Kode_Ruangan: d.Kode_Ruangan,
                    NUP: d.NUP,
                    Nama_Barang: d.Nama_Barang,
                    Lokasi: d.Lokasi,
                    Merk_Tipe: d.Merk_Tipe,
                    Nama_Satker: d.Nama_Satker
                };
                this.details = {
                    ...this.details,
                    Kondisi: d.Kondisi,
                    Tgl_Rekam_Pertama: d.Tgl_Rekam_Pertama,
                    Tgl_Perolehan: d.Tgl_Perolehan,
                    Nilai_Perolehan_Pertama: d.Nilai_Perolehan_Pertama,
                    Nilai_Mutasi: d.Nilai_Mutasi,
                    Nilai_Perolehan: d.Nilai_Perolehan,
                    Nilai_Penyusutan: d.Nilai_Penyusutan,
                    Nilai_Buku: d.Nilai_Buku,
                    Kuantitas: d.Kuantitas,
                    Jml_Foto: d.jml_foto,
                    Status_Penggunaan: d.Status_Penggunaan,
                    Status_Pengelolaan: d.Status_Pengelolaan,
                    No_PSP: d.No_PSP,
                    Tgl_PSP: d.Tgl_PSP,
                    Jumlah_KIB: d.Jumlah_KIB

                };
                this.$forceUpdate();
            });
        },
        retrieveLokasi(lokasi) {
            this.isLoading = true;
            let url = "/lokasi/" + lokasi;
            axios.get(url).then(response => {
                this.list_lokasi = response.data.map(x => x.Lokasi);
                this.lokasi_dict = response.data;
                console.log({ a: this.list_lokasi, b: this.lokasi_dict });
                this.isLoading = false;
            });
        },
        retrieveNama(nama) {
            let url = '/aset/barang/' + nama;
            axios.get(url).then((response) => {
                console.log({ url: url, res: response.data });
                this.master_barang = response.data;
            });
        },
        retrieveSatker(sat) {
            console.log(sat);
            let url = '/satker/list/' + sat;
            axios.get(url).then((res) => {
                this.master_satker = res.data;
            });
        }
        ,
        selectBarang(e) {
            let sel = this.master_barang.filter(x => x.Nama_Barang == this.pack.Nama_Barang);
            if (sel.length < 1) {
                this.pack = {
                    ...this.pack,
                    Nama_Barang: "",
                    Kode_Barang: "",
                    Merk_Tipe: ""
                };
                this.retrieveNama("");
                return;
            }
            this.pack.Kode_Barang = sel[0].Kode_Barang;
            this.pack.Merk_Tipe = sel[0].Merk_Tipe;
            this.retrieveNama(this.pack.Nama_Barang);
        },
        selectSatker(e) {
            let sel = this.master_satker.filter(x => x.Nama_Satker == this.pack.Nama_Satker);
            if (sel.length < 1) {
                this.pack = {
                    ...this.pack,
                    Nama_Satker: "",
                    Kode_Satker: ""
                };
                this.retrieveSatker("");
                return;
            }
            this.pack.Kode_Satker = sel[0].Kode_Satker;
            this.retrieveSatker(this.pack.Nama_Satker);
        },
        selectLokasi(e) {
            console.log({ dict: this.lokasi_dict });
            let sel = this.lokasi_dict.filter(x => x.Lokasi == this.pack.Lokasi);
            this.pack.Kode_Ruangan = sel[0].Kode_Ruangan;
            //                    this.retrieveLokasi(sel[0].Lokasi);
        }
    }
}
</script>
