<template>
    <div>

    <div>
        <div class="col-md-3">
            <button @click="createModal" class="btn btn-primary btn-block">Add New LDAP</button>
        </div><br>

        <vue-good-table
            :columns="ldap_columns"
            :rows="ldaps"
            :search-options="{
                enabled: true,
                trigger: 'enter',
                skipDiacritics: true,
                searchFn: mySearchFn,
                placeholder: 'Search LDAP',
                externalQuery: searchQuery
                }">
                                        
            <template slot="table-row" slot-scope="props">
                <span v-if="props.column.field == 'actions'">
                    <button @click="updateModal(props.index)" class="btn btn-info">Edit</button>
                    <button @click="delete_ldap(props.index)" class="btn btn-danger">Delete</button>
                </span>
            </template> 
            
        </vue-good-table>

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

                    <div class="form-group">
                        <label for="description">System Role</label>
                        <select v-model="ldap.system_role" name="system_role" id="system_role" class="form-control" tabindex="-1">
                            <option disabled value="" selected="" ></option>
                            <option v-for="(system_role, index) in system_roles" v-bind:value="system_role.id">{{system_role.role_name}}</option>
                        </select>
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
                    id_number: '',
                    system_role: ''
                },

                ldaps: [],
                system_roles: [],
                url: 'http://127.0.0.1:8000/ldap_barcode/',
                url_system_roles: 'http://127.0.0.1:8000/ldap_roles/',
                errors: [],
                new_update_ldap: [],
                ldap_columns: [
                    {
                        label: 'LDAP Username',
                        field: 'ldap_username'
                    },
                    {
                        label: 'ID Number',
                        field: 'id_number'
                    },
                    {
                        label: 'Actions',
                        field: 'actions'
                    },
                ]
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

                axios.post(this.url, 
                {
                    ldap_username: this.ldap.ldap_username, 
                    id_number: this.ldap.id_number,
                    system_role: this.ldap.system_role
                })

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

            loadSystemRoles(){

                axios.get(this.url_system_roles).then(response => {

                    this.system_roles = response.data.system_roles;
                });
            },

            resetData(){
                this.ldap.ldap_username = '';
                this.ldap.id_number = '';
            }
        },

        mounted() {
            this.loadLDAP();
            this.loadSystemRoles();
        }
    }
</script>

