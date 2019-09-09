<template>
    <div>

        <nav>

            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">

                <a class="nav-item nav-link active" id="employee-parking-tab" data-toggle="tab" href="#nav-employee-parking" role="tab" aria-controls="nav-employee-parking" aria-selected="true">Employees Parking</a>
                <a class="nav-item nav-link" id="student-parking-tab" data-toggle="tab" href="#nav-student-parking" role="tab" aria-controls="nav-employee-parking" aria-selected="false">Students Parking</a>
                <a class="nav-item nav-link" id="vehicles-master-tab" data-toggle="tab" href="#nav-vehicles-master" role="tab" aria-controls="nav-vehicles-master" aria-selected="false">Vehicles</a>

            </div>
            
        </nav><br>

        <div class="tab-content" id='nav-tabContent'>
            
            <div class="tab-pane fade show active" id="nav-employee-parking" role="tabpanel" aria-labelledby="employee-parking-tab">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">Register Parking for Employees and University Vehicles</div>
                                <div class="card-body">
                                    <button @click="employeeParkingModal" class="btn btn-primary btn-block">Register Parking for Employees and University Vehicles</button>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">Name</th>
                                                <th scope="col">Contact Number</th>
                                                <th scope="col">School/Dept/Office</th>
                                                <th scope="col">License Number</th>
                                                <th scope="col">License Expiry Date</th>
                                                <th scope="col">School Year</th>
                                                <th scope="col">Semester</th>
                                                <th scope="col">Parking Type</th>
                                                <th scope="col">Sticker Number</th>
                                                <th scope="col">Date Issued</th>
                                            </tr>
                                        </thead>
                                            <tbody>
                                                <tr v-for="(employee_parking, index) in employee_parkings">
                                                    <td>{{ employee_parking.id_number }}</td>
                                                    <td>{{ employee_parking.contact_number }}</td>
                                                    <td>{{ employee_parking.school_dept_office }}</td>
                                                    <td>{{ employee_parking.license_number }}</td>
                                                    <td>{{ employee_parking.license_expiry_date }}</td>
                                                    <td>{{ employee_parking.schoolyear }}</td>
                                                    <td>{{ employee_parking.semester }}</td>
                                                    <td>{{ employee_parking.parking_type }}</td>
                                                    <td>{{ employee_parking.sticker_number }}</td>
                                                    <td>{{ employee_parking.date_issued }}</td>
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
            
            <div class="tab-pane fade" id="nav-vehicles-master" role="tabpanel" aria-labelledby="vehicles-master-tab">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">Vehicles</div>
                                <div class="card-body">
                                    <button @click="vehicleModal" class="btn btn-primary btn-block">Add Vehicle</button>
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th scope="col">AdDU Employee</th>
                                                <th scope="col">Owner's Name Registered to LTO</th>
                                                <th scope="col">Relation to Owner</th>
                                                <th scope="col">Make</th>
                                                <th scope="col">Model</th>
                                                <th scope="col">Plate Number</th>
                                                <th scope="col">Color</th>
                                                <th scope="col">Vehicle Registration Expiry Date</th>
                                                <th scope="col">LTO Official Receipt</th>
                                                <th scope="col">LTO Certificate of Registration</th>
                                                <th scope="col"></th>
                                                <th scope="col"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(vehicle, index) in vehicles">
                                                <td>{{ vehicle.id_number }}</td>
                                                <td>{{ vehicle.owner_name_lto }}</td>
                                                <td>{{ vehicle.relation_to_owner }}</td>
                                                <td>{{ vehicle.make }}</td>
                                                <td>{{ vehicle.model }}</td>
                                                <td>{{ vehicle.plate_number }}</td>
                                                <td>{{ vehicle.color }}</td>
                                                <td>{{ vehicle.reg_expiry_date }}</td>
                                                <td>{{ vehicle.lto_cr }}</td>
                                                <td>{{ vehicle.lto_or }}</td>
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
                            <label for="name">Employee Name</label>
                            <select v-model="employee_parking.id_number" data-placeholder="Choose an Employee..." name="employee_names" id="employee_names" class="form-control" tabindex="-1">
                                <option disabled value="" selected="" ></option>
                                <option v-for="(employee_name, index) in employee_names" v-bind:value="employee_name.id_no">{{employee_name.cLast}}, {{employee_name.cFirst}} {{employee_name.middle}}</option>
                            </select>
                            <span> Selected: {{ employee_parking.id_number}}</span>
                        </div>

                        <div class="form-group">
                            <label for="description">School / Dept / Office</label>
                            <input v-model="employee_parking.school_dept_office" type="text" id="school_dept_office" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="description">Contact Number</label>
                            <input v-model="employee_parking.contact_number" type="text" id="contact_number" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="description">License Number</label>
                            <input v-model="employee_parking.license_number" type="text" id="license_number" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="description">License Expiry Date</label>
                            <input v-model="employee_parking.license_expiry_date" type="date" id="licence_expiry_date" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="description">School Year</label>
                            <input v-model="employee_parking.schoolyear" type="text" id="schoolyear" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="description">Semester</label>
                            <select v-model="employee_parking.semester" name="semester" id="semester" class="form-control" tabindex="-1">
                                <option value="" selected="" ></option>
                                <option value="1" selected="" >First Semester</option>
                                <option value="2" selected="" >Second Semester</option>
                                <option value="3" selected="" >Summer</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description">Parking Type</label>
                            <select v-model="employee_parking.parking_type" name="parking_type" id="parking_type" class="form-control" tabindex="-1">
                                <option disabled value="" selected="" ></option>
                                <option v-for="(pricing, index) in pricings" v-bind:value="pricing.id">{{pricing.service_name}} - {{pricing.price}} - {{pricing.schoolyear}} - {{ pricing.semester}}</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="description">OR Number</label>
                            <input v-model="employee_parking.or_number" type="text" id="or_number" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="description">Sticker Number</label>
                            <input v-model="employee_parking.sticker_number" type="text" id="sticker_number" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="description">Date Issued</label>
                            <input v-model="employee_parking.date_issued" type="date" id="date_issued" class="form-control">
                        </div>

                        <div class="form-group">
                            <label><b>Supporting Documents</b></label>
                        </div>

                        <div class="form-group form-check-inline">
                            <input class="form-check-input" type="checkbox" value="" id="lto_">
                            <label class="form-check-label" for="defaultCheck1">
                                LTO-issued Driver's License
                            </label>
                        </div>

                        <div class="form-group form-check-inline">
                            <input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
                            <label class="form-check-label" for="defaultCheck1">
                                Certificate of Employment from HR
                            </label>
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
                        <button @click="create_employee_parking" type="button" class="btn btn-primary">Register Parking</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="vehicle-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Vehicle Registration</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="name">Employee Name</label>
                            <select v-model="vehicle.id_number" data-placeholder="Choose an Employee..." name="employee_names" id="employee_names" class="form-control" tabindex="-1">
                                <option disabled value="" selected="" ></option>
                                <option v-for="(employee_name, index) in employee_names" v-bind:value="employee_name.id_no">{{employee_name.cLast}}, {{employee_name.cFirst}} {{employee_name.middle}}</option>
                            </select>
                            <span> Selected: {{ vehicle.id_number}}</span>
                        </div>

                        <div class="form-group">
                            <label for="description">Owner's Name registered to LTO</label>
                            <input v-model="vehicle.owner_name_lto" type="text" id="school_dept_office" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="description">Relation to the Owner</label>
                            <input v-model="vehicle.relation_to_owner" type="text" id="contact_number" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="description">Make</label>
                            <select v-model="vehicle.make" data-placeholder="Choose an Employee..." name="employee_names" id="employee_names" class="form-control" tabindex="-1">
                                <option disabled value="" selected="" ></option>
                                <option v-for="(vehicle_makes, index) in vehicle_make" v-bind:value="vehicle_makes.make">{{vehicle_makes.make}}</option>
                            </select><!--
                            <select v-model="vehicle.make" data-placeholder="Choose an Employee..." name="make" id="make" class="form-control" tabindex="-1">
                                <option disabled value="" selected="" ></option>
                                <option v-for="(vehicle_make, index) in vehicle_makes" v-bind:value="vehicle_make.make">{{vehicle_make.make}}</option>-->
                        </div>

                        <div class="form-group">
                            <label for="description">Model</label>
                            <input v-model="vehicle.model" type="text" id="license_number" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="description">Plate Number</label>
                            <input v-model="vehicle.plate_number" type="text" id="licence_expiry_date" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="description">Color</label>
                            <input v-model="vehicle.color" type="text" id="schoolyear" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="description">Registration Expiry Date</label>
                            <input v-model="vehicle.reg_expiry_date" type="date" id="license_expiry_date" class="form-control">
                        </div>

                        <div class="form-group">
                            <label><b>Supporting Documents</b></label>
                        </div>

                        <div class="form-group form-check-inline">
                            <input v-model="vehicle.lto_cr" class="form-check-input" type="checkbox" value="" id="lto_cr">
                            <label class="form-check-label" for="lto_cr">
                                LTO Certificate of Registration
                            </label>
                        </div>

                        <div class="form-group form-check-inline">
                            <input v-model="vehicle.lto_or" class="form-check-input" type="checkbox" value="" id="lto_or">
                            <label class="form-check-label" for="lto_or">
                                LTO Official Receipt
                            </label>
                        </div>
                </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button @click="create_vehicle" type="button" class="btn btn-primary">Register Parking</button>
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
                employee_parking:{
                    id_number: '',
                    contact_number: '',
                    school_dept_office: '',
                    license_number: '',
                    license_expiry_date: '',
                    schoolyear: '',
                    semester: '',
                    parking_type: '',
                    or_number: '',
                    sticker_number: '',
                    date_issued: ''
                },

                vehicle:{
                    id_number: '',
                    owner_name_lto: '',
                    relation_to_owner: '',
                    make: '',
                    model: '',
                    plate_number: '',
                    color: '',
                    reg_expiry_date: '',
                    lto_cr: '',
                    lto_or: ''
                },

                vehicle_make:{
                    make: ''
                },

                employee_parkings: [],
                employee_names: [],
                pricings: [],
                vehicles: [],
                vehicle_make: [],
                url: 'http://127.0.0.1:8000/employee_parking/',
                url_emp_list: 'http://127.0.0.1:8000/employee_names/',
                url_pricing: 'http://127.0.0.1:8000/ccfc_pricing_1/',
                url_vehicle: 'http://127.0.0.1:8000/ccfc_vehicles/',
                url_vehicle_process: 'http://127.0.0.1:8000/ccfc_vehicles_process/',
                url_vehicle_make: 'http://127.0.0.1:8000/ccfc_vehicle_make/'
            }
        },

        methods: {

            employeeParkingModal(){
                $("#employee-parking-modal").modal("show");
            },

            vehicleModal(){
                $("#vehicle-modal").modal("show");
            },

            create_employee_parking(){

                axios.post(this.url, 
                {
                    id_number: this.employee_parking.id_number,
                    contact_number: this.employee_parking.contact_number,
                    school_dept_office: this.employee_parking.school_dept_office,
                    license_number: this.employee_parking.license_number,
                    license_expiry_date: this.employee_parking.license_expiry_date,
                    schoolyear: this.employee_parking.schoolyear,
                    semester: this.employee_parking.semester,
                    parking_type: this.employee_parking.parking_type,
                    or_number: this.employee_parking.or_number,
                    sticker_number: this.employee_parking.sticker_number,
                    date_issued: this.employee_parking.date_issued
                })

                .then(response=>{

                    this.resetData();
                    this.employee_parkings.push(response.data.employee_parking);
                    $("#employee-parking-modal").modal("hide");
                })
            },
            
            create_vehicle(){

                axios.post(this.url_vehicle_process, 
                {
                    id_number: this.vehicle.id_number,
                    owner_name_lto: this.vehicle.owner_name_lto,
                    relation_to_owner: this.vehicle.relation_to_owner,
                    make: this.vehicle.make,
                    model: this.vehicle.model,
                    plate_number: this.vehicle.plate_number,
                    color: this.vehicle.color,
                    reg_expiry_date: this.vehicle.reg_expiry_date,
                    lto_cr: this.vehicle.lto_cr,
                    lto_or: this.vehicle.lto_or,
                })

                .then(response=>{

                    this.resetData();
                    this.vehicles.push(response.data.vehicle);
                    $("#vehicle-modal").modal("hide");
                })

                
            },

            load_vehicle(){

                axios.get(this.url_vehicle).then(response=>{

                    this.vehicles = response.data.vehicles;
                });
            },

            load_employee_parking(){
                
                axios.get(this.url).then(response=>{

                    this.employee_parkings = response.data.employee_parkings;
                });
            },

            load_employee_names(){
                
                axios.get(this.url_emp_list).then(response=>{

                    this.employee_names = response.data.employee_names;
                });

            },

            load_pricing(){
                
                axios.get(this.url_pricing).then(response=>{

                    this.pricings = response.data.pricings;
                });

            },

            load_vehicle_make(){
                
                axios.get(this.url_vehicle_make).then(response=>{

                    this.vehicle_make = response.data.vehicle_make;
                });

            },

            resetData(){
                this.employee_parking.employee_names = '';
                this.employee_parking.id_number = '';
                this.employee_parking.contact_number = '';
                this.employee_parking.school_dept_office = '';
                this.employee_parking.license_number = '';
                this.employee_parking.license_expiry_date = '';
                this.employee_parking.schoolyear = '';
                this.employee_parking.semester = '';
                this.employee_parking.parking_type = '';
                this.employee_parking.or_number = '';
                this.employee_parking.sticker_number = '';
                this.employee_parking.date_issued = '';
                
            }
        },
        mounted() {
            this.load_employee_parking();
            this.load_employee_names();
            this.load_pricing();
            this.load_vehicle();
            this.load_vehicle_make();
        }
    }
</script>
