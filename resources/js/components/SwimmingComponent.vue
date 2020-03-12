<template>

    <div>

        <nav>

            <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">

                <a class="nav-item nav-link active" id="employee-parking-tab" data-toggle="tab" href="#nav-employee-parking" role="tab" aria-controls="nav-employee-parking" aria-selected="true">Employees Swimming</a>
                <a class="nav-item nav-link" id="student-parking-tab" data-toggle="tab" href="#nav-student-parking" role="tab" aria-controls="nav-employee-parking" aria-selected="false">Students Swimming</a>

            </div>

        </nav><br>

        <div class="tab-content" id='nav-tabContent'>

            <div class="tab-pane fade show active" id="nav-employee-parking" role="tabpanel" aria-labelledby="employee-parking-tab">
                <div class="container-fluid">
                    <div class="row justify-content-center">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">Register Swimming for Employees and University Vehicles</div>
                                <div class="card-body">
                                    <button @click="employeeParkingModal" class="btn btn-primary btn-block">Register Swimming for Employees and University Vehicles</button>
                                    
                                    <div v-if="!loading">
                                        <img class="rounder mx-auto d-block" :src="image" alt="loader">
                                    </div>

                                    <div v-else>

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
                                <div class="card-header">Students Swimming</div>
                                <div class="card-body">
                                    <button @click="studentParkingModal" class="btn btn-primary btn-block">Register Student</button>

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
                       <!-- <h5 class="modal-title" id="exampleModalLabel">Employees Swimming Registration for
                            <font color="red" v-if="is_parking_period == 1">First Semester</font>
                            <font color="red" v-if="is_parking_period == 2">Second Semester</font>
                            <font color="red" v-if="is_parking_period == 3">Summer Semester</font>
                        </h5>-->
                        <button @click="clear_errors" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">


                        <div class="form-group">
                            <label for="name">Employee Name</label>
                            <v-select v-model="employee_parking.id_number" label="emp_name" :options="employee_names" :reduce="employee_names => employee_names.id_no"></v-select>

                            <span> Selected: {{ employee_parking.id_number}}</span>
                        </div>

                        <div class="form-group">
                            <label for="description">OR Number</label>
                            <input v-model="employee_swimming.or_number" type="text" id="or_number" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="description">Swimming Type</label>
                            <select v-model="employee_swimming.swimming_type" name="parking_type" id="parking_type" class="form-control" tabindex="-1">
                                <option disabled value="" selected="" ></option>
                                <option v-for="(pricing, index) in pricings" v-bind:value="pricing.id">{{pricing.service_name}} - ₱{{pricing.price}} - SY: {{pricing.schoolyear}} - Semester {{ pricing.semester}}</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description">School Year</label>
                            <input v-model="employee_swimming.schoolyear" type="text" id="schoolyear" class="form-control">
                        </div>

                        <div class="form-group">
                            <label for="description">Semester</label>
                            <select v-model="employee_swimming.semester" name="semester" id="semester" class="form-control" tabindex="-1">
                                <option value="1" selected="" >First Semester</option>
                                <option value="2" selected="" >Second Semester</option>
                                <option value="3" selected="" >Summer</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="description">Date / Time Usage</label>
                            <input v-model="employee_swimming.date_issued = new Date().toISOString().slice(0,10)" type="date" id="date_issued" class="form-control">
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
                        <button @click="clear_errors" type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                        <button @click="create_employee_swimming" type="button" class="btn btn-primary" :disabled="submitted">Register Employee Swimming</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Student Modal -->
        <div class="modal fade" id="student-parking-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                       <!-- <h5 class="modal-title" id="exampleModalLabel">Students Swimming Registration for
                            <font color="red" v-if="is_parking_period == 1">First Semester</font>
                            <font color="red" v-if="is_parking_period == 2">Second Semester</font>
                            <font color="red" v-if="is_parking_period == 3">Summer Semester</font>
                        </h5>-->
                        <button @click="clear_errors" type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
<!--
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
                        <button @click="create_student_swimming" type="button" class="btn btn-primary" :disabled="submitted">Register Student Swimming</button>
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

                employee_swimming:{
                    employee_id_number: '',
                    or_number: '',
                    swimming_type: '',
                    date_time_usage: new Date().toISOString().slice(0,10),
                    school_year: '',
                    semester: '',
                    amount: ''
                },

                student_swimming:{
                    student_id_number: '',
                    or_number: '',
                    swimming_type: '',
                    date_time_usage: new Date().toISOString().slice(0,10),
                    amount: ''
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
                url_employee_swimming: 'https://ccfcis.addu.edu.ph/employee_swimming/',
                url_student_swimming: 'https://ccfcis.addu.edu.ph/student_swimming/',
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
                second_period_start: new Date().getFullYear() + '-11-4',
                second_period_end: new Date().getFullYear() + '-11-30',
                summer_period_start: (new Date().getFullYear()) + '-3-1',
                summer_period_end: (new Date().getFullYear()) + '-4-3',
                semester: '',
                image: 'img/loader1.gif',
                loading: false,
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
                    this.semester = 2;
                    this.employee_parking.semester = 2;
                    this.employee_parking.schoolyear = new Date().getFullYear();
                    this.student_parking.semester = 2;
                    this.student_parking.schoolyear = new Date().getFullYear();

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

            create_employee_swimming(){

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
                    this.load_employee_swimming();
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

            create_student_swimming(){

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
                    this.load_student_swimming();
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

            load_employee_swimming(){

                axios.get(this.url.employee).then(response=>{

                    this.employee_parkings = response.data.employee_parkings;
                    this.loading = true;
                });
            },

            load_student_swimming(){

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
            this.load_employee_swimming();
            this.load_student_swimming();
            this.load_employee_names();
            this.load_student_names();
            this.load_pricing();
        }
    }
</script>
