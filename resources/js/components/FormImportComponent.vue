<template>
    <div class="modal fade" id="mdlImport" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <form id="frmImport" method="POST" :Action="url" enctype="multipart/form-data">
                            <input :value="csrf" type="hidden" name="_token"/>
                            <input class="form-control mb-2" name="Tahun" placeholder="Tahun.." type="number" :value="tahun" step="1"/>
                            <input class="form-control" placeholder="Upload File Here" name="import_file" type="file" />
                        </form>
                    </v-app>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <input type="submit"  class="btn btn-primary" :value=" 'Upload' " :form="'frmImport'" />
                </div>
            </div>
        </div>
    </div>
</template>
<script>
    export default {
        props:{
            title: String,
            url: String,
            csrf: String
        },
        computed:
        {
            tahun()
            {
                return new Date().getFullYear();
            }
        },
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
