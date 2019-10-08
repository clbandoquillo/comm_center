<template>
    <div>

    <div>
        <div class="col-md-3">
            <button @click="createModal" class="btn btn-primary btn-block">Add New LDAP</button>
        </div><br>
        
        <b-table id="my-table" striped hover 
            :fields="ldap_fields" 
            :items="filtered"
            :per-page="perPage"
            :current-page="currentPage"
            :bordered=true
            responsive="sm"
            show-empty>

            <template slot="top-row" slot-scope="{ fields }" v-if="ldaps.length > 0">
                <td v-for="field in fields" :key="field.key">
                <input v-if="field.label != 'Actions'" v-model="filters[field.key]" :placeholder="field.label">
                </td>
            </template>
            
            <template v-slot:cell(actions)="row" v-if="ldaps.length > 0">
                <button @click="updateModal(row.index)" class="btn btn-info">Edit</button>
                <button @click="delete_ldap(row.index)" class="btn btn-danger">Delete</button>
            </template>
            
        </b-table>

        <b-pagination
        v-model="currentPage"
        :total-rows="rows"
        :per-page="perPage"
        aria-controls="my-table"
        ></b-pagination>
        <p class="mt-3">Current Page: {{ currentPage }}</p>

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
                            <option disabled value="" selected ></option>
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

                    <div class="form-group">
                        <label for="description">System Role</label>
                        <select v-model="new_update_ldap.system_role" name="system_role" id="system_role" class="form-control" tabindex="-1">
                            <option disabled value="" selected ></option>
                            <option v-for="(system_role, index) in system_roles" v-bind:value="system_role.id">{{system_role.role_name}}</option>
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="description">Account Status</label>
                        <select v-model="new_update_ldap.status" name="status" id="status" class="form-control" tabindex="-1">
                            <option disabled value="" selected ></option>
                            <option value="0">Inactive</option>
                            <option value="1">Active</option>
                        </select>
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
                    system_role: '',
                    status: '1',
                },

                ldaps: [],
                system_roles: [],
                url: 'http://127.0.0.1:8000/ldap_barcode/',
                url_system_roles: 'http://127.0.0.1:8000/ldap_roles/',
                errors: [],
                new_update_ldap: [],
                ldap_fields: [
                    {
                        key: 'ldap_username',
                        label: 'LDAP Username',
                        sortable: true
                    },
                    {
                        key: 'id_number',
                        label: 'ID Number',
                        sortable: true
                    },
                    {
                        key: 'actions',
                        label: 'Actions',
                        sortable: false
                    }
                ],
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
                ],
                filters: {
                    ldap_username: '',
                    id_number: ''
                },
                totalRows: 1,
                currentPage: 1,
                perPage: 5,
                pageOptions: [5, 10, 15]
            }
        },

        computed: {
            filtered(){
                const filtered = this.ldaps.filter(item =>{
                    return Object.keys(this.filters).every(key =>
                        String(item[key]).includes(this.filters[key]))
                })
                return filtered.length > 0 ? filtered : [{
                    ldap_username: '',
                    id_number: ''
                }]
            },

            rows() {
                return this.ldaps.length
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
                axios.post('http://127.0.0.1:8000/ldap_barcode', 
                {
                    ldap_username: this.ldap.ldap_username, 
                    id_number: this.ldap.id_number,
                    system_role: this.ldap.system_role,
                    status: this.ldap.status
                })

                .then(response=>{

                    this.ldaps.push(response.data.ldap);
                    $("#create-modal").modal("hide");
                    this.makeToast('success', this.ldap.ldap_username, this.ldap.id_number, 'added');
                    this.resetData();
                    
                })
            },

            update_ldap(){

                axios.patch(this.url + this.new_update_ldap.id,{

                    ldap_username: this.new_update_ldap.ldap_username,
                    id_number: this.new_update_ldap.id_number,
                    system_role: this.new_update_ldap.system_role,
                    status: this.new_update_ldap.status

                }).then(response=>{

                    $("#update-modal").modal("hide");
                    //toastr.success(response.data.message);
                    this.makeToast('success', this.new_update_ldap.ldap_username, this.new_update_ldap.id_number, 'updated');
                })

            },

            delete_ldap(index){
                let confirmBox = confirm("Do you really want to delete this?");
                if(confirmBox == true){
                    axios.delete(this.url + this.ldaps[index].id)
                        .then(response=>{
                            this.$delete(this.ldaps, index);
                            //toastr.success(response.data.message);
                            this.makeToast1('danger', response.data.message, 'deleted');
                        }).catch(error =>{
                            console.log("Could not delete for some reason")
                        });
                }

            },

            loadLDAP(){

                axios.get('http://127.0.0.1:8000/ldap_barcode/').then(response => {

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
            },

            makeToast(variant = null, username, barcode, processType) {
                this.$bvToast.toast("The LDAP Username: "+username+" Employee Barcode: "+barcode+".", {
                title: "LDAP successfully "+processType+".",
                variant: variant,
                autoHideDelay: 5000,
                solid: true
                })
            },

            makeToast1(variant = null, message, processType) {
                this.$bvToast.toast(message, {
                title: "LDAP successfully "+processType+".",
                variant: variant,
                autoHideDelay: 5000,
                solid: true
                })
            }
        },

        mounted() {
            this.loadLDAP();
            this.loadSystemRoles();
        }
    }
</script>

