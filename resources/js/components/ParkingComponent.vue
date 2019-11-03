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
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">Register Parking for Employees and University Vehicles</div>
                                <div class="card-body">
                                    <button @click="employeeParkingModal" class="btn btn-primary btn-block">Register Parking for Employees and University Vehicles</button>
                                    
                                    <div v-if="!loading">
                                        <img class="rounder mx-auto d-block" :src="image" alt="loader">
                                    </div>

                                    <div v-else>

                                        <b-table 
                                            responsive 
                                            id="my-table" 
                                            striped hover 
                                            :items="filtered_emp_parking"
                                            :fields="columns_emp_parking"
                                            :per-page="perPage"
                                            :current-page="currentPage"
                                            :bordered=true
                                            show-empty
                                            >

                                            <template slot="top-row" slot-scope="{ fields }" v-if="employee_parkings.length > 0">
                                                <td v-for="field in fields" :key="field.key">
                                                <input v-if="field.label == 'ID Number' || field.label == 'Middlename' || field.label == 'Lastname' || field.label == 'Firstname' || field.label == 'School Year' || field.label == 'Semester'" v-model="filters_ep[field.key]" :placeholder="field.label">
                                                </td>
                                            </template>    
                                    
                                            <!--<template v-slot:cell(actions)="row" v-if="vehicles.length > 0">
                                                <button @click="updateModal(row.index)" class="btn btn-info">Edit</button>
                                                <button @click="delete_ldap(row.index)" class="btn btn-danger">Delete</button>
                                            </template>-->
                                                
                                        </b-table>

                                        <b-pagination
                                        v-model="currentPage"
                                        :total-rows="emp_rows"
                                        :per-page="perPage"
                                        aria-controls="my-table"
                                        ></b-pagination>
                                        <p class="mt-3">Current Page: {{ currentPage }}</p>

                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="nav-student-parking" role="tabpanel" aria-labelledby="student-parking-tab">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">Students Parking</div>
                                <div class="card-body">
                                    <button @click="studentParkingModal" class="btn btn-primary btn-block">Register Student</button>

                                        <b-table 
                                            responsive 
                                            ref="table"
                                            id="students-table" 
                                            striped hover 
                                            :items="filtered_stud_parking"
                                            :fields="columns_stud_parking"
                                            :per-page="sp_perPage"
                                            :current-page="currentPage"
                                            :bordered=true
                                            show-empty
                                            >  

                                            <template slot="top-row" slot-scope="{ fields }" v-if="student_parkings.length > 0">
                                                <td v-for="field in fields" :key="field.key">
                                                <input v-if="field.label == 'ID Number' || field.label == 'Middlename' || field.label == 'Lastname' || field.label == 'Firstname'" v-model="filters_stud[field.key]" :placeholder="field.label">
                                                </td>
                                            </template> 
                                    
                                            <!--<template v-slot:cell(actions)="row" v-if="vehicles.length > 0">
                                                <button @click="updateModal(row.index)" class="btn btn-info">Edit</button>
                                                <button @click="delete_ldap(row.index)" class="btn btn-danger">Delete</button>
                                            </template>-->
                                                
                                        </b-table>

                                        <b-pagination
                                        v-model="currentPage"
                                        :total-rows="stud_rows"
                                        :per-page="perPage"
                                        aria-controls="my-table"
                                        ></b-pagination>
                                        <p class="mt-3">Current Page: {{ currentPage }}</p>\
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="nav-vehicles-master" role="tabpanel" aria-labelledby="vehicles-master-tab">
                <div class="container-fluid">
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

                                            <b-table 
                                                responsive 
                                                ref="table"
                                                id="vehicles-table" 
                                                striped hover 
                                                :items="filtered_emp_vehicle"
                                                :fields="columns_emp_vehicle"
                                                :per-page="perPage_emp_vehicles"
                                                :current-page="currentPage_emp_vehicles"
                                                show-empty>

                                                <template slot="top-row" slot-scope="{ fields }" v-if="emp_vehicles.length > 0">
                                                    <td v-for="field in fields" :key="field.key">
                                                        <input v-if="field.label == 'Employee ID Number' || field.label == 'Plate Number' || field.label == 'Lastname' || field.label == 'Firstname'" v-model="filters[field.key]" :placeholder="field.label">
                                                    </td>
                                                </template>
                                                
                                                <!--<template v-slot:cell(actions)="row" v-if="vehicles.length > 0">
                                                    <button @click="updateModal(row.index)" class="btn btn-info">Edit</button>
                                                    <button @click="delete_ldap(row.index)" class="btn btn-danger">Delete</button>
                                                </template>-->
                                                
                                            </b-table>

                                            <b-pagination
                                            v-model="currentPage_emp_vehicles"
                                            :total-rows="emp_vehicles_rows"
                                            :per-page="perPage_emp_vehicles"
                                            aria-controls="my-table"
                                            ></b-pagination>
                                            <p class="mt-3">Current Page: {{ currentPage_emp_vehicles }}</p>
                                            <!--
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

                                            </vue-good-table>-->

                                        </div>

                                        <div class="tab-pane fade" id="students" role="tabpanel" aria-labelledby="students-tab">

                                            <b-table 
                                                responsive 
                                                ref="table"
                                                id="vehicles-table" 
                                                striped hover 
                                                :items="filtered_stud_vehicle"
                                                :fields="columns_stud_vehicle"
                                                :per-page="perPage_stud_vehicles"
                                                :current-page="currentPage_stud_vehicles"
                                                show-empty>

                                                <template slot="top-row" slot-scope="{ fields }" v-if="emp_vehicles.length > 0">
                                                    <td v-for="field in fields" :key="field.key">
                                                        <input v-if="field.label == 'Student ID Number' || field.label == 'Plate Number' || field.label == 'Lastname' || field.label == 'Firstname'" v-model="filters[field.key]" :placeholder="field.label">
                                                    </td>
                                                </template>
                                                
                                                <!--<template v-slot:cell(actions)="row" v-if="vehicles.length > 0">
                                                    <button @click="updateModal(row.index)" class="btn btn-info">Edit</button>
                                                    <button @click="delete_ldap(row.index)" class="btn btn-danger">Delete</button>
                                                </template>-->
                                                
                                            </b-table>

                                            <b-pagination
                                            v-model="currentPage"
                                            :total-rows="stud_vehicles_rows"
                                            :per-page="perPage"
                                            aria-controls="my-table"
                                            ></b-pagination>
                                            <p class="mt-3">Current Page: {{ currentPage }}</p>

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
        <div class="modal fade" id="employee-parking-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" data-backdrop="static" data-keyboard="false">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Employees Parking Registration for
                            <font color="red" v-if="is_parking_period == 1">First Semester</font>
                            <font color="red" v-if="is_parking_period == 2">Second Semester</font>
                            <font color="red" v-if="is_parking_period == 3">Summer Semester</font>
                        </h5>
                        <button @click="clear_errors" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger" v-if="errors.length > 0">
                            <ul>
                                <li v-for="emp_parking_err in errors">{{ emp_parking_err }}</li>
                            </ul>
                        </div>


                        <div class="form-group">
                            <label for="name">Employee Name</label>
                            <v-select v-model="employee_parking.id_number" label="emp_name" :options="employee_names.length" :reduce="employee_names => employee_names.id_no"></v-select>

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
                                <option value="1" selected="" >First Semester</option>
                                <option value="2" selected="" >Second Semester</option>
                                <option value="3" selected="" >Summer</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description">Parking Type</label>
                            <select v-model="employee_parking.parking_type" name="parking_type" id="parking_type" class="form-control" tabindex="-1">
                                <option disabled value="" selected="" ></option>
                                <option v-for="(pricing, index) in pricings" v-bind:value="pricing.id">{{pricing.service_name}} - ₱{{pricing.price}} - SY: {{pricing.schoolyear}} - Semester {{ pricing.semester}}</option>
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
                            <input v-model="employee_parking.date_issued = new Date().toISOString().slice(0,10)" type="date" id="date_issued" class="form-control">
                            <br>
                        </div>

                        

                        <div class="form-group">
                            <b-form-checkbox
                                id="checkbox-1"
                                v-model="employee_parking.isPayroll"
                                name="checkbox-1"
                                value="1"
                                unchecked-value="0"
                            >
                                Check if payment is due on every Payroll
                            </b-form-checkbox>
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
                        <button @click="clear_errors" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button @click="create_employee_parking" type="button" class="btn btn-primary" :disabled="submitted">Register Employee Parking</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Student Modal -->
        <div class="modal fade" id="student-parking-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Students Parking Registration for
                            <font color="red" v-if="is_parking_period == 1">First Semester</font>
                            <font color="red" v-if="is_parking_period == 2">Second Semester</font>
                            <font color="red" v-if="is_parking_period == 3">Summer Semester</font>
                        </h5>
                        <button @click="clear_errors" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger" v-if="errors.length > 0">
                            <ul>
                                <li v-for="stud_parking_err in errors">{{ stud_parking_err }}</li>
                            </ul>
                        </div>


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
                            <input v-model="student_parking.date_issued = new Date().toISOString().slice(0,10)" type="date" id="date_issued" class="form-control">
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
                        <button @click="clear_errors" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button @click="create_student_parking" type="button" class="btn btn-primary" :disabled="submitted">Register Student Parking</button>
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
                        <button @click="clear_errors" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="alert alert-danger" v-if="errors.length > 0">
                            <ul>
                                <li v-for="vehicle_error in errors">{{ vehicle_error }}</li>
                            </ul>
                        </div>

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
                            <label for="description">Year Model - <b><i>Example: 2019 Ford Ranger Raptor</i></b></label>
                            <input v-model="vehicle.model" type="text" id="license_number" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="description">Plate Number <br><b>Follow this format:</b><i> <br>For vehicles, use ABC-1234 (2014 series plates) and ABC-123 (1981 Series plates)
                            <br>For motorcycles, use MC-12345 (2014 series plates) and MC-1234 (1981 Series plates)</i></label>
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
                        <button @click="clear_errors" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button @click="create_vehicle" type="button" class="btn btn-primary" :disabled="submitted">Register Vehicle</button>
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
                    date_issued: new Date().toISOString().slice(0,10),
                    isPayroll: ''
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
                    date_issued: new Date().toISOString().slice(0,10)
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
                emp_vehicles: [],
                stud_vehicles: [],
                vehicle_make: [],
                url: 'https://ccfcis.addu.edu.ph/employee_parking/',
                url_student_parking: 'https://ccfcis.addu.edu.ph/student_parking/',
                url_emp_list: 'https://ccfcis.addu.edu.ph/employee_names/',
                url_pricing: 'https://ccfcis.addu.edu.ph/ccfc_pricing_1/',
                url_vehicle: 'https://ccfcis.addu.edu.ph/ccfc_vehicles/',
                url_vehicle_process: 'https://ccfcis.addu.edu.ph/ccfc_vehicles_process/',
                url_vehicle_make: 'https://ccfcis.addu.edu.ph/ccfc_vehicle_make/',
                url_student_name: 'https://ccfcis.addu.edu.ph/student_names',
                errors: [],
                type: '',
                current_year: new Date().getFullYear(),
                current_date: new Date().toISOString().slice(0,10),
                //current_date: '2019-11-1',
                first_period_start: new Date().getFullYear() + '-06-01',
                first_period_end: new Date().getFullYear() + '-10-31',
                second_period_start: new Date().getFullYear() + '-11-1',
                second_period_end: new Date().getFullYear() + '-11-30',
                summer_period_start: (new Date().getFullYear()) + '-3-1',
                summer_period_end: (new Date().getFullYear()) + '-4-3',
                semester: '',
                image: 'img/loader1.gif',
                loading: false,

                columns_emp_parking: [
                    {
                    label: 'ID Number',
                    key: 'id_number',
                    sortable: true
                    },
                    {
                    label: 'Lastname',
                    key: 'clast',
                    sortable: true
                    },
                    {
                    label: 'Firstname',
                    key: 'cfirst',
                    sortable: true
                    },
                    {
                    label: 'Middlename',
                    key: 'middle',
                    sortable: true
                    },
                    {
                    label: 'Contact Number',
                    key: 'contact_number',
                    sortable: true
                    },
                    {
                    label: 'School/Dept/Office',
                    key: 'school_dept_office',
                    sortable: true
                    },
                    {
                    label: 'License Number',
                    key: 'license_number',
                    sortable: true
                    },
                    {
                    label: 'License Expiry Date',
                    key: 'license_expiry_date',
                    type: 'date',
                    dateInputFormat: 'yyyy-MM-dd',
                    dateOutputFormat: 'MMM dd,yyyy',
                    sortable: true
                    },
                    {
                    label: 'School Year',
                    key: 'schoolyear',
                    sortable: true
                    },
                    {
                    label: 'Semester',
                    key: 'semester',
                    sortable: true
                    },
                    {
                    label: 'Parking Type',
                    key: 'service_name',
                    sortable: true
                    },
                    {
                    label: 'Sticker Number',
                    key: 'sticker_number',
                    sortable: true
                    },
                    {
                    label: 'Date Issued',
                    key: 'date_issued',
                    type: 'date',
                    dateInputFormat: 'yyyy-MM-dd',
                    dateOutputFormat: 'MMM dd,yyyy',
                    sortable: true
                    },
                    {
                    label: 'Actions',
                    key: 'actions',
                    sortable: false,
                    },
                ],
                columns_emp_vehicle:[
                    {
                        label: 'Employee ID Number',
                        key: 'emp_id',
                        sortable: true
                    },
                    {
                        label: 'Lastname',
                        key: 'clast',
                        sortable: true
                    },
                    {
                        label: 'Firstname',
                        key: 'cfirst',
                        sortable: true
                    },
                    {
                        label: 'Owner Name Registered to LTO',
                        key: 'owner_name_lto',
                        sortable: true
                    },
                    {
                        label: 'Relation to Owner',
                        key: 'relation_to_owner',
                        sortable: true
                    },
                    {
                        label: 'Make',
                        key: 'make',
                        sortable: true
                    },
                    {
                        label: 'Model',
                        key: 'model',
                        sortable: true
                    },
                    {
                        label: 'Plate Number',
                        key: 'plate_number',
                        sortable: true
                    },
                    {
                        label: 'Color',
                        key: 'color',
                        sortable: true
                    },
                    {
                        label: 'Vehicle Registration Expiry Date',
                        key: 'reg_expiry_date',
                        sortable: true
                    },
                    {
                        label: 'LTO Official Receipt',
                        key: 'lto_or',
                        sortable: true
                    },
                    {
                        label: 'LTO Certificate of Registration',
                        key: 'lto_cr',
                        sortable: true
                    },
                    {
                        label: 'Actions',
                        key: 'actions',
                        sortable: false
                    }
                ],

                columns_stud_vehicle:[
                    {
                        label: 'Student ID Number',
                        key: 'stud_id',
                        sortable: true
                    },
                    {
                        label: 'Lastname',
                        key: 'lastname',
                        sortable: true
                    },
                    {
                        label: 'Firstname',
                        key: 'firstname',
                        sortable: true
                    },
                    {
                        label: 'Middlename',
                        key: 'middlename',
                        sortable: true
                    },
                    {
                        label: 'Owner Name Registered to LTO',
                        key: 'owner_name_lto',
                        sortable: true
                    },
                    {
                        label: 'Relation to Owner',
                        key: 'relation_to_owner',
                        sortable: true
                    },
                    {
                        label: 'Make',
                        key: 'make',
                        sortable: true
                    },
                    {
                        label: 'Model',
                        key: 'model',
                        sortable: true
                    },
                    {
                        label: 'Plate Number',
                        key: 'plate_number',
                        sortable: true
                    },
                    {
                        label: 'Color',
                        key: 'color',
                        sortable: true
                    },
                    {
                        label: 'Vehicle Registration Expiry Date',
                        key: 'reg_expiry_date',
                        sortable: true
                    },
                    {
                        label: 'LTO Official Receipt',
                        key: 'lto_or',
                        sortable: true
                    },
                    {
                        label: 'LTO Certificate of Registration',
                        key: 'lto_cr',
                        sortable: true
                    },
                    {
                        label: 'Actions',
                        key: 'actions',
                        sortable: false
                    }
                ],

                columns_stud_parking:[
                    {
                    label: 'ID Number',
                    key: 'id_number',
                    },
                    {
                    label: 'Lastname',
                    key: 'lastname',
                    },
                    {
                    label: 'Firstname',
                    key: 'firstname',
                    },
                    {
                    label: 'Middlename',
                    key: 'middlename',
                    },
                    {
                    label: 'Plate Number',
                    key: 'plate_number',
                    },
                    {
                    label: 'Contact Number',
                    key: 'contact_number',
                    },
                    {
                    label: 'License Number',
                    key: 'license_number',
                    },
                    {
                    label: 'License Expiry Date',
                    key: 'license_expiry_date',
                    type: 'date',
                    dateInputFormat: 'yyyy-MM-dd',
                    dateOutputFormat: 'MMM dd,yyyy',
                    },
                    {
                    label: 'School Year',
                    key: 'schoolyear',
                    },
                    {
                    label: 'Semester',
                    key: 'semester',
                    },
                    {
                    label: 'Parking Type',
                    key: 'service_name',
                    },
                    {
                    label: 'Sticker Number',
                    key: 'sticker_number',
                    },
                    {
                    label: 'Date Issued',
                    key: 'date_issued',
                    type: 'date',
                    dateInputFormat: 'yyyy-MM-dd',
                    dateOutputFormat: 'MMM dd,yyyy',
                    },
                    {
                    label: 'Actions',
                    key: 'actions',
                    sortable: false,
                    },
                ],
                filters: {

                },
                filters_ep: {

                },
                filters_stud: {

                },
                totalRows: 1,
                currentPage: 1,
                perPage: 5,
                sp_perPage: 5,
                pageOptions: [5, 10, 15],
                totalRows_emp_vehicles: 1,
                currentPage_emp_vehicles: 1,
                perPage_emp_vehicles: 5,
                pageOptions_emp_vehicles: [5, 10, 15],
                totalRows_stud_vehicles: 1,
                currentPage_stud_vehicles: 1,
                perPage_stud_vehicles: 5,
                pageOptions_stud_vehicles: [5, 10, 15],
                submitted: false
            }
        },

        computed: {
            filtered_emp_vehicle(){
                const filtered = this.emp_vehicles.filter(item =>{
                    return Object.keys(this.filters).every(key =>
                        String(item[key]).includes(this.filters[key]))
                })
                return filtered.length > 0 ? filtered : [{
                    emp_id: '',
                    cfirst: '',
                    clast: '',
                    plate_number: ''
                }]
            },

            filtered_stud_vehicle(){
                const filtered = this.stud_vehicles.filter(item =>{
                    return Object.keys(this.filters).every(key =>
                        String(item[key]).includes(this.filters[key]))
                })
                return filtered.length > 0 ? filtered : [{
                    stud_id: '',
                    firstname: '',
                    lastname: '',
                    plate_number: ''
                }]
            },

            filtered_emp_parking(){
                const filtered_ep = this.employee_parkings.filter(item =>{
                    return Object.keys(this.filters_ep).every(key =>
                        String(item[key]).includes(this.filters_ep[key]))
                })
                return filtered_ep.length > 0 ? filtered_ep : [{
                    id_number: '',
                    cfirst: '',
                    clast: '',
                    middle: '',
                    semester: '',
                    schoolyear: ''
                }]
            },

            filtered_stud_parking(){
                const filtered_stud = this.student_parkings.filter(item =>{
                    return Object.keys(this.filters_stud).every(key =>
                        String(item[key]).includes(this.filters_stud[key]))
                })
                return filtered_stud.length > 0 ? filtered_stud : [{
                    id_number: '',
                    firstname: '',
                    lastname: '',
                    middlename: '',
                    semester: '',
                    schoolyear: ''
                }]
            },

            is_parking_period(){

                if (this.current_date >= this.first_period_start && this.current_date <= this.first_period_end) {
                    this.semester = 1;
                    this.employee_parking.semester = 1;
                    this.employee_parking.schoolyear = new Date().getFullYear();
                    this.student_parking.semester = 1;
                    this.student_parking.schoolyear = new Date().getFullYear();
                } else if (this.current_date >= this.second_period_start && this.current_date <= this.second_period_end) {
                    this.semester = 2;
                    this.employee_parking.semester = 2;
                    this.employee_parking.schoolyear = new Date().getFullYear();
                    this.student_parking.semester = 2;
                    this.student_parking.schoolyear = new Date().getFullYear();
                } else if (this.current_date >= this.summer_period_start && this.current_date <= this.summer_period_end) {
                    this.semester = 3;
                    this.employee_parking.semester = 3;
                    this.employee_parking.schoolyear = new Date().getFullYear() - 1;
                    this.student_parking.semester = 3;
                    this.student_parking.schoolyear = new Date().getFullYear() - 1;
                }

                return this.semester// + ' ' + this.current_date + ' ' + this.summer_period_start
            },

            emp_rows() {
                return this.employee_parkings.length
            },

            stud_rows() {
                return this.student_parkings.length
            },

            emp_vehicles_rows() {
                return this.emp_vehicles.length
            },

            stud_vehicles_rows() {
                return this.stud_vehicles.length
            }
        },

        methods: {
          getOptions(search, loading) {
            loading(true)
            axios.get('https://ccfcis.addu.edu.ph/employee_names/')
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

                this.submitted = true;
                axios.post('https://ccfcis.addu.edu.ph/employee_parking',
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
                    date_issued: this.employee_parking.date_issued,
                    isPayroll: this.employee_parking.isPayroll
                })

                .then(response=>{

                    this.resetData();
                    this.submitted = false;
                    this.employee_parkings.push(response.data.employee_parking);
                    $("#employee-parking-modal").modal("hide");
                    //toastr.success(response.data.message);
                    this.load_employee_parking();
                    this.makeToastEP('success', response.data.message, 'added', 'Employee Parking successfully ');
                    this.errors = [];
                })

                .catch(error=>{
                    
                    this.errors = [];
                    if(error.response.data.errors.id_number){
                        this.errors.push(error.response.data.errors.id_number[0]);
                    }
                    if(error.response.data.errors.plate_number){
                        this.errors.push(error.response.data.errors.plate_number[0]);
                    }
                    if(error.response.data.errors.contact_number){
                        this.errors.push(error.response.data.errors.contact_number[0]);
                    }
                    if(error.response.data.errors.school_dept_office){
                        this.errors.push(error.response.data.errors.school_dept_office[0]);
                    }
                    if(error.response.data.errors.license_number){
                        this.errors.push(error.response.data.errors.license_number[0]);
                    }
                    if(error.response.data.errors.license_expiry_date){
                        this.errors.push(error.response.data.errors.license_expiry_date[0]);
                    }
                    if(error.response.data.errors.schoolyear){
                        this.errors.push(error.response.data.errors.schoolyear[0]);
                    }
                    if(error.response.data.errors.semester){
                        this.errors.push(error.response.data.errors.semester[0]);
                    }
                    if(error.response.data.errors.parking_type){
                        this.errors.push(error.response.data.errors.parking_type[0]);
                    }
                    if(error.response.data.errors.or_number){
                        this.errors.push(error.response.data.errors.or_number[0]);
                    }
                    if(error.response.data.errors.sticker_number){
                        this.errors.push(error.response.data.errors.sticker_number[0]);
                    }
                    if(error.response.data.errors.date_issued){
                        this.errors.push(error.response.data.errors.date_issued[0]);
                    }
                    
                    this.submitted = false;
                });
            },

            create_student_parking(){

                this.submitted = true;

                axios.post('https://ccfcis.addu.edu.ph/student_parking',
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
                    this.submitted = false;
                    this.student_parkings.push(response.data.student_parking);
                    $("#student-parking-modal").modal("hide");
                    this.load_student_parking();
                    this.makeToastEP('success', response.data.message, 'added', 'Student Parking successfully ');
                }).catch(error=>{
                    
                    this.errors = [];
                    if(error.response.data.errors.id_number){
                        this.errors.push(error.response.data.errors.id_number[0]);
                    }
                    if(error.response.data.errors.plate_number){
                        this.errors.push(error.response.data.errors.plate_number[0]);
                    }
                    if(error.response.data.errors.or_number){
                        this.errors.push(error.response.data.errors.or_number[0]);
                    }
                    if(error.response.data.errors.contact_number){
                        this.errors.push(error.response.data.errors.contact_number[0]);
                    }
                    if(error.response.data.errors.license_number){
                        this.errors.push(error.response.data.errors.license_number[0]);
                    }
                    if(error.response.data.errors.license_expiry_date){
                        this.errors.push(error.response.data.errors.license_expiry_date[0]);
                    }
                    if(error.response.data.errors.schoolyear){
                        this.errors.push(error.response.data.errors.schoolyear[0]);
                    }
                    if(error.response.data.errors.semester){
                        this.errors.push(error.response.data.errors.semester[0]);
                    }
                    if(error.response.data.errors.parking_type){
                        this.errors.push(error.response.data.errors.parking_type[0]);
                    }
                    if(error.response.data.errors.sticker_number){
                        this.errors.push(error.response.data.errors.sticker_number[0]);
                    }
                    if(error.response.data.errors.date_issued){
                        this.errors.push(error.response.data.errors.date_issued[0]);
                    }
                    
                    this.submitted = false;
                });
            },

            create_vehicle(){

                this.submitted = true;
                axios.post('https://ccfcis.addu.edu.ph/ccfc_vehicles_process',
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
                    this.submitted = false;
                    this.vehicles.push(response.data.vehicle);
                    $("#vehicle-modal").modal("hide");
                    this.load_vehicle();
                    this.makeToastEP('success', response.data.message, 'added', 'Vehicle successfully ');
                })

                .catch(error=>{
                    this.errors = [];
                    if(error.response.data.errors.owner_name_lto){
                        this.errors.push(error.response.data.errors.owner_name_lto[0]);
                    }
                    if(error.response.data.errors.relation_to_owner){
                        this.errors.push(error.response.data.errors.relation_to_owner[0]);
                    }
                    if(error.response.data.errors.make){
                        this.errors.push(error.response.data.errors.make[0]);
                    }
                    if(error.response.data.errors.model){
                        this.errors.push(error.response.data.errors.model[0]);
                    }
                    if(error.response.data.errors.plate_number){
                        this.errors.push(error.response.data.errors.plate_number[0]);
                    }
                    if(error.response.data.errors.color){
                        this.errors.push(error.response.data.errors.color[0]);
                    }
                    if(error.response.data.errors.reg_expiry_date){
                        this.errors.push(error.response.data.errors.reg_expiry_date[0]);
                    }
                    if(error.response.data.errors.relation_to_owner){
                        this.errors.push(error.response.data.errors.reg_expiry_date[0]);
                    }
                    
                    this.submitted = false;
                });


            },

            load_vehicle(){

                axios.get(this.url_vehicle).then(response=>{

                    this.vehicles = response.data.vehicles;
                    this.emp_vehicles = response.data.emp_vehicles;
                    this.stud_vehicles = response.data.stud_vehicles;
                });
            },

            load_employee_parking(){

                axios.get(this.url).then(response=>{

                    this.employee_parkings = response.data.employee_parkings;
                    this.loading = true;
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
                this.employee_parking.parking_type = '';
                this.employee_parking.or_number = '';
                this.employee_parking.sticker_number = '';
                this.employee_parking.date_issued = '';

                this.student_parking.id_number = '';
                this.student_parking.plate_number = '';
                this.student_parking.or_number = '';
                this.student_parking.contact_number = '';
                this.student_parking.license_number = '';
                this.student_parking.license_expiry_date = '';
                this.student_parking.parking_type = '';
                this.student_parking.sticker_number = '';
                this.student_parking.date_issued = '';

                this.vehicle.id_number_employee = '';
                this.vehicle.id_number_student = '';
                this.vehicle.owner_name_lto = '';
                this.vehicle.relation_to_owner = '';
                this.vehicle.make = '';
                this.vehicle.model = '';
                this.vehicle.plate_number = '';
                this.vehicle.color = '';
                this.vehicle.reg_expiry_date = '';
                this.vehicle.lto_cr = '';
                this.vehicle.lto_or = '';

            },

            clear_errors(){
                
                this.errors = [];
            },

            makeToastEP(variant = null, message, processType, title) {
                this.$bvToast.toast(message, {
                title: title+processType+".",
                variant: variant,
                autoHideDelay: 5000,
                solid: true
                })
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
