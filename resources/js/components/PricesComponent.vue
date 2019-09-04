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
                                                    <td>{{ pricing.price }}</td>
                                                    <td>{{ pricing.schoolyear }}</td>
                                                    <td>{{ pricing.semester }}</td>
                                                    <td>{{ pricing.category_Name }}</td>
                                                    <td v-if="pricing.status == 1">Active</td>
                                                    <td v-if="pricing.status == 0">Inactive</td>
                                                    <td><button @click="updateModal(index)" class="btn btn-info">Edit</button><button @click="deleteTask(index)" class="btn btn-danger">Delete</button></td>
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
                                <div class="card-header">Students Parking</div>
                                <div class="card-body">
                                    <button class="btn btn-primary btn-block">Register Student</button>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">School Year</th>
                                                <th scope="col">Semester</th>
                                                <th scope="col">Contact Number</th>
                                                <th scope="col">School/Dept/Office</th>
                                                <th scope="col">License Number</th>
                                                <th scope="col">License Expiry Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td>BANDOQUILLO, CHRISTIAN LACSINTO</td>
                                                <td>2019</td>
                                                <td>1st Semester</td>
                                                <td>09491106932</td>
                                                <td>MIS Office</td>
                                                <td>MD1234567890</td>
                                                <td>01-03-2023</td>
                                                <td><button @click="updateModal(index)" class="btn btn-info">Edit</button></td>
                                                <td><button @click="deleteTask(index)" class="btn btn-danger">Delete</button></td>
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
        <div class="modal fade" id="employee-parking-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Employees Parking Registration</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="description">Service Name</label>
                            <input v-model="pricing.school_dept_office" type="text" id="school_dept_office" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="name">Service Category</label>
                            <select v-model="pricing.id_number" data-placeholder="Choose an Employee..." name="employee_names" id="employee_names" class="form-control" tabindex="-1">
                                <option disabled value="" selected="" ></option>
                                <option v-for="(employee_name, index) in employee_names" v-bind:value="employee_name.id_no">{{employee_name.cLast}}, {{employee_name.cFirst}} {{employee_name.middle}}</option>
                            </select>
                            <span> Selected: {{ pricing.id_number}}</span>
                        </div>

                        <div class="form-group">
                            <label for="description">Price</label>
                            <input v-model="pricing.school_dept_office" type="text" id="school_dept_office" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="description">School Year</label>
                            <input v-model="pricing.school_dept_office" type="text" id="school_dept_office" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="description">Semester</label>
                            <input v-model="pricing.school_dept_office" type="text" id="school_dept_office" class="form-control">
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
        
    </div>

    
</template>

<script>
    
    export default {

        data(){

            return{
                pricing:{
                    service_name: '',
                    price: '',
                    schoolyear: '',
                    semester: '',
                    category_Name: '',
                    status: '',
                },

                pricings: [],
                employee_names: [],
                url: 'http://127.0.0.1:8000/ccfc_pricing',
                url_emp_list: 'http://127.0.0.1:8000/employee_names'
            }
        },

        methods: {

            employeeParkingModal(){
                $("#employee-parking-modal").modal("show");
            },

            create_pricing(){

                axios.post(this.url, 
                {
                    service_name: this.pricing.id_number,
                    price: this.pricing.contact_number,
                    schoolyear: this.pricing.school_dept_office,
                    semester: this.pricing.license_number,
                    category_Name: this.pricing.license_expiry_date,
                    status: this.pricing.schoolyear
                })

                .then(response=>{

                    this.resetData();
                    this.pricings.push(response.data.pricing);
                    $("#employee-parking-modal").modal("hide");
                })
            },

            load_pricing(){
                
                axios.get(this.url).then(response=>{

                    this.pricings = response.data.pricings;
                });
            },

            load_employee_names(){
                
                axios.get(this.url_emp_list).then(response=>{

                    this.employee_names = response.data.employee_names;
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
            this.load_employee_names();
        }
    }
</script>
