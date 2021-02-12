<template>
  <div class="container-fluid">
    <div class="row">
      <div
        class="col-2"
        style="background-color: #0177fb; height: 100vh; overflow-y: scroll"
      >
        <div class="form-group mt-3">
          <input
            type="file"
            class="form-control"
            :class="{ ' is-invalid': error.message }"
            id="input-file-import"
            name="file_import"
            ref="import_file"
            @change="onFileChange"
          />
          <div v-if="error.message" class="invalid-feedback"></div>
          <button
            class="btn btn-outline-light mt-3"
            type="button"
            style="width: 100%;"
            @click="proceedAction"
          >
            Upload
          </button>
        </div>
        <div class="row mt-3">
          <div class="col-12">
            <button
              class="btn btn-light mt-3 text-primary"
              :disabled="loading || empty"
              style="width: 100%; text-align: left;"
              @click="makeContactsFile"
            >
              <i class="fa fa-user"></i>
              &nbsp; Contacts
            </button>
            <button
              class="btn btn-light mt-3 text-primary"
              style="width: 100%; text-align: left;"
              @click="list = !list"
            >
              <i class="fa fa-th" v-if="!list"></i>
              <i class="fa fa-list" v-if="list"></i>
              &nbsp;
              <span v-if="list">List</span>
              <span v-if="!list">Table</span>
            </button>
            <button
              class="btn btn-light mt-3 text-primary"
              style="width: 100%; text-align: left;"
              @click="printSection"
            >
              <i class="fa fa-print"></i>
              &nbsp; Print
            </button>
            <div class="form-group">
              <input
                type="text"
                class="form-control mt-3"
                placeholder="First Name"
                v-model="new_first_name"
              />
              <input
                type="text"
                class="form-control mt-3"
                placeholder="Last Name"
                v-model="new_last_name"
              />
              <input
                type="number"
                class="form-control mt-3"
                placeholder="Phone Number"
                maxlength="10"
                v-model="new_phone_number"
              />
              <button
                class="btn btn-light mt-3 text-primary"
                style="width: 100%;"
                @click="store"
              >
                <i class="fa fa-plus"></i>
                &nbsp; Add
              </button>
              <select class="form-control mt-3" name="" @change="loadPreviousStudents" placeholder="Previous Classes">
                <option disabled>Select a Class</option>
                <option v-for="record in records" :value="record.id">{{record.date}}</option>
              </select>
              <a class="btn btn-light text-primary mt-3" style="width: 100%;" href="/logout">
                <i class="fa fa-power-off"></i>
                logout
              </a>
              <Timer />
            </div>
          </div>
        </div>
      </div>
      <div
        class="col-8"
        style="height: 100vh; overflow-y: scroll"
        id="printSection"
        v-if="list"
      >
        <div class="input-group">
          <input
            type="text"
            placeholder="First name"
            class="form-control mt-3 mb-3"
            v-model="first_name"
          />
          <input
            type="text"
            placeholder="Last name"
            class="form-control mt-3 mb-3"
            v-model="last_name"
          />
          <input
            type="number"
            placeholder="Score"
            class="form-control mt-3 mb-3"
            disabled
            :value="
              (score =
                task_completion +
                comprehensibility +
                fluency +
                vocabulary +
                language_control)
            "
          />
          <button
            class="btn btn-primary form-control mt-3 mb-3"
            :disabled="loading || empty"
            @click="save"
          >
            Save
          </button>
          <table class="table table-bordered mb-0 change">
            <tr>
              <td>{{first_name == "" ? 'First Name' : first_name}}</td>
              <td>{{last_name == "" ? 'Last Name' : last_name}}</td>
              <td>{{(score =
                task_completion +
                comprehensibility +
                fluency +
                vocabulary +
                language_control)}}</td>
            </tr>
          </table>
        </div>
        <table class="table table-bordered text-center">
          <tr class="hide">
            <td colspan="5">
              <h3>Speaking Rubric</h3>
            </td>
          </tr>
          <tr>
            <td></td>
            <td style="background-color: #ddd">
              <b>Advanced(4)</b>
            </td>
            <td style="background-color: #ddd">
              <b>Proficient(3)</b>
            </td>
            <td style="background-color: #ddd">
              <b>Basic(2)</b>
            </td>
            <td style="background-color: #ddd">
              <b>Below Basic(1)</b>
            </td>
          </tr>
          <tr>
            <td style="background-color: #ddd">
              <b>Task Completion</b>
            </td>
            <td
              class="count"
              v-for="item in info.task_completion"
              @click="taskCompletion(item)"
              :style="{ 'background-color': item.bgcolor }"
              :key="item.id"
            >
              {{ item.text }}
            </td>
          </tr>
          <tr>
            <td style="background-color: #ddd">
              <b>Comprehensibility</b>
            </td>
            <td
              class="count"
              v-for="item in info.comprehensibility"
              @click="Comprehensibility(item)"
              :style="{ 'background-color': item.bgcolor }"
              :key="item.id"
            >
              {{ item.text }}
            </td>
          </tr>
          <tr>
            <td style="background-color: #ddd">
              <b>Fluency</b>
            </td>
            <td
              class="count"
              v-for="item in info.fluency"
              @click="Fluency(item)"
              :style="{ 'background-color': item.bgcolor }"
              :key="item.id"
            >
              {{ item.text }}
            </td>
          </tr>
          <tr>
            <td style="background-color: #ddd">
              <b>Vocabulary</b>
            </td>
            <td
              class="count"
              v-for="item in info.vocabulary"
              @click="Vocabulary(item)"
              :style="{ 'background-color': item.bgcolor }"
              :key="item.id"
            >
              {{ item.text }}
            </td>
          </tr>
          <tr>
            <td style="background-color: #ddd">
              <b>Language Control</b>
            </td>
            <td
              class="count"
              v-for="item in info.language_control"
              @click="languageControl(item)"
              :style="{ 'background-color': item.bgcolor }"
              :key="item.id"
            >
              {{ item.text }}
            </td>
          </tr>
          <tr>
            <td colspan="5">
              <textarea
                placeholder="Comments:"
                style="width: 100%"
                v-model="comment"
              ></textarea>
            </td>
          </tr>
        </table>
      </div>
      <div
        class="col-8 pt-3"
        style="height: 100vh; overflow-y: scroll"
        v-else
        id="printSection"
      >
        <table class="table table-bordered">
          <tr>
            <th>#</th>
            <th>Name</th>
            <th>Last name</th>
            <th>Score</th>
          </tr>
          <tr v-for="(student, index) in students" :key="student.id" :style="student.score == 0 ? 'background-color: pink;' : student.score < 15 ? 'background-color: yellow;': 'background-color: white;'">
            <td>{{ index + 1 }}</td>
            <td>{{ student.first_name }}</td>
            <td>{{ student.last_name }}</td>
            <td>{{ student.score }}</td>
          </tr>
        </table>
        <div class="text-center" v-if="students.length === 0">
          <i class="fa fa-th" style="font-size: 50px; margin-top: 40vh"></i>
        </div>
      </div>
      <div class="col-2 pb-3" style="background-color: #0177fb">
        <div class="row">
          <div class="col-12 pb-3" style="height: 100vh; overflow-y: scroll">
            <div class="row">
              <div class="col-9">
                <form @submit.prevent="search">
                  <div class="form-group pt-3">
                    <input
                      type="search"
                      class="form-control"
                      placeholder="Search"
                      :disabled="loading || empty"
                      v-model="search_text"
                    />
                  </div>
                </form>
              </div>
              <div class="col-3 pt-3">
                <button
                  class="btn btn-light text-primary"
                  @click="loadStudents"
                >
                  <i class="fa fa-undo"></i>
                </button>
              </div>
              <div class="col-6">
                <button
                  class="btn btn-light mt-3"
                  style="width: 100%"
                  :disabled="loading || empty"
                  @click="selectAll"
                >
                  <i class="fa fa-check-square-o"></i>
                  All
                </button>
              </div>
              <div class="col-6">
                <button
                  class="btn btn-danger mt-3"
                  style="width: 100%"
                  :disabled="loading || empty"
                  @click="deleteStudent"
                >
                  <i class="fa fa-trash"></i>
                  Delete
                </button>
              </div>
              <div class="col-12">
                <div
                  class="mt-3 btn-group"
                  style="width: 100%"
                  role="group"
                  aria-label="Basic example"
                  v-for="student in students"
                  :key="student.id"
                >
                  <button
                    type="button"
                    class="btn btn-light"
                    style="width: 15%"
                  >
                    <input type="checkbox" v-model="student.selected" />
                  </button>
                  <button
                    :class="
                      student.scored ? 'btn btn-light' : 'btn btn-outline-light'
                    "
                    style="text-align: left; width: 85%"
                    @click="show(student)"
                  >
                    {{ student.first_name }} {{ student.last_name }}
                  </button>
                  <button class="btn btn-light" @click="undo(student)">
                    <i class="fa fa-undo text-primary"></i>
                  </button>
                </div>
              </div>
              <div class="text-center">
                <i
                  class="fa fa-th text-white"
                  style="font-size: 50px; margin-top: 30vh"
                  v-if="empty"
                ></i>
                <i
                  class="fa fa-undo fa-spin text-white"
                  style="font-size: 50px; margin-top: 30vh"
                  v-if="loading"
                ></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import axios from "axios";
