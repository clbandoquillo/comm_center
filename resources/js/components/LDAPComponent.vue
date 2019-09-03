<template>
    <div>

    <div>
        <button @click="createModal" class="btn btn-primary btn-block">Add New LDAP</button>
        <table id="example" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th scope="col">id</th>
                    <th scope="col">ADDUNET Username</th>
                    <th scope="col">Barcode</th>
                </tr>
            </thead>
            <tbody>
                <tr v-for="(ldap, index) in ldaps">
                    <td>{{ index + 1}}</td>
                    <td>{{ ldap.ldap_username }}</td>
                    <td>{{ ldap.id_number }}</td>
                    <td><button @click="updateModal(index)" class="btn btn-info">Edit</button></td>
                    <td><button @click="delete_ldap(index)" class="btn btn-danger">Delete</button></td>
                </tr>
            </tbody>
        </table>

        <!-- Modal -->
        <div class="modal fade" id="create-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Create Modal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">ADDUNET Username</label>
                        <input v-model="ldap.ldap_username" type="text" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Barcode</label>
                        <input v-model="ldap.id_number" type="text" id="description" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button @click="create_ldap" type="button" class="btn btn-primary">Save changes</button>
                </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="update-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Update Modal</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="name">ADDUNET Username</label>
                        <input v-model="new_update_ldap.ldap_username" type="text" id="name" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="description">Barcode</label>
                        <input v-model="new_update_ldap.id_number" type="text" id="description" class="form-control">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button @click="update_ldap" type="button" class="btn btn-primary">Save changes</button>
                </div>
                </div>
            </div>
        </div>
    </div>

    </div>
</template>

<script>
    export default {

        data(){
            return{
                ldap:{
                    ldap_username: '',
                    id_number: ''
                },

                ldaps: [],
                url: 'http://127.0.0.1:8000/ldap_barcode/',
                errors: [],
                new_update_ldap: []
            }
        },

        methods:{

            createModal(){
                $("#create-modal").modal("show");
            },

            updateModal(index){
                $("#update-modal").modal("show");
                this.new_update_ldap = this.ldaps[index];
            },

            create_ldap(){

                axios.post(this.url, {ldap_username: this.ldap.ldap_username, id_number: this.ldap.id_number})

                .then(response=>{

                    this.resetData();
                    this.ldaps.push(response.data.ldap);
                    $("#create-modal").modal("hide");
                    toastr.success(response.data.message);
                })
            },

            update_ldap(){

                axios.patch(this.url + this.new_update_ldap.id,{

                    ldap_username: this.new_update_ldap.ldap_username,
                    id_number: this.new_update_ldap.id_number,

                }).then(response=>{

                    $("#update-modal").modal("hide");
                    toastr.success(response.data.message);
                })

            },

            delete_ldap(index){

                let confirmBox = confirm("Do you really want to delete this?");
                if(confirmBox == true){
                    axios.delete(this.url + this.ldaps[index].id)
                        .then(response=>{
                            this.$delete(this.ldaps, index);
                            toastr.success(response.data.message);
                        }).catch(error =>{
                            console.log("Could not delete for some reason")
                        });
                }

            },

            loadLDAP(){

                axios.get(this.url).then(response => {

                    this.ldaps = response.data.ldaps;
                });
            },

            resetData(){
                this.ldap.ldap_username = '';
                this.ldap.id_number = '';
            }
        },

        mounted() {
            this.loadLDAP();
        }
    }
</script>

