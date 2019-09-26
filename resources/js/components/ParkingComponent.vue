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
                                    
                                    <vue-good-table
                                        :columns="columns"
                                        :rows="employee_parkings"
                                        :search-options="{
                                        enabled: true,
                                        trigger: 'enter',
                                        skipDiacritics: true,
                                        placeholder: 'Search this table'
                                    }"> 
                                        <template slot="table-row" slot-scope="props">
                                            <span v-if="props.column.field == 'actions'"><button @click="updateModal(index)" class="btn btn-info">Edit</button><button @click="deleteTask(index)" class="btn btn-danger">Delete</button>
                                            </span>
                                            <span v-else>
                                            {{props.formattedRow[props.column.field]}}
                                            </span>
                                        </template> 
                                    </vue-good-table>

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
                                    <button @click="studentParkingModal" class="btn btn-primary btn-block">Register Student</button>
                                    
                                    <vue-good-table
                                        :columns="columns_stud_parking"
                                        :rows="student_parkings"
                                        :search-options="{
                                        enabled: true,
                                        trigger: 'enter',
                                        skipDiacritics: true,
                                        placeholder: 'Search this table'
                                    }"> 
                                        <template slot="table-row" slot-scope="props">
                                            <span v-if="props.column.field == 'actions'"><button @click="updateModal(index)" class="btn btn-info">Edit</button><button @click="deleteTask(index)" class="btn btn-danger">Delete</button>
                                            </span>
                                            <span v-else>
                                            {{props.formattedRow[props.column.field]}}
                                            </span>
                                        </template> 
                                    </vue-good-table>

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
                                    <br>
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="employees-tab" data-toggle="tab" href="#employees" role="tab" aria-controls="employees" aria-selected="true">Employees</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="students-tab" data-toggle="tab" href="#students" role="tab" aria-controls="students" aria-selected="false">Students</a>
                                        </li>
                                    </ul>

                                    <div class="tab-content" id="myTabContent">
                                        
                                        <div class="tab-pane fade show active" id="employees" role="tabpanel" aria-labelledby="employees-tab">
                                    
                                            <vue-good-table 
                                                :columns="columns_emp_vehicle"
                                                :rows="vehicles"
                                                :search-options="{
                                                enabled: true,
                                                trigger: 'enter',
                                                skipDiacritics: true,
                                                placeholder: 'Search this table'
                                            }"> 
                                                <template slot="table-row" slot-scope="props">
                                                    <span v-if="props.column.field == 'actions'"><button @click="updateModal(index)" class="btn btn-info">Edit</button><button @click="deleteTask(index)" class="btn btn-danger">Delete</button>
                                                    </span>
                                                    <span v-else>
                                                    {{props.formattedRow[props.column.field]}}
                                                    </span>
                                                </template> 

                                            </vue-good-table>

                                        </div>

                                        <div class="tab-pane fade" id="students" role="tabpanel" aria-labelledby="students-tab">

                                        </div>

                                    </div>
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
                            <v-select v-model="employee_parking.id_number" label="emp_name" :options="employee_names" :reduce="employee_names => employee_names.id_no"></v-select>
                            
                            <span> Selected: {{ employee_parking.id_number}}</span>
                        </div>

                        <!--<div class="form-group">
                            <label for="name">Employee Name</label>
                            <select v-model="employee_parking.id_number" data-placeholder="Choose an Employee..." name="employee_names" id="employee_names" class="form-control" tabindex="-1">
                                <option disabled value="" selected="" ></option>
                                <option v-for="(employee_name, index) in employee_names" v-bind:value="employee_name.id_no">{{employee_name.cLast}}, {{employee_name.cFirst}} {{employee_name.middle}}</option>
                            </select>
                            <span> Selected: {{ employee_parking.id_number}}</span>
                        </div>-->

                        <div class="form-group">
                            <label for="name">Vehicle</label>
                            <select v-model="employee_parking.plate_number" data-placeholder="Choose an Employee..." name="employee_names" id="employee_names" class="form-control" tabindex="-1">
                                <option v-for="(vehicle, index) in vehicles"  v-bind:value="vehicle.plate_number" v-if="vehicle.emp_id == employee_parking.id_number"><b>{{vehicle.plate_number}}: {{vehicle.make}} {{vehicle.model}}</b></option>
                            </select>
                            <span> Selected: {{ employee_parking.plate_number }}</span>
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
                            <br>
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
        <!-- Student Modal -->
        <div class="modal fade" id="student-parking-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Student Parking Registration</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="form-group">
                            <label for="name">Student Name</label>
                            <v-select v-model="student_parking.id_number" label="label" :options="student_names" :reduce="student_names => student_names.studentcode"></v-select>
                            
                            <span> Selected: {{ student_parking.id_number }}</span>
                        </div>

                        <div class="form-group">
                            <label for="name">Vehicle</label>
                            <select v-model="student_parking.plate_number" data-placeholder="Choose an Employee..." name="employee_names" id="employee_names" class="form-control" tabindex="-1">
                                <option selected v-for="(vehicle, index) in vehicles"  v-bind:value="vehicle.plate_number" v-if="vehicle.stud_id == student_parking.id_number"><b>{{vehicle.plate_number}}: {{vehicle.make}} {{vehicle.model}}</b></option>
                            </select>
                            <span> Selected: {{ student_parking.plate_number }}</span>
                        </div>

                        <div class="form-group">
                            <label for="description">Contact Number</label>
                            <input v-model="student_parking.contact_number" type="text" id="contact_number" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="description">License Number</label>
                            <input v-model="student_parking.license_number" type="text" id="license_number" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="description">License Expiry Date</label>
                            <input v-model="student_parking.license_expiry_date" type="date" id="licence_expiry_date" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="description">School Year</label>
                            <input v-model="student_parking.schoolyear" type="text" id="schoolyear" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="description">Semester</label>
                            <select v-model="student_parking.semester" name="semester" id="semester" class="form-control" tabindex="-1">
                                <option value="" selected="" ></option>
                                <option value="1" selected="" >First Semester</option>
                                <option value="2" selected="" >Second Semester</option>
                                <option value="3" selected="" >Summer</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description">Parking Type</label>
                            <select v-model="student_parking.parking_type" name="parking_type" id="parking_type" class="form-control" tabindex="-1">
                                <option disabled value="" selected="" ></option>
                                <option v-for="(pricing, index) in pricings" v-bind:value="pricing.id">{{pricing.service_name}} - {{pricing.price}} - {{pricing.schoolyear}} - {{ pricing.semester}}</option>
                            </select>
                        </div>
                        
                        <div class="form-group">
                            <label for="description">OR Number</label>
                            <input v-model="student_parking.or_number" type="text" id="or_number" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="description">Sticker Number</label>
                            <input v-model="student_parking.sticker_number" type="text" id="sticker_number" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="description">Date Issued</label>
                            <input v-model="student_parking.date_issued" type="date" id="date_issued" class="form-control">
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
                        <button @click="create_student_parking" type="button" class="btn btn-primary">Register Parking</button>
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
                            <div class="form-check form-check-inline">
                                <input v-model="type" class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="student">
                                <label class="form-check-label" for="inlineRadio1">Student</label>
                            </div>

                            <div class="form-check form-check-inline">
                                <input v-model="type" class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="employee">
                                <label class="form-check-label" for="inlineRadio2">Employee</label>
                            </div>
                        </div>

                        
                        <div class="form-group" v-if="type == 'employee'">
                            <label for="name">Employee Name</label>
                            <v-select v-model="vehicle.id_number_employee" label="emp_name" :options="employee_names" :reduce="employee_names => employee_names.id_no"></v-select>
                            
                            <span> Selected: {{ vehicle.id_number_employee}}</span>
                        </div>

                        <div class="form-group" v-if="type == 'student'">
                            <label for="name">Student Name</label>
                            <v-select v-model="vehicle.id_number_student" label="label" :options="student_names" :reduce="student_names => student_names.studentcode"></v-select>
                            
                            <span> Selected: {{ vehicle.id_number_student }}</span>
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
    

    export default{

        data(){

            return{

                employee_parking:{
                    id_number: '',
                    plate_number: '',
                    contact_number: '',
                    school_dept_office: '',
                    license_number: '',
                    license_expiry_date: '',
                    schoolyear: '',
                    semester: '',
                    parking_type: '',
                    or_number: '',
                    sticker_number: '',
                    date_issued: new Date().toISOString().slice(0,10)
                },

                student_parking:{
                    id_number: '',
                    plate_number: '',
                    contact_number: '',
                    latest_course: '',
                    department: '',
                    year_level: '',
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
                    id_number_employee: '',
                    id_number_student: '',
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
                student_parkings: [],
                employee_names: [],
                student_names: [],
                pricings: [],
                vehicles: [],
                vehicle_make: [],
                url: 'http://ccfcis.addu.edu.ph/employee_parking/',
                url_student_parking: 'http://ccfcis.addu.edu.ph/student_parking/',
                url_emp_list: 'http://ccfcis.addu.edu.ph/employee_names/',
                url_pricing: 'http://ccfcis.addu.edu.ph/ccfc_pricing_1/',
                url_vehicle: 'http://ccfcis.addu.edu.ph/ccfc_vehicles/',
                url_vehicle_process: 'http://ccfcis.addu.edu.ph/ccfc_vehicles_process/',
                url_vehicle_make: 'http://ccfcis.addu.edu.ph/ccfc_vehicle_make/',
                url_student_name: 'http://ccfcis.addu.edu.ph/student_names',
                type: '',
                columns: [
                    {
                    label: 'ID Number',
                    field: 'id_number',
                    },
                    {
                    label: 'Contact Number',
                    field: 'contact_number',
                    },
                    {
                    label: 'School/Dept/Office',
                    field: 'school_dept_office',
                    },
                    {
                    label: 'License Number',
                    field: 'license_number',
                    },
                    {
                    label: 'License Expiry Date',
                    field: 'license_expiry_date',
                    type: 'date',
                    dateInputFormat: 'yyyy-MM-dd',
                    dateOutputFormat: 'MMM dd,yyyy',
                    },
                    {
                    label: 'School Year',
                    field: 'schoolyear',
                    },
                    {
                    label: 'Semester',
                    field: 'semester',
                    },
                    {
                    label: 'Parking Type',
                    field: 'parking_type',
                    },
                    {
                    label: 'Sticker Number',
                    field: 'sticker_number',
                    },
                    {
                    label: 'Date Issued',
                    field: 'date_issued',
                    type: 'date',
                    dateInputFormat: 'yyyy-MM-dd',
                    dateOutputFormat: 'MMM dd,yyyy',
                    },
                    {
                    label: 'Actions',
                    field: 'actions',
                    sortable: false,
                    },
                ],
                columns_emp_vehicle:[
                    {
                    label: 'Employee Name',
                    field: 'employee_name',
                    },
                    {
                        label: 'Owner Name Registered to LTO',
                        field: 'owner_name_lto',
                    },
                    {
                        label: 'Relation to Owner',
                        field: 'relation_to_owner',
                    },
                    {
                        label: 'Make',
                        field: 'make',
                    },
                    {
                        label: 'Model',
                        field: 'model',
                    },
                    {
                        label: 'Plate Number',
                        field: 'plate_number',
                    },
                    {
                        label: 'Color',
                        field: 'color',
                    },
                    {
                        label: 'Vehicle Registration Expiry Date',
                        field: 'reg_expiry_date',
                    },
                    {
                        label: 'LTO Official Receipt',
                        field: 'lto_or',
                    },
                    {
                        label: 'LTO Certificate of Registration',
                        field: 'lto_cr',
                    },
                    {
                        label: 'Actions',
                        field: 'actions',
                    }
                ],

                columns_stud_vehicle:[
                    {
                    label: 'Student Name',
                    field: 'student_name',
                    },
                    {
                        label: 'Owner Name Registered to LTO',
                        field: 'owner_name_lto',
                    },
                    {
                        label: 'Relation to Owner',
                        field: 'relation_to_owner',
                    },
                    {
                        label: 'Make',
                        field: 'make',
                    },
                    {
                        label: 'Model',
                        field: 'model',
                    },
                    {
                        label: 'Plate Number',
                        field: 'plate_number',
                    },
                    {
                        label: 'Color',
                        field: 'color',
                    },
                    {
                        label: 'Vehicle Registration Expiry Date',
                        field: 'reg_expiry_date',
                    },
                    {
                        label: 'LTO Official Receipt',
                        field: 'lto_or',
                    },
                    {
                        label: 'LTO Certificate of Registration',
                        field: 'lto_cr',
                    },
                    {
                        label: 'Actions',
                        field: 'actions',
                    }
                ],

                columns_stud_parking:[
                    {
                    label: 'ID Number',
                    field: 'id_number',
                    },
                    {
                    label: 'Plate Number',
                    field: 'plate_number',
                    },
                    {
                    label: 'Contact Number',
                    field: 'contact_number',
                    },
                    {
                    label: 'License Number',
                    field: 'license_number',
                    },
                    {
                    label: 'License Expiry Date',
                    field: 'license_expiry_date',
                    type: 'date',
                    dateInputFormat: 'yyyy-MM-dd',
                    dateOutputFormat: 'MMM dd,yyyy',
                    },
                    {
                    label: 'School Year',
                    field: 'schoolyear',
                    },
                    {
                    label: 'Semester',
                    field: 'semester',
                    },
                    {
                    label: 'Parking Type',
                    field: 'parking_type',
                    },
                    {
                    label: 'Sticker Number',
                    field: 'sticker_number',
                    },
                    {
                    label: 'Date Issued',
                    field: 'date_issued',
                    type: 'date',
                    dateInputFormat: 'yyyy-MM-dd',
                    dateOutputFormat: 'MMM dd,yyyy',
                    },
                    {
                    label: 'Actions',
                    field: 'actions',
                    sortable: false,
                    },
                ]
            }
        },

        methods: {
          getOptions(search, loading) {
            loading(true)
            axios.get('http://ccfcis.addu.edu.ph/employee_names/')
            },

            employeeParkingModal(){
                $("#employee-parking-modal").modal("show");
            },

            updateModal(index){
                $("#employee-parking-modal").modal("show");
            },

            studentParkingModal(){
                $("#student-parking-modal").modal("show");
            },

            vehicleModal(){
                $("#vehicle-modal").modal("show");
            },

            create_employee_parking(){

                axios.post('http://ccfcis.addu.edu.ph/employee_parking', 
                {
                    id_number: this.employee_parking.id_number,
                    plate_number: this.employee_parking.plate_number,
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

            create_student_parking(){

                axios.post('http://ccfcis.addu.edu.ph/student_parking', 
                {
                    id_number: this.student_parking.id_number,
                    plate_number: this.student_parking.plate_number,
                    or_number: this.student_parking.or_number,
                    contact_number: this.student_parking.contact_number,
                    license_number: this.student_parking.license_number,
                    license_expiry_date: this.student_parking.license_expiry_date,
                    schoolyear: this.student_parking.schoolyear,
                    semester: this.student_parking.semester,
                    parking_type: this.student_parking.parking_type,
                    sticker_number: this.student_parking.sticker_number,
                    date_issued: this.student_parking.date_issued
                })

                .then(response=>{

                    this.resetData();
                    this.employee_parkings.push(response.data.employee_parking);
                    $("#employee-parking-modal").modal("hide");
                })
            },
            
            create_vehicle(){

                axios.post('http://ccfcis.addu.edu.ph/ccfc_vehicles_process', 
                {
                    id_number_employee: this.vehicle.id_number_employee,
                    id_number_student: this.vehicle.id_number_student,
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

            load_student_parking(){
                
                axios.get(this.url_student_parking).then(response=>{

                    this.student_parkings = response.data.student_parkings;
                });
            },

            load_employee_names(){
                
                axios.get(this.url_emp_list).then(response=>{

                    this.employee_names = response.data.employee_names;
                });

            },

            load_student_names(){
                
                axios.get(this.url_student_name).then(response=>{

                    this.student_names = response.data.student_names;
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
            this.load_student_parking();
            this.load_employee_names();
            this.load_student_names();
            this.load_pricing();
            this.load_vehicle();
            this.load_vehicle_make();
        }
    }
</script>