import Timer from "./Timer";

export default {
  data() {
    return {
      students: [],
      records: [],
      list: true,
      error: {},
      import_file: "",
      id: 0,
      first_name: "",
      last_name: "",
      score: 0,
      task_completion: 0,
      comprehensibility: 0,
      fluency: 0,
      vocabulary: 0,
      language_control: 0,
      comment: "",
      new_first_name: "",
      new_last_name: "",
      new_phone_number: "",
      search_text: "",
      info: window.info,
      loading: true,
      empty: false,
    };
  },
  components: {
    Timer,
  },
  mounted() {
    this.loadStudents();
    this.loadRecords();
  },
  methods: {
    loadStudents() {
      this.loading = true;
      this.empty = false;
      axios.get("/students").then((response) => {
        this.students = response.data;
        this.loading = false;
        if (this.students.length === 0) {
          this.empty = true;
        }
      });
    },
    show(student) {
      this.id = student.id;
      this.first_name = student.first_name;
      this.last_name = student.last_name;
      this.task_completion = student.task_completion;
      this.comprehensibility = student.comprehensibility;
      this.fluency = student.fluency;
      this.vocabulary = student.vocabulary;
      this.language_control = student.language_control;
      this.comment = student.comment;
      for (let i = 0; i < 4; i++) {
        if (student.task_completion === this.info.task_completion[i].score) {
          this.info.task_completion[i].bgcolor = "#90ed90";
        } else {
          this.info.task_completion[i].bgcolor = "#fff";
        }
        if (
          student.comprehensibility === this.info.comprehensibility[i].score
        ) {
          this.info.comprehensibility[i].bgcolor = "#90ed90";
        }else{
          this.info.comprehensibility[i].bgcolor = "#fff";
        }
        if (student.fluency === this.info.fluency[i].score) {
          this.info.fluency[i].bgcolor = "#90ed90";
        }else{
          this.info.fluency[i].bgcolor = "#fff";
        }
        if (student.vocabulary === this.info.vocabulary[i].score) {
          this.info.vocabulary[i].bgcolor = "#90ed90";
        }else{
          this.info.vocabulary[i].bgcolor = "#fff";
        }
        if (student.language_control === this.info.language_control[i].score) {
          this.info.language_control[i].bgcolor = "#90ed90";
        }else{
          this.info.language_control[i].bgcolor = "#fff";
        }
      }
      console.log(this.info);
    },
    selectAll() {
      for (let i = 0; i < this.students.length; i++) {
        this.students[i].selected = true;
      }
    },
    save() {
      axios
        .put("/students/" + this.id, {
          first_name: this.first_name,
          last_name: this.last_name,
          task_completion: this.task_completion,
          comprehensibility: this.comprehensibility,
          fluency: this.fluency,
          vocabulary: this.vocabulary,
          language_control: this.language_control,
          score: this.score,
          comment: this.comment,
        })
        .then((response) => {
          this.loadStudents();
          console.log(response);
        });
    },
    store() {
      this.loading = true;
      axios
        .post("/students", {
          first_name: this.new_first_name,
          last_name: this.new_last_name,
          active_whatsapp_number: this.new_phone_number,
        })
        .then((response) => {
          this.loadStudents();
          this.new_first_name = "";
          this.new_last_name = "";
          this.new_phone_number = "";
          console.log(response);
          this.loading = false;
        });
    },
    deleteStudent() {
      for (let i = 0; i < this.students.length; i++) {
        if (this.students[i].selected) {
          axios.delete("/students/" + this.students[i].id).then((response) => {
            this.loadStudents();
            console.log(response);
          });
        }
      }
    },
    search() {
      axios.get("/search/" + this.search_text).then((response) => {
        this.students = response.data;
      });
    },
    undo(student) {
      axios
        .post("/undo/" + student.id)
        .then((response) => {
          this.loadStudents();
        })
        .catch((error) => {});
    },
    printSection() {
      this.$htmlToPaper("printSection");
    },
    onFileChange(e) {
      this.import_file = e.target.files[0];
    },
    proceedAction() {
      let formData = new FormData();
      formData.append("import_file", this.import_file);

      axios
        .post("/students/import", formData, {
          headers: { "content-type": "multipart/form-data" },
        })
        .then((response) => {
          if (response.status === 200) {
            // codes here after the file is upload successfully
            this.loadStudents();
          }
        })
        .catch((error) => {
          // code here when an upload is not valid
          this.uploading = false;
          this.error = error.response.data;
          console.log("check error: ", this.error);
        });
    },
    taskCompletion(args) {
      for (let i = 0; i < 4; i++) {
        if (this.info.task_completion[i].row === args.row) {
          if (this.info.task_completion[i].id === args.id) {
            if (this.info.task_completion[i].bgcolor === "#fff") {
              this.info.task_completion[i].bgcolor = "#90ed90";
              this.task_completion = args.score;
            }
          } else {
            this.info.task_completion[i].bgcolor = "#fff";
          }
        }
      }
    },
    Comprehensibility(args) {
      for (let i = 0; i < 4; i++) {
        if (this.info.comprehensibility[i].row === args.row) {
          if (this.info.comprehensibility[i].id == args.id) {
            if (this.info.comprehensibility[i].bgcolor === "#fff") {
              this.info.comprehensibility[i].bgcolor = "#90ed90";
              this.comprehensibility = args.score;
            }
          } else {
            this.info.comprehensibility[i].bgcolor = "#fff";
          }
        }
      }
    },
    Fluency(args) {
      for (let i = 0; i < 4; i++) {
        if (this.info.fluency[i].row === args.row) {
          if (this.info.fluency[i].id == args.id) {
            if (this.info.fluency[i].bgcolor === "#fff") {
              this.info.fluency[i].bgcolor = "#90ed90";
              this.fluency = args.score;
            }
          } else {
            this.info.fluency[i].bgcolor = "#fff";
          }
        }
      }
    },
    Vocabulary(args) {
      for (let i = 0; i < 4; i++) {
        if (this.info.vocabulary[i].row === args.row) {
          if (this.info.vocabulary[i].id == args.id) {
            if (this.info.vocabulary[i].bgcolor === "#fff") {
              this.info.vocabulary[i].bgcolor = "#90ed90";
              this.vocabulary = args.score;
            }
          } else {
            this.info.vocabulary[i].bgcolor = "#fff";
          }
        }
      }
    },
    languageControl(args) {
      for (let i = 0; i < 4; i++) {
        if (this.info.language_control[i].row === args.row) {
          if (this.info.language_control[i].id == args.id) {
            if (this.info.language_control[i].bgcolor === "#fff") {
              this.info.language_control[i].bgcolor = "#90ed90";
              this.language_control = args.score;
            }
          } else {
            this.info.language_control[i].bgcolor = "#fff";
          }
        }
      }
    },
    makeContactsFile() {
      let whole = "";
      for (let i = 0; i < this.students.length; i++) {
        whole =
          whole +
          "BEGIN:VCARD\nVERSION:2.1\nN:" +
          this.students[i].last_name +
          ";" +
          this.students[i].first_name +
          ";;;\nFN:" +
          this.students[i].first_name +
          " " +
          this.students[i].last_name +
          "\nTEL;CELL:" +
          this.students[i].active_whatsapp_number +
          "\nEND:VCARD\n";
      }
      var vm = this,
        text = "hello world",
        blob = new Blob([whole], { type: "vcf/plain" }),
        anchor = document.createElement("a");

      anchor.download = _.kebabCase("Contacts") + ".vcf";
      anchor.href = (window.webkitURL || window.URL).createObjectURL(blob);
      anchor.dataset.downloadurl = [
        "text/plain",
        anchor.download,
        anchor.href,
      ].join(":");
      anchor.click();
    },
    score() {
      this.score =
        this.task_completion +
        this.comprehensibility +
        this.fluency +
        this.vocabulary +
        this.language_control;
    },
    loadRecords(){
      axios.get('/records').then(response => {
        this.records = response.data;
      })
    },
    loadPreviousStudents(record){
      axios.get('/students/' + record.target.value).then(response => {
        this.students = response.data;
      })
    }
  },
};
</script>

<style scoped>
.count {
  cursor: pointer;
}

.count:hover {
  background-color: #90ed90;
}
</style>
