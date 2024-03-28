let url = new URL(window.location.origin);
let pathurl = window.location.pathname;
let a = url.origin;
// console.log(a);
let pathSegments = pathurl.split('/');
let sms = "/"+pathSegments[1];
// console.log("/" + sms);
let baseurl  = a + sms;
console.log(baseurl);


$(document).ready(function () {
  $("#recipientEmail").select2({
    maximumSelectionLength: 5,
  });
});

$(".list-unstyled.components li a").click(function () {
  $(".list-unstyled.components li a").removeClass("active-link");
  $(this).addClass("active-link");
});
$("#tbody").hide();
$("#notify").hide();
$("#allstudent").click(function (e) {
  e.preventDefault();
  $(".conntt").hide();
  $("#notify").hide();
  fetchData();
});
$("#dashboard").click(function (e) {
  e.preventDefault();
  $(".conntt").show();
  $("#tbody").hide();
  $("#notify").hide();
});
$("#notification").click(function (e) {
  e.preventDefault();
  $("#tbody").hide();
  $(".conntt").hide();
  fetchNotificationsData();
});
$(document).on("click", ".deleterecode", function () {
  let id = $(this).attr("data-id");
  del(id);
});
$(document).on("click", ".updateStatus", function () {
  let val = $(this).attr("data-value");
  let id = $(this).attr("data-id");
  console.log(val);
  updateStatus(id, val);
});
$(document).on("click", ".updateapprove", function () {
  let val = $(this).attr("data-value");
  let id = $(this).attr("data-id");
  console.log(val);
  updateapprove(id, val);
});

async function fetchData() {
  let res = await fetch(
    "http://localhost/student_management_system/Controllers/Admin/AllStudent.php"
  );
  let data = await res.json();
  display(data);
}
function display(data) {
  str = "";
  for (let x in data) {
    if (data[x]["firstname"] == "admin") {
      continue;
    }
    str +=
      `<tr id="roww"> 
    <td><img src="./../../Public/uploads/${data[x]["profile"]}" style="width: 50px; height: 50px;"/></td>
    <td>${data[x]["firstname"]} ${data[x]["lastname"]}</td>
    <td>${data[x]["phonenumber"]}</td>
    <td>${data[x]["gender"]}</th>
    <td>` +
      `${
        data[x]["status"] == "active"
          ? `<label class="switch"><input type="checkbox" class="updateStatus" data-id="${data[x]["id"]}" data-value="deactive" checked><span class="slider round"></span></label>`
          : `<label class="switch"><input type="checkbox" class="updateStatus" data-value="active" data-id="${data[x]["id"]}"><span class="slider round"></span></label>`
      }` +
      `</td>
    <td>${
      data[x]["is_varified"] == "true"
        ? `<div>&#9989;</div>`
        : `<divdata-value="1" data-id="${data[x]["id"]}">&#10060;</div>`
    }</td>
    <td>` +
      `${
        data[x]["is_approved"] == "true"
          ? `<div id="approvebtn" class="btn">Approved</div>`
          : `<div class="btn btn-warning updateapprove" data-value="1" data-id="${data[x]["id"]}">Approve</div>`
      }` +
      `</td>
      <td><div class="btn btn-danger deleterecode" data-id="${data[x]["id"]}">Delete</div></td>
    </tr>`;
  }

  $("#tbody").show();
  $("tbody").html(str);
  if (!$.fn.DataTable.isDataTable("#myTable")) {
    $("#myTable").DataTable({
      aoColumnDefs: [{ orderable: false, targets: [0] }],
      order: [[1, "asc"]],
    });
  }

  // $("table#myTable tr:first-child th:first-child").hide();

  // $("table#myTable td:nth-child(1)").hide();
}

async function fetchNotificationsData() {
  try {
    let res = await fetch(
      "http://localhost/student_management_system/Controllers/Admin/Notification.php"
    );
    let notificationData = await res.json();
    displayNotifications(notificationData);
  } catch (error) {
    console.error("Error fetching notifications data:", error);
  }
}

function displayNotifications(notificationData) {
  let str = "";
  for (let x in notificationData) {
    str += `<tr id="row"> 
      <td>${notificationData[x]["emails"]}</td>
      <td>${notificationData[x]["subject"]}</td>
      <td><a id="showPopup" class="btn btn-info">Show</a></td>
    </tr>`;
  }
  $("#notify").show();
  $("tbody").html(str);
  $("#myTab").DataTable();
}

async function del(id) {
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, delete it!",
  }).then(async (result) => {
    if (result.isConfirmed) {
      let res = await fetch(
        "http://localhost/student_management_system/Controllers/Admin/DeleteStudent.php?id=" +
          id
      );
      let data = await res.json();
      fetchData();
      Swal.fire({
        title: "Deleted!",
        text: "Record has been deleted.",
        icon: "success",
      });
    }
  });
}
async function updateStatus(id, value) {
  Swal.fire({
    title: "Are you sure?",
    text: "You won't be able to revert this!",
    icon: "warning",
    showCancelButton: true,
    confirmButtonColor: "#3085d6",
    cancelButtonColor: "#d33",
    confirmButtonText: "Yes, change it!",
  }).then(async (result) => {
    if (result.isConfirmed) {
      let res = await fetch(
        "http://localhost/student_management_system/Controllers/Admin/UpdateStatus.php?id=" +
          id +
          "&value=" +
          value
      );
      let data = await res.json();
      fetchData();
      Swal.fire({
        title: "Changed!",
        text: "record has been Changed.",
        icon: "success",
      });
    }
  });
  fetchData();
}
async function updateapprove(id, value) {
  let res = await fetch(
    "http://localhost/student_management_system/Controllers/Admin/UpdateApprove.php?id=" +
      id +
      "&value=" +
      value
  );
  let data = await res.json();
  fetchData();
}

// Function to load popup content from database
function loadPopupContent() {
  var content = `
      <h2>Popup Content</h2>
      <table>
          <tr>
              <th>ID</th>
              <th>Email</th>
              <th>Subject</th>
              <th>Message</th>
          </tr>
          <tr>
              <td>1</td>
              <td>example@example.com</td>
              <td>Example Subject</td>
              <td>Example Message</td>
          </tr>
      </table>
  `;
  document.getElementById("popupContent").innerHTML = content;
}

// // Event listener for the Show button
// document.getElementById('showPopup').addEventListener('click', function(event) {
//   event.preventDefault();
//   document.getElementById('popupContainer').style.display = 'block';
//   loadPopupContent();
// });

// // Close popup when clicking outside the content
// document.getElementById('popupContainer').addEventListener('click', function(event) {
//   if (event.target === this) {
//       this.style.display = 'none';
//   }
// });
