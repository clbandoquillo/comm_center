<template>
    <div>

        <nav>

            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">

                <a class="nav-item nav-link active" id="employee-parking-tab" data-toggle="tab" href="#nav-employee-parking" role="tab" aria-controls="nav-employee-parking" aria-selected="true">CCFC Pricing</a>
                <a class="nav-item nav-link" id="student-parking-tab" data-toggle="tab" href="#nav-student-parking" role="tab" aria-controls="nav-employee-parking" aria-selected="false">CCFC Services</a>

            </div>
            
        </nav><br>

        <div class="tab-content" id='nav-tabContent'>
            
            <div class="tab-pane fade show active" id="nav-employee-parking" role="tabpanel" aria-labelledby="employee-parking-tab">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">CCFC Current List of Prices</div>
                                <div class="card-body">
                                    <button @click="employeeParkingModal" class="btn btn-primary btn-block">Add Price to CCFC Service</button>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Service Name</th>
                                                <th scope="col">Service Category</th>
                                                <th scope="col">Price</th>
                                                <th scope="col">Semester</th>
                                                <th scope="col">School Year</th>
                                            </tr>
                                        </thead>
                                            <tbody>
                                                <tr v-for="(pricing, index) in pricings">
                                                    <td>{{ pricing.service_name }}</td>
                                                    <td>{{ pricing.category_Name }}</td>
                                                    <td>{{ pricing.price }}</td>
                                                    <td>{{ pricing.semester }}</td>
                                                    <td>{{ pricing.schoolyear }}</td>
                                                    <td v-if="pricing.status == 1">Active</td>
                                                    <td v-if="pricing.status == 0">Inactive</td>
                                                    <td><button @click="updateModal(index)" class="btn btn-info">Edit</button><!--<button @click="deleteTask(index)" class="btn btn-danger">Delete</button>--></td>
                                                </tr>
                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="nav-student-parking" role="tabpanel" aria-labelledby="student-parking-tab">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">CCFC List of Services</div>
                                <div class="card-body">
                                    <!--<button class="btn btn-primary btn-block">Add New CCFC Service</button>-->
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">ID</th>
                                                <th scope="col">Service</th>
                                                <th scope="col">Status</th>
                                            </tr>
                                        </thead>
                                            <tbody>
                                                <tr v-for="(service, index) in services">
                                                    <td>{{ index + 1 }}</td>
                                                    <td>{{ service.category_Name }}</td>
                                                    <td v-if="service.status == 1">Active</td>
                                                    <td v-if="service.status == 0">Inactive</td>
                                                </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>        

        </div>
        

        
        <!-- Modal -->
        <div class="modal fade" id="pricing-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Add CCFC Pricing</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="service_name">Service Name</label>
                            <input v-model="pricing.service_name" type="text" id="service_name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="name">Service Category</label>
                            <select v-model="pricing.category_id" data-placeholder="Choose an Employee..." name="category_id" id="category_id" class="form-control" tabindex="-1">
                                <option disabled value="" selected="" ></option>
                                <option v-for="(service, index) in services" v-bind:value="service.id">{{service.category_Name}}</option>
                            </select>
                            <span> Selected: {{ pricing.category_id }}</span>
                        </div>

                        <div class="form-group">
                            <label for="price">Price</label>
                            <input v-model="pricing.price" type="text" id="price" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="schoolyear">School Year</label>
                            <input v-model="pricing.schoolyear" type="text" id="schoolyear" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="description">Semester</label>
                            <select v-model="pricing.semester" name="semester" id="semester" class="form-control" tabindex="-1">
                                <option value="" selected="" ></option>
                                <option value="1" selected="" >First Semester</option>
                                <option value="2" selected="" >Second Semester</option>
                                <option value="3" selected="" >Summer</option>
                            </select>
                        </div>
                        

                    <!--  <div class="form-group">
                            <label for="name">Name</label>
                            <input v-model="task.name" type="text" id="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input v-model="task.body" type="text" id="description" class="form-control">
                        </div>-->
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button @click="create_pricing" type="button" class="btn btn-primary">Register Parking</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Update Pricing Modal -->
        <div class="modal fade" id="update-pricing-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit CCFC Pricing</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="service_name">Service Name</label>
                            <input v-model="new_update_pricings.service_name" type="text" id="service_name" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="name">Service Category</label>
                            <select v-model="new_update_pricings.category_id" data-placeholder="Choose an Employee..." name="category_id" id="category_id" class="form-control" tabindex="-1">
                                <option disabled value="" selected="" ></option>
                                <option v-for="(service, index) in services" v-bind:value="service.id">{{service.category_Name}}</option>
                            </select>
                            <span> Selected: {{ new_update_pricings.category_id }}</span>
                        </div>

                        <div class="form-group">
                            <label for="price">Price</label>
                            <input v-model="new_update_pricings.price" type="text" id="price" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="schoolyear">School Year</label>
                            <input v-model="new_update_pricings.schoolyear" type="text" id="schoolyear" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="description">Semester</label>
                            <select v-model="new_update_pricings.semester" name="semester" id="semester" class="form-control" tabindex="-1">
                                <option value="" selected="" ></option>
                                <option value="1" selected="" >First Semester</option>
                                <option value="2" selected="" >Second Semester</option>
                                <option value="3" selected="" >Summer</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description">Status</label>
                            <select v-model="new_update_pricings.status" name="semester" id="semester" class="form-control" tabindex="-1">
                                <option value="" selected="" ></option>
                                <option value="1" selected="" >Active</option>
                                <option value="0" selected="" >Inactive</option>
                            </select>
                        </div>
                        

                    <!--  <div class="form-group">
                            <label for="name">Name</label>
                            <input v-model="task.name" type="text" id="name" class="form-control">
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input v-model="task.body" type="text" id="description" class="form-control">
                        </div>-->
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button @click="update_pricing" type="button" class="btn btn-primary">Save Changes</button>
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
                pricing:{
                    service_name: '',
                    category_id: '',
                    price: '',
                    schoolyear: '',
                    semester: '',
                    status: '',
                    default_status: '1',
                },

                pricings: [],
                services: [],
                new_update_pricings: [],
                url: 'https://ccfcis.addu.edu.ph/ccfc_pricing/',
                url_services: 'https://ccfcis.addu.edu.ph/ccfc_services/'
            }
        },

        methods: {

            employeeParkingModal(){
                $("#pricing-modal").modal("show");
            },

            create_pricing(){

                axios.post('https://ccfcis.addu.edu.ph/ccfc_pricing', 
                {
                    service_name: this.pricing.service_name,
                    category_id: this.pricing.category_id,
                    price: this.pricing.price,
                    schoolyear: this.pricing.schoolyear,
                    semester: this.pricing.semester,
                    status: this.pricing.default_status
                })

                .then(response=>{

                    this.resetData();
                    this.pricings.push(response.data.pricing);
                    this.load_pricing();
                    $("#pricing-modal").modal("hide");
                })
            },

            updateModal(index){
                $("#update-pricing-modal").modal("show");
                this.new_update_pricings = this.pricings[index];
            },

            update_pricing(){

                axios.patch(this.url + this.new_update_pricings.id,{

                    service_name: this.new_update_pricings.service_name,
                    category_id: this.new_update_pricings.category_id,
                    price: this.new_update_pricings.price,
                    schoolyear: this.new_update_pricings.schoolyear,
                    semester: this.new_update_pricings.semester,
                    status: this.new_update_pricings.status
                }).then(response=>{

                    $("#update-modal").modal("hide");
                    toastr.success(response.data.message = this.new_update_pricings.status);
                   // this.makeToast('success', this.new_update_ldap.ldap_username, this.new_update_ldap.id_number, 'updated');
                })
            },

            load_pricing(){
                
                axios.get(this.url).then(response=>{

                    this.pricings = response.data.pricings;
                });
            },

            load_services(){
                
                axios.get(this.url_services).then(response=>{

                    this.services = response.data.services;
                });
            },

            resetData(){
                this.pricing.employee_names = '';
                this.pricing.id_number = '';
                this.pricing.contact_number = '';
                this.pricing.school_dept_office = '';
                this.pricing.license_number = '';
                this.pricing.license_expiry_date = '';
                this.pricing.schoolyear = '';
                this.pricing.semester = '';
                this.pricing.parking_type = '';
                this.pricing.or_number = '';
                this.pricing.sticker_number = '';
                this.pricing.date_issued = '';
                
            }
        },
        mounted() {
            this.load_pricing();
            this.load_services();
        }
    }
</script>
