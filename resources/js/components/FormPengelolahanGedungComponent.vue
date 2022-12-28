
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
                    <v-app app>
                        <v-stepper v-model="e1">
                            <v-stepper-header>
                                <v-stepper-step :complete="e1 > 1" step="1">Pilih Master Gedung</v-stepper-step>

                                <v-divider></v-divider>

                                <v-stepper-step step="2">Masukkan Data Detail Gedung Bagian 1</v-stepper-step>
                                <v-divider></v-divider>

                                <v-stepper-step step="3">Masukkan Data Detail Gedung Bagian 2</v-stepper-step>
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
                                                    <option v-for="satker in master_satker"> {{satker.Nama_Satker}}
                                                    </option>
                                                </datalist>
                                            </div>
                                            <div v-else>
                                                <input readonly type="text" class="form-control" value="Waiting for data">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <input type="text" id="defaultContactFormEmail" class="form-control "
                                                v-model="pack.Kode_Satker" name="Kode_Satker" placeholder="Kode Satker">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div v-if="master_gedung == []">
                                                <input readonly type="text" class="form-control" value="Waiting for data">
                                            </div>
                                            <div v-else>
                                                <input type="text" @change="selectGedung" v-model="pack.Nama_Gedung"
                                                    name="Nama_Gedung" class="form-control mb-4" placeholder="Nama Gedung"
                                                    list="list_gedung">
                                                <datalist id="list_gedung">
                                                    <option v-for="gedung in master_gedung ">{{ gedung.Nama_Gedung }}
                                                    </option>
                                                </datalist>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <input type="text" name="Kode_Gedung" v-model="pack.Kode_Gedung"
                                                id="defaultContactFormEmail" class="form-control mb-4"
                                                placeholder="Kode Gedung">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" id="defaultContactFormEmail" name="Merk_Tipe"
                                                v-model="pack.Merk_Tipe" class="form-control mb-4" placeholder="Merk/Tipe">
                                        </div>
                                        <div class="col">
                                            <input type="text" id="defaultContactFormEmail" class="form-control mb-4"
                                                v-model="pack.NUP" placeholder="NUP">
                                        </div>
                                    </div>
                                    <v-btn color="primary" @click="e1 = 2"
                                        :disabled="isValid">
                                        Next
                                    </v-btn>
                                </v-stepper-content>

                                <form :id="form" method="POST" :action="_url">
                                <v-stepper-content step="2">
                                        <input type="hidden" name="_token" :value="csrf">
                                        <input type="hidden" v-model="pack.Kode_Gedung" name="Kode_Gedung" />
                                        <input type="hidden" v-model="pack.Kode_Satker" name="Kode_Satker" />
                                        <input type="hidden" v-model="pack.NUP" name="NUP" />
                                        <div class="row">
                                            <div class="col">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Tgl Rekam Pertama</span>
                                                    </div>
                                                    <input type="date" id="defaultContactFormEmail" name="Tgl_Rekam_Pertama"
                                                    v-model="details.Tgl_Rekam_Pertama" class="form-control">
                                                </div>
                                            </div>
                                            <div class="col">

                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Tgl Perolehan</span>
                                                    </div>
                                                <input type="date" id="defaultContactFormEmail" class="form-control " name="Tgl_Perolehan"
                                                    v-model="details.Tgl_Perolehan" placeholder="Tgl Perolehan">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" id="defaultContactFormEmail" class="form-control mb-4"
                                                    v-model="details.Nilai_Perolehan_Pertama" name="Nilai_Perolehan_Pertama"
                                                    placeholder="Nilai Perolehan Pertama">
                                            </div>
                                            <div class="col">
                                                <input type="text" id="defaultContactFormEmail" class="form-control mb-4"
                                                    v-model="details.Nilai_Mutasi" placeholder="Nilai Mutasi" name="Nilai_Mutasi">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" id="defaultContactFormEmail" class="form-control mb-4" name="Nilai_Perolehan"
                                                    v-model="details.Nilai_Perolehan" placeholder="Nilai Perolehan">
                                            </div>
                                            <div class="col">
                                                <input type="text" id="defaultContactFormEmail" class="form-control mb-4"
                                                    v-model="details.Nilai_Penyusutan" placeholder="Nilai Penyusutan" name="Nilai_Penyusutan">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" id="defaultContactFormEmail" class="form-control mb-4"
                                                    v-model="details.Nilai_Buku" placeholder="Nilai Buku" name="Nilai_Buku">
                                            </div>
                                            <div class="col">
                                                <input type="text" id="defaultContactFormEmail" class="form-control mb-4"
                                                    v-model="details.Kuantitas" placeholder="KUANTITAS" name="Kuantitas">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" id="defaultContactFormEmail" class="form-control mb-4"
                                                    v-model="details.Jml_Foto" placeholder="Jml Foto" name="Jml_Foto">
                                            </div>
                                            <div class="col">
                                                <input type="text" id="defaultContactFormEmail" class="form-control mb-4"
                                                    v-model="details.Status_Penggunaan" placeholder="Status Penggunaan" name="Status_Penggunaan">
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" id="defaultContactFormEmail" class="form-control mb-4"
                                                    v-model="details.Status_Pengelolaan" placeholder="Status Pengelolaan" name="Status_Pengelolaan">
                                            </div>
                                            <div class="col">


                                                <input type="text" id="defaultContactFormEmail" class="form-control mb-4"
                                                    v-model="details.No_PSP" placeholder="NO PSP" name="No_PSP">
                                                </div>
                                        </div>
                                        <div class="row">
                                            <div class="col">
                                                <input type="text" id="defaultContactFormEmail" class="form-control mb-4"
                                                    v-model="details.Jumlah_KIB" placeholder="Jumlah KIB" name="Jumlah_KIB">
                                            </div>
                                            <div class="col">
                                                <div class="input-group">
                                                    <div class="input-group-prepend">
                                                        <span class="input-group-text">Tgl PSP</span>
                                                    </div>
                                                <input type="date" id="defaultContactFormEmail" class="form-control "
                                                    v-model="details.Tgl_PSP" placeholder="Tgl PSP" name="Tgl_PSP">
                                                </div>
                                            </div>
                                            <div class="col">
                                                <input type="text" class="form-control" name="SBSK" v-model="details.SBSK"
                                                placeholder="SBSK"/>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <textarea class="form-control mb-5" row="5" name="Kondisi" placeholder="Kondisi..."
                                                v-model="details.Kondisi"></textarea>
                                        </div>

                                    <div class="row">
                                        <div class="col">
                                            <v-btn color="primary" @click="e1 = 1">
                                                Back
                                                </v-btn>
                                        </div>
                                        <div class="col">
                                            <v-btn color="primary" @click="e1 = 3"
                                            >
                                            Next
                                            </v-btn>
                                        </div>
                                    </div>
                                </v-stepper-content>
                                <v-stepper-content step="3">
                                    <div class="row">
                                        <div class="col">
                                            <div class="input-group">
                                                <input type="text" id="defaultContactFormEmail" name="Dokumen"
                                                v-model="details.Dokumen" class="form-control" placeholder="Dokumen">
                                            </div>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" name="Kode_Pos" v-model="details.Kode_Pos"
                                            placeholder="Kode Pos"/>

                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" class="form-control" name="Jalan" v-model="details.Jalan"
                                            placeholder="Jalan"/>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" name="Jumlah_Lantai" v-model="details.Jumlah_Lantai"
                                            placeholder="Jumlah Lantai"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" class="form-control" name="Optimalisasi" v-model="details.Optimalisasi"
                                            placeholder="Optimalisasi"/>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" name="Status_SBSN" v-model="details.Status_SBSN"
                                            placeholder="Status_SBSN"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" class="form-control" name="Kode_Kab_Kota" v-model="details.Kode_Kab_Kota"
                                            placeholder="Kode Kabupaten Kota"/>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" name="Uraian_Kab_Kota" v-model="details.Uraian_Kab_Kota"
                                            placeholder="Nama Kabupaten Kota"/>
                                        </div>
                                    </div>>
                                    <div class="row">
                                        <div class="col">
                                            <input type="text" class="form-control" name="Kode_Provinsi" v-model="details.Kode_Provinsi"
                                            placeholder="Kode Provinsi"/>
                                        </div>
                                        <div class="col">
                                            <input type="text" class="form-control" name="Uraian_Provinsi" v-model="details.Uraian_Provinsi"
                                            placeholder="Nama Provinsi"/>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="input-group">
                                                <input type="number" id="defaultContactFormEmail" class="form-control " name="Luas_Bangunan"
                                                    v-model="details.Luas_Bangunan" placeholder="Luas Bangunan">
                                                </div>

                                                <div class="input-group-append">
                                                    <span class="input-group-text">m</span>
                                                </div>
                                        </div>

                                        <div class="col">
                                            <div class="input-group">
                                                <input type="number" id="defaultContactFormEmail" class="form-control " name="Luas_Dasar_Bangunan" v-model="details.Luas_Dasar_Bangunan" placeholder="Luas Dasar Bangunan">
                                                </div>

                                                <div class="input-group-append">
                                                    <span class="input-group-text">m</span>
                                                </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <v-btn color="primary" @click="e1 = 2">
                                            Back
                                        </v-btn>
                                    </div>
                                </v-stepper-content>
                                </form>
                            </v-stepper-items>
                        </v-stepper>
                    </v-app>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit" :disabled="isValid || isCompleted" class="btn btn-primary" :value=" modalid == 'mdlUpdate' ? 'Update Data' : 'Tambah Data' " :form="form" />
                </div>
            </div>
        </div>
    </div>
