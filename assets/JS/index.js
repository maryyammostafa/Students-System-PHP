let currentPage = 1;

$("form.search").submit(function (e) {
    e.preventDefault();
    let data = new FormData(this);
    $.ajax({
        url: "backend/search.php",
        type: "POST",
        data: data,
        success: function (response) {
            if (response.total == 0) {
                $("tbody").html("");
                $(".pagination").html("");
                Swal.fire({
                    icon: "info",
                    title: "Not Found",
                    text: "No students found."
                });
                return;
            }
            currentPage = 1;
            showStudents(response.students);
            updatePagination(response.total,currentPage);
        },
        error: function (error) {
            Swal.fire({
                icon: "error",
                title: "ERROR!!",
                text: error['responseJSON']['message'],
            });
        }
    });
});

function showStudents(students) {
    $("tbody").html("");
    let tbody = "";
    for (let i = 0; i < students.length; i++) {
        tbody += `
            <tr data-id='${students[i]['id']}'>
                <th>${students[i]['id']}</th>
                <td>${students[i]['first_name']} ${students[i]['last_name']}</td>
                <td>${students[i]['email']}</td>
                <td>${students[i]['password'].slice(0, 15)}...</td>
                <td>${students[i]['age']}</td>
                <td>${students[i]['phone']}</td>
                <td>
                    <a href='edit.php?studentId=${students[i]['id']}' class='btn btn-info text-light me-2 edit'>Edit</a>
                    <button class='btn btn-primary me-2 undo d-none'>Undo</button>
                    <button class='btn btn-danger delete' onclick='deleteStudent(${students[i]['id']})'>Delete</button>
                </td>
            </tr>`;
    }

    $("tbody").html(tbody);
}

function updatePagination(total,currPage) {
    $(".pagination").html("");
    if (total == 0)
        return;
    let li = "",
        number = Math.ceil(total/10);
    for (let i = 0; i <= number+1; i++) {
        if(i==0){
            let isDisabled = (currPage == 1) ? 'disabled' : '',
                previous = (currPage == 1) ? 1 : currPage-1;
            li += `<li class='page-item'><a class='page-link ${isDisabled}' onclick='changePage(${previous})'>Previous</a></li>`;
        }else if(i==number+1){
            let isDisabled = (currPage == number) ? 'disabled' : '',
                next = (currPage == number) ? number : currPage+1;
            li += `<li class='page-item'><a class='page-link ${isDisabled}' onclick='changePage(${next})'>Next</a></li>`;
        }else{
            let isActive = (i == currPage) ? 'active' : '';
            li += `<li class='page-item'><a class='page-link ${isActive}' onclick='changePage(${i})'>${i}</a></li>`;
        }
    }

    $(".pagination").html(li);
}

function changePage(page) {
    let search = $("form.search input").val();

    $.ajax({
        url: "backend/search.php",
        type: "POST",
        data: {
            search: search,
            page: page
        },
        success: function (response) {
            if (response.total == 0) {
                $("tbody").html("");
                $(".pagination").html("");
                Swal.fire({
                    icon: "info",
                    title: "Not Found",
                    text: "No students found."
                });
                return;
            }
            currentPage = page;
            showStudents(response.students);
            updatePagination(response.total,currentPage);
        },
        error: function (error) {
            console.log(error);
        }
    });
}

function deleteStudent(id) {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be able to revert this!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.isConfirmed) {
            let search = $("form.search input").val(),
                data = {
                    studentId: id,
                    search: search,
                    page: currentPage
                };
            $.ajax({
                url: "backend/delete.php",
                type: "POST",
                data: data,
                dataType: "json",
                success: function (response) {
                    currentPage = response.page;
                    showStudents(response.students);
                    updatePagination(response.total, currentPage);
                    Swal.fire({
                        title: "Deleted!",
                        text: "Student has been deleted.",
                        icon: "success"
                    });
                },
                error: function (error) {
                    console.log(error);
                    Swal.fire({
                        icon: "error",
                        title: "ERROR!!",
                        text: error['responseJSON']['message'],
                    });
                }
            });
        }
    });
}

function togglePassword(that) {
    let input = $(that).closest(".input-group").find("input.password");
    if (input.attr("type") === "password") {
        input.attr("type", "text");
        $(that).removeClass("fa-eye").addClass("fa-eye-slash");
    } else {
        input.attr("type", "password");
        $(that).removeClass("fa-eye-slash").addClass("fa-eye");
    }
}
function toggleEye(that) {
    if ($(that).val() === ""){
        $(that).next(".eye").children().hide();}
    else
        $(that).next(".eye").children().show();
}
$(".form-control").on("input", function () {
    let error;
    if ($(this).hasClass("password"))
        error = $(this).closest(".input-group").children().last();
    else
        error = $(this).next();
    if (error.length)
        error.text("");
});