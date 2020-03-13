<template>
  <div>
    <nav>
      <div class="nav nav-tabs nav-fill" id="nav-tab" role="tablist">
        <a
          class="nav-item nav-link active"
          id="employee-parking-tab"
          data-toggle="tab"
          href="#nav-employee-parking"
          role="tab"
          aria-controls="nav-employee-parking"
          aria-selected="true"
        >Employees Swimming</a>
        <a
          class="nav-item nav-link"
          id="student-parking-tab"
          data-toggle="tab"
          href="#nav-student-parking"
          role="tab"
          aria-controls="nav-employee-parking"
          aria-selected="false"
        >Students Swimming</a>
      </div>
    </nav>
    <br />

    <div class="tab-content" id="nav-tabContent">
      <div
        class="tab-pane fade show active"
        id="nav-employee-parking"
        role="tabpanel"
        aria-labelledby="employee-parking-tab"
      >
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">Register Swimming for Employees and University Vehicles</div>
                <div class="card-body">
                  <button
                    @click="employeeParkingModal"
                    class="btn btn-primary btn-block"
                  >Register Swimming for Employees and University Vehicles</button>

                  <div v-if="!loading">
                    <img class="rounder mx-auto d-block" :src="image" alt="loader" />
                  </div>

                  <div v-else>
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Employee Name</th>
                          <th scope="col">OR Number</th>
                          <th scope="col">Swimming Type</th>
                          <th scope="col">Total Hours</th>
                          <th scope="col">School Year</th>
                          <th scope="col">Semester</th>
                          <th scope="col">Date / Time Usage</th>
                          <th scope="col">Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(employee_swimming, index) in employee_swimmings">
                          <td>{{ employee_swimming.clast }}, {{ employee_swimming.cfirst }} {{ employee_swimming.middle }}  </td>
                          <td>{{ employee_swimming.or_number }}</td>
                          <td>{{ employee_swimming.swimming_type }}</td>
                          <td>{{ employee_swimming.totalHrs }}</td>
                          <td>{{ employee_swimming.schoolyear }}</td>
                          <td>{{ employee_swimming.semester }}</td>
                          <td>{{ employee_swimming.date_time_usage }}</td>
                          <td>{{ employee_swimming.amount }}</td>
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

      <div
        class="tab-pane fade"
        id="nav-student-parking"
        role="tabpanel"
        aria-labelledby="student-parking-tab"
      >
        <div class="container-fluid">
          <div class="row justify-content-center">
            <div class="col-md-12">
              <div class="card">
                <div class="card-header">Students Swimming</div>
                <div class="card-body">
                  <button
                    @click="studentParkingModal"
                    class="btn btn-primary btn-block"
                  >Register Student</button>
                    <table class="table">
                      <thead>
                        <tr>
                          <th scope="col">Student Name</th>
                          <th scope="col">OR Number</th>
                          <th scope="col">Swimming Type</th>
                          <th scope="col">Total Hours</th>
                          <th scope="col">School Year</th>
                          <th scope="col">Semester</th>
                          <th scope="col">Date / Time Usage</th>
                          <th scope="col">Amount</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr v-for="(student_swimming, index) in student_swimmings">
                          <td>{{ student_swimming.lastname }}, {{ student_swimming.firstname }} {{ student_swimming.middlename }} </td>
                          <td>{{ student_swimming.or_number }}</td>
                          <td>{{ student_swimming.swimming_type }}</td>
                          <td>{{ student_swimming.totalHrs }}</td>
                          <td>{{ student_swimming.schoolyear }}</td>
                          <td>{{ student_swimming.semester }}</td>
                          <td>{{ student_swimming.date_time_usage }}</td>
                          <td>{{ student_swimming.amount }}</td>
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
    <div
      class="modal fade"
      id="employee-swimming-modal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
      data-backdrop="static"
      data-keyboard="false"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Employees Swimming Registration for
                            <font color="red" v-if="is_swimming_period == 1">First Semester</font>
                            <font color="red" v-if="is_swimming_period == 2">Second Semester</font>
                            <font color="red" v-if="is_swimming_period == 3">Summer Semester</font>
            </h5>
            <button
              @click="clear_errors"
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <div class="form-group">
              <label for="name">Employee Name</label>
              <v-select
                v-model="employee_swimming.employee_id_number"
                label="emp_name"
                :options="employee_names"
                :reduce="employee_names => employee_names.id_no"
              ></v-select>

              <span>Selected: {{ employee_swimming.employee_id_number}}</span>
            </div>

            <div class="form-group">
              <label for="description">OR Number</label>
              <input
                v-model="employee_swimming.or_number"
                type="text"
                id="or_number"
                class="form-control"
              />
            </div>

            <div class="form-group">
              <label for="description">Swimming Type</label>
              <select
                v-model="employee_swimming.swimming_type"
                name="parking_type"
                id="parking_type"
                class="form-control"
                tabindex="-1"
              >
                <option disabled value selected></option>
                <option
                  v-for="(pricing, index) in pricings"
                  v-bind:value="pricing.id"
                >{{pricing.service_name}} - ₱{{pricing.price}} - SY: {{pricing.schoolyear}} - Semester {{ pricing.semester}}</option>
              </select>
            </div>

            <div class="form-group">
              <label for="description">Total hours</label>
              <input
                v-model="employee_swimming.totalHrs"
                type="number"
                id="totalHrs"
                class="form-control"
              />
            </div>

            <div class="form-group">
              <label for="description">Date</label>
              <input
                v-model="employee_swimming.date_time_usage"
                type="date"
                id="date_issued"
                class="form-control"
              />
              <br />
            </div>

            <div class="form-group">
              <label for="description">School Year</label>
              <input
                v-model="employee_swimming.schoolyear"
                type="text"
                id="schoolyear"
                class="form-control"
              />
            </div>

            <div class="form-group">
              <label for="description">Semester</label>
              <select
                v-model="employee_swimming.semester"
                name="semester"
                id="semester"
                class="form-control"
                tabindex="-1"
              >
                <option value="1" selected>First Semester</option>
                <option value="2" selected>Second Semester</option>
                <option value="3" selected>Summer</option>
              </select>
            </div>

            <div class="form-group">
              <label for="description">Amount</label>
              <input
                v-model="employee_swimming.amount"
                type="text"
                id="amount"
                class="form-control"
              />
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
            <button
              @click="clear_errors"
              type="button"
              class="btn btn-danger"
              data-dismiss="modal"
            >Close</button>
            <button
              @click="create_employee_swimming"
              type="button"
              class="btn btn-primary"
              :disabled="submitted"
            >Register Employee Swimming</button>
          </div>
        </div>
      </div>
    </div>
    <!-- Student Modal -->
    <div
      class="modal fade"
      id="student-swimming-modal"
      tabindex="-1"
      role="dialog"
      aria-labelledby="exampleModalLabel"
      aria-hidden="true"
    >
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <!-- <h5 class="modal-title" id="exampleModalLabel">Students Swimming Registration for
                            <font color="red" v-if="is_swimming_period == 1">First Semester</font>
                            <font color="red" v-if="is_swimming_period == 2">Second Semester</font>
                            <font color="red" v-if="is_swimming_period == 3">Summer Semester</font>
            </h5>-->
            <button
              @click="clear_errors"
              type="button"
              class="close"
              data-dismiss="modal"
              aria-label="Close"
            >
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
                        <div class="form-group">
                            <label for="name">Student Name</label>
                            <v-select v-model="student_swimming.student_id_number" label="label" :options="student_names" :reduce="student_names => student_names.studentcode"></v-select>

                            <span> Selected: {{ student_swimming.id_number }}</span>
                        </div>

            <div class="form-group">
              <label for="description">OR Number</label>
              <input
                v-model="student_swimming.or_number"
                type="text"
                id="or_number"
                class="form-control"
              />
            </div>

            <div class="form-group">
              <label for="description">Swimming Type</label>
              <select
                v-model="student_swimming.swimming_type"
                name="parking_type"
                id="parking_type"
                class="form-control"
                tabindex="-1"
              >
                <option disabled value selected></option>
                <option
                  v-for="(pricing, index) in pricings"
                  v-bind:value="pricing.id"
                >{{pricing.service_name}} - ₱{{pricing.price}} - SY: {{pricing.schoolyear}} - Semester {{ pricing.semester}}</option>
              </select>
            </div>

            <div class="form-group">
              <label for="description">Total hours</label>
              <input
                v-model="student_swimming.totalHrs"
                type="number"
                id="totalHrs"
                class="form-control"
              />
            </div>

            <div class="form-group">
              <label for="description">Date</label>
              <input
                v-model="student_swimming.date_time_usage"
                type="date"
                id="date_issued"
                class="form-control"
              />
              <br />
            </div>

            <div class="form-group">
              <label for="description">School Year</label>
              <input
                v-model="student_swimming.schoolyear"
                type="text"
                id="schoolyear"
                class="form-control"
              />
            </div>

            <div class="form-group">
              <label for="description">Semester</label>
              <select
                v-model="student_swimming.semester"
                name="semester"
                id="semester"
                class="form-control"
                tabindex="-1"
              >
                <option value="1" selected>First Semester</option>
                <option value="2" selected>Second Semester</option>
                <option value="3" selected>Summer</option>
              </select>
            </div>

            <div class="form-group">
              <label for="description">Amount</label>
              <input
                v-model="student_swimming.amount"
                type="text"
                id="amount"
                class="form-control"
              />
            </div>

          </div>
          <div class="modal-footer">
            <button
              @click="clear_errors"
              type="button"
              class="btn btn-danger"
              data-dismiss="modal"
            >Close</button>
            <button
              @click="create_student_swimming"
              type="button"
              class="btn btn-primary"
              :disabled="submitted"
            >Register Student Swimming</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  data() {
    return {
      employee_swimming: {
        employee_id_number: "",
        or_number: "",
        swimming_type: "",
        totalHrs: "",
        schoolyear: "",
        semester: "",
        date_time_usage: new Date().toISOString().slice(0, 10),
        amount: ""
      },

      student_swimming: {
        student_id_number: "",
        or_number: "",
        swimming_type: "",
        totalHrs: "",
        schoolyear: "",
        semester: "",
        date_time_usage: new Date().toISOString().slice(0, 10),
        amount: ""
      },

      employee_swimmings: [],
      student_swimmings: [],
      employee_names: [],
      student_names: [],
      pricings: [],
      vehicles: [],
      emp_vehicles: [],
      stud_vehicles: [],
      vehicle_make: [],
      url_employee_swimming: "https://ccfcis.addu.edu.ph/employee_swimming/",
      url_student_swimming: "https://ccfcis.addu.edu.ph/student_swimming/",
      url_emp_list: "https://ccfcis.addu.edu.ph/employee_names/",
      url_pricing: "https://ccfcis.addu.edu.ph/ccfc_pricing_1/",
      url_vehicle: "https://ccfcis.addu.edu.ph/ccfc_vehicles/",
      url_vehicle_process: "https://ccfcis.addu.edu.ph/ccfc_vehicles_process/",
      url_vehicle_make: "https://ccfcis.addu.edu.ph/ccfc_vehicle_make/",
      url_student_name: "https://ccfcis.addu.edu.ph/student_names",
      errors: [],
      type: "",
      current_month: new Date().getMonth(),
      current_year: new Date().getFullYear(),
      current_date: new Date().toISOString().slice(0, 10),
     // current_time = today.getHours() + ":" + today.getMinutes() + ":" + today.getSeconds(),
      //current_date: '2019-11-1',
      first_period_start: new Date().getFullYear() + "-06-01",
      first_period_end: new Date().getFullYear() + "-10-31",
      second_period_start: new Date().getFullYear() + "-11-1",
      second_period_end: new Date().getFullYear() + "-3-31",
      summer_period_start: new Date().getFullYear() + "4-1",
      summer_period_end: new Date().getFullYear() + "-5-31",
      semester: "",
      image: "img/loader1.gif",
      loading: false,
      submitted: false
    };
  },

  computed: {
    filtered_emp_vehicle() {
      const filtered = this.emp_vehicles.filter(item => {
        return Object.keys(this.filters).every(key =>
          String(item[key]).includes(this.filters[key])
        );
      });
      return filtered.length > 0
        ? filtered
        : [
            {
              emp_id: "",
              cfirst: "",
              clast: "",
              plate_number: ""
            }
          ];
    },

    filtered_stud_vehicle() {
      const filtered = this.stud_vehicles.filter(item => {
        return Object.keys(this.filters).every(key =>
          String(item[key]).includes(this.filters[key])
        );
      });
      return filtered.length > 0
        ? filtered
        : [
            {
              stud_id: "",
              firstname: "",
              lastname: "",
              plate_number: ""
            }
          ];
    },

    filtered_emp_parking() {
      const filtered_ep = this.employee_swimmings.filter(item => {
        return Object.keys(this.filters_ep).every(key =>
          String(item[key]).includes(this.filters_ep[key])
        );
      });
      return filtered_ep.length > 0
        ? filtered_ep
        : [
            {
              id_number: "",
              cfirst: "",
              clast: "",
              middle: "",
              semester: "",
              schoolyear: ""
            }
          ];
    },

    filtered_stud_parking() {
      const filtered_stud = this.student_swimmings.filter(item => {
        return Object.keys(this.filters_stud).every(key =>
          String(item[key]).includes(this.filters_stud[key])
        );
      });
      return filtered_stud.length > 0
        ? filtered_stud
        : [
            {
              id_number: "",
              firstname: "",
              lastname: "",
              middlename: "",
              semester: "",
              schoolyear: ""
            }
          ];
    },

    is_swimming_period() {
      if (
        this.current_date >= this.first_period_start &&
        this.current_date <= this.first_period_end
      ) {
        this.semester = 1;
        this.employee_swimming.semester = 1;
        this.employee_swimming.schoolyear = new Date().getFullYear();
        this.student_swimming.semester = 1;
        this.student_swimming.schoolyear = new Date().getFullYear();
      } else if (
        this.current_date >= this.second_period_start &&
        this.current_date <= this.second_period_end
      ) {

        if(this.current_month <= 5){
        this.semester = 2;
        this.employee_swimming.semester = 2;
        this.employee_swimming.schoolyear = new Date().getFullYear()-1;
        this.student_swimming.semester = 2;
        this.student_swimming.schoolyear = new Date().getFullYear()-1;
        console.log(this.current_month);
        }
        else if(this.current_month > 5){
        this.semester = 2;
        this.employee_swimming.semester = 2;
        this.employee_swimming.schoolyear = new Date().getFullYear();
        this.student_swimming.semester = 2;
        this.student_swimming.schoolyear = new Date().getFullYear();
        console.log(this.current_month);
        }
      } else if (
        this.current_date >= this.summer_period_start &&
        this.current_date <= this.summer_period_end
      ) {
        this.semester = 3;
        this.employee_swimming.semester = 3;
        this.employee_swimming.schoolyear = new Date().getFullYear() - 1;
        this.student_swimming.semester = 3;
        this.student_swimming.schoolyear = new Date().getFullYear() - 1;
      }
      this.semester = 2;
      this.employee_swimming.semester = 2;
      this.employee_swimming.schoolyear = new Date().getFullYear()-1;
      this.student_swimming.semester = 2;
      this.student_swimming.schoolyear = new Date().getFullYear()-1;

      return this.semester; // + ' ' + this.current_date + ' ' + this.summer_period_start
    },

    emp_rows() {
      return this.employee_swimmings.length;
    },

    stud_rows() {
      return this.student_swimmings.length;
    },

    emp_vehicles_rows() {
      return this.emp_vehicles.length;
    },

    stud_vehicles_rows() {
      return this.stud_vehicles.length;
    }
  },

  methods: {
    getOptions(search, loading) {
      loading(true);
      axios.get("https://ccfcis.addu.edu.ph/employee_names/");
    },

    employeeParkingModal() {
      $("#employee-swimming-modal").modal("show");
    },

    updateModal(index) {
      $("#employee-swimming-modal").modal("show");
    },

    studentParkingModal() {
      $("#student-swimming-modal").modal("show");
    },

    vehicleModal() {
      $("#vehicle-modal").modal("show");
    },

    create_employee_swimming() {
      this.submitted = true;
      axios
        .post("https://ccfcis.addu.edu.ph/employee_swimming", {
          employee_id_number: this.employee_swimming.employee_id_number,
          or_number: this.employee_swimming.or_number,
          swimming_type: this.employee_swimming.swimming_type,
          totalHrs: this.employee_swimming.totalHrs,
          schoolyear: this.employee_swimming.schoolyear,
          semester: this.employee_swimming.semester,
          date_time_usage: this.employee_swimming.date_time_usage,
          amount: this.employee_swimming.amount
        })

        .then(response => {
          this.resetData();
          this.submitted = false;
          this.employee_swimmings.push(response.data.employee_swimming);
          $("#employee-swimming-modal").modal("hide");
          //toastr.success(response.data.message);
          this.load_employee_swimming();
          this.makeToastEP(
            "success",
            response.data.message,
            "added",
            "Employee Swimming successfully "
          );
          this.errors = [];
        })

        .catch(error => {
          

          this.submitted = false;
        });
    },

    create_student_swimming() {
      this.submitted = true;

      axios
        .post("https://ccfcis.addu.edu.ph/student_swimming", {
          student_id_number: this.student_swimming.student_id_number,
          or_number: this.student_swimming.or_number,
          swimming_type: this.student_swimming.swimming_type,
          totalHrs: this.student_swimming.totalHrs,
          schoolyear: this.student_swimming.schoolyear,
          semester: this.student_swimming.semester,
          date_time_usage: this.student_swimming.date_time_usage,
          amount: this.student_swimming.amount
        })

        .then(response => {
          this.resetData();
          this.submitted = false;
          this.student_swimmings.push(response.data.student_swimming);
          $("#student-swimming-modal").modal("hide");
          this.load_student_swimming();
          this.makeToastEP(
            "success",
            response.data.message,
            "added",
            "Student Swimming successfully "
          );
        })
        .catch(error => {

          this.submitted = false;
        });
    },

    load_employee_swimming() {
      axios.get(this.url_employee_swimming).then(response => {
        this.employee_swimmings = response.data.employee_swimmings;
        this.loading = true;
      });
    },

    load_student_swimming() {
      axios.get(this.url_student_swimming).then(response => {
        this.student_swimmings = response.data.student_swimming;
      });
    },

    load_employee_names() {
      axios.get(this.url_emp_list).then(response => {
        this.employee_names = response.data.employee_names;
      });
    },

    load_student_names() {
      axios.get(this.url_student_name).then(response => {
        this.student_names = response.data.student_names;
      });
    },

    load_pricing() {
      axios.get(this.url_pricing).then(response => {
        this.pricings = response.data.pricings;
      });
    },

    resetData() {
      this.employee_swimming.employee_id_number = "";
      this.employee_swimming.or_number = "";
      this.employee_swimming.swimming_type = "";
      this.employee_swimming.totalHrs = "";
      this.employee_swimming.schoolyear = "";
      this.employee_swimming.semester = "";
      this.employee_swimming.date_time_usage = "";
      this.employee_swimming.amount = ""; 

      this.student_swimming.student_id_number = "";
      this.student_swimming.or_number = "";
      this.student_swimming.swimming_type = "";
      this.student_swimming.totalHrs = "";
      this.student_swimming.schoolyear = "";
      this.student_swimming.semester = "";
      this.student_swimming.date_time_usage = "";
      this.student_swimming.amount = ""; 

      
    },

    clear_errors() {
      this.errors = [];
    },

    makeToastEP(variant = null, message, processType, title) {
      this.$bvToast.toast(message, {
        title: title + processType + ".",
        variant: variant,
        autoHideDelay: 5000,
        solid: true
      });
    }
  },
  mounted() {
    this.load_employee_swimming();
    this.load_student_swimming();
    this.load_employee_names();
    this.load_student_names();
    this.load_pricing();
  }
};
</script>