</template>



<script>
    export default{
            props:{
                url: String,
                id: String,
                urlDetailGedung: String,
                urlListSatker : String,
                urlMasterGedung:String,
                title: String,
                form:String,
                csrf: String,
                modalid: String,
            },
            computed:{
                isValid()
                {
                    let pack = this.pack;
                    return false;// (pack.Kode_Ruangan=="") || (pack.Kode_Gedung=="") || (pack.Kode_Satker=="" || pack.Kode_Ruangan==undefined) || (pack.Kode_Gedung==undefined) || (pack.Kode_Satker==undefined);
                },
                isCompleted()
                {
                    let d = Object.values(this.details);
                    return false;// d.some(x =>  x == '');
                }
                ,_url()
                {
                    return this.URL;
                }
            },
            mounted(){
                this.URL = this.$props.url;
                this.retrieveNama("");
                this.retrieveSatker("");
                ///this.retrieveLokasi("");
                if (this.id != "")
                    this.retrieveDetails(this.id);
            },
            data()
            {
                return {
                    e1 : 1,
                    URL: "",
                    pack : {
                        Nama_Gedung:"",
                        Kode_Gedung:"",
                        Merk_Tipe:"",
                        Kode_Satker:"",
                        Nama_Satker:"",
                        Kode_Ruangan:"",
                        NUP:""
                    },
                    details:{
                        Kondisi:"",
                        Tgl_Rekam_Pertama: new Date().toLocaleDateString('en-US'),
                        Tgl_Perolehan: new Date().toLocaleDateString('en-US'),
                        Nilai_Perolehan_Pertama:"",
                        Nilai_Mutasi:"",
                        Nilai_Perolehan:"",
                        Nilai_Penyusutan:"",
                        Nilai_Buku:"",
                        Kuantitas:"",
                        Jml_Foto:"",
                        Status_Penggunaan:"",
                        Status_Pengelolaan:"",
                        No_PSP:"",
                        Tgl_PSP:new Date().toLocaleDateString('en-US'),
                        Jumlah_KIB:"",
                        Dokumen:"",
                        Luas_Bangunan: 0,
                        Luas_Dasar_Bangunan: 0,
                        Jumlah_Lantai: 1,
                        Jalan: "",
                        Kode_Kab_Kota: "",
                        Uraian_Kab_Kota: "",
                        Kode_Provinsi: "",
                        Uraian_Provinsi : "",
                        Kode_Pos:"",
                        SBSK:"",
                        Optimalisasi:"",
                        Status_SBSN:""
                    },
                    master_gedung:[],
                    master_satker:[]
                };
            },
            methods:{
                setUrl(url)
                {
                    this.URL = url;
                },
                retrieveDetails(id)
                {
                    console.log("RETRIEVE");
                    axios.get(this.$props.urlDetailGedung + "/"+ id).then((res)=>{
                        let d = res.data[0];
                        this.pack = {...this.pack,
                            Kode_Gedung: d.Kode_Gedung,
                            Kode_Satker:d.Kode_Satker,
                            NUP: d.NUP,
                            Nama_Gedung: d.Nama_Gedung,
                            Merk_Tipe: d.Merk_Tipe,
                            Nama_Satker: d.Nama_Satker
                        };
                        this.details = { ...this.details,
                            Kondisi:d.Kondisi,
                            Tgl_Rekam_Pertama:d.Tgl_Rekam_Pertama,
                            Tgl_Perolehan:d.Tgl_Perolehan,
                            Nilai_Perolehan_Pertama:d.Nilai_Perolehan_Pertama,
                            Nilai_Mutasi:d.Nilai_Mutasi,
                            Nilai_Perolehan:d.Nilai_Perolehan,
                            Nilai_Penyusutan:d.Nilai_Penyusutan,
                            Nilai_Buku:d.Nilai_Buku,
                            Kuantitas:d.Kuantitas,
                            Jml_Foto:d.jml_foto,
                            Status_Penggunaan:d.Status_Penggunaan,
                            Status_Pengelolaan:d.Status_Pengelolaan,
                            No_PSP:d.No_PSP,
                            Tgl_PSP:d.Tgl_PSP,
                            Jumlah_KIB:d.Jumlah_KIB,
                            Dokumen: d.Dokumen,
                            Luas_Bangunan: d.Luas_Bangunan,
                            Luas_Dasar_Bangunan : d.Luas_Dasar_Bangunan,
                            Jumlah_Lantai : d.Jumlah_Lantai,
                            Jalan: d.Jalan,
                            Kode_Kab_Kota: d.Kode_Kab_Kota,
                            Uraian_Kab_Kota: d.Uraian_Kab_Kota,
                            Kode_Provinsi: d.Kode_Provinsi,
                            Uraian_Provinsi: d.Uraian_Provinsi,
                            Kode_Pos : d.Kode_Pos,
                            Optimalisasi: d.Optimalisasi,
                            SBSK: d.SBSK,
                            Status_SBSN: d.Status_SBSN
                        };

                        this.$forceUpdate();
                        console.log({pack:this.pack,details:this.details});
                    });
                },
                retrieveNama(nama){
                    console.log({nama:nama,data:this.$props.urlMasterGedung});
                    let url = this.$props.urlMasterGedung +"/" + nama;
                     axios.get(url).then((response)=>{
                        console.log({url:url,res:response.data});
                        this.master_gedung = response.data;
                     });
                },
                retrieveSatker(sat){
                    console.log(sat);
                    let url = this.$props.urlListSatker + '/' + sat;
                    axios.get(url).then((res)=>{
                        this.master_satker = res.data;
                    });
                }
                ,
                selectGedung(e){
                    console.log({mag:this.master_gedung});
                    let sel = this.master_gedung.filter(x=>x.Nama_Gedung==this.pack.Nama_Gedung);
                    if (sel.length < 1)
                    {
                        this.pack = { ...this.pack,
                            Nama_Gedung:"",
                            Kode_Gedung:"",
                            Merk_Tipe:""
                        };
                        this.retrieveNama("");
                        return;
                    }
                    this.pack.Kode_Gedung = sel[0].Kode_Gedung;
                    this.pack.Merk_Tipe = sel[0].Merk_Tipe;
                    this.retrieveNama(this.pack.Nama_Gedung);
                },
                selectSatker(e){
                    let sel = this.master_satker.filter(x=>x.Nama_Satker==this.pack.Nama_Satker);
                    if (sel.length < 1)
                    {
                        this.pack = { ...this.pack,
                            Nama_Satker:"",
                            Kode_Satker:""
                        };
                        this.retrieveSatker("");
                        return;
                    }
                    this.pack.Kode_Satker = sel[0].Kode_Satker;
                    this.retrieveSatker(this.pack.Nama_Satker);
                }
            }
        }
</script>
